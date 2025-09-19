<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Payment;
use App\Models\PromoCode;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Create a Stripe Checkout Session for appointment payment
     */
    public function createCheckoutSession(Appointment $appointment, $promoCode = null)
    {
        try {
            $finalAmount = $appointment->calculateFinalAmount($promoCode);
            
            // If final amount is 0 (free with promo code), don't create Stripe session
            if ($finalAmount <= 0) {
                return $this->handleFreeAppointment($appointment, $promoCode);
            }

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => "Immigration Consultation - {$appointment->enquiry_type_display}",
                            'description' => "Appointment for {$appointment->full_name} on {$appointment->appointment_datetime->format('M d, Y g:i A')}",
                        ],
                        'unit_amount' => $finalAmount * 100, // Convert to cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payments.success', ['appointment' => $appointment->id]) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payments.cancel', ['appointment' => $appointment->id]),
                'metadata' => [
                    'appointment_id' => $appointment->id,
                    'promo_code' => $promoCode ?? '',
                ],
            ]);

            // Create payment record
            $payment = Payment::create([
                'appointment_id' => $appointment->id,
                'stripe_session_id' => $session->id,
                'stripe_payment_intent_id' => $session->payment_intent,
                'amount' => $appointment->getPrice(),
                'currency' => 'usd',
                'status' => 'pending',
                'promo_code' => $promoCode,
                'discount_amount' => $appointment->getPrice() - $finalAmount,
                'final_amount' => $finalAmount,
            ]);

            return [
                'success' => true,
                'session_id' => $session->id,
                'url' => $session->url,
                'payment_id' => $payment->id,
            ];

        } catch (ApiErrorException $e) {
            Log::error('Stripe API Error: ' . $e->getMessage(), [
                'appointment_id' => $appointment->id,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => 'Payment processing error. Please try again.',
            ];
        } catch (\Exception $e) {
            Log::error('Payment Service Error: ' . $e->getMessage(), [
                'appointment_id' => $appointment->id,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => 'An unexpected error occurred. Please try again.',
            ];
        }
    }

    /**
     * Handle free appointment (with promo code making it free)
     */
    private function handleFreeAppointment(Appointment $appointment, $promoCode = null)
    {
        // Create payment record with $0 amount
        $payment = Payment::create([
            'appointment_id' => $appointment->id,
            'stripe_payment_intent_id' => 'free_' . uniqid(),
            'amount' => $appointment->getPrice(),
            'currency' => 'usd',
            'status' => 'succeeded',
            'promo_code' => $promoCode,
            'discount_amount' => $appointment->getPrice(),
            'final_amount' => 0,
            'paid_at' => now(),
        ]);

        // Update appointment
        $appointment->update([
            'is_paid' => true,
            'amount' => $appointment->getPrice(),
            'promo_code' => $promoCode,
            'discount_amount' => $appointment->getPrice(),
            'final_amount' => 0,
            'status' => 'confirmed',
            'confirmed_at' => now(),
        ]);

        // Mark promo code as used if applicable
        if ($promoCode) {
            $promo = PromoCode::where('code', $promoCode)->first();
            if ($promo) {
                $promo->markAsUsedBy($appointment->user_id);
            }
        }

        return [
            'success' => true,
            'free' => true,
            'payment_id' => $payment->id,
        ];
    }

    /**
     * Handle successful payment
     */
    public function handleSuccessfulPayment($sessionId)
    {
        try {
            $session = Session::retrieve($sessionId);
            $paymentIntent = PaymentIntent::retrieve($session->payment_intent);

            $payment = Payment::where('stripe_session_id', $sessionId)->first();
            
            if (!$payment) {
                throw new \Exception('Payment record not found');
            }

            // Update payment record
            $payment->update([
                'status' => 'succeeded',
                'payment_method' => $paymentIntent->charges->data[0]->payment_method_details->type ?? 'card',
                'stripe_metadata' => $paymentIntent->metadata->toArray(),
                'paid_at' => now(),
            ]);

            // Update appointment
            $appointment = $payment->appointment;
            $appointment->update([
                'is_paid' => true,
                'amount' => $payment->amount,
                'promo_code' => $payment->promo_code,
                'discount_amount' => $payment->discount_amount,
                'final_amount' => $payment->final_amount,
                'status' => 'confirmed',
                'confirmed_at' => now(),
            ]);

            // Mark promo code as used if applicable
            if ($payment->promo_code) {
                $promo = PromoCode::where('code', $payment->promo_code)->first();
                if ($promo) {
                    $promo->markAsUsedBy($appointment->user_id);
                }
            }

            return [
                'success' => true,
                'appointment' => $appointment,
                'payment' => $payment,
            ];

        } catch (ApiErrorException $e) {
            Log::error('Stripe API Error in payment success: ' . $e->getMessage());
            return ['success' => false, 'error' => 'Payment verification failed'];
        } catch (\Exception $e) {
            Log::error('Payment success handling error: ' . $e->getMessage());
            return ['success' => false, 'error' => 'Payment processing failed'];
        }
    }

    /**
     * Handle cancelled payment
     */
    public function handleCancelledPayment($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        
        if ($appointment) {
            $appointment->update(['status' => 'cancelled']);
        }

        return ['success' => true];
    }

    /**
     * Refund payment
     */
    public function refundPayment(Payment $payment, $reason = null)
    {
        try {
            if ($payment->final_amount <= 0) {
                // Free appointment, just mark as refunded
                $payment->refund($reason);
                return ['success' => true];
            }

            $refund = \Stripe\Refund::create([
                'payment_intent' => $payment->stripe_payment_intent_id,
                'reason' => 'requested_by_customer',
                'metadata' => [
                    'appointment_id' => $payment->appointment_id,
                    'refund_reason' => $reason,
                ],
            ]);

            $payment->refund($reason);

            return [
                'success' => true,
                'refund_id' => $refund->id,
            ];

        } catch (ApiErrorException $e) {
            Log::error('Stripe refund error: ' . $e->getMessage());
            return ['success' => false, 'error' => 'Refund failed'];
        }
    }
}
