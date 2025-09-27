<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

// Study in Australia Routes
Route::prefix('study-australia')->name('study-australia.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'study-australia')->name('index');
    
    // Education Subpages
    Route::get('/admission-in-australia', function() {
        return app(\App\Http\Controllers\PageController::class)->show('study-australia', 'admission-in-australia');
    })->name('admission');
    Route::get('/new-coe', function() {
        return app(\App\Http\Controllers\PageController::class)->show('study-australia', 'new-coe');
    })->name('new-coe');
    Route::get('/course-change-in-australia', function() {
        return app(\App\Http\Controllers\PageController::class)->show('study-australia', 'course-change-in-australia');
    })->name('course-change');
    Route::get('/recognized-prior-learning-rpl', function() {
        return app(\App\Http\Controllers\PageController::class)->show('study-australia', 'what-is-recognized-prior-learning-rpl-australia');
    })->name('rpl');
    Route::get('/professional-year-program', function() {
        return app(\App\Http\Controllers\PageController::class)->show('study-australia', 'professional-year-program');
    })->name('professional-year');
    Route::get('/request-to-defer-studies', function() {
        return app(\App\Http\Controllers\PageController::class)->show('study-australia', 'request-to-defer-your-studies');
    })->name('defer-studies');
    Route::get('/our-affiliations', function() {
        return app(\App\Http\Controllers\PageController::class)->show('study-australia', 'our-affiliations');
    })->name('affiliations');
    
    // Student Visa Subpages
    Route::get('/student-dependent-visa-500', function() {
        return app(\App\Http\Controllers\PageController::class)->show('study-australia', 'student-dependent-visa-to-student-visa-subclass-500');
    })->name('student-dependent');
    Route::get('/student-visa-extension', function() {
        return app(\App\Http\Controllers\PageController::class)->show('study-australia', 'student-visa-extension');
    })->name('student-extension');
    Route::get('/student-guardian-visa-590', function() {
        return app(\App\Http\Controllers\PageController::class)->show('study-australia', 'student-guardian-visa-subclass-590');
    })->name('student-guardian');
    Route::get('/student-visa-journey', function() {
        return app(\App\Http\Controllers\PageController::class)->show('study-australia', 'student-visa-journey');
    })->name('student-journey');
    Route::get('/student-subsequent-visa', function() {
        return app(\App\Http\Controllers\PageController::class)->show('study-australia', 'student-subsequent-entrant-visa-information');
    })->name('student-subsequent');
    Route::get('/student-visa-information', function() {
        return app(\App\Http\Controllers\PageController::class)->show('study-australia', 'student-visa-information');
    })->name('student-info');
    // moved 407 to employer-sponsored section below
    
    // Other Student-Related Pages
    Route::get('/student-visa-financial-calculator', [PageController::class, 'studentVisaCalculator'])->name('calculator');
    Route::get('/tourist-to-student-visa', function() {
        return app(\App\Http\Controllers\PageController::class)->show('study-australia', 'tourist-to-student-visa');
    })->name('tourist-to-student');
    Route::get('/master-to-diploma-student-visa', function() {
        return app(\App\Http\Controllers\PageController::class)->show('study-australia', 'master-to-diploma-student-visa-subclass-500');
    })->name('master-to-diploma');
    Route::get('/student-dependent-to-student-visa', function() {
        return app(\App\Http\Controllers\PageController::class)->show('study-australia', 'student-dependent-visa-to-student-visa-subclass-500');
    })->name('dependent-to-student');
    Route::get('/apply-afp-ipc-form', function() {
        return app(\App\Http\Controllers\PageController::class)->show('study-australia', 'apply-afp-ipc-form');
    })->name('afp-ipc');
});

// Visitor Visa Routes
Route::prefix('visitor-visa')->name('visitor-visa.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'visitor-visa')->name('index');
    Route::get('/visitor-visa-600', function() {
        return app(\App\Http\Controllers\PageController::class)->show('visitor-visa', 'visitor-visa-600');
    })->name('600');
    // Renamed: Onshore Visitor Visa Extension
    Route::get('/onshore-visitor-visa-extension', function() {
        return app(\App\Http\Controllers\PageController::class)->show('visitor-visa', 'onshore-visitor-visa-extension');
    })->name('onshore-extension');
    // Travel Exemption removed
    Route::get('/work-holiday-visa-462', function() {
        return app(\App\Http\Controllers\PageController::class)->show('visitor-visa', 'work-holiday-462');
    })->name('work-holiday-462');
    Route::get('/work-holiday-visa-417', function() {
        return app(\App\Http\Controllers\PageController::class)->show('visitor-visa', 'work-holiday-417');
    })->name('work-holiday-417');
    Route::get('/sponsored-family-stream', function() {
        return app(\App\Http\Controllers\PageController::class)->show('visitor-visa', 'sponsored-family');
    })->name('sponsored-family');
});

// Migrate to Australia Routes
Route::prefix('migrate-to-australia')->name('migrate-to-australia.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'migrate-to-australia')->name('index');
    // Skilled Migration dedicated hub
    Route::get('/skilled-migration', function() {
        $page = (object) [
            'title' => 'Skilled Migration',
            'excerpt' => 'Permanent and provisional skilled migration pathways including 189, 190, 491 and more.'
        ];
        return view('pages.skilled-migration', compact('page'));
    })->name('skilled-hub');
    
    // Graduate Visa Subpages
    Route::get('/temporary-graduate-visa-485', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migrate-to-australia', 'temporary-graduate-visa-subclass-485');
    })->name('temporary-graduate');
    Route::get('/post-study-work-visa-485', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migrate-to-australia', 'post-study-work-visa-subclass-485');
    })->name('post-study-work');
    Route::get('/skilled-recognised-graduate-visa-476', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migrate-to-australia', 'skilled-recognised-graduate-visa-subclass-476');
    })->name('skilled-graduate');
    
    // Permanent Visa Subpages
    Route::get('/skilled-independent-visa-189', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migrate-to-australia', 'skilled-independent-visa-subclass-189');
    })->name('skilled-independent');
    Route::get('/skilled-nominated-visa-190', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migrate-to-australia', 'skilled-nominated-visa-subclass-190');
    })->name('skilled-nominated');
    Route::get('/skilled-regional-visa-887', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migrate-to-australia', 'skilled-regional-visa-subclass-887');
    })->name('skilled-regional');
    
    // Regional Visas
    Route::get('/permanent-residence-skilled-regional-191', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migrate-to-australia', 'permanent-residence-skilled-regional-visa-subclass-191');
    })->name('pr-skilled-regional');
    Route::get('/skilled-work-regional-provisional-491', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migrate-to-australia', 'skilled-work-regional-provisional-visa-subclass-491');
    })->name('skilled-work-regional');
    
    // Skill Assessment
    Route::get('/acs-skill-assessment', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migrate-to-australia', 'acs-skill-assessment');
    })->name('acs-assessment');
    Route::get('/vetassess-skill-assessment', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migrate-to-australia', 'vetassess-skill-assessment');
    })->name('vetassess-assessment');
    Route::get('/job-ready-program', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migrate-to-australia', 'job-ready-program');
    })->name('job-ready-program');
    Route::get('/ea-skill-assessment', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migrate-to-australia', 'ea-skill-assessment');
    })->name('ea-assessment');
    Route::get('/accountant-skill-assessment', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migrate-to-australia', 'accountant-skill-assessment');
    })->name('accountant-assessment');
    Route::get('/nursing-aphara-anmac-assessment', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migrate-to-australia', 'nursing-aphara-registration-and-anmac-skill-assessment');
    })->name('nursing-assessment');
    
    // Others
    Route::get('/pr-point-calculator', [PageController::class, 'prPointCalculator'])->name('pr-calculator');
    Route::get('/how-to-claim-regional-points', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migrate-to-australia', 'how-to-claim-regional-points');
    })->name('regional-points');
    Route::get('/points-for-english-score', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migrate-to-australia', 'english-points');
    })->name('english-points');
});

// Family Visa Routes
Route::prefix('family-visa')->name('family-visa.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'family-visa')->name('index');
    
    // Partner Visa Subpages
    Route::get('/partner-provisional-visa-309', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'partner-provisional-visa-subclass-309');
    })->name('partner-provisional-309');
    Route::get('/partner-permanent-visa-100', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'partner-permanent-visa-subclass-100');
    })->name('partner-permanent-100');
    Route::get('/partner-provisional-visa-820', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'partner-provisional-visa-subclass-820');
    })->name('partner-provisional-820');
    Route::get('/partner-permanent-visa-801', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'partner-permanent-visa-subclass-801');
    })->name('partner-permanent-801');
    Route::get('/prospective-marriage-visa-300', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'prospective-marriage-visa-subclass-300');
    })->name('prospective-marriage');
    Route::get('/new-zealand-citizen-family-relationship-461', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'new-zealand-citizen-family-relationship-visa-subclass-461');
    })->name('nz-461');
    
    // Parents Visa Subpages
    Route::get('/contributory-aged-parent-temporary-884', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'contributory-aged-parent-temporary-visa-subclass-884');
    })->name('contributory-aged-parent-884');
    Route::get('/contributory-aged-parent-864', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'contributory-aged-parent-visa-subclass-864');
    })->name('contributory-aged-parent-864');
    Route::get('/contributory-parent-temporary-173', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'contributory-parent-temporary-visa-subclass-173');
    })->name('contributory-parent-173');
    Route::get('/contributory-parent-143', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'contributory-parent-subclass-143');
    })->name('contributory-parent-143');
    Route::get('/parent-visa-103', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'parent-visa-subclass-103');
    })->name('parent-visa-103');
    Route::get('/aged-parent-visa-804', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'aged-parent-visa-subclass-804');
    })->name('aged-parent-804');
    Route::get('/sponsored-parent-temporary-870', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'sponsored-parent-temporary-visa-subclass-870');
    })->name('sponsored-parent-870');
    
    // Child Visas
    Route::get('/child-visa-101', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'child-visa-subclass-101');
    })->name('child-visa-101');
    Route::get('/child-visa-802', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'child-visa-subclass-802');
    })->name('child-visa-802');
    Route::get('/adoption-visa-australia', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'adoption-visa');
    })->name('adoption-visa');
    Route::get('/remaining-relative-visa-115', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'remaining-relative-visa-subclass-115');
    })->name('remaining-relative-115');
    Route::get('/remaining-relative-visa-835', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'remaining-relative-visa-subclass-835');
    })->name('remaining-relative-835');
    Route::get('/orphan-relative-visa-117', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'orphan-reletive-visa-117');
    })->name('orphan-relative-117');
    Route::get('/orphan-relative-visa-837', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'orphan-relative-visa-837');
    })->name('orphan-relative-837');
    Route::get('/dependent-child-visa', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'dependent-child-visa');
    })->name('dependent-child');
    
    // Relative Visas
    Route::get('/aged-dependent-relative-visa-114', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'aged-dependent-114');
    })->name('aged-dependent-114');
    Route::get('/aged-dependent-relative-visa-offshore-114', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'aged-dependent-offshore-114');
    })->name('aged-dependent-offshore-114');
    Route::get('/aged-dependent-relative-visa-onshore-838', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'aged-dependent-onshore-838');
    })->name('aged-dependent-onshore-838');
    Route::get('/carer-visa-offshore-116', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'carer-visa-offshore-subclass-116');
    })->name('carer-offshore-116');
    Route::get('/carer-visa-onshore-836', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'carer-visa-onshore-subclass-836');
    })->name('carer-onshore-836');
    
    // Others
    Route::get('/cost-for-contributory-visas', function() {
        return app(\App\Http\Controllers\PageController::class)->show('family-visa', 'cost-for-contributory-visas');
    })->name('contributory-costs');
});

// Parent Visas dedicated hub
Route::prefix('parent-visas')->name('parent-visas.')->group(function () {
    Route::get('/', function() {
        // Static hub view for Parent Visas similar to other category pages
        $page = (object) [
            'title' => 'Parent Visas',
            'excerpt' => 'Overview of Australian parent visa options to reunite families.',
        ];
        return view('pages.parent-visas', compact('page'));
    })->name('index');
});

// Employer Sponsored Visas Routes
// Redirect from old plural URL to new singular URL for backward compatibility
Route::get('/employer-sponsored-visas', function () {
    return redirect()->route('employer-sponsored.index');
})->name('employer-sponsored-visas-redirect');

Route::prefix('employer-sponsored')->name('employer-sponsored.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'employer-sponsored')->name('index');
    
    // Temporary Visas
    Route::get('/skill-in-demand-visa-482', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employer-sponsored', 'sid-visa-482');
    })->name('sid-482');
    
    // Redirect old 482 URLs
    Route::get('/temporary-skill-shortage-visa-subclass-482-old', function() {
        return redirect()->route('sid-482', [], 301);
    });
    Route::get('/temporary-skill-shortage-visa-subclass-482', function() {
        return redirect()->route('sid-482', [], 301);
    });
    Route::get('/designated-area-migration-agreements-dama', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employer-sponsored', 'dama');
    })->name('dama');
    Route::get('/skilled-employer-sponsored-regional-494', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employer-sponsored', 'skilled-regional-494');
    })->name('skilled-regional-494');
    Route::get('/temporary-activity-visa-408', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employer-sponsored', 'temporary-activity-408');
    })->name('temporary-activity-408');
    Route::get('/training-visa-407', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employer-sponsored', 'training-visa-407');
    })->name('training-visa-407');
    Route::get('/temporary-work-short-stay-specialist-400', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employer-sponsored', 'short-stay-400');
    })->name('short-stay-400');
    
    // Permanent Visas
    Route::get('/employer-nomination-scheme-186-trt', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employer-sponsored', 'ens-186-trt');
    })->name('ens-186-trt');
    Route::get('/employer-nomination-direct-entry-186', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employer-sponsored', 'ens-186-direct');
    })->name('ens-186-direct');
    Route::get('/national-innovation-visa-858', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employer-sponsored', 'national-innovation-visa');
    })->name('national-innovation-visa');
    
    // Global Talent Visas
    Route::get('/global-talent-independent-program-gti', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employer-sponsored', 'gti');
    })->name('gti');
    Route::get('/global-talent-employer-sponsored-gtes', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employer-sponsored', 'gtes');
    })->name('gtes');
});

// Business Visas Routes
Route::prefix('business-visas')->name('business-visa.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'business-visa')->name('index');
    Route::get('/business-innovation-investment-permanent-888', function() {
        return app(\App\Http\Controllers\PageController::class)->show('business-visa', 'business-innovation-and-investment-permanent-visa-subclass-888');
    })->name('business-permanent-888');
    Route::get('/business-innovation-investment-provisional-188', function() {
        return app(\App\Http\Controllers\PageController::class)->show('business-visa', 'business-innovation-and-investment-provisional-visa-subclass-188');
    })->name('business-provisional-188');
    Route::get('/business-talent-permanent-132', function() {
        return app(\App\Http\Controllers\PageController::class)->show('business-visa', 'business-talent-permanent-visa-subclass-132');
    })->name('business-talent-132');
});

// Appeals Routes
Route::prefix('appeals')->name('appeals.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'appeals')->name('index');
    // New main items
    Route::get('/aat-appeals', function() {
        return app(\App\Http\Controllers\PageController::class)->show('appeals', 'aat-appeals');
    })->name('aat-appeals');
    Route::get('/federal-court-appeals', function() {
        return app(\App\Http\Controllers\PageController::class)->show('appeals', 'federal-court-appeals');
    })->name('federal-court-appeals');
    Route::get('/ministerial-intervention', function() {
        return app(\App\Http\Controllers\PageController::class)->show('appeals', 'ministerial-intervention');
    })->name('ministerial-intervention');
    Route::get('/review-process', function() {
        return app(\App\Http\Controllers\PageController::class)->show('appeals', 'review-process');
    })->name('review-process');
    Route::get('/visa-refusal', function() {
        return app(\App\Http\Controllers\PageController::class)->show('appeals', 'visa-refusal');
    })->name('visa-refusal');
    Route::get('/visa-cancellation', function() {
        return app(\App\Http\Controllers\PageController::class)->show('appeals', 'visa-cancellation');
    })->name('visa-cancellation');
    Route::get('/notice-of-intention-to-consider-cancellation', function() {
        return app(\App\Http\Controllers\PageController::class)->show('appeals', 'notice-of-intention-to-consider-cancellation');
    })->name('notice-cancellation');
    // Friendly short alias for NOICC
    Route::get('/noicc', function() {
        return app(\App\Http\Controllers\PageController::class)->show('appeals', 'notice-of-intention-to-consider-cancellation');
    })->name('noicc');
    Route::get('/waiver-request', function() {
        return app(\App\Http\Controllers\PageController::class)->show('appeals', 'waiver-request');
    })->name('waiver-request');
    Route::get('/applying-for-work-rights', function() {
        return app(\App\Http\Controllers\PageController::class)->show('appeals', 'applying-for-work-rights');
    })->name('work-rights');
    Route::get('/applying-for-study-rights', function() {
        return app(\App\Http\Controllers\PageController::class)->show('appeals', 'applying-for-study-rights');
    })->name('study-rights');
});

// Citizenship Routes
Route::prefix('citizenship')->name('citizenship.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'citizenship')->name('index');
    Route::get('/citizenship-by-conferral', function() {
        return app(\App\Http\Controllers\PageController::class)->show('citizenship', 'citizenship-by-conferral');
    })->name('by-conferral');
    Route::get('/citizenship-by-descent', function() {
        return app(\App\Http\Controllers\PageController::class)->show('citizenship', 'citizenship-by-descent');
    })->name('by-descent');
    Route::get('/evidence-of-australian-citizenship', function() {
        return app(\App\Http\Controllers\PageController::class)->show('citizenship', 'evidence-of-australian-citizenship');
    })->name('evidence');

    // New: Additional Citizenship topics
    Route::get('/citizenship-by-birth', function() {
        return app(\App\Http\Controllers\PageController::class)->show('citizenship', 'citizenship-by-birth');
    })->name('by-birth');
    Route::get('/dual-citizenship', function() {
        return app(\App\Http\Controllers\PageController::class)->show('citizenship', 'dual-citizenship');
    })->name('dual');
    Route::get('/citizenship-test', function() {
        return app(\App\Http\Controllers\PageController::class)->show('citizenship', 'citizenship-test');
    })->name('test');
});

// Other Countries Routes
Route::prefix('other-countries')->name('other-countries.')->group(function () {
    Route::get('/canada', function() {
        return app(\App\Http\Controllers\PageController::class)->show('other-countries', 'canada');
    })->name('canada');
    Route::get('/new-zealand', function() {
        return app(\App\Http\Controllers\PageController::class)->show('other-countries', 'new-zealand');
    })->name('new-zealand');
    Route::get('/usa', function() {
        return app(\App\Http\Controllers\PageController::class)->show('other-countries', 'usa');
    })->name('usa');
});

// Celebrity Visas Routes
Route::prefix('celebrity-visas')->name('celebrity-visas.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'celebrity-visas')->name('index');
});

// Skill Assessment Routes
Route::prefix('skill-assessment')->name('skill-assessment.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'skill-assessment')->name('index');
    // Professional Assessments
    Route::get('/acs-assessment', function() {
        return app(\App\Http\Controllers\PageController::class)->show('skill-assessment', 'acs-skill-assessment');
    })->name('acs-assessment');
    Route::get('/vetassess-assessment', function() {
        return app(\App\Http\Controllers\PageController::class)->show('skill-assessment', 'vetassess-skill-assessment');
    })->name('vetassess-assessment');
    Route::get('/ea-assessment', function() {
        return app(\App\Http\Controllers\PageController::class)->show('skill-assessment', 'ea-skill-assessment');
    })->name('ea-assessment');
    Route::get('/accountant-assessment', function() {
        return app(\App\Http\Controllers\PageController::class)->show('skill-assessment', 'accountant-skill-assessment');
    })->name('accountant-assessment');
    Route::get('/nursing-assessment', function() {
        return app(\App\Http\Controllers\PageController::class)->show('skill-assessment', 'nursing-aphara-registration-and-anmac-skill-assessment');
    })->name('nursing-assessment');

    // Trade Assessments
    Route::get('/trades-recognition-australia', function() {
        return app(\App\Http\Controllers\PageController::class)->show('skill-assessment', 'trades-recognition-australia');
    })->name('trades-recognition-australia');
    Route::get('/skills-assessment-for-trades', function() {
        return app(\App\Http\Controllers\PageController::class)->show('skill-assessment', 'skills-assessment-for-trades');
    })->name('skills-assessment-for-trades');
    Route::get('/job-ready-program', function() {
        return app(\App\Http\Controllers\PageController::class)->show('skill-assessment', 'job-ready-program');
    })->name('job-ready-program');

    // Assessment Tools
    Route::get('/guide', function() {
        return app(\App\Http\Controllers\PageController::class)->show('skill-assessment', 'skills-assessment-guide');
    })->name('guide');
    Route::get('/requirements', function() {
        return app(\App\Http\Controllers\PageController::class)->show('skill-assessment', 'assessment-requirements');
    })->name('requirements');
    Route::get('/timeline', function() {
        return app(\App\Http\Controllers\PageController::class)->show('skill-assessment', 'assessment-timeline');
    })->name('timeline');
});

// Transit & Special Purpose Routes
Route::prefix('transit-special-purpose')->name('transit-special-purpose.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'transit-special-purpose')->name('index');
});

// Medical & Humanitarian Routes
Route::prefix('medical-humanitarian')->name('medical-humanitarian.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'medical-humanitarian')->name('index');
});

// Maritime & Crew Routes
Route::prefix('maritime-crew')->name('maritime-crew.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'maritime-crew')->name('index');
});

// Bridging & Return Visas Routes
Route::prefix('bridging-return-visas')->name('bridging-return-visas.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'bridging-return-visas')->name('index');
});
