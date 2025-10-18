<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalendarSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CalendarSettingController extends Controller
{
    /**
     * Display a listing of all calendar settings (5 calendars x 2 types = 10 settings)
     */
    public function index()
    {
        // Group settings by calendar
        $adelaideSettings = CalendarSetting::where('location', 'adelaide')
                                          ->whereNull('enquiry_type')
                                          ->orderBy('appointment_type')
                                          ->get();

        $melbourneSettings = CalendarSetting::where('location', 'melbourne')
                                            ->orderBy('enquiry_type')
                                            ->orderBy('appointment_type')
                                            ->get()
                                            ->groupBy('enquiry_type');

        $enquiryTypes = [
            'tr' => 'TR (TRand JRP)',
            'tourist' => 'Tourist Visa',
            'education' => 'Education',
            'pr_complex' => 'PR/Complex'
        ];

        return view('admin.calendar-settings.index', compact(
            'adelaideSettings',
            'melbourneSettings',
            'enquiryTypes'
        ));
    }

    /**
     * Show the form for editing a calendar setting
     */
    public function edit(CalendarSetting $calendarSetting)
    {
        return view('admin.calendar-settings.edit', compact('calendarSetting'));
    }

    /**
     * Update the specified calendar setting
     */
    public function update(Request $request, CalendarSetting $calendarSetting)
    {
        $validator = Validator::make($request->all(), [
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'slot_duration_minutes' => 'required|integer|min:5|max:180',
            'lunch_break_start' => 'nullable|date_format:H:i',
            'lunch_break_end' => 'nullable|date_format:H:i|after:lunch_break_start',
            'days_of_week' => 'nullable|array',
            'days_of_week.*' => 'integer|between:1,7',
            'is_active' => 'boolean',
            'notes' => 'nullable|string|max:1000'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Convert times to proper format
            $data = [
                'start_time' => $request->start_time . ':00',
                'end_time' => $request->end_time . ':00',
                'slot_duration_minutes' => $request->slot_duration_minutes,
                'days_of_week' => $request->days_of_week,
                'is_active' => $request->has('is_active'),
                'notes' => $request->notes
            ];

            // Add lunch break if provided
            if ($request->lunch_break_start && $request->lunch_break_end) {
                $data['lunch_break_start'] = $request->lunch_break_start . ':00';
                $data['lunch_break_end'] = $request->lunch_break_end . ':00';
            } else {
                $data['lunch_break_start'] = null;
                $data['lunch_break_end'] = null;
            }

            $calendarSetting->update($data);

            return redirect()->route('admin.calendar-settings.index')
                ->with('success', 'Calendar setting updated successfully!');

        } catch (\Exception $e) {
            \Log::error('Failed to update calendar setting', [
                'error' => $e->getMessage(),
                'setting_id' => $calendarSetting->id
            ]);

            return redirect()->back()
                ->with('error', 'Failed to update calendar setting. Please try again.')
                ->withInput();
        }
    }

    /**
     * Toggle active status
     */
    public function toggleStatus(CalendarSetting $calendarSetting)
    {
        try {
            $calendarSetting->update([
                'is_active' => !$calendarSetting->is_active
            ]);

            $status = $calendarSetting->is_active ? 'activated' : 'deactivated';

            return redirect()->back()
                ->with('success', "Calendar setting has been {$status} successfully!");

        } catch (\Exception $e) {
            \Log::error('Failed to toggle calendar setting status', [
                'error' => $e->getMessage(),
                'setting_id' => $calendarSetting->id
            ]);

            return redirect()->back()
                ->with('error', 'Failed to update status. Please try again.');
        }
    }
}
