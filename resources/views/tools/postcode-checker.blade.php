@extends('layouts.frontend')

@section('seoinfo')
    <title>Australian Postcode Checker - Regional Area Points Calculator</title>
    <meta name="description" content="Check if your Australian postcode qualifies for regional area points for skilled migration. Free postcode checker tool.">
    <meta property="og:title" content="Australian Postcode Checker - Regional Area Points Calculator">
    <meta property="og:description" content="Check if your Australian postcode qualifies for regional area points for skilled migration. Free postcode checker tool.">
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Australian Postcode Checker</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Check if your Australian postcode qualifies for regional area points for skilled migration visas</p>
    </div>

    <!-- Postcode Checker Tool -->
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Postcode Checker Tool</h2>
            
            <form id="postcodeForm" class="space-y-6">
                <div>
                    <label for="postcode" class="block text-sm font-medium text-gray-700 mb-2">Enter Australian Postcode</label>
                    <input type="text" id="postcode" name="postcode" placeholder="e.g., 3000" 
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                           maxlength="4" pattern="[0-9]{4}" required>
                </div>
                
                <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Check Postcode
                </button>
            </form>

            <!-- Results Area -->
            <div id="results" class="mt-8 hidden">
                <div class="border-t pt-6">
                    <div id="resultContent"></div>
                </div>
            </div>
        </div>

        <!-- Information Section -->
        <div class="bg-blue-50 rounded-lg p-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">About Regional Area Points</h3>
            <div class="prose text-gray-600">
                <p class="mb-4">Under Australia's skilled migration points system, you may be eligible for additional points if you:</p>
                <ul class="list-disc list-inside mb-4 space-y-2">
                    <li>Have lived and worked in a designated regional area</li>
                    <li>Have studied in a designated regional area</li>
                    <li>Have a spouse/partner who has lived in a regional area</li>
                </ul>
                <p class="mb-4"><strong>Regional Area Points:</strong> Up to 5 additional points may be available for regional study or work experience.</p>
                <p class="text-sm text-gray-500">Note: This tool provides general guidance only. Always consult with a registered migration agent for accurate advice on your specific situation.</p>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="mt-16 bg-green-50 rounded-lg p-8 text-center">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Need Help with Your Points Calculation?</h3>
        <p class="text-gray-600 mb-6">Our migration experts can help you maximize your points for Australian skilled migration.</p>
        <a href="{{ route('contact') }}" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition-colors inline-block font-medium">Get Expert Advice</a>
    </div>
</div>

<script>
document.getElementById('postcodeForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const postcode = document.getElementById('postcode').value;
    const results = document.getElementById('results');
    const resultContent = document.getElementById('resultContent');
    
    // Simple postcode checker logic (you can enhance this with a real API)
    const regionalPostcodes = {
        // Sample regional postcodes - you should use a comprehensive list
        '3000': { area: 'Melbourne CBD', regional: false, state: 'VIC' },
        '3001': { area: 'Melbourne', regional: false, state: 'VIC' },
        '3350': { area: 'Ballarat', regional: true, state: 'VIC' },
        '4000': { area: 'Brisbane CBD', regional: false, state: 'QLD' },
        '4350': { area: 'Toowoomba', regional: true, state: 'QLD' },
        '5000': { area: 'Adelaide CBD', regional: true, state: 'SA' },
        '6000': { area: 'Perth CBD', regional: false, state: 'WA' },
        '7000': { area: 'Hobart', regional: true, state: 'TAS' },
        '2000': { area: 'Sydney CBD', regional: false, state: 'NSW' },
        '2480': { area: 'Byron Bay', regional: true, state: 'NSW' }
    };
    
    if (regionalPostcodes[postcode]) {
        const info = regionalPostcodes[postcode];
        const isRegional = info.regional;
        
        resultContent.innerHTML = `
            <div class="p-4 rounded-lg ${isRegional ? 'bg-green-100 border border-green-200' : 'bg-yellow-100 border border-yellow-200'}">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 ${isRegional ? 'text-green-600' : 'text-yellow-600'}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${isRegional ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' : 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z'}" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-lg font-semibold ${isRegional ? 'text-green-800' : 'text-yellow-800'}">
                            ${isRegional ? 'Regional Area' : 'Metropolitan Area'}
                        </h4>
                        <div class="mt-2 text-sm ${isRegional ? 'text-green-700' : 'text-yellow-700'}">
                            <p><strong>Postcode:</strong> ${postcode}</p>
                            <p><strong>Area:</strong> ${info.area}</p>
                            <p><strong>State:</strong> ${info.state}</p>
                            <p><strong>Regional Status:</strong> ${isRegional ? 'Yes - May qualify for regional points' : 'No - Metropolitan area'}</p>
                        </div>
                    </div>
                </div>
            </div>
        `;
    } else {
        resultContent.innerHTML = `
            <div class="p-4 rounded-lg bg-gray-100 border border-gray-200">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-lg font-semibold text-gray-800">Postcode Not Found</h4>
                        <div class="mt-2 text-sm text-gray-700">
                            <p>We don't have information for postcode ${postcode} in our database.</p>
                            <p class="mt-2">Please contact our migration experts for accurate information about this postcode's regional status.</p>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }
    
    results.classList.remove('hidden');
    results.scrollIntoView({ behavior: 'smooth' });
});
</script>
@endsection
