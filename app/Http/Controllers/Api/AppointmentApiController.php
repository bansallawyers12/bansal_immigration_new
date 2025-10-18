<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentApiController extends Controller
{
    /**
     * Get all appointments (with filters for CRM sync)
     * GET /api/crm/appointments
     */
    public function index(Request $request)
    {
        $query = Appointment::with(['assignedAdmin', 'payment']);

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->dateRange($request->start_date, $request->end_date);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        // Filter by enquiry type
        if ($request->filled('enquiry_type')) {
            $query->where('enquiry_type', $request->enquiry_type);
        }

        // Filter by created date (for incremental sync)
        if ($request->filled('created_after')) {
            $query->where('created_at', '>=', $request->created_after);
        }

        // Filter by updated date (for incremental sync)
        if ($request->filled('updated_after')) {
            $query->where('updated_at', '>=', $request->updated_after);
        }

        // Pagination
        $perPage = $request->input('per_page', 50);
        $appointments = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $appointments->map(function($appointment) {
                return $this->formatAppointmentForCRM($appointment);
            })->values()->all(),
            'pagination' => [
                'total' => $appointments->total(),
                'per_page' => $appointments->perPage(),
                'current_page' => $appointments->currentPage(),
                'last_page' => $appointments->lastPage(),
                'from' => $appointments->firstItem(),
                'to' => $appointments->lastItem()
            ]
        ]);
    }

    /**
     * Get single appointment by ID
     * GET /api/crm/appointments/{id}
     */
    public function show($id)
    {
        $appointment = Appointment::with(['assignedAdmin', 'payment'])->find($id);

        if (!$appointment) {
            return response()->json([
                'success' => false,
                'message' => 'Appointment not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $this->formatAppointmentForCRM($appointment)
        ]);
    }

    /**
     * Get appointments in CSV format for CRM import
     * GET /api/crm/appointments/export
     */
    public function export(Request $request)
    {
        $query = Appointment::with(['assignedAdmin', 'payment']);

        // Apply same filters as index
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->dateRange($request->start_date, $request->end_date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        if ($request->filled('enquiry_type')) {
            $query->where('enquiry_type', $request->enquiry_type);
        }

        $appointments = $query->orderBy('created_at', 'desc')
            ->limit(10000) // Prevent massive exports that could timeout
            ->get();

        // Generate CSV
        $csv = $this->generateCSV($appointments);

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="appointments_' . date('Y-m-d') . '.csv"',
        ]);
    }

    /**
     * Webhook endpoint - Get recent appointments for CRM polling
     * GET /api/crm/appointments/recent
     */
    public function recent(Request $request)
    {
        // Get appointments from last N minutes (default 30, max 1440 = 24 hours)
        $minutes = min((int)$request->input('minutes', 30), 1440);
        $minutes = max($minutes, 1); // Minimum 1 minute
        
        $appointments = Appointment::with(['assignedAdmin', 'payment'])
            ->where('created_at', '>=', now()->subMinutes($minutes))
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'count' => $appointments->count(),
            'data' => $appointments->map(function($appointment) {
                return $this->formatAppointmentForCRM($appointment);
            })
        ]);
    }

    /**
     * Get appointment statistics for dashboard
     * GET /api/crm/appointments/stats
     */
    public function stats(Request $request)
    {
        // Validate date inputs
        $validated = $request->validate([
            'start_date' => 'nullable|date|before_or_equal:today',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
        
        $startDate = $request->input('start_date', now()->startOfMonth());
        $endDate = $request->input('end_date', now()->endOfMonth());

        // Optimized queries - reduce N+1 problem
        $baseQuery = Appointment::dateRange($startDate, $endDate);
        
        // Get counts by status in one query
        $statusCounts = (clone $baseQuery)
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');
        
        // Get counts by enquiry type in one query
        $enquiryTypeCounts = (clone $baseQuery)
            ->selectRaw('enquiry_type, COUNT(*) as count')
            ->groupBy('enquiry_type')
            ->pluck('count', 'enquiry_type');
        
        // Get counts by location in one query
        $locationCounts = (clone $baseQuery)
            ->selectRaw('location, COUNT(*) as count')
            ->groupBy('location')
            ->pluck('count', 'location');
        
        // Get paid appointments stats in one query
        $paidStats = (clone $baseQuery)
            ->where('is_paid', true)
            ->selectRaw('COUNT(*) as count, SUM(final_amount) as revenue')
            ->first();

        $stats = [
            'total_appointments' => $baseQuery->count(),
            'pending' => $statusCounts->get('pending', 0),
            'confirmed' => $statusCounts->get('confirmed', 0),
            'completed' => $statusCounts->get('completed', 0),
            'cancelled' => $statusCounts->get('cancelled', 0),
            'paid_appointments' => $paidStats->count ?? 0,
            'total_revenue' => $paidStats->revenue ?? 0,
            'by_enquiry_type' => [
                'tr' => $enquiryTypeCounts->get('tr', 0),
                'tourist' => $enquiryTypeCounts->get('tourist', 0),
                'education' => $enquiryTypeCounts->get('education', 0),
                'pr_complex' => $enquiryTypeCounts->get('pr_complex', 0),
            ],
            'by_location' => [
                'melbourne' => $locationCounts->get('melbourne', 0),
                'adelaide' => $locationCounts->get('adelaide', 0),
            ]
        ];

        return response()->json([
            'success' => true,
            'period' => [
                'start_date' => $startDate,
                'end_date' => $endDate
            ],
            'stats' => $stats
        ]);
    }

    /**
     * Format appointment data for CRM
     */
    private function formatAppointmentForCRM($appointment)
    {
        return [
            'id' => $appointment->id,
            'full_name' => $appointment->full_name,
            'email' => $appointment->email,
            'phone' => $appointment->phone,
            'location' => $appointment->location,
            'meeting_type' => $appointment->meeting_type,
            'preferred_language' => $appointment->preferred_language,
            'enquiry_type' => $appointment->enquiry_type,
            'enquiry_type_display' => $appointment->enquiry_type_display,
            'service_type' => $appointment->service_type,
            'specific_service' => $appointment->specific_service,
            'enquiry_details' => $appointment->enquiry_details,
            'appointment_date' => $appointment->appointment_date->format('Y-m-d'),
            'appointment_time' => $appointment->appointment_time,
            'appointment_datetime' => $appointment->appointment_datetime->toISOString(),
            'duration_minutes' => $appointment->duration_minutes,
            'status' => $appointment->status,
            'status_display' => $appointment->status_display['name'],
            'is_paid' => $appointment->is_paid,
            'amount' => $appointment->amount,
            'discount_amount' => $appointment->discount_amount,
            'final_amount' => $appointment->final_amount,
            'promo_code' => $appointment->promo_code,
            'assigned_admin' => $appointment->assignedAdmin ? [
                'id' => $appointment->assignedAdmin->id,
                'name' => $appointment->assignedAdmin->name,
                'email' => $appointment->assignedAdmin->email,
            ] : null,
            'payment' => $appointment->payment ? [
                'id' => $appointment->payment->id,
                'status' => $appointment->payment->status,
                'amount' => $appointment->payment->amount,
                'payment_method' => $appointment->payment->payment_method,
                'paid_at' => $appointment->payment->paid_at,
            ] : null,
            'admin_notes' => $appointment->admin_notes,
            'client_notes' => $appointment->client_notes,
            'confirmed_at' => $appointment->confirmed_at?->toISOString(),
            'cancelled_at' => $appointment->cancelled_at?->toISOString(),
            'cancellation_reason' => $appointment->cancellation_reason,
            'created_at' => $appointment->created_at->toISOString(),
            'updated_at' => $appointment->updated_at->toISOString(),
        ];
    }

    /**
     * Generate CSV from appointments
     */
    private function generateCSV($appointments)
    {
        $csv = "ID,Name,Email,Phone,Location,Meeting Type,Language,Enquiry Type,Service Type,Appointment Date,Appointment Time,Duration,Status,Is Paid,Amount,Final Amount,Promo Code,Admin Notes,Created At,Updated At\n";

        foreach ($appointments as $apt) {
            $csv .= sprintf(
                "%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s\n",
                $apt->id,
                $this->escapeCsv($apt->full_name),
                $this->escapeCsv($apt->email),
                $this->escapeCsv($apt->phone),
                $apt->location,
                $apt->meeting_type,
                $apt->preferred_language,
                $apt->enquiry_type_display,
                $this->escapeCsv($apt->service_type),
                $apt->appointment_date->format('Y-m-d'),
                $apt->appointment_time,
                $apt->duration_minutes,
                $apt->status,
                $apt->is_paid ? 'Yes' : 'No',
                $apt->amount,
                $apt->final_amount,
                $this->escapeCsv($apt->promo_code),
                $this->escapeCsv($apt->admin_notes),
                $apt->created_at->format('Y-m-d H:i:s'),
                $apt->updated_at->format('Y-m-d H:i:s')
            );
        }

        return $csv;
    }

    /**
     * Escape CSV field
     */
    private function escapeCsv($value)
    {
        if ($value === null) return '';
        return '"' . str_replace('"', '""', $value) . '"';
    }
}

