@extends('layouts.admin')

@section('title', 'Weekly Appointments Calendar')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Weekly Appointments Calendar</h1>
            <p class="text-gray-600 mt-1">View appointments in weekly format across 4 calendar types</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.appointments.calendar-view') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-calendar-day mr-2"></i>
                Daily View
            </a>
            <a href="{{ route('admin.appointments.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-list mr-2"></i>
                List View
            </a>
            <a href="{{ route('admin.appointments.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i>
                New Appointment
            </a>
        </div>
    </div>

    <!-- Week Navigation & Filters -->
    <div class="bg-white rounded-lg shadow mb-6 p-4">
        <div class="flex flex-wrap justify-between items-center gap-4">
            <!-- Week Navigation -->
            <div class="flex items-center space-x-4">
                <button onclick="changeWeek(-1)" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="text-lg font-semibold text-gray-900" id="current-week">
                    <!-- Week range will be populated by JavaScript -->
                </div>
                <button onclick="changeWeek(1)" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <button onclick="goToToday()" class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-2 rounded-lg">
                    Today
                </button>
            </div>

            <!-- Calendar Type Filters -->
            <div class="flex flex-wrap gap-2 items-center">
                <span class="text-sm font-medium text-gray-700 mr-2">Filter:</span>
                <button onclick="filterCalendar('all')" id="filter-all" 
                        class="calendar-filter px-3 py-1 rounded-full text-xs font-medium bg-gray-800 text-white">
                    All Types
                </button>
                <button onclick="filterCalendar('tr')" id="filter-tr"
                        class="calendar-filter px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700 hover:bg-blue-200">
                    <span class="w-2 h-2 bg-blue-600 rounded-full inline-block mr-1"></span>
                    TR
                </button>
                <button onclick="filterCalendar('tourist')" id="filter-tourist"
                        class="calendar-filter px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700 hover:bg-green-200">
                    <span class="w-2 h-2 bg-green-600 rounded-full inline-block mr-1"></span>
                    Tourist
                </button>
                <button onclick="filterCalendar('education')" id="filter-education"
                        class="calendar-filter px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700 hover:bg-yellow-200">
                    <span class="w-2 h-2 bg-yellow-600 rounded-full inline-block mr-1"></span>
                    Education
                </button>
                <button onclick="filterCalendar('pr_complex')" id="filter-pr_complex"
                        class="calendar-filter px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-700 hover:bg-purple-200">
                    <span class="w-2 h-2 bg-purple-600 rounded-full inline-block mr-1"></span>
                    PR/Complex
                </button>
            </div>
        </div>
    </div>

    <!-- Weekly Calendar Grid -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <!-- Time Column Header -->
            <div class="weekly-calendar">
                <!-- Header Row -->
                <div class="calendar-header grid grid-cols-8 gap-2 mb-4 pb-4 border-b border-gray-200">
                    <div class="text-center font-semibold text-gray-700">Time</div>
                    <div class="text-center font-semibold text-gray-700" id="day-0">Mon</div>
                    <div class="text-center font-semibold text-gray-700" id="day-1">Tue</div>
                    <div class="text-center font-semibold text-gray-700" id="day-2">Wed</div>
                    <div class="text-center font-semibold text-gray-700" id="day-3">Thu</div>
                    <div class="text-center font-semibold text-gray-700" id="day-4">Fri</div>
                    <div class="text-center font-semibold text-gray-700" id="day-5">Sat</div>
                    <div class="text-center font-semibold text-gray-700" id="day-6">Sun</div>
                </div>

                <!-- Calendar Body -->
                <div id="calendar-body" class="space-y-1">
                    <!-- Time slots will be generated by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Legend -->
    <div class="mt-6 bg-white rounded-lg shadow p-4">
        <h3 class="text-sm font-semibold text-gray-700 mb-3">Legend</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
            <div class="flex items-center">
                <div class="w-4 h-4 bg-blue-600 rounded mr-2"></div>
                <span>TR (TRand JRP) - 30min</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 bg-green-600 rounded mr-2"></div>
                <span>Tourist Visa - 45min</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 bg-yellow-600 rounded mr-2"></div>
                <span>Education - 60min</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 bg-purple-600 rounded mr-2"></div>
                <span>PR/Complex - 30min</span>
            </div>
        </div>
        <div class="mt-3 pt-3 border-t border-gray-200">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 text-sm">
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-red-600 rounded mr-2"></div>
                    <span>Blocked Time</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-gray-300 rounded mr-2"></div>
                    <span>Pending</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-green-300 rounded mr-2"></div>
                    <span>Confirmed</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-blue-300 rounded mr-2"></div>
                    <span>Completed</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-orange-300 rounded mr-2"></div>
                    <span>In Progress</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Appointment Details Modal -->
<div id="appointmentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900" id="modalTitle">Appointment Details</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="modalContent" class="text-sm text-gray-600">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<style>
.weekly-calendar {
    min-height: 600px;
}

.time-slot {
    height: 60px;
    border-bottom: 1px solid #e5e7eb;
}

.appointment-block {
    border-radius: 4px;
    padding: 2px 6px;
    margin: 1px 0;
    font-size: 11px;
    cursor: pointer;
    transition: opacity 0.2s;
    border-left: 3px solid;
    background: rgba(255, 255, 255, 0.9);
}

.appointment-block:hover {
    opacity: 0.8;
}

.blocked-time {
    background: rgba(220, 53, 69, 0.2);
    border-left-color: #dc3545;
    color: #721c24;
}

.appointment-tr {
    background: rgba(0, 123, 255, 0.2);
    border-left-color: #007bff;
    color: #004085;
}

.appointment-tourist {
    background: rgba(40, 167, 69, 0.2);
    border-left-color: #28a745;
    color: #155724;
}

.appointment-education {
    background: rgba(255, 193, 7, 0.2);
    border-left-color: #ffc107;
    color: #856404;
}

.appointment-pr_complex {
    background: rgba(111, 66, 193, 0.2);
    border-left-color: #6f42c1;
    color: #432874;
}

.current-time-line {
    border-top: 2px solid #dc3545;
    position: relative;
    z-index: 10;
}
</style>

<script>
let currentWeekStart = new Date();
let currentFilter = 'all';
let appointmentsData = [];

// Set to start of week (Monday)
currentWeekStart.setDate(currentWeekStart.getDate() - currentWeekStart.getDay() + 1);

document.addEventListener('DOMContentLoaded', function() {
    updateWeekDisplay();
    loadAppointments();
});

function updateWeekDisplay() {
    const weekEnd = new Date(currentWeekStart);
    weekEnd.setDate(weekEnd.getDate() + 6);
    
    const options = { month: 'short', day: 'numeric', year: 'numeric' };
    const startStr = currentWeekStart.toLocaleDateString('en-US', options);
    const endStr = weekEnd.toLocaleDateString('en-US', options);
    
    document.getElementById('current-week').textContent = `${startStr} - ${endStr}`;
    
    // Update day headers
    for (let i = 0; i < 7; i++) {
        const day = new Date(currentWeekStart);
        day.setDate(day.getDate() + i);
        const dayName = day.toLocaleDateString('en-US', { weekday: 'short' });
        const dayNum = day.getDate();
        document.getElementById(`day-${i}`).innerHTML = `${dayName}<br><span class="text-xs text-gray-500">${dayNum}</span>`;
    }
}

async function loadAppointments() {
    try {
        const weekEnd = new Date(currentWeekStart);
        weekEnd.setDate(weekEnd.getDate() + 6);
        
        const response = await fetch(`/api/appointments/calendar-events?start=${currentWeekStart.toISOString().split('T')[0]}&end=${weekEnd.toISOString().split('T')[0]}`);
        const data = await response.json();
        
        if (data.success) {
            appointmentsData = data.events;
            renderWeeklyCalendar();
        }
    } catch (error) {
        console.error('Error loading appointments:', error);
    }
}

function renderWeeklyCalendar() {
    const calendarBody = document.getElementById('calendar-body');
    let html = '';
    
    // Generate time slots from 8 AM to 6 PM
    for (let hour = 8; hour <= 18; hour++) {
        for (let minute = 0; minute < 60; minute += 30) {
            const timeString = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
            const displayTime = new Date(`2000-01-01T${timeString}`).toLocaleTimeString('en-US', { 
                hour: 'numeric', 
                minute: '2-digit',
                hour12: true 
            });
            
            html += `<div class="time-slot grid grid-cols-8 gap-2">`;
            html += `<div class="text-xs text-gray-500 text-right pr-2 py-1">${displayTime}</div>`;
            
            // Generate 7 day columns
            for (let day = 0; day < 7; day++) {
                const currentDate = new Date(currentWeekStart);
                currentDate.setDate(currentDate.getDate() + day);
                const dateString = currentDate.toISOString().split('T')[0];
                
                html += `<div class="border-r border-gray-100 p-1 min-h-[60px] relative" data-date="${dateString}" data-time="${timeString}">`;
                
                // Find appointments for this time slot
                const slotAppointments = appointmentsData.filter(apt => {
                    if (!apt.start.includes(dateString)) return false;
                    
                    const aptTime = new Date(apt.start).toTimeString().substring(0, 5);
                    const slotTime = timeString;
                    
                    // Check if appointment overlaps with this time slot
                    const aptStart = new Date(`2000-01-01T${aptTime}`);
                    const aptEnd = new Date(apt.end);
                    const slotStart = new Date(`2000-01-01T${slotTime}`);
                    const slotEnd = new Date(slotStart.getTime() + 30 * 60000);
                    
                    return aptStart < slotEnd && aptEnd > slotStart;
                });
                
                // Filter by current filter
                const filteredAppointments = currentFilter === 'all' ? 
                    slotAppointments : 
                    slotAppointments.filter(apt => apt.extendedProps?.enquiry_type === currentFilter);
                
                filteredAppointments.forEach(apt => {
                    const time = new Date(apt.start).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
                    const typeClass = apt.extendedProps?.enquiry_type ? `appointment-${apt.extendedProps.enquiry_type}` : 'appointment-default';
                    
                    if (apt.type === 'blocked_time') {
                        html += `<div class="appointment-block blocked-time" onclick="showAppointmentDetails('${apt.id}')">`;
                        html += `<div class="font-medium">🚫 ${apt.title}</div>`;
                    } else {
                        html += `<div class="appointment-block ${typeClass}" onclick="showAppointmentDetails('${apt.id}')">`;
                        html += `<div class="font-medium">${time}</div>`;
                        html += `<div class="truncate">${apt.title.split(' - ')[0]}</div>`;
                    }
                    html += '</div>';
                });
                
                html += '</div>';
            }
            
            html += '</div>';
        }
    }
    
    calendarBody.innerHTML = html;
}

function changeWeek(direction) {
    currentWeekStart.setDate(currentWeekStart.getDate() + (direction * 7));
    updateWeekDisplay();
    loadAppointments();
}

function goToToday() {
    const today = new Date();
    currentWeekStart = new Date(today);
    currentWeekStart.setDate(currentWeekStart.getDate() - currentWeekStart.getDay() + 1);
    updateWeekDisplay();
    loadAppointments();
}

function filterCalendar(type) {
    currentFilter = type;
    
    // Update filter buttons
    document.querySelectorAll('.calendar-filter').forEach(btn => {
        btn.className = 'calendar-filter px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 hover:bg-gray-200';
    });
    
    const activeBtn = document.getElementById('filter-' + type);
    if (type === 'all') {
        activeBtn.className = 'calendar-filter px-3 py-1 rounded-full text-xs font-medium bg-gray-800 text-white';
    } else {
        const colors = {
            'tr': 'bg-blue-600 text-white',
            'tourist': 'bg-green-600 text-white',
            'education': 'bg-yellow-600 text-white',
            'pr_complex': 'bg-purple-600 text-white'
        };
        activeBtn.className = `calendar-filter px-3 py-1 rounded-full text-xs font-medium ${colors[type]}`;
    }
    
    renderWeeklyCalendar();
}

function showAppointmentDetails(appointmentId) {
    const apt = appointmentsData.find(a => a.id === appointmentId);
    if (!apt) return;
    
    const modal = document.getElementById('appointmentModal');
    const modalContent = document.getElementById('modalContent');
    
    let html = '<div class="space-y-3">';
    html += `<div><strong>Title:</strong> ${apt.title}</div>`;
    html += `<div><strong>Time:</strong> ${new Date(apt.start).toLocaleString()}</div>`;
    
    if (apt.extendedProps) {
        if (apt.extendedProps.enquiry_type) {
            const typeNames = {
                'tr': 'TR (TRand JRP)',
                'tourist': 'Tourist Visa',
                'education': 'Education',
                'pr_complex': 'PR/Complex'
            };
            html += `<div><strong>Type:</strong> ${typeNames[apt.extendedProps.enquiry_type] || apt.extendedProps.enquiry_type}</div>`;
        }
        if (apt.extendedProps.email) {
            html += `<div><strong>Email:</strong> ${apt.extendedProps.email}</div>`;
        }
        if (apt.extendedProps.phone) {
            html += `<div><strong>Phone:</strong> ${apt.extendedProps.phone}</div>`;
        }
        if (apt.extendedProps.status) {
            html += `<div><strong>Status:</strong> <span class="capitalize">${apt.extendedProps.status}</span></div>`;
        }
        if (apt.extendedProps.meeting_type) {
            html += `<div><strong>Meeting Type:</strong> ${apt.extendedProps.meeting_type.replace('_', ' ')}</div>`;
        }
        if (apt.extendedProps.location) {
            html += `<div><strong>Location:</strong> ${apt.extendedProps.location}</div>`;
        }
    }
    
    html += '</div>';
    modalContent.innerHTML = html;
    modal.classList.remove('hidden');
}

function closeModal() {
    document.getElementById('appointmentModal').classList.add('hidden');
}
</script>
@endsection
