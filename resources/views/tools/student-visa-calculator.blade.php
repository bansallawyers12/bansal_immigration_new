@extends('layouts.main')

@section('title', 'Student Visa Financial Calculator - Calculate Your Financial Requirements | Bansal Immigration')
@section('description', 'Calculate the financial requirements for your Australian student visa application. Check living costs, tuition fees, and financial capacity.')

@section('content')
<div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4">Student Visa Financial Calculator</h1>
        <p class="text-xl opacity-90">Calculate your financial requirements for Australian student visa</p>
        <p class="text-sm opacity-75 mt-2">Based on Migration Instrument LIN 19/198 (Updated May 2024)</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Calculator Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold text-gray-900 mb-6">Calculate Your Financial Requirements</h2>
                
                <form id="studentCalculator" class="space-y-6">
                    <!-- Course Duration -->
                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">
                            Course Duration (years)
                        </label>
                        <input 
                            type="number" 
                            name="duration" 
                            id="duration" 
                            min="0.5" 
                            max="10" 
                            step="0.5" 
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter course duration"
                        >
                    </div>

                    <!-- Annual Tuition Fee -->
                    <div>
                        <label for="tuition" class="block text-sm font-medium text-gray-700 mb-2">
                            Annual Tuition Fee (AUD)
                        </label>
                        <input 
                            type="number" 
                            name="tuition" 
                            id="tuition" 
                            min="0" 
                            step="1000"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter annual tuition fee"
                        >
                        <p class="text-xs text-gray-600 mt-1">
                            For visa purposes: Maximum 12 months of fees required (or remainder if less)
                        </p>
                    </div>

                    <!-- Living Costs (Student) - Display Only -->
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Annual Living Cost (Primary Student)
                        </label>
                        <div class="text-2xl font-bold text-blue-600">AUD $29,710</div>
                        <p class="text-xs text-gray-600 mt-1">
                            Official rate per Migration Instrument 2019 (May 2024)
                        </p>
                        <input type="hidden" name="student_living_cost" value="29710">
                    </div>

                    <!-- Partner/Spouse -->
                    <div>
                        <label for="partners" class="block text-sm font-medium text-gray-700 mb-2">
                            Partner/Spouse Accompanying You
                        </label>
                        <select 
                            name="partners" 
                            id="partners" 
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="0">No partner</option>
                            <option value="1">1 partner (AUD $10,394/year)</option>
                        </select>
                    </div>

                    <!-- Dependent Children -->
                    <div>
                        <label for="children" class="block text-sm font-medium text-gray-700 mb-2">
                            Number of Dependent Children
                        </label>
                        <select 
                            name="children" 
                            id="children" 
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="0">No children</option>
                            <option value="1">1 child (AUD $4,449/year living cost)</option>
                            <option value="2">2 children</option>
                            <option value="3">3 children</option>
                            <option value="4">4 children</option>
                            <option value="5">5+ children</option>
                        </select>
                    </div>

                    <!-- School-age Children -->
                    <div>
                        <label for="school_children" class="block text-sm font-medium text-gray-700 mb-2">
                            Number of School-age Children (Requiring School Fees)
                        </label>
                        <select 
                            name="school_children" 
                            id="school_children" 
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="0">No school-age children</option>
                            <option value="1">1 child (AUD $13,502/year)</option>
                            <option value="2">2 children</option>
                            <option value="3">3 children</option>
                            <option value="4">4 children</option>
                            <option value="5">5+ children</option>
                        </select>
                        <p class="text-xs text-gray-600 mt-1">
                            Note: School fees may be waived for certain government schools in specific circumstances
                        </p>
                    </div>

                    <!-- Accommodation -->
                    <div>
                        <label for="accommodation" class="block text-sm font-medium text-gray-700 mb-2">
                            Additional Accommodation Costs (Optional)
                        </label>
                        <select 
                            name="accommodation" 
                            id="accommodation" 
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="0">Included in living costs above</option>
                            <option value="15000">On-campus accommodation (~AUD $15,000/year)</option>
                            <option value="20000">Off-campus rental (~AUD $20,000/year)</option>
                            <option value="25000">Private rental (~AUD $25,000/year)</option>
                        </select>
                        <p class="text-xs text-gray-600 mt-1">
                            Only select if you want to add extra accommodation beyond the minimum living costs
                        </p>
                    </div>

                    <!-- Health Cover (OSHC) -->
                    <div>
                        <label for="health_cover" class="block text-sm font-medium text-gray-700 mb-2">
                            Overseas Student Health Cover (OSHC)
                        </label>
                        <select 
                            name="health_cover" 
                            id="health_cover" 
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="600">Single coverage (~AUD $600/year)</option>
                            <option value="1200">Couple coverage (~AUD $1,200/year)</option>
                            <option value="1800">Family coverage (~AUD $1,800/year)</option>
                            <option value="2500">Family coverage - extended (~AUD $2,500/year)</option>
                        </select>
                    </div>

                    <!-- Travel Costs -->
                    <div>
                        <label for="travel" class="block text-sm font-medium text-gray-700 mb-2">
                            Travel Expenses (Return flights)
                        </label>
                        <input 
                            type="number" 
                            name="travel" 
                            id="travel" 
                            min="0" 
                            step="500"
                            value="2000"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter estimated travel costs"
                        >
                        <p class="text-xs text-gray-600 mt-1">
                            Include return airfare for yourself and all dependents
                        </p>
                    </div>

                    <button 
                        type="button" 
                        onclick="calculateFinancial()" 
                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 font-medium transition-colors"
                    >
                        Calculate Requirements
                    </button>
                </form>
            </div>

            <!-- Income Evidence Alternative -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg shadow-md p-6 border-2 border-green-200 mt-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Alternative: Income Evidence</h3>
                        <p class="text-sm text-gray-700 mb-3">
                            Instead of showing funds, you can provide evidence that your parent/spouse/de facto partner earned sufficient income in the 12 months before application:
                        </p>
                        <div class="space-y-3">
                            <div class="bg-white rounded-lg p-4 border border-green-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-sm font-medium text-gray-700">Without Dependants</div>
                                        <div class="text-xs text-gray-500">Annual income required</div>
                                    </div>
                                    <div class="text-2xl font-bold text-green-600">AUD $87,856</div>
                                </div>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-green-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-sm font-medium text-gray-700">With Dependants</div>
                                        <div class="text-xs text-gray-500">Annual income required</div>
                                    </div>
                                    <div class="text-2xl font-bold text-green-600">AUD $102,500</div>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-600 mt-3 italic">
                            Note: Income must be from official government documentation of your parent/spouse/de facto partner
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Results Panel -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6 sticky top-4">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Financial Requirements</h3>
                
                <div id="financialResults" class="hidden">
                    <div class="space-y-4">
                        <div class="border-b pb-2">
                            <div class="text-sm text-gray-600">Total Tuition Fees</div>
                            <div class="text-lg font-semibold text-blue-600" id="totalTuition">AUD $0</div>
                        </div>
                        <div class="border-b pb-2">
                            <div class="text-sm text-gray-600">Living Expenses</div>
                            <div class="text-lg font-semibold text-green-600" id="livingExpenses">AUD $0</div>
                        </div>
                        <div class="border-b pb-2">
                            <div class="text-sm text-gray-600">School Fees</div>
                            <div class="text-lg font-semibold text-purple-600" id="schoolFees">AUD $0</div>
                        </div>
                        <div class="border-b pb-2">
                            <div class="text-sm text-gray-600">Travel Expenses</div>
                            <div class="text-lg font-semibold text-orange-600" id="travelCosts">AUD $0</div>
                        </div>
                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 p-4 rounded-lg">
                            <div class="text-sm text-gray-600 mb-1">Total Financial Capacity Required</div>
                            <div class="text-3xl font-bold text-blue-600" id="totalRequired">AUD $0</div>
                        </div>
                        
                        <!-- OSHC - Separate Requirement -->
                        <div class="bg-gradient-to-r from-amber-50 to-yellow-50 p-4 rounded-lg border-2 border-amber-300 mt-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-amber-600 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                <div class="flex-1">
                                    <div class="text-sm font-semibold text-gray-900 mb-1">Additional Requirement: OSHC</div>
                                    <div class="text-xs text-gray-700 mb-2">Overseas Student Health Cover is mandatory but separate from financial capacity</div>
                                    <div class="flex items-baseline">
                                        <span class="text-xs text-gray-600 mr-2">Estimated cost:</span>
                                        <span class="text-lg font-bold text-amber-700" id="healthCover">AUD $0</span>
                                    </div>
                                    <div class="text-xs text-gray-600 mt-1 italic">Must cover entire visa duration</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Breakdown Details -->
                        <div id="breakdownDetails" class="text-xs text-gray-600 space-y-1 pt-2 border-t">
                            <!-- Populated by JavaScript -->
                        </div>
                    </div>
                </div>
                
                <div id="noFinancialResults" class="text-center text-gray-500 py-8">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    <p>Fill out the form to calculate your financial requirements</p>
                </div>
            </div>

            <!-- Tips Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Important Notes</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex items-start">
                        <span class="text-blue-600 mr-2">💡</span>
                        <span><strong>Living costs:</strong> 12 months maximum (or pro-rata if course is shorter)</span>
                    </div>
                    <div class="flex items-start">
                        <span class="text-green-600 mr-2">💰</span>
                        <span><strong>Tuition fees:</strong> Up to 12 months or remainder of course (whichever is less)</span>
                    </div>
                    <div class="flex items-start">
                        <span class="text-purple-600 mr-2">📋</span>
                        <span><strong>OSHC:</strong> Mandatory for entire visa duration but NOT included in financial capacity calculation (typically prepaid separately)</span>
                    </div>
                    <div class="flex items-start">
                        <span class="text-orange-600 mr-2">🎯</span>
                        <span><strong>Buffer:</strong> Consider adding 10-20% extra for unexpected expenses</span>
                    </div>
                    <div class="flex items-start">
                        <span class="text-indigo-600 mr-2">✈️</span>
                        <span><strong>Travel:</strong> Return airfare for all applicants and dependents</span>
                    </div>
                    <div class="flex items-start">
                        <span class="text-red-600 mr-2">⚠️</span>
                        <span><strong>School fees:</strong> AUD $13,502/year per school-age child (may be waived for some government schools)</span>
                    </div>
                    <div class="flex items-start bg-green-50 p-3 rounded-lg border border-green-200 mt-2">
                        <span class="text-green-600 mr-2">💵</span>
                        <span><strong>Alternative option:</strong> Instead of showing funds, you can use income evidence (parent/spouse/de facto): AUD $87,856 (no dependants) or AUD $102,500 (with dependants)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function calculateFinancial() {
    const form = document.getElementById('studentCalculator');
    const formData = new FormData(form);
    
    // Get form values
    const duration = parseFloat(formData.get('duration') || 0);
    const tuition = parseFloat(formData.get('tuition') || 0);
    const studentLivingCost = 29710; // Official May 2024 rate
    const partners = parseInt(formData.get('partners') || 0);
    const children = parseInt(formData.get('children') || 0);
    const schoolChildren = parseInt(formData.get('school_children') || 0);
    const accommodation = parseFloat(formData.get('accommodation') || 0);
    const healthCover = parseFloat(formData.get('health_cover') || 600);
    const travel = parseFloat(formData.get('travel') || 2000);
    
    // Validation
    if (duration === 0 || tuition === 0) {
        alert('Please fill in course duration and tuition fee');
        return;
    }
    
    // Official rates (May 2024)
    const PARTNER_RATE = 10394;
    const CHILD_LIVING_RATE = 4449;
    const SCHOOL_FEE_RATE = 13502;
    
    // Calculate costs
    // For visa application: Maximum 12 months of tuition or remainder if less
    const tuitionYearsRequired = Math.min(duration, 1);
    const totalTuition = tuition * tuitionYearsRequired;
    
    // Living costs calculation - 12 months maximum (or pro-rata if less)
    const livingYearsRequired = Math.min(duration, 1);
    const studentLiving = studentLivingCost * livingYearsRequired;
    const partnerLiving = (partners * PARTNER_RATE) * livingYearsRequired;
    const childrenLiving = (children * CHILD_LIVING_RATE) * livingYearsRequired;
    const accommodationCosts = accommodation * livingYearsRequired;
    const totalLiving = studentLiving + partnerLiving + childrenLiving + accommodationCosts;
    
    // School fees - 12 months maximum (or pro-rata if less)
    const totalSchoolFees = (schoolChildren * SCHOOL_FEE_RATE) * livingYearsRequired;
    
    // Travel costs
    const totalTravel = travel;
    
    // Grand total for financial capacity (excluding OSHC)
    const totalRequired = totalTuition + totalLiving + totalSchoolFees + totalTravel;
    
    // OSHC - Separate mandatory requirement (not part of financial capacity calculation)
    const totalHealthCover = healthCover * duration;
    
    // Display results
    document.getElementById('totalTuition').textContent = formatCurrency(totalTuition);
    document.getElementById('livingExpenses').textContent = formatCurrency(totalLiving);
    document.getElementById('schoolFees').textContent = formatCurrency(totalSchoolFees);
    document.getElementById('healthCover').textContent = formatCurrency(totalHealthCover);
    document.getElementById('travelCosts').textContent = formatCurrency(totalTravel);
    document.getElementById('totalRequired').textContent = formatCurrency(totalRequired);
    
    // Show breakdown
    const yearsText = livingYearsRequired < 1 ? `${Math.round(livingYearsRequired * 12)} months` : '12 months';
    let breakdown = `<div class="font-semibold mb-2">Living Costs Breakdown (${yearsText}):</div>`;
    breakdown += `<div>• Student: ${formatCurrency(studentLiving)}</div>`;
    if (partners > 0) {
        breakdown += `<div>• Partner: ${formatCurrency(partnerLiving)}</div>`;
    }
    if (children > 0) {
        breakdown += `<div>• ${children} Child${children > 1 ? 'ren' : ''}: ${formatCurrency(childrenLiving)}</div>`;
    }
    if (accommodation > 0) {
        breakdown += `<div>• Extra Accommodation: ${formatCurrency(accommodationCosts)}</div>`;
    }
    if (schoolChildren > 0) {
        breakdown += `<div class="mt-2 font-semibold">School Fees (${yearsText}):</div>`;
        breakdown += `<div>• ${schoolChildren} Child${schoolChildren > 1 ? 'ren' : ''}: ${formatCurrency(totalSchoolFees)}</div>`;
    }
    
    // Add note about duration
    if (duration > 1) {
        breakdown += `<div class="mt-3 text-yellow-600"><strong>Note:</strong> Calculations show 12 months maximum as per visa requirements, even though your course is ${duration} years.</div>`;
    }
    
    document.getElementById('breakdownDetails').innerHTML = breakdown;
    
    // Show results panel
    document.getElementById('financialResults').classList.remove('hidden');
    document.getElementById('noFinancialResults').classList.add('hidden');
}

function formatCurrency(amount) {
    return `AUD $${amount.toLocaleString('en-AU', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}`;
}
</script>
@endpush
@endsection
