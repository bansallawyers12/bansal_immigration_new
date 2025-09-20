@extends('layouts.admin')

@section('title', 'Payment Details - ' . $appointment->full_name)

@section('content')
<div class="admin-content">
    <div class="content-header">
        <div class="header-left">
            <h1>Payment Details</h1>
            <p class="text-gray-600">Payment information for appointment #{{ $appointment->id }}</p>
        </div>
        <div class="header-right">
            <a href="{{ route('admin.appointments.show', $appointment) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Appointment
            </a>
        </div>
    </div>

    <div class="content-body">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Payment Information -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payment Information</h3>
                </div>
                <div class="card-body">
                    @if($payment)
                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <span class="font-medium">Payment ID:</span>
                                <span class="text-gray-600">#{{ $payment->id }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium">Status:</span>
                                <span class="badge badge-{{ $payment->status === 'completed' ? 'success' : ($payment->status === 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium">Amount:</span>
                                <span class="font-semibold">${{ number_format($payment->amount, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium">Final Amount:</span>
                                <span class="font-semibold">${{ number_format($payment->final_amount, 2) }}</span>
                            </div>
                            @if($payment->discount_amount > 0)
                                <div class="flex justify-between">
                                    <span class="font-medium">Discount:</span>
                                    <span class="text-green-600">-${{ number_format($payment->discount_amount, 2) }}</span>
                                </div>
                            @endif
                            @if($payment->promo_code)
                                <div class="flex justify-between">
                                    <span class="font-medium">Promo Code:</span>
                                    <span class="text-blue-600">{{ $payment->promo_code }}</span>
                                </div>
                            @endif
                            <div class="flex justify-between">
                                <span class="font-medium">Payment Method:</span>
                                <span class="text-gray-600">{{ ucfirst($payment->payment_method ?? 'N/A') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium">Transaction ID:</span>
                                <span class="text-gray-600 font-mono text-sm">{{ $payment->transaction_id ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium">Created:</span>
                                <span class="text-gray-600">{{ $payment->created_at->format('M j, Y g:i A') }}</span>
                            </div>
                            @if($payment->completed_at)
                                <div class="flex justify-between">
                                    <span class="font-medium">Completed:</span>
                                    <span class="text-gray-600">{{ $payment->completed_at->format('M j, Y g:i A') }}</span>
                                </div>
                            @endif
                        </div>

                        @if($payment->status === 'completed' && !$payment->refunded_at)
                            <div class="mt-6 pt-6 border-t">
                                <form action="{{ route('admin.appointments.payment.refund', $payment) }}" method="POST" onsubmit="return confirm('Are you sure you want to refund this payment?')">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="refund_reason" class="block text-sm font-medium text-gray-700 mb-2">Refund Reason</label>
                                        <textarea name="refund_reason" id="refund_reason" rows="3" class="form-input" placeholder="Enter reason for refund..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-undo"></i> Process Refund
                                    </button>
                                </form>
                            </div>
                        @endif

                        @if($payment->refunded_at)
                            <div class="mt-6 pt-6 border-t">
                                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-undo text-red-500 mr-2"></i>
                                        <span class="font-medium text-red-800">Payment Refunded</span>
                                    </div>
                                    <p class="text-red-600 text-sm mt-1">
                                        Refunded on {{ $payment->refunded_at->format('M j, Y g:i A') }}
                                        @if($payment->refund_reason)
                                            - {{ $payment->refund_reason }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-credit-card text-gray-400 text-4xl mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No Payment Found</h3>
                            <p class="text-gray-600">This appointment does not have an associated payment.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Appointment Information -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Appointment Information</h3>
                </div>
                <div class="card-body">
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="font-medium">Client Name:</span>
                            <span class="text-gray-600">{{ $appointment->full_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Email:</span>
                            <span class="text-gray-600">{{ $appointment->email }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Phone:</span>
                            <span class="text-gray-600">{{ $appointment->phone }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Enquiry Type:</span>
                            <span class="badge badge-info">{{ ucfirst(str_replace('_', ' ', $appointment->enquiry_type)) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Appointment Date:</span>
                            <span class="text-gray-600">{{ $appointment->appointment_date->format('M j, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Appointment Time:</span>
                            <span class="text-gray-600">{{ $appointment->appointment_time }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Status:</span>
                            <span class="badge badge-{{ $appointment->status === 'confirmed' ? 'success' : ($appointment->status === 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Location:</span>
                            <span class="text-gray-600">{{ ucfirst($appointment->location) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Meeting Type:</span>
                            <span class="text-gray-600">{{ ucfirst(str_replace('_', ' ', $appointment->meeting_type)) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
