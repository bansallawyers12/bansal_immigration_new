@extends('layouts.main')

@section('title', 'Australian Postcode Checker - Regional Area Points Calculator')
@section('description', 'Check if your Australian postcode qualifies for regional area points for skilled migration. Free postcode checker tool.')

@push('styles')
    <title>Australian Postcode Checker - Regional Area Points Calculator</title>
    <meta name="description" content="Check if your Australian postcode qualifies for regional area points for skilled migration. Free postcode checker tool.">
    <meta property="og:title" content="Australian Postcode Checker - Regional Area Points Calculator">
    <meta property="og:description" content="Check if your Australian postcode qualifies for regional area points for skilled migration. Free postcode checker tool.">
@endpush

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
                <div class="relative">
                    <label for="postcode" class="block text-sm font-medium text-gray-700 mb-2">Enter Australian Postcode</label>
                    <input type="text" id="postcode" name="postcode" placeholder="e.g., 3000" 
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                           maxlength="4" pattern="[0-9]{4}" required autocomplete="off">
                    <div id="postcodeSuggestions" class="absolute left-0 right-0 mt-1 bg-white border border-gray-200 rounded-md shadow-lg max-h-60 overflow-auto hidden z-50"></div>
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
            <h3 class="text-2xl font-bold text-gray-800 mb-4">About designated regional areas and points</h3>
            <div class="prose text-gray-600">
                <p class="mb-4">Designated regional area categories (1–3) affect eligibility for certain visas and, in some cases, points on the skilled migration points test.</p>
                <ul class="list-disc list-inside mb-4 space-y-2">
                    <li><strong>Points for study in regional Australia:</strong> Completing eligible study while living and studying in a designated regional area can attract additional points (on top of the Australian study requirement), subject to current policy settings.</li>
                    <li><strong>Points via nomination/sponsorship:</strong> For provisional regional skilled visas (e.g. subclass 491), state/territory nomination or eligible family sponsorship provides additional points toward your Expression of Interest.</li>
                    <li><strong>Visa eligibility conditions:</strong> Some visas require residence, work, or study in designated regional areas (e.g. 491/494 pathways and the permanent 191 visa), regardless of points.</li>
                </ul>
                <p class="mb-4">This checker tells you whether a postcode falls in Category 1 (Not regional – major cities), Category 2 (Cities and major regional centres), or Category 3 (Regional centres and other regional areas). Use this to assess regional requirements and potential points interactions for your chosen visa pathway.</p>
                <p class="text-sm text-gray-500">Policy settings change from time to time. This tool is general information only and not migration advice. Confirm requirements on the Department of Home Affairs website or with a registered migration agent.</p>
            </div>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="mt-16 bg-white rounded-lg shadow-lg p-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Need Help with Your Points Calculation?</h3>
        <p class="text-gray-600 mb-6 text-center">Our migration experts can help you maximize your points for Australian skilled migration. Send us your details for personalized points assessment.</p>
        
        @include('components.unified-contact-form', [
            'form_source' => 'postcode-checker-tool',
            'form_variant' => 'compact',
            'show_phone' => true,
            'show_subject' => false
        ])
    </div>
</div>

<script>
document.getElementById('postcodeForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const postcode = document.getElementById('postcode').value;
    const results = document.getElementById('results');
    const resultContent = document.getElementById('resultContent');

    fetch(`/api/postcode/check?search=${encodeURIComponent(postcode)}`)
        .then(res => res.json())
        .then(data => {
            if (Array.isArray(data) && data.length > 0) {
                const item = data[0];
                const isRegional = !!item.regional;
                const area = item.suburb;
                const state = item.state;
                const category = item.category || (isRegional ? 'Category 2/3' : 'Category 1, Not Regional – Major Cities');

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
                            <p><strong>Area:</strong> ${area}</p>
                            <p><strong>State:</strong> ${state}</p>
                            <p><strong>Regional Status:</strong> ${isRegional ? 'Yes - May qualify for regional points' : 'No - Metropolitan area'}</p>
                            <p><strong>Category:</strong> ${category}</p>
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
        })
        .catch(() => {
            resultContent.innerHTML = '<div class="text-red-600">Error checking postcode. Please try again later.</div>';
            results.classList.remove('hidden');
        });
});

// Autocomplete: populate suburb names when entering a postcode
(function() {
    const input = document.getElementById('postcode');
    const box = document.getElementById('postcodeSuggestions');

    function hideBox() {
        box.classList.add('hidden');
        box.innerHTML = '';
    }

    input.addEventListener('input', function() {
        const q = input.value.trim();
        // Only trigger for numeric input with at least 2 digits
        if (!/^\d{2,4}$/.test(q)) { hideBox(); return; }

        fetch(`/api/postcode/suggest?q=${encodeURIComponent(q)}`)
            .then(res => res.json())
            .then(list => {
                if (!Array.isArray(list) || list.length === 0) { hideBox(); return; }
                box.innerHTML = '';
                list.forEach(item => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'w-full text-left px-3 py-2 hover:bg-gray-100';
                    btn.textContent = `${item.suburb} (${item.postcode}, ${item.state})`;
                    btn.onclick = () => {
                        // Keep postcode in the field; submit to show category result
                        input.value = String(item.postcode);
                        hideBox();
                        document.getElementById('postcodeForm').dispatchEvent(new Event('submit', { cancelable: true }));
                    };
                    box.appendChild(btn);
                });
                box.classList.remove('hidden');
            })
            .catch(() => hideBox());
    });

    document.addEventListener('click', function(ev) {
        if (!box.contains(ev.target) && ev.target !== input) hideBox();
    });
})();
</script>
@endsection
