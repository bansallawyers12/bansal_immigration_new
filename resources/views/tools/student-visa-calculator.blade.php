@extends('layouts.main')

@section('title', 'Student Visa Financial Calculator - Calculate Your Financial Requirements | Bansal Immigration')
@section('description', 'Calculate the financial requirements for your Australian student visa application. Check living costs, tuition fees, and financial capacity.')

@push('styles')
@extends('layouts.main')


    <title>Student Visa Financial Calculator - Calculate Your Financial Requirements | Bansal Immigration</title>
    <meta name="description" content="Calculate the financial requirements for your Australian student visa application. Check living costs, tuition fees, and financial capacity.">
    <meta name="keywords" content="student visa calculator, financial requirements, living costs australia, student visa 500">


@section('content')
<div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4">Student Visa Financial Calculator</h1>
        <p class="text-xl opacity-90">Calculate your financial requirements for Australian student visa</p>
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
                        <label class="block text-sm font-medium text-gray-700 mb-2">Course Duration (years)</label>
                        <input type="number" name="duration" id="duration" min="0.5" max="10" step="0.5" 
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Enter course duration">
                    </div>

                    <!-- Annual Tuition Fee -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Annual Tuition Fee (AUD)</label>
                        <input type="number" name="tuition" id="tuition" min="0" step="1000"
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Enter annual tuition fee">
                    </div>

                    <!-- Location -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Study Location</label>
                        <select name="location" id="location" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select location</option>
                            <option value="24505">Sydney, Melbourne, Brisbane, Perth, Adelaide (AUD 24,505/year)</option>
                            <option value="18610">Other areas (AUD 18,610/year)</option>
                        </select>
                    </div>

                    <!-- Dependents -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Number of Dependents</label>
                        <select name="dependents" id="dependents" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="0">No dependents</option>
                            <option value="1">1 dependent</option>
                            <option value="2">2 dependents</option>
                            <option value="3">3 dependents</option>
                            <option value="4">4+ dependents</option>
                        </select>
                    </div>

                    <!-- Accommodation -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Accommodation Type</label>
                        <select name="accommodation" id="accommodation" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="0">Included in living costs calculation</option>
                            <option value="15000">On-campus accommodation (~AUD 15,000/year)</option>
                            <option value="20000">Off-campus rental (~AUD 20,000/year)</option>
                            <option value="25000">Private rental (~AUD 25,000/year)</option>
                        </select>
                    </div>

                    <!-- Health Cover -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Overseas Student Health Cover (OSHC)</label>
                        <select name="health_cover" id="health_cover" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="600">Single coverage (~AUD 600/year)</option>
                            <option value="1200">Couple coverage (~AUD 1,200/year)</option>
                            <option value="1800">Family coverage (~AUD 1,800/year)</option>
                        </select>
                    </div>

                    <button type="button" onclick="calculateFinancial()" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 font-medium">
                        Calculate Requirements
                    </button>
                </form>
            </div>
        </div>

        <!-- Results -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Financial Requirements</h3>
                <div id="financialResults" class="hidden">
                    <div class="space-y-4">
                        <div class="border-b pb-2">
                            <div class="text-sm text-gray-600">Total Tuition Fees</div>
                            <div class="text-lg font-semibold text-blue-600" id="totalTuition">AUD 0</div>
                        </div>
                        <div class="border-b pb-2">
                            <div class="text-sm text-gray-600">Living Expenses</div>
                            <div class="text-lg font-semibold text-green-600" id="livingExpenses">AUD 0</div>
                        </div>
                        <div class="border-b pb-2">
                            <div class="text-sm text-gray-600">Health Cover (OSHC)</div>
                            <div class="text-lg font-semibold text-purple-600" id="healthCover">AUD 0</div>
                        </div>
                        <div class="border-b pb-2">
                            <div class="text-sm text-gray-600">Other Costs</div>
                            <div class="text-lg font-semibold text-orange-600" id="otherCosts">AUD 2,000</div>
                        </div>
                        <div class="bg-blue-50 p-3 rounded">
                            <div class="text-sm text-gray-600">Total Required</div>
                            <div class="text-2xl font-bold text-blue-600" id="totalRequired">AUD 0</div>
                        </div>
                    </div>
                </div>
                <div id="noFinancialResults" class="text-center text-gray-500">
                    Fill out the form to calculate your financial requirements
                </div>
            </div>

            <!-- Tips -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Financial Tips</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex items-start">
                        <span class="text-blue-600 mr-2">💡</span>
                        <span>Show 12 months of living expenses for yourself and dependents</span>
                    </div>
                    <div class="flex items-start">
                        <span class="text-green-600 mr-2">💰</span>
                        <span>Include first year tuition fees in your financial evidence</span>
                    </div>
                    <div class="flex items-start">
                        <span class="text-purple-600 mr-2">📋</span>
                        <span>OSHC is mandatory for the entire visa duration</span>
                    </div>
                    <div class="flex items-start">
                        <span class="text-orange-600 mr-2">🎯</span>
                        <span>Add 10-20% buffer for unexpected expenses</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function calculateFinancial() {
    const form = document.getElementById('studentCalculator');
    const formData = new FormData(form);
    
    const duration = parseFloat(formData.get('duration') || 0);
    const tuition = parseFloat(formData.get('tuition') || 0);
    const locationCost = parseFloat(formData.get('location') || 0);
    const dependents = parseInt(formData.get('dependents') || 0);
    const accommodation = parseFloat(formData.get('accommodation') || 0);
    const healthCover = parseFloat(formData.get('health_cover') || 600);
    
    if (duration === 0 || tuition === 0 || locationCost === 0) {
        alert('Please fill in all required fields');
        return;
    }
    
    // Calculate costs
    const totalTuition = tuition * duration;
    const livingCostPerYear = locationCost + (dependents * 8,560); // AUD 8,560 per dependent per year
    const totalLiving = livingCostPerYear * duration;
    const totalHealthCover = healthCover * duration;
    const otherCosts = 2000; // Visa fees, airfares, etc.
    const accommodationCosts = accommodation * duration;
    
    const totalRequired = totalTuition + totalLiving + totalHealthCover + otherCosts + accommodationCosts;
    
    // Display results
    document.getElementById('totalTuition').textContent = `AUD ${totalTuition.toLocaleString()}`;
    document.getElementById('livingExpenses').textContent = `AUD ${(totalLiving + accommodationCosts).toLocaleString()}`;
    document.getElementById('healthCover').textContent = `AUD ${totalHealthCover.toLocaleString()}`;
    document.getElementById('otherCosts').textContent = `AUD ${otherCosts.toLocaleString()}`;
    document.getElementById('totalRequired').textContent = `AUD ${totalRequired.toLocaleString()}`;
    
    document.getElementById('financialResults').classList.remove('hidden');
    document.getElementById('noFinancialResults').classList.add('hidden');
}
</script>
@endsection

@endpush

@section('content')
<div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4">Student Visa Financial Calculator</h1>
        <p class="text-xl opacity-90">Calculate your financial requirements for Australian student visa</p>
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
                        <label class="block text-sm font-medium text-gray-700 mb-2">Course Duration (years)</label>
                        <input type="number" name="duration" id="duration" min="0.5" max="10" step="0.5" 
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Enter course duration">
                    </div>

                    <!-- Annual Tuition Fee -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Annual Tuition Fee (AUD)</label>
                        <input type="number" name="tuition" id="tuition" min="0" step="1000"
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Enter annual tuition fee">
                    </div>

                    <!-- Location -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Study Location</label>
                        <select name="location" id="location" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select location</option>
                            <option value="24505">Sydney, Melbourne, Brisbane, Perth, Adelaide (AUD 24,505/year)</option>
                            <option value="18610">Other areas (AUD 18,610/year)</option>
                        </select>
                    </div>

                    <!-- Dependents -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Number of Dependents</label>
                        <select name="dependents" id="dependents" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="0">No dependents</option>
                            <option value="1">1 dependent</option>
                            <option value="2">2 dependents</option>
                            <option value="3">3 dependents</option>
                            <option value="4">4+ dependents</option>
                        </select>
                    </div>

                    <!-- Accommodation -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Accommodation Type</label>
                        <select name="accommodation" id="accommodation" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="0">Included in living costs calculation</option>
                            <option value="15000">On-campus accommodation (~AUD 15,000/year)</option>
                            <option value="20000">Off-campus rental (~AUD 20,000/year)</option>
                            <option value="25000">Private rental (~AUD 25,000/year)</option>
                        </select>
                    </div>

                    <!-- Health Cover -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Overseas Student Health Cover (OSHC)</label>
                        <select name="health_cover" id="health_cover" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="600">Single coverage (~AUD 600/year)</option>
                            <option value="1200">Couple coverage (~AUD 1,200/year)</option>
                            <option value="1800">Family coverage (~AUD 1,800/year)</option>
                        </select>
                    </div>

                    <button type="button" onclick="calculateFinancial()" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 font-medium">
                        Calculate Requirements
                    </button>
                </form>
            </div>
        </div>

        <!-- Results -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Financial Requirements</h3>
                <div id="financialResults" class="hidden">
                    <div class="space-y-4">
                        <div class="border-b pb-2">
                            <div class="text-sm text-gray-600">Total Tuition Fees</div>
                            <div class="text-lg font-semibold text-blue-600" id="totalTuition">AUD 0</div>
                        </div>
                        <div class="border-b pb-2">
                            <div class="text-sm text-gray-600">Living Expenses</div>
                            <div class="text-lg font-semibold text-green-600" id="livingExpenses">AUD 0</div>
                        </div>
                        <div class="border-b pb-2">
                            <div class="text-sm text-gray-600">Health Cover (OSHC)</div>
                            <div class="text-lg font-semibold text-purple-600" id="healthCover">AUD 0</div>
                        </div>
                        <div class="border-b pb-2">
                            <div class="text-sm text-gray-600">Other Costs</div>
                            <div class="text-lg font-semibold text-orange-600" id="otherCosts">AUD 2,000</div>
                        </div>
                        <div class="bg-blue-50 p-3 rounded">
                            <div class="text-sm text-gray-600">Total Required</div>
                            <div class="text-2xl font-bold text-blue-600" id="totalRequired">AUD 0</div>
                        </div>
                    </div>
                </div>
                <div id="noFinancialResults" class="text-center text-gray-500">
                    Fill out the form to calculate your financial requirements
                </div>
            </div>

            <!-- Tips -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Financial Tips</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex items-start">
                        <span class="text-blue-600 mr-2">💡</span>
                        <span>Show 12 months of living expenses for yourself and dependents</span>
                    </div>
                    <div class="flex items-start">
                        <span class="text-green-600 mr-2">💰</span>
                        <span>Include first year tuition fees in your financial evidence</span>
                    </div>
                    <div class="flex items-start">
                        <span class="text-purple-600 mr-2">📋</span>
                        <span>OSHC is mandatory for the entire visa duration</span>
                    </div>
                    <div class="flex items-start">
                        <span class="text-orange-600 mr-2">🎯</span>
                        <span>Add 10-20% buffer for unexpected expenses</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function calculateFinancial() {
    const form = document.getElementById('studentCalculator');
    const formData = new FormData(form);
    
    const duration = parseFloat(formData.get('duration') || 0);
    const tuition = parseFloat(formData.get('tuition') || 0);
    const locationCost = parseFloat(formData.get('location') || 0);
    const dependents = parseInt(formData.get('dependents') || 0);
    const accommodation = parseFloat(formData.get('accommodation') || 0);
    const healthCover = parseFloat(formData.get('health_cover') || 600);
    
    if (duration === 0 || tuition === 0 || locationCost === 0) {
        alert('Please fill in all required fields');
        return;
    }
    
    // Calculate costs
    const totalTuition = tuition * duration;
    const livingCostPerYear = locationCost + (dependents * 8,560); // AUD 8,560 per dependent per year
    const totalLiving = livingCostPerYear * duration;
    const totalHealthCover = healthCover * duration;
    const otherCosts = 2000; // Visa fees, airfares, etc.
    const accommodationCosts = accommodation * duration;
    
    const totalRequired = totalTuition + totalLiving + totalHealthCover + otherCosts + accommodationCosts;
    
    // Display results
    document.getElementById('totalTuition').textContent = `AUD ${totalTuition.toLocaleString()}`;
    document.getElementById('livingExpenses').textContent = `AUD ${(totalLiving + accommodationCosts).toLocaleString()}`;
    document.getElementById('healthCover').textContent = `AUD ${totalHealthCover.toLocaleString()}`;
    document.getElementById('otherCosts').textContent = `AUD ${otherCosts.toLocaleString()}`;
    document.getElementById('totalRequired').textContent = `AUD ${totalRequired.toLocaleString()}`;
    
    document.getElementById('financialResults').classList.remove('hidden');
    document.getElementById('noFinancialResults').classList.add('hidden');
}
</script>
@endsection
