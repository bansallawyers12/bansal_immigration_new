<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\Contact;
use App\Models\Enquiry;
use App\Mail\ContactUsMail;

class ContactController extends Controller
{
    /**
     * Handle the unified contact form submission
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        // Rate limiting: max 5 attempts per minute per IP
        $key = 'contact-form:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Too many attempts. Please try again later.',
                    'errors' => [
                        'rate_limit' => ['Too many attempts. Please try again later.']
                    ]
                ], 422);
            }
            
            return redirect()->back()->withErrors([
                'rate_limit' => 'Too many attempts. Please try again in ' . ceil($seconds / 60) . ' minutes.'
            ])->withInput();
        }

        // Honeypot spam protection
        if ($request->filled('website')) {
            // This is likely spam, silently reject
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you! Your message has been sent successfully.'
                ]);
            }
            return redirect()->back()->with('success', 'Thank you! Your message has been sent successfully.');
        }

        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'g-recaptcha-response' => 'required',
            'form_source' => 'nullable|string|max:50',
            'form_variant' => 'nullable|string|max:50',
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'The email must be a valid email address.',
            'subject.required' => 'Subject is required.',
            'message.required' => 'Message is required.',
            'g-recaptcha-response.required' => 'Please complete the reCAPTCHA verification.',
        ]);

        // Verify reCAPTCHA
        $recaptchaSecret = config('services.recaptcha.secret');
        if ($recaptchaSecret) {
            $recaptchaResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $recaptchaSecret,
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]);

            $recaptchaResult = $recaptchaResponse->json();

            if (!$recaptchaResult['success']) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'reCAPTCHA validation failed',
                        'errors' => [
                            'g-recaptcha-response' => ['Please complete the reCAPTCHA verification.']
                        ]
                    ], 422);
                }
                
                return redirect()->back()->withErrors([
                    'g-recaptcha-response' => 'Please complete the reCAPTCHA verification.'
                ])->withInput();
            }
        }

        try {
            // Create Contact record
            $contact = Contact::create([
                'name' => $validatedData['name'],
                'contact_email' => $validatedData['email'],
                'contact_phone' => $validatedData['phone'] ?? null,
                'subject' => $validatedData['subject'],
                'message' => $validatedData['message'],
                'status' => 'unread',
                'form_source' => $validatedData['form_source'] ?? null,
                'form_variant' => $validatedData['form_variant'] ?? null,
                'ip_address' => $request->ip(),
            ]);

            // Create Enquiry record
            $enquiry = Enquiry::create([
                'first_name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'] ?? null,
                'subject' => $validatedData['subject'],
                'message' => $validatedData['message'],
                'ip_address' => $request->ip(),
            ]);

            // Send email notification to admin
            $adminEmail = config('mail.from.address', 'info@bansalimmigration.com.au');
            Mail::to($adminEmail)->send(new ContactUsMail($contact));

            // Optional: Send acknowledgment email to customer
            // Uncomment the following lines to enable customer acknowledgment emails
            // Mail::to($validatedData['email'])->send(new ContactUsCustomerMail($contact));

            // Record successful attempt for rate limiting
            RateLimiter::hit($key, 60);

            // Return success response
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you! Your message has been sent successfully. We\'ll get back to you within 24 hours.'
                ]);
            }

            return redirect()->back()->with('success', 'Thank you! Your message has been sent successfully. We\'ll get back to you within 24 hours.');

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Contact form submission error: ' . $e->getMessage(), [
                'request_data' => $request->except(['g-recaptcha-response']),
                'ip' => $request->ip(),
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, there was an error sending your message. Please try again.'
                ], 500);
            }

            return redirect()->back()->withErrors([
                'general' => 'Sorry, there was an error sending your message. Please try again.'
            ])->withInput();
        }
    }
}
