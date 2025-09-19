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
    Route::get('/training-visa-407', function() {
        return app(\App\Http\Controllers\PageController::class)->show('study-australia', 'training-visa-407');
    })->name('training-visa');
    
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
    Route::get('/offshore-tourist-visa-extension', function() {
        return app(\App\Http\Controllers\PageController::class)->show('visitor-visa', 'offshore-extension');
    })->name('offshore-extension');
    Route::get('/travel-exemption', function() {
        return app(\App\Http\Controllers\PageController::class)->show('visitor-visa', 'travel-exemption');
    })->name('travel-exemption');
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

// Migration Routes
Route::prefix('migration')->name('migration.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'migration')->name('index');
    
    // Graduate Visa Subpages
    Route::get('/temporary-graduate-visa-485', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migration', 'temporary-graduate-visa-subclass-485');
    })->name('temporary-graduate');
    Route::get('/post-study-work-visa-485', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migration', 'post-study-work-visa-subclass-485');
    })->name('post-study-work');
    Route::get('/skilled-recognised-graduate-visa-476', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migration', 'skilled-recognised-graduate-visa-subclass-476');
    })->name('skilled-graduate');
    
    // Permanent Visa Subpages
    Route::get('/skilled-independent-visa-189', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migration', 'skilled-independent-visa-subclass-189');
    })->name('skilled-independent');
    Route::get('/skilled-nominated-visa-190', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migration', 'skilled-nominated-visa-subclass-190');
    })->name('skilled-nominated');
    Route::get('/skilled-regional-visa-887', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migration', 'skilled-regional-visa-subclass-887');
    })->name('skilled-regional');
    
    // Regional Visas
    Route::get('/permanent-residence-skilled-regional-191', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migration', 'permanent-residence-skilled-regional-visa-subclass-191');
    })->name('pr-skilled-regional');
    Route::get('/skilled-work-regional-provisional-491', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migration', 'skilled-work-regional-provisional-visa-subclass-491');
    })->name('skilled-work-regional');
    
    // Skill Assessment
    Route::get('/acs-skill-assessment', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migration', 'acs-skill-assessment');
    })->name('acs-assessment');
    Route::get('/vetassess-skill-assessment', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migration', 'vetassess-skill-assessment');
    })->name('vetassess-assessment');
    Route::get('/job-ready-program', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migration', 'job-ready-program');
    })->name('job-ready-program');
    Route::get('/ea-skill-assessment', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migration', 'ea-skill-assessment');
    })->name('ea-assessment');
    Route::get('/accountant-skill-assessment', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migration', 'accountant-skill-assessment');
    })->name('accountant-assessment');
    Route::get('/nursing-aphara-anmac-assessment', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migration', 'nursing-aphara-registration-and-anmac-skill-assessment');
    })->name('nursing-assessment');
    
    // Others
    Route::get('/pr-point-calculator', [PageController::class, 'prPointCalculator'])->name('pr-calculator');
    Route::get('/how-to-claim-regional-points', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migration', 'how-to-claim-regional-points');
    })->name('regional-points');
    Route::get('/points-for-english-score', function() {
        return app(\App\Http\Controllers\PageController::class)->show('migration', 'english-points');
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

// Employee Sponsored Visas Routes
Route::prefix('employee-sponsored-visas')->name('employee-sponsored.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'employee-sponsored')->name('index');
    
    // Temporary Visas
    Route::get('/temporary-skill-shortage-visa-482', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employee-sponsored', 'tss-visa-482');
    })->name('tss-482');
    Route::get('/designated-area-migration-agreements-dama', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employee-sponsored', 'dama');
    })->name('dama');
    Route::get('/skilled-employer-sponsored-regional-494', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employee-sponsored', 'skilled-regional-494');
    })->name('skilled-regional-494');
    Route::get('/temporary-activity-visa-408', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employee-sponsored', 'temporary-activity-408');
    })->name('temporary-activity-408');
    Route::get('/temporary-work-short-stay-specialist-400', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employee-sponsored', 'short-stay-400');
    })->name('short-stay-400');
    
    // Permanent Visas
    Route::get('/employer-nomination-scheme-186-trt', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employee-sponsored', 'ens-186-trt');
    })->name('ens-186-trt');
    Route::get('/employer-nomination-direct-entry-186', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employee-sponsored', 'ens-186-direct');
    })->name('ens-186-direct');
    Route::get('/distinguished-talent-visa-offshore-124', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employee-sponsored', 'distinguished-talent-124');
    })->name('distinguished-talent-124');
    Route::get('/distinguished-talent-visa-onshore-858', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employee-sponsored', 'distinguished-talent-858');
    })->name('distinguished-talent-858');
    
    // Global Talent Visas
    Route::get('/global-talent-independent-program-gti', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employee-sponsored', 'gti');
    })->name('gti');
    Route::get('/global-talent-employer-sponsored-gtes', function() {
        return app(\App\Http\Controllers\PageController::class)->show('employee-sponsored', 'gtes');
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
    Route::get('/visa-checklists', function() {
        return app(\App\Http\Controllers\PageController::class)->show('business-visa', 'visa-checklists');
    })->name('visa-checklists');
});

// Appeals Routes
Route::prefix('appeals')->name('appeals.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'appeals')->name('index');
    Route::get('/visa-refusal', function() {
        return app(\App\Http\Controllers\PageController::class)->show('appeals', 'visa-refusal');
    })->name('visa-refusal');
    Route::get('/visa-cancellation', function() {
        return app(\App\Http\Controllers\PageController::class)->show('appeals', 'visa-cancellation');
    })->name('visa-cancellation');
    Route::get('/notice-of-intention-to-consider-cancellation', function() {
        return app(\App\Http\Controllers\PageController::class)->show('appeals', 'notice-cancellation');
    })->name('notice-cancellation');
    Route::get('/waiver-request', function() {
        return app(\App\Http\Controllers\PageController::class)->show('appeals', 'waiver-request');
    })->name('waiver-request');
    Route::get('/applying-for-work-rights', function() {
        return app(\App\Http\Controllers\PageController::class)->show('appeals', 'work-rights');
    })->name('work-rights');
    Route::get('/applying-for-study-rights', function() {
        return app(\App\Http\Controllers\PageController::class)->show('appeals', 'study-rights');
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
