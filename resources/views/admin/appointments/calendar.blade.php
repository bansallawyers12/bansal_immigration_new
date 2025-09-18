@extends('layouts.admin')

@section('title', 'Appointments Calendar')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Appointments Calendar</h1>
            <p class="text-gray-600 mt-1">View appointments across all 4 calendar types</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.appointments.weekly-calendar') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-calendar-week mr-2"></i>
                Weekly View
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

    <!-- Calendar Type Filter -->
    <div class="bg-white rounded-lg shadow mb-6 p-4">
        <div class="flex flex-wrap gap-2 items-center">
            <span class="text-sm font-medium text-gray-700 mr-4">Calendar Types:</span>
            <div class="flex flex-wrap gap-2">
                <button onclick="filterCalendar('all')" id="filter-all" 
                        class="calendar-filter px-3 py-1 rounded-full text-xs font-medium bg-gray-800 text-white">
                    All Types
                </button>
                <button onclick="filterCalendar('tr')" id="filter-tr"
                        class="calendar-filter px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700 hover:bg-blue-200">
                    <span class="w-2 h-2 bg-blue-600 rounded-full inline-block mr-1"></span>
                    TR (TRand JRP)
                </button>
                <button onclick="filterCalendar('tourist')" id="filter-tourist"
                        class="calendar-filter px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700 hover:bg-green-200">
                    <span class="w-2 h-2 bg-green-600 rounded-full inline-block mr-1"></span>
                    Tourist Visa
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

    <!-- Calendar Container -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <div id="calendar-container" class="min-h-96">
                <!-- Simple calendar grid will be loaded here -->
                <div id="calendar-grid"></div>
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
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
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

<script>
let currentFilter = 'all';
let appointmentsData = [];

// Load appointments data
async function loadAppointments() {
    try {
        const response = await fetch('/api/appointments/calendar-events?start={{ Carbon\Carbon::today()->format("Y-m-d") }}&end={{ Carbon\Carbon::today()->addDays(14)->format("Y-m-d") }}');
        const data = await response.json();
        
        if (data.success) {
            appointmentsData = data.events;
            renderCalendar();
        }
    } catch (error) {
        console.error('Error loading appointments:', error);
    }
}

// Render simple calendar
function renderCalendar() {
    const container = document.getElementById('calendar-grid');
    const startDate = new Date('{{ Carbon\Carbon::today()->format("Y-m-d") }}');
    const endDate = new Date('{{ Carbon\Carbon::today()->addDays(14)->format("Y-m-d") }}');
    
    let html = '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">';
    
    for (let d = new Date(startDate); d <= endDate; d.setDate(d.getDate() + 1)) {
        // Skip weekends
        if (d.getDay() === 0 || d.getDay() === 6) continue;
        
        const dateStr = d.toISOString().split('T')[0];
        const dayAppointments = appointmentsData.filter(apt => apt.start.includes(dateStr));
        const filteredAppointments = currentFilter === 'all' ? 
            dayAppointments : 
            dayAppointments.filter(apt => apt.extendedProps?.enquiry_type === currentFilter);
        
        html += `<div class="border border-gray-200 rounded-lg p-4">`;
        html += `<div class="font-semibold text-gray-900 mb-2">${d.toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric' })}</div>`;
        
        if (filteredAppointments.length === 0) {
            html += '<div class="text-gray-400 text-sm">No appointments</div>';
        } else {
            filteredAppointments.forEach(apt => {
                const time = new Date(apt.start).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
                const typeColor = apt.backgroundColor || '#6b7280';
                
                html += `<div class="mb-2 p-2 rounded cursor-pointer hover:opacity-80" 
                             style="background-color: ${typeColor}20; border-left: 3px solid ${typeColor}"
                             onclick="showAppointmentDetails('${apt.id}')">`;
                html += `<div class="text-xs font-medium" style="color: ${typeColor}">${time}</div>`;
                html += `<div class="text-sm text-gray-900">${apt.title}</div>`;
                if (apt.extendedProps?.status) {
                    html += `<div class="text-xs text-gray-500">${apt.extendedProps.status}</div>`;
                }
                html += '</div>';
            });
        }
        
        html += '</div>';
    }
    
    html += '</div>';
    container.innerHTML = html;
}

// Filter calendar
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
    
    renderCalendar();
}

// Show appointment details
function showAppointmentDetails(appointmentId) {
    const apt = appointmentsData.find(a => a.id === appointmentId);
    if (!apt) return;
    
    const modal = document.getElementById('appointmentModal');
    const modalContent = document.getElementById('modalContent');
    
    let html = '<div class="space-y-3">';
    html += `<div><strong>Client:</strong> ${apt.title.split(' - ')[0]}</div>`;
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

// Close modal
function closeModal() {
    document.getElementById('appointmentModal').classList.add('hidden');
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    loadAppointments();
});
</script>
@endsection
