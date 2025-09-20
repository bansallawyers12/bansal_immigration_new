@extends('layouts.main')

@section('title', 'PR Points Calculator - Calculate Your Australian PR Points | Bansal Immigration')
@section('description', 'Calculate your Australian PR points with our comprehensive points calculator. Check your eligibility for skilled migration visas 189, 190, 491.')

@push('styles')
@extends('layouts.main')


    <title>PR Points Calculator - Calculate Your Australian PR Points | Bansal Immigration</title>
    <meta name="description" content="Calculate your Australian PR points with our comprehensive points calculator. Check your eligibility for skilled migration visas 189, 190, 491.">
    <meta name="keywords" content="PR points calculator, Australia PR points, skilled migration points, visa 189 points, visa 190 points">
    <meta property="og:title" content="PR Points Calculator - Australian Immigration">
    <meta property="og:description" content="Calculate your Australian PR points with our comprehensive points calculator.">


@section('content')
<div class="bg-gradient-to-r from-blue-600 to-green-600 text-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4">Australian PR Points Calculator</h1>
        <p class="text-xl opacity-90">Calculate your eligibility for Australian Skilled Migration Visas</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="/" class="hover:text-blue-600">Home</a></li>
            <li>/</li>
            <li><a href="/migration" class="hover:text-blue-600">Migration</a></li>
            <li>/</li>
            <li class="text-gray-900">PR Points Calculator</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Calculator Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold text-gray-900 mb-6">Calculate Your Points</h2>
                
                <form id="prCalculator" class="space-y-6">
                    <!-- Age -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Age (at time of invitation)</label>
                        <select name="age" id="age" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="0">Select your age</option>
                            <option value="0">Under 18 years (0 points)</option>
                            <option value="25">18-24 years (25 points)</option>
                            <option value="30">25-32 years (30 points)</option>
                            <option value="25">33-39 years (25 points)</option>
                            <option value="15">40-44 years (15 points)</option>
                            <option value="0">45 years and over (0 points)</option>
                        </select>
                    </div>

                    <!-- English Language -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">English Language Proficiency</label>
                        <select name="english" id="english" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="0">Select English level</option>
                            <option value="0">Competent English (0 points)</option>
                            <option value="10">Proficient English (10 points)</option>
                            <option value="20">Superior English (20 points)</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">IELTS 6/PTE 50 = Competent, IELTS 7/PTE 65 = Proficient, IELTS 8/PTE 79 = Superior</p>
                    </div>

                    <!-- Education -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Educational Qualifications</label>
                        <select name="education" id="education" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="0">Select highest qualification</option>
                            <option value="10">Diploma or trade qualification (10 points)</option>
                            <option value="15">Bachelor degree or equivalent (15 points)</option>
                            <option value="20">Masters/PhD or equivalent (20 points)</option>
                        </select>
                    </div>

                    <!-- Skilled Employment - Overseas -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Skilled Employment Experience (Overseas)</label>
                        <select name="overseas_experience" id="overseas_experience" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="0">Select experience</option>
                            <option value="0">Less than 3 years (0 points)</option>
                            <option value="5">3-4 years (5 points)</option>
                            <option value="10">5-7 years (10 points)</option>
                            <option value="15">8+ years (15 points)</option>
                        </select>
                    </div>

                    <!-- Skilled Employment - Australia -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Skilled Employment Experience (Australia)</label>
                        <select name="australian_experience" id="australian_experience" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="0">Select experience</option>
                            <option value="0">Less than 1 year (0 points)</option>
                            <option value="5">1-2 years (5 points)</option>
                            <option value="10">3-4 years (10 points)</option>
                            <option value="15">5-7 years (15 points)</option>
                            <option value="20">8+ years (20 points)</option>
                        </select>
                    </div>

                    <!-- Other Factors -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-800">Additional Points</h3>
                        
                        <div class="flex items-center">
                            <input type="checkbox" name="australian_study" id="australian_study" value="5" class="mr-2">
                            <label for="australian_study" class="text-sm text-gray-700">Australian study requirement (5 points)</label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" name="specialist_education" id="specialist_education" value="10" class="mr-2">
                            <label for="specialist_education" class="text-sm text-gray-700">Specialist Education Qualification (10 points)</label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" name="community_language" id="community_language" value="5" class="mr-2">
                            <label for="community_language" class="text-sm text-gray-700">Credentialed Community Language (5 points)</label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" name="professional_year" id="professional_year" value="5" class="mr-2">
                            <label for="professional_year" class="text-sm text-gray-700">Professional Year in Australia (5 points)</label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" name="regional_study" id="regional_study" value="5" class="mr-2">
                            <label for="regional_study" class="text-sm text-gray-700">Regional study (5 points)</label>
                        </div>
                    </div>

                    <!-- Partner Points -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Partner/Spouse Points</label>
                        <select name="partner_points" id="partner_points" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="0">No partner or not applicable (0 points)</option>
                            <option value="10">Partner with skills and qualifications (10 points)</option>
                            <option value="5">Partner with competent English (5 points)</option>
                            <option value="10">Partner is Australian citizen/PR (10 points)</option>
                        </select>
                    </div>

                    <button type="button" onclick="calculatePoints()" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 font-medium">
                        Calculate My Points
                    </button>
                </form>
            </div>
        </div>

        <!-- Results & Information -->
        <div class="lg:col-span-1">
            <!-- Results -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Your Points</h3>
                <div id="results" class="hidden">
                    <div class="text-center">
                        <div class="text-4xl font-bold text-blue-600 mb-2" id="totalPoints">0</div>
                        <p class="text-gray-600 mb-4">Total Points</p>
                        <div id="eligibilityStatus" class="p-3 rounded-lg mb-4"></div>
                        <div id="pointsBreakdown" class="text-left text-sm space-y-1"></div>
                    </div>
                </div>
                <div id="noResults" class="text-center text-gray-500">
                    Fill out the form to calculate your points
                </div>
            </div>

            <!-- Visa Information -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Visa Options</h3>
                <div class="space-y-3 text-sm">
                    <div class="border-l-4 border-blue-500 pl-3">
                        <strong>Subclass 189 (Independent)</strong><br>
                        Minimum 65 points required
                    </div>
                    <div class="border-l-4 border-green-500 pl-3">
                        <strong>Subclass 190 (State Nominated)</strong><br>
                        Minimum 65 points + state nomination
                    </div>
                    <div class="border-l-4 border-purple-500 pl-3">
                        <strong>Subclass 491 (Regional)</strong><br>
                        Minimum 65 points + regional nomination
                    </div>
                </div>
            </div>

            <!-- Contact CTA -->
            <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-lg p-6 text-white">
                <h3 class="text-lg font-semibold mb-2">Need Professional Advice?</h3>
                <p class="text-sm mb-4">Our migration agents can help you improve your points and choose the best visa pathway.</p>
                <a href="{{ route('appointment') }}" class="bg-white text-yellow-600 px-4 py-2 rounded font-medium hover:bg-gray-100 inline-block text-center w-full">Book Consultation</a>
            </div>
        </div>
    </div>
</div>

<script>
function calculatePoints() {
    const form = document.getElementById('prCalculator');
    const formData = new FormData(form);
    
    let totalPoints = 0;
    let breakdown = [];
    
    // Age points
    const age = parseInt(formData.get('age') || 0);
    if (age > 0) {
        totalPoints += age;
        breakdown.push(`Age: ${age} points`);
    }
    
    // English points
    const english = parseInt(formData.get('english') || 0);
    if (english > 0) {
        totalPoints += english;
        breakdown.push(`English: ${english} points`);
    }
    
    // Education points
    const education = parseInt(formData.get('education') || 0);
    if (education > 0) {
        totalPoints += education;
        breakdown.push(`Education: ${education} points`);
    }
    
    // Experience points
    const overseasExp = parseInt(formData.get('overseas_experience') || 0);
    const australianExp = parseInt(formData.get('australian_experience') || 0);
    if (overseasExp > 0) {
        totalPoints += overseasExp;
        breakdown.push(`Overseas Experience: ${overseasExp} points`);
    }
    if (australianExp > 0) {
        totalPoints += australianExp;
        breakdown.push(`Australian Experience: ${australianExp} points`);
    }
    
    // Additional points
    const additionalFactors = ['australian_study', 'specialist_education', 'community_language', 'professional_year', 'regional_study'];
    additionalFactors.forEach(factor => {
        if (formData.get(factor)) {
            const points = parseInt(document.getElementById(factor).value);
            totalPoints += points;
            breakdown.push(`${document.querySelector(`label[for="${factor}"]`).textContent.replace(' (' + points + ' points)', '')}: ${points} points`);
        }
    });
    
    // Partner points
    const partnerPoints = parseInt(formData.get('partner_points') || 0);
    if (partnerPoints > 0) {
        totalPoints += partnerPoints;
        breakdown.push(`Partner: ${partnerPoints} points`);
    }
    
    // Display results
    document.getElementById('totalPoints').textContent = totalPoints;
    document.getElementById('pointsBreakdown').innerHTML = breakdown.map(item => `<div>${item}</div>`).join('');
    
    // Eligibility status
    const statusDiv = document.getElementById('eligibilityStatus');
    if (totalPoints >= 80) {
        statusDiv.className = 'p-3 rounded-lg mb-4 bg-green-100 text-green-800';
        statusDiv.textContent = 'Excellent chances for invitation!';
    } else if (totalPoints >= 70) {
        statusDiv.className = 'p-3 rounded-lg mb-4 bg-blue-100 text-blue-800';
        statusDiv.textContent = 'Good chances for invitation';
    } else if (totalPoints >= 65) {
        statusDiv.className = 'p-3 rounded-lg mb-4 bg-yellow-100 text-yellow-800';
        statusDiv.textContent = 'Meets minimum requirement';
    } else {
        statusDiv.className = 'p-3 rounded-lg mb-4 bg-red-100 text-red-800';
        statusDiv.textContent = 'Below minimum requirement';
    }
    
    document.getElementById('results').classList.remove('hidden');
    document.getElementById('noResults').classList.add('hidden');
}
</script>
@endsection

@endpush

@section('content')
<div class="bg-gradient-to-r from-blue-600 to-green-600 text-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4">Australian PR Points Calculator</h1>
        <p class="text-xl opacity-90">Calculate your eligibility for Australian Skilled Migration Visas</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="/" class="hover:text-blue-600">Home</a></li>
            <li>/</li>
            <li><a href="/migration" class="hover:text-blue-600">Migration</a></li>
            <li>/</li>
            <li class="text-gray-900">PR Points Calculator</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Calculator Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold text-gray-900 mb-6">Calculate Your Points</h2>
                
                <form id="prCalculator" class="space-y-6">
                    <!-- Age -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Age (at time of invitation)</label>
                        <select name="age" id="age" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="0">Select your age</option>
                            <option value="0">Under 18 years (0 points)</option>
                            <option value="25">18-24 years (25 points)</option>
                            <option value="30">25-32 years (30 points)</option>
                            <option value="25">33-39 years (25 points)</option>
                            <option value="15">40-44 years (15 points)</option>
                            <option value="0">45 years and over (0 points)</option>
                        </select>
                    </div>

                    <!-- English Language -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">English Language Proficiency</label>
                        <select name="english" id="english" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="0">Select English level</option>
                            <option value="0">Competent English (0 points)</option>
                            <option value="10">Proficient English (10 points)</option>
                            <option value="20">Superior English (20 points)</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">IELTS 6/PTE 50 = Competent, IELTS 7/PTE 65 = Proficient, IELTS 8/PTE 79 = Superior</p>
                    </div>

                    <!-- Education -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Educational Qualifications</label>
                        <select name="education" id="education" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="0">Select highest qualification</option>
                            <option value="10">Diploma or trade qualification (10 points)</option>
                            <option value="15">Bachelor degree or equivalent (15 points)</option>
                            <option value="20">Masters/PhD or equivalent (20 points)</option>
                        </select>
                    </div>

                    <!-- Skilled Employment - Overseas -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Skilled Employment Experience (Overseas)</label>
                        <select name="overseas_experience" id="overseas_experience" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="0">Select experience</option>
                            <option value="0">Less than 3 years (0 points)</option>
                            <option value="5">3-4 years (5 points)</option>
                            <option value="10">5-7 years (10 points)</option>
                            <option value="15">8+ years (15 points)</option>
                        </select>
                    </div>

                    <!-- Skilled Employment - Australia -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Skilled Employment Experience (Australia)</label>
                        <select name="australian_experience" id="australian_experience" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="0">Select experience</option>
                            <option value="0">Less than 1 year (0 points)</option>
                            <option value="5">1-2 years (5 points)</option>
                            <option value="10">3-4 years (10 points)</option>
                            <option value="15">5-7 years (15 points)</option>
                            <option value="20">8+ years (20 points)</option>
                        </select>
                    </div>

                    <!-- Other Factors -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-800">Additional Points</h3>
                        
                        <div class="flex items-center">
                            <input type="checkbox" name="australian_study" id="australian_study" value="5" class="mr-2">
                            <label for="australian_study" class="text-sm text-gray-700">Australian study requirement (5 points)</label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" name="specialist_education" id="specialist_education" value="10" class="mr-2">
                            <label for="specialist_education" class="text-sm text-gray-700">Specialist Education Qualification (10 points)</label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" name="community_language" id="community_language" value="5" class="mr-2">
                            <label for="community_language" class="text-sm text-gray-700">Credentialed Community Language (5 points)</label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" name="professional_year" id="professional_year" value="5" class="mr-2">
                            <label for="professional_year" class="text-sm text-gray-700">Professional Year in Australia (5 points)</label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" name="regional_study" id="regional_study" value="5" class="mr-2">
                            <label for="regional_study" class="text-sm text-gray-700">Regional study (5 points)</label>
                        </div>
                    </div>

                    <!-- Partner Points -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Partner/Spouse Points</label>
                        <select name="partner_points" id="partner_points" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="0">No partner or not applicable (0 points)</option>
                            <option value="10">Partner with skills and qualifications (10 points)</option>
                            <option value="5">Partner with competent English (5 points)</option>
                            <option value="10">Partner is Australian citizen/PR (10 points)</option>
                        </select>
                    </div>

                    <button type="button" onclick="calculatePoints()" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 font-medium">
                        Calculate My Points
                    </button>
                </form>
            </div>
        </div>

        <!-- Results & Information -->
        <div class="lg:col-span-1">
            <!-- Results -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Your Points</h3>
                <div id="results" class="hidden">
                    <div class="text-center">
                        <div class="text-4xl font-bold text-blue-600 mb-2" id="totalPoints">0</div>
                        <p class="text-gray-600 mb-4">Total Points</p>
                        <div id="eligibilityStatus" class="p-3 rounded-lg mb-4"></div>
                        <div id="pointsBreakdown" class="text-left text-sm space-y-1"></div>
                    </div>
                </div>
                <div id="noResults" class="text-center text-gray-500">
                    Fill out the form to calculate your points
                </div>
            </div>

            <!-- Visa Information -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Visa Options</h3>
                <div class="space-y-3 text-sm">
                    <div class="border-l-4 border-blue-500 pl-3">
                        <strong>Subclass 189 (Independent)</strong><br>
                        Minimum 65 points required
                    </div>
                    <div class="border-l-4 border-green-500 pl-3">
                        <strong>Subclass 190 (State Nominated)</strong><br>
                        Minimum 65 points + state nomination
                    </div>
                    <div class="border-l-4 border-purple-500 pl-3">
                        <strong>Subclass 491 (Regional)</strong><br>
                        Minimum 65 points + regional nomination
                    </div>
                </div>
            </div>

            <!-- Contact CTA -->
            <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-lg p-6 text-white">
                <h3 class="text-lg font-semibold mb-2">Need Professional Advice?</h3>
                <p class="text-sm mb-4">Our migration agents can help you improve your points and choose the best visa pathway.</p>
                <a href="{{ route('appointment') }}" class="bg-white text-yellow-600 px-4 py-2 rounded font-medium hover:bg-gray-100 inline-block text-center w-full">Book Consultation</a>
            </div>
        </div>
    </div>
</div>

<script>
function calculatePoints() {
    const form = document.getElementById('prCalculator');
    const formData = new FormData(form);
    
    let totalPoints = 0;
    let breakdown = [];
    
    // Age points
    const age = parseInt(formData.get('age') || 0);
    if (age > 0) {
        totalPoints += age;
        breakdown.push(`Age: ${age} points`);
    }
    
    // English points
    const english = parseInt(formData.get('english') || 0);
    if (english > 0) {
        totalPoints += english;
        breakdown.push(`English: ${english} points`);
    }
    
    // Education points
    const education = parseInt(formData.get('education') || 0);
    if (education > 0) {
        totalPoints += education;
        breakdown.push(`Education: ${education} points`);
    }
    
    // Experience points
    const overseasExp = parseInt(formData.get('overseas_experience') || 0);
    const australianExp = parseInt(formData.get('australian_experience') || 0);
    if (overseasExp > 0) {
        totalPoints += overseasExp;
        breakdown.push(`Overseas Experience: ${overseasExp} points`);
    }
    if (australianExp > 0) {
        totalPoints += australianExp;
        breakdown.push(`Australian Experience: ${australianExp} points`);
    }
    
    // Additional points
    const additionalFactors = ['australian_study', 'specialist_education', 'community_language', 'professional_year', 'regional_study'];
    additionalFactors.forEach(factor => {
        if (formData.get(factor)) {
            const points = parseInt(document.getElementById(factor).value);
            totalPoints += points;
            breakdown.push(`${document.querySelector(`label[for="${factor}"]`).textContent.replace(' (' + points + ' points)', '')}: ${points} points`);
        }
    });
    
    // Partner points
    const partnerPoints = parseInt(formData.get('partner_points') || 0);
    if (partnerPoints > 0) {
        totalPoints += partnerPoints;
        breakdown.push(`Partner: ${partnerPoints} points`);
    }
    
    // Display results
    document.getElementById('totalPoints').textContent = totalPoints;
    document.getElementById('pointsBreakdown').innerHTML = breakdown.map(item => `<div>${item}</div>`).join('');
    
    // Eligibility status
    const statusDiv = document.getElementById('eligibilityStatus');
    if (totalPoints >= 80) {
        statusDiv.className = 'p-3 rounded-lg mb-4 bg-green-100 text-green-800';
        statusDiv.textContent = 'Excellent chances for invitation!';
    } else if (totalPoints >= 70) {
        statusDiv.className = 'p-3 rounded-lg mb-4 bg-blue-100 text-blue-800';
        statusDiv.textContent = 'Good chances for invitation';
    } else if (totalPoints >= 65) {
        statusDiv.className = 'p-3 rounded-lg mb-4 bg-yellow-100 text-yellow-800';
        statusDiv.textContent = 'Meets minimum requirement';
    } else {
        statusDiv.className = 'p-3 rounded-lg mb-4 bg-red-100 text-red-800';
        statusDiv.textContent = 'Below minimum requirement';
    }
    
    document.getElementById('results').classList.remove('hidden');
    document.getElementById('noResults').classList.add('hidden');
}
</script>
@endsection
