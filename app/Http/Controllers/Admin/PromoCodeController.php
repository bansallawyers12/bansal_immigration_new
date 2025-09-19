<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PromoCodeController extends Controller
{
    /**
     * Display a listing of promo codes
     */
    public function index(Request $request)
    {
        $query = PromoCode::query();

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            } elseif ($request->status === 'expired') {
                $query->where('valid_until', '<', now());
            }
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Search by code
        if ($request->filled('search')) {
            $query->where('code', 'like', '%' . $request->search . '%');
        }

        $promoCodes = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('appointments.admin.promo-codes.index', compact('promoCodes'));
    }

    /**
     * Show the form for creating a new promo code
     */
    public function create()
    {
        $enquiryTypes = [
            'tr' => 'TR (TRand JRP)',
            'tourist' => 'Tourist Visa',
            'education' => 'Education',
            'pr_complex' => 'PR/Complex'
        ];

        return view('appointments.admin.promo-codes.create', compact('enquiryTypes'));
    }

    /**
     * Store a newly created promo code
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:50|unique:promo_codes,code',
            'description' => 'nullable|string|max:255',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'minimum_amount' => 'required|numeric|min:0',
            'maximum_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after:valid_from',
            'applicable_enquiry_types' => 'nullable|array',
            'applicable_enquiry_types.*' => 'in:tr,tourist,education,pr_complex',
            'is_active' => 'boolean',
            'is_one_time_use' => 'boolean'
        ]);

        // Additional validation for percentage type
        if ($request->type === 'percentage' && $request->value > 100) {
            $validator->after(function ($validator) {
                $validator->errors()->add('value', 'Percentage value cannot exceed 100%.');
            });
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $promoCode = PromoCode::create([
                'code' => strtoupper($request->code),
                'description' => $request->description,
                'type' => $request->type,
                'value' => $request->value,
                'minimum_amount' => $request->minimum_amount,
                'maximum_discount' => $request->maximum_discount,
                'usage_limit' => $request->usage_limit,
                'valid_from' => $request->valid_from ?: null,
                'valid_until' => $request->valid_until ?: null,
                'applicable_enquiry_types' => $request->applicable_enquiry_types ?: null,
                'is_active' => $request->boolean('is_active', true),
                'is_one_time_use' => $request->boolean('is_one_time_use', false),
            ]);

            return redirect()->route('admin.promo-codes.show', $promoCode)
                ->with('success', 'Promo code created successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to create promo code. Please try again.')
                ->withInput();
        }
    }

    /**
     * Display the specified promo code
     */
    public function show(PromoCode $promoCode)
    {
        $enquiryTypes = [
            'tr' => 'TR (TRand JRP)',
            'tourist' => 'Tourist Visa',
            'education' => 'Education',
            'pr_complex' => 'PR/Complex'
        ];

        return view('appointments.admin.promo-codes.show', compact('promoCode', 'enquiryTypes'));
    }

    /**
     * Show the form for editing the specified promo code
     */
    public function edit(PromoCode $promoCode)
    {
        $enquiryTypes = [
            'tr' => 'TR (TRand JRP)',
            'tourist' => 'Tourist Visa',
            'education' => 'Education',
            'pr_complex' => 'PR/Complex'
        ];

        return view('appointments.admin.promo-codes.edit', compact('promoCode', 'enquiryTypes'));
    }

    /**
     * Update the specified promo code
     */
    public function update(Request $request, PromoCode $promoCode)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:50|unique:promo_codes,code,' . $promoCode->id,
            'description' => 'nullable|string|max:255',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'minimum_amount' => 'required|numeric|min:0',
            'maximum_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after:valid_from',
            'applicable_enquiry_types' => 'nullable|array',
            'applicable_enquiry_types.*' => 'in:tr,tourist,education,pr_complex',
            'is_active' => 'boolean',
            'is_one_time_use' => 'boolean'
        ]);

        // Additional validation for percentage type
        if ($request->type === 'percentage' && $request->value > 100) {
            $validator->after(function ($validator) {
                $validator->errors()->add('value', 'Percentage value cannot exceed 100%.');
            });
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $promoCode->update([
                'code' => strtoupper($request->code),
                'description' => $request->description,
                'type' => $request->type,
                'value' => $request->value,
                'minimum_amount' => $request->minimum_amount,
                'maximum_discount' => $request->maximum_discount,
                'usage_limit' => $request->usage_limit,
                'valid_from' => $request->valid_from ?: null,
                'valid_until' => $request->valid_until ?: null,
                'applicable_enquiry_types' => $request->applicable_enquiry_types ?: null,
                'is_active' => $request->boolean('is_active', true),
            ]);

            return redirect()->route('admin.promo-codes.show', $promoCode)
                ->with('success', 'Promo code updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update promo code. Please try again.')
                ->withInput();
        }
    }

    /**
     * Remove the specified promo code
     */
    public function destroy(PromoCode $promoCode)
    {
        try {
            $promoCode->delete();

            return redirect()->route('admin.promo-codes.index')
                ->with('success', 'Promo code deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete promo code. Please try again.');
        }
    }

    /**
     * Toggle promo code active status
     */
    public function toggleActive(PromoCode $promoCode)
    {
        try {
            $promoCode->update(['is_active' => !$promoCode->is_active]);

            $status = $promoCode->is_active ? 'activated' : 'deactivated';
            return redirect()->back()
                ->with('success', "Promo code {$status} successfully!");

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update promo code status.');
        }
    }

    /**
     * Generate a random promo code
     */
    public function generateCode(Request $request)
    {
        $length = $request->input('length', 8);
        $prefix = $request->input('prefix', '');
        
        do {
            $code = $prefix . strtoupper(Str::random($length));
        } while (PromoCode::where('code', $code)->exists());

        return response()->json(['code' => $code]);
    }

    /**
     * Test promo code calculation
     */
    public function testCalculation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'minimum_amount' => 'required|numeric|min:0',
            'maximum_discount' => 'nullable|numeric|min:0',
            'test_amount' => 'required|numeric|min:0',
            'enquiry_type' => 'required|in:tr,tourist,education,pr_complex'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid input'], 422);
        }

        // Create temporary promo code for testing
        $tempPromo = new PromoCode([
            'type' => $request->type,
            'value' => $request->value,
            'minimum_amount' => $request->minimum_amount,
            'maximum_discount' => $request->maximum_discount,
        ]);

        $discountAmount = $tempPromo->calculateDiscount($request->test_amount);
        $finalAmount = max(0, $request->test_amount - $discountAmount);

        return response()->json([
            'original_amount' => $request->test_amount,
            'discount_amount' => $discountAmount,
            'final_amount' => $finalAmount,
            'discount_percentage' => $request->test_amount > 0 ? round(($discountAmount / $request->test_amount) * 100, 2) : 0
        ]);
    }
}