<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Payment;
use App\Models\PromoCode;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Show payment form for appointment
     */
    public function show(Appointment $appointment)
    {
        // Check if appointment requires payment
        if (!$appointment->requiresPayment()) {
            return redirect()->route('appointment.success', $appointment)
                ->with('info', 'This appointment does not require payment.');
        }

        $pricing = Appointment::getPricing();
        $baseAmount = $appointment->getPrice();
        
        return view('appointments.payment.show', compact('appointment', 'pricing', 'baseAmount'));
    }

    /**
     * Process payment request
     */
    public function process(Request $request, Appointment $appointment)
    {
        $validator = Validator::make($request->all(), [
            'promo_code' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $promoCode = $request->input('promo_code');
        
        // Validate promo code if provided
        if ($promoCode) {
            $promo = PromoCode::findValid($promoCode, $appointment->enquiry_type, $appointment->getPrice());
            if (!$promo) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or expired promo code.',
                ], 422);
            }
        }

        // Create payment session
        $result = $this->paymentService->createCheckoutSession($appointment, $promoCode);

        if ($result['success']) {
            if (isset($result['free']) && $result['free']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Appointment confirmed! Your promo code made this appointment free.',
                    'redirect' => route('payments.success', $appointment)
                ]);
            }

            return response()->json([
                'success' => true,
                'redirect_url' => $result['url']
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $result['error']
        ], 500);
    }

    /**
     * Handle successful payment
     */
    public function success(Request $request, Appointment $appointment)
    {
        $sessionId = $request->get('session_id');
        
        if ($sessionId) {
            $result = $this->paymentService->handleSuccessfulPayment($sessionId);
            
            if (!$result['success']) {
                return redirect()->route('payments.cancel', $appointment)
                    ->with('error', 'Payment verification failed. Please contact support.');
            }
        }

        return view('appointments.payment.success', compact('appointment'));
    }

    /**
     * Handle cancelled payment
     */
    public function cancel(Appointment $appointment)
    {
        $this->paymentService->handleCancelledPayment($appointment->id);
        
        return view('appointments.payment.cancel', compact('appointment'));
    }

    /**
     * Validate promo code
     */
    public function validatePromoCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'promo_code' => 'required|string|max:50',
            'enquiry_type' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid input',
                'errors' => $validator->errors()
            ], 422);
        }

        $promo = PromoCode::findValid(
            $request->promo_code,
            $request->enquiry_type,
            $request->amount,
            auth()->id()
        );

        if (!$promo) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired promo code.',
            ]);
        }

        $discountAmount = $promo->calculateDiscount($request->amount);
        $finalAmount = max(0, $request->amount - $discountAmount);

        return response()->json([
            'success' => true,
            'promo_code' => $promo->code,
            'discount_amount' => $discountAmount,
            'final_amount' => $finalAmount,
            'is_free' => $finalAmount <= 0,
            'message' => $finalAmount <= 0 
                ? 'Congratulations! This promo code makes your appointment free!' 
                : "You saved \${$discountAmount} with this promo code!"
        ]);
    }

    /**
     * Show payment details (admin)
     */
    public function showPayment(Appointment $appointment)
    {
        $payment = $appointment->payment;
        
        if (!$payment) {
            return redirect()->back()->with('error', 'No payment found for this appointment.');
        }

        return view('appointments.admin.payment-show', compact('appointment', 'payment'));
    }

    /**
     * Refund payment (admin)
     */
    public function refund(Request $request, Payment $payment)
    {
        $validator = Validator::make($request->all(), [
            'refund_reason' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = $this->paymentService->refundPayment($payment, $request->refund_reason);

        if ($result['success']) {
            return redirect()->back()->with('success', 'Payment refunded successfully.');
        }

        return redirect()->back()->with('error', $result['error'] ?? 'Refund failed.');
    }
}