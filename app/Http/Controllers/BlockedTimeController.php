<?php

namespace App\Http\Controllers;

use App\Models\BlockedTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BlockedTimeController extends Controller
{
    /**
     * Display a listing of blocked times
     */
    public function index(Request $request)
    {
        $query = BlockedTime::with('creator')
                           ->orderBy('blocked_date', 'desc');

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->dateRange($request->start_date, $request->end_date);
        }

        // Filter by active status
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->boolean('is_active'));
        }

        // Filter by block type
        if ($request->filled('block_type')) {
            $query->where('block_type', $request->block_type);
        }

        $blockedTimes = $query->paginate(20);

        $blockTypes = [
            'unavailable' => 'Unavailable',
            'busy' => 'Busy',
            'holiday' => 'Holiday',
            'maintenance' => 'Maintenance'
        ];

        $enquiryTypes = [
            'tr' => 'TR (TRand JRP)',
            'tourist' => 'Tourist Visa',
            'education' => 'Education',
            'pr_complex' => 'PR/Complex'
        ];

        return view('admin.blocked-times.index', compact('blockedTimes', 'blockTypes', 'enquiryTypes'));
    }

    /**
     * Show the form for creating a new blocked time
     */
    public function create()
    {
        $blockTypes = [
            'unavailable' => 'Unavailable',
            'busy' => 'Busy',
            'holiday' => 'Holiday',
            'maintenance' => 'Maintenance'
        ];

        $enquiryTypes = [
            'tr' => 'TR (TRand JRP)',
            'tourist' => 'Tourist Visa',
            'education' => 'Education',
            'pr_complex' => 'PR/Complex'
        ];

        $recurrenceTypes = [
            'none' => 'No Recurrence',
            'daily' => 'Daily',
            'weekly' => 'Weekly',
            'monthly' => 'Monthly',
            'yearly' => 'Yearly'
        ];

        return view('admin.blocked-times.create', compact('blockTypes', 'enquiryTypes', 'recurrenceTypes'));
    }

    /**
     * Store a newly created blocked time
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'blocked_date' => 'required|date|after_or_equal:today',
            'start_time' => 'nullable|date_format:H:i|required_unless:is_all_day,1',
            'end_time' => 'nullable|date_format:H:i|required_unless:is_all_day,1|after:start_time',
            'is_all_day' => 'boolean',
            'recurrence_type' => 'required|in:none,daily,weekly,monthly,yearly',
            'recurrence_end_date' => 'nullable|date|after:blocked_date|required_unless:recurrence_type,none',
            'blocked_enquiry_types' => 'nullable|array',
            'blocked_enquiry_types.*' => 'in:tr,tourist,education,pr_complex',
            'block_type' => 'required|in:unavailable,busy,holiday,maintenance',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $blockedTime = BlockedTime::create([
                'title' => $request->title,
                'description' => $request->description,
                'blocked_date' => $request->blocked_date,
                'start_time' => $request->boolean('is_all_day') ? null : $request->start_time,
                'end_time' => $request->boolean('is_all_day') ? null : $request->end_time,
                'is_all_day' => $request->boolean('is_all_day'),
                'recurrence_type' => $request->recurrence_type,
                'recurrence_end_date' => $request->recurrence_end_date,
                'blocked_enquiry_types' => $request->blocked_enquiry_types,
                'block_type' => $request->block_type,
                'is_active' => $request->boolean('is_active', true),
                'created_by' => Auth::id()
            ]);

            return redirect()->route('admin.blocked-times.show', $blockedTime)
                           ->with('success', 'Blocked time created successfully!');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create blocked time.'])->withInput();
        }
    }

    /**
     * Display the specified blocked time
     */
    public function show(BlockedTime $blockedTime)
    {
        $blockedTime->load('creator');
        return view('admin.blocked-times.show', compact('blockedTime'));
    }

    /**
     * Show the form for editing the specified blocked time
     */
    public function edit(BlockedTime $blockedTime)
    {
        $blockTypes = [
            'unavailable' => 'Unavailable',
            'busy' => 'Busy',
            'holiday' => 'Holiday',
            'maintenance' => 'Maintenance'
        ];

        $enquiryTypes = [
            'tr' => 'TR (TRand JRP)',
            'tourist' => 'Tourist Visa',
            'education' => 'Education',
            'pr_complex' => 'PR/Complex'
        ];

        $recurrenceTypes = [
            'none' => 'No Recurrence',
            'daily' => 'Daily',
            'weekly' => 'Weekly',
            'monthly' => 'Monthly',
            'yearly' => 'Yearly'
        ];

        return view('admin.blocked-times.edit', compact('blockedTime', 'blockTypes', 'enquiryTypes', 'recurrenceTypes'));
    }

    /**
     * Update the specified blocked time
     */
    public function update(Request $request, BlockedTime $blockedTime)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'blocked_date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i|required_unless:is_all_day,1',
            'end_time' => 'nullable|date_format:H:i|required_unless:is_all_day,1|after:start_time',
            'is_all_day' => 'boolean',
            'recurrence_type' => 'required|in:none,daily,weekly,monthly,yearly',
            'recurrence_end_date' => 'nullable|date|after:blocked_date|required_unless:recurrence_type,none',
            'blocked_enquiry_types' => 'nullable|array',
            'blocked_enquiry_types.*' => 'in:tr,tourist,education,pr_complex',
            'block_type' => 'required|in:unavailable,busy,holiday,maintenance',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $blockedTime->update([
                'title' => $request->title,
                'description' => $request->description,
                'blocked_date' => $request->blocked_date,
                'start_time' => $request->boolean('is_all_day') ? null : $request->start_time,
                'end_time' => $request->boolean('is_all_day') ? null : $request->end_time,
                'is_all_day' => $request->boolean('is_all_day'),
                'recurrence_type' => $request->recurrence_type,
                'recurrence_end_date' => $request->recurrence_end_date,
                'blocked_enquiry_types' => $request->blocked_enquiry_types,
                'block_type' => $request->block_type,
                'is_active' => $request->boolean('is_active', true)
            ]);

            return redirect()->route('admin.blocked-times.show', $blockedTime)
                           ->with('success', 'Blocked time updated successfully!');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update blocked time.'])->withInput();
        }
    }

    /**
     * Remove the specified blocked time
     */
    public function destroy(BlockedTime $blockedTime)
    {
        try {
            $blockedTime->delete();
            return redirect()->route('admin.blocked-times.index')
                           ->with('success', 'Blocked time deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete blocked time.']);
        }
    }

    /**
     * Toggle active status of blocked time
     */
    public function toggleActive(BlockedTime $blockedTime)
    {
        try {
            $blockedTime->update(['is_active' => !$blockedTime->is_active]);
            
            $status = $blockedTime->is_active ? 'activated' : 'deactivated';
            return response()->json([
                'success' => true,
                'message' => "Blocked time {$status} successfully!",
                'is_active' => $blockedTime->is_active
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update blocked time status.'
            ], 500);
        }
    }

    /**
     * Get blocked times for calendar view
     */
    public function calendar(Request $request)
    {
        $startDate = $request->get('start', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end', now()->endOfMonth()->format('Y-m-d'));
        $enquiryType = $request->get('enquiry_type');

        $query = BlockedTime::active()
                           ->dateRange($startDate, $endDate);

        if ($enquiryType) {
            $query->forEnquiryType($enquiryType);
        }

        $blockedTimes = $query->get();

        $events = $blockedTimes->map(function ($blockedTime) {
            $startDateTime = $blockedTime->is_all_day ? 
                           $blockedTime->blocked_date->format('Y-m-d') :
                           $blockedTime->blocked_date->format('Y-m-d') . 'T' . $blockedTime->start_time;
            
            $endDateTime = $blockedTime->is_all_day ? 
                         $blockedTime->blocked_date->format('Y-m-d') :
                         $blockedTime->blocked_date->format('Y-m-d') . 'T' . $blockedTime->end_time;

            return [
                'id' => 'blocked_' . $blockedTime->id,
                'title' => $blockedTime->title,
                'start' => $startDateTime,
                'end' => $endDateTime,
                'allDay' => $blockedTime->is_all_day,
                'backgroundColor' => $blockedTime->block_type_color,
                'borderColor' => $blockedTime->block_type_color,
                'textColor' => '#ffffff',
                'extendedProps' => [
                    'type' => 'blocked_time',
                    'block_type' => $blockedTime->block_type,
                    'description' => $blockedTime->description,
                    'blocked_enquiry_types' => $blockedTime->blocked_enquiry_types
                ]
            ];
        });

        return response()->json($events);
    }
}
