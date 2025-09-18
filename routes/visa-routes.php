<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

// Study in Australia Routes
Route::prefix('study-australia')->name('study-australia.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'study-australia')->name('index');
    
    // Education Subpages
    Route::get('/admission-in-australia', [PageController::class, 'show'])->defaults('category', 'study-australia', 'slug', 'admission-in-australia')->name('admission');
    Route::get('/new-coe', [PageController::class, 'show'])->defaults('category', 'study-australia', 'slug', 'new-coe')->name('new-coe');
    Route::get('/course-change-in-australia', [PageController::class, 'show'])->defaults('category', 'study-australia', 'slug', 'course-change')->name('course-change');
    Route::get('/recognized-prior-learning-rpl', [PageController::class, 'show'])->defaults('category', 'study-australia', 'slug', 'rpl')->name('rpl');
    Route::get('/professional-year-program', [PageController::class, 'show'])->defaults('category', 'study-australia', 'slug', 'professional-year')->name('professional-year');
    Route::get('/request-to-defer-studies', [PageController::class, 'show'])->defaults('category', 'study-australia', 'slug', 'defer-studies')->name('defer-studies');
    Route::get('/our-affiliations', [PageController::class, 'show'])->defaults('category', 'study-australia', 'slug', 'affiliations')->name('affiliations');
    
    // Student Visa Subpages
    Route::get('/student-dependent-visa-500', [PageController::class, 'show'])->defaults('category', 'study-australia', 'slug', 'student-dependent-visa')->name('student-dependent');
    Route::get('/student-visa-extension', [PageController::class, 'show'])->defaults('category', 'study-australia', 'slug', 'student-extension')->name('student-extension');
    Route::get('/student-guardian-visa-590', [PageController::class, 'show'])->defaults('category', 'study-australia', 'slug', 'student-guardian-visa')->name('student-guardian');
    Route::get('/student-visa-journey', [PageController::class, 'show'])->defaults('category', 'study-australia', 'slug', 'student-journey')->name('student-journey');
    Route::get('/student-subsequent-visa', [PageController::class, 'show'])->defaults('category', 'study-australia', 'slug', 'student-subsequent')->name('student-subsequent');
    Route::get('/student-visa-information', [PageController::class, 'show'])->defaults('category', 'study-australia', 'slug', 'student-info')->name('student-info');
    Route::get('/training-visa-407', [PageController::class, 'show'])->defaults('category', 'study-australia', 'slug', 'training-visa')->name('training-visa');
    
    // Other Student-Related Pages
    Route::get('/student-visa-financial-calculator', [PageController::class, 'studentVisaCalculator'])->name('calculator');
    Route::get('/tourist-to-student-visa', [PageController::class, 'show'])->defaults('category', 'study-australia', 'slug', 'tourist-to-student')->name('tourist-to-student');
    Route::get('/master-to-diploma-student-visa', [PageController::class, 'show'])->defaults('category', 'study-australia', 'slug', 'master-to-diploma')->name('master-to-diploma');
    Route::get('/student-dependent-to-student-visa', [PageController::class, 'show'])->defaults('category', 'study-australia', 'slug', 'dependent-to-student')->name('dependent-to-student');
    Route::get('/apply-afp-ipc-form', [PageController::class, 'show'])->defaults('category', 'study-australia', 'slug', 'afp-ipc-form')->name('afp-ipc');
});

// Visitor Visa Routes
Route::prefix('visitor-visa')->name('visitor-visa.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'visitor-visa')->name('index');
    Route::get('/visitor-visa-600', [PageController::class, 'show'])->defaults('category', 'visitor-visa', 'slug', 'visitor-visa-600')->name('600');
    Route::get('/offshore-tourist-visa-extension', [PageController::class, 'show'])->defaults('category', 'visitor-visa', 'slug', 'offshore-extension')->name('offshore-extension');
    Route::get('/travel-exemption', [PageController::class, 'show'])->defaults('category', 'visitor-visa', 'slug', 'travel-exemption')->name('travel-exemption');
    Route::get('/work-holiday-visa-462', [PageController::class, 'show'])->defaults('category', 'visitor-visa', 'slug', 'work-holiday-462')->name('work-holiday-462');
    Route::get('/work-holiday-visa-417', [PageController::class, 'show'])->defaults('category', 'visitor-visa', 'slug', 'work-holiday-417')->name('work-holiday-417');
    Route::get('/sponsored-family-stream', [PageController::class, 'show'])->defaults('category', 'visitor-visa', 'slug', 'sponsored-family')->name('sponsored-family');
});

// Migration Routes
Route::prefix('migration')->name('migration.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'migration')->name('index');
    
    // Graduate Visa Subpages
    Route::get('/temporary-graduate-visa-485', [PageController::class, 'show'])->defaults('category', 'migration', 'slug', 'temporary-graduate-485')->name('temporary-graduate');
    Route::get('/post-study-work-visa-485', [PageController::class, 'show'])->defaults('category', 'migration', 'slug', 'post-study-work')->name('post-study-work');
    Route::get('/skilled-recognised-graduate-visa-476', [PageController::class, 'show'])->defaults('category', 'migration', 'slug', 'skilled-graduate-476')->name('skilled-graduate');
    
    // Permanent Visa Subpages
    Route::get('/skilled-independent-visa-189', [PageController::class, 'show'])->defaults('category', 'migration', 'slug', 'skilled-independent-189')->name('skilled-independent');
    Route::get('/skilled-nominated-visa-190', [PageController::class, 'show'])->defaults('category', 'migration', 'slug', 'skilled-nominated-190')->name('skilled-nominated');
    Route::get('/skilled-regional-visa-887', [PageController::class, 'show'])->defaults('category', 'migration', 'slug', 'skilled-regional-887')->name('skilled-regional');
    
    // Regional Visas
    Route::get('/permanent-residence-skilled-regional-191', [PageController::class, 'show'])->defaults('category', 'migration', 'slug', 'pr-skilled-regional-191')->name('pr-skilled-regional');
    Route::get('/skilled-work-regional-provisional-491', [PageController::class, 'show'])->defaults('category', 'migration', 'slug', 'skilled-work-regional-491')->name('skilled-work-regional');
    
    // Skill Assessment
    Route::get('/acs-skill-assessment', [PageController::class, 'show'])->defaults('category', 'migration', 'slug', 'acs-assessment')->name('acs-assessment');
    Route::get('/vetassess-skill-assessment', [PageController::class, 'show'])->defaults('category', 'migration', 'slug', 'vetassess-assessment')->name('vetassess-assessment');
    Route::get('/job-ready-program', [PageController::class, 'show'])->defaults('category', 'migration', 'slug', 'job-ready-program')->name('job-ready-program');
    Route::get('/ea-skill-assessment', [PageController::class, 'show'])->defaults('category', 'migration', 'slug', 'ea-assessment')->name('ea-assessment');
    Route::get('/accountant-skill-assessment', [PageController::class, 'show'])->defaults('category', 'migration', 'slug', 'accountant-assessment')->name('accountant-assessment');
    Route::get('/nursing-aphara-anmac-assessment', [PageController::class, 'show'])->defaults('category', 'migration', 'slug', 'nursing-assessment')->name('nursing-assessment');
    
    // Others
    Route::get('/pr-point-calculator', [PageController::class, 'prPointCalculator'])->name('pr-calculator');
    Route::get('/how-to-claim-regional-points', [PageController::class, 'show'])->defaults('category', 'migration', 'slug', 'regional-points')->name('regional-points');
    Route::get('/points-for-english-score', [PageController::class, 'show'])->defaults('category', 'migration', 'slug', 'english-points')->name('english-points');
});

// Family Visa Routes
Route::prefix('family-visa')->name('family-visa.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'family-visa')->name('index');
    
    // Partner Visa Subpages
    Route::get('/partner-provisional-visa-309', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'partner-provisional-309')->name('partner-provisional-309');
    Route::get('/partner-permanent-visa-100', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'partner-permanent-100')->name('partner-permanent-100');
    Route::get('/partner-provisional-visa-820', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'partner-provisional-820')->name('partner-provisional-820');
    Route::get('/partner-permanent-visa-801', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'partner-permanent-801')->name('partner-permanent-801');
    Route::get('/prospective-marriage-visa-300', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'prospective-marriage-300')->name('prospective-marriage');
    
    // Parents Visa Subpages
    Route::get('/contributory-aged-parent-temporary-884', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'contributory-aged-parent-884')->name('contributory-aged-parent-884');
    Route::get('/contributory-aged-parent-864', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'contributory-aged-parent-864')->name('contributory-aged-parent-864');
    Route::get('/contributory-parent-temporary-173', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'contributory-parent-173')->name('contributory-parent-173');
    Route::get('/contributory-parent-143', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'contributory-parent-143')->name('contributory-parent-143');
    Route::get('/parent-visa-103', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'parent-visa-103')->name('parent-visa-103');
    Route::get('/aged-parent-visa-804', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'aged-parent-804')->name('aged-parent-804');
    Route::get('/sponsored-parent-temporary-870', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'sponsored-parent-870')->name('sponsored-parent-870');
    
    // Child Visas
    Route::get('/child-visa-101', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'child-visa-101')->name('child-visa-101');
    Route::get('/child-visa-802', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'child-visa-802')->name('child-visa-802');
    Route::get('/adoption-visa-australia', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'adoption-visa')->name('adoption-visa');
    Route::get('/remaining-relative-visa-115', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'remaining-relative-115')->name('remaining-relative-115');
    Route::get('/remaining-relative-visa-835', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'remaining-relative-835')->name('remaining-relative-835');
    Route::get('/orphan-relative-visa-117', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'orphan-relative-117')->name('orphan-relative-117');
    Route::get('/orphan-relative-visa-837', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'orphan-relative-837')->name('orphan-relative-837');
    Route::get('/dependent-child-visa', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'dependent-child')->name('dependent-child');
    
    // Relative Visas
    Route::get('/aged-dependent-relative-visa-114', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'aged-dependent-114')->name('aged-dependent-114');
    Route::get('/aged-dependent-relative-visa-offshore-114', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'aged-dependent-offshore-114')->name('aged-dependent-offshore-114');
    Route::get('/aged-dependent-relative-visa-onshore-838', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'aged-dependent-onshore-838')->name('aged-dependent-onshore-838');
    Route::get('/carer-visa-offshore-116', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'carer-offshore-116')->name('carer-offshore-116');
    Route::get('/carer-visa-onshore-836', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'carer-onshore-836')->name('carer-onshore-836');
    
    // Others
    Route::get('/cost-for-contributory-visas', [PageController::class, 'show'])->defaults('category', 'family-visa', 'slug', 'contributory-costs')->name('contributory-costs');
});

// Employee Sponsored Visas Routes
Route::prefix('employee-sponsored-visas')->name('employee-sponsored.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'employee-sponsored')->name('index');
    
    // Temporary Visas
    Route::get('/temporary-skill-shortage-visa-482', [PageController::class, 'show'])->defaults('category', 'employee-sponsored', 'slug', 'tss-visa-482')->name('tss-482');
    Route::get('/designated-area-migration-agreements-dama', [PageController::class, 'show'])->defaults('category', 'employee-sponsored', 'slug', 'dama')->name('dama');
    Route::get('/skilled-employer-sponsored-regional-494', [PageController::class, 'show'])->defaults('category', 'employee-sponsored', 'slug', 'skilled-regional-494')->name('skilled-regional-494');
    Route::get('/temporary-activity-visa-408', [PageController::class, 'show'])->defaults('category', 'employee-sponsored', 'slug', 'temporary-activity-408')->name('temporary-activity-408');
    Route::get('/temporary-work-short-stay-specialist-400', [PageController::class, 'show'])->defaults('category', 'employee-sponsored', 'slug', 'short-stay-400')->name('short-stay-400');
    
    // Permanent Visas
    Route::get('/employer-nomination-scheme-186-trt', [PageController::class, 'show'])->defaults('category', 'employee-sponsored', 'slug', 'ens-186-trt')->name('ens-186-trt');
    Route::get('/employer-nomination-direct-entry-186', [PageController::class, 'show'])->defaults('category', 'employee-sponsored', 'slug', 'ens-186-direct')->name('ens-186-direct');
    Route::get('/distinguished-talent-visa-offshore-124', [PageController::class, 'show'])->defaults('category', 'employee-sponsored', 'slug', 'distinguished-talent-124')->name('distinguished-talent-124');
    Route::get('/distinguished-talent-visa-onshore-858', [PageController::class, 'show'])->defaults('category', 'employee-sponsored', 'slug', 'distinguished-talent-858')->name('distinguished-talent-858');
    
    // Global Talent Visas
    Route::get('/global-talent-independent-program-gti', [PageController::class, 'show'])->defaults('category', 'employee-sponsored', 'slug', 'gti')->name('gti');
    Route::get('/global-talent-employer-sponsored-gtes', [PageController::class, 'show'])->defaults('category', 'employee-sponsored', 'slug', 'gtes')->name('gtes');
});

// Business Visas Routes
Route::prefix('business-visas')->name('business-visa.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'business-visa')->name('index');
    Route::get('/business-innovation-investment-permanent-888', [PageController::class, 'show'])->defaults('category', 'business-visa', 'slug', 'business-permanent-888')->name('business-permanent-888');
    Route::get('/business-innovation-investment-provisional-188', [PageController::class, 'show'])->defaults('category', 'business-visa', 'slug', 'business-provisional-188')->name('business-provisional-188');
    Route::get('/business-talent-permanent-132', [PageController::class, 'show'])->defaults('category', 'business-visa', 'slug', 'business-talent-132')->name('business-talent-132');
    Route::get('/visa-checklists', [PageController::class, 'show'])->defaults('category', 'business-visa', 'slug', 'visa-checklists')->name('visa-checklists');
});

// Appeals Routes
Route::prefix('appeals')->name('appeals.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'appeals')->name('index');
    Route::get('/visa-refusal', [PageController::class, 'show'])->defaults('category', 'appeals', 'slug', 'visa-refusal')->name('visa-refusal');
    Route::get('/visa-cancellation', [PageController::class, 'show'])->defaults('category', 'appeals', 'slug', 'visa-cancellation')->name('visa-cancellation');
    Route::get('/notice-of-intention-to-consider-cancellation', [PageController::class, 'show'])->defaults('category', 'appeals', 'slug', 'notice-cancellation')->name('notice-cancellation');
    Route::get('/waiver-request', [PageController::class, 'show'])->defaults('category', 'appeals', 'slug', 'waiver-request')->name('waiver-request');
    Route::get('/applying-for-work-rights', [PageController::class, 'show'])->defaults('category', 'appeals', 'slug', 'work-rights')->name('work-rights');
    Route::get('/applying-for-study-rights', [PageController::class, 'show'])->defaults('category', 'appeals', 'slug', 'study-rights')->name('study-rights');
});

// Citizenship Routes
Route::prefix('citizenship')->name('citizenship.')->group(function () {
    Route::get('/', [PageController::class, 'show'])->defaults('category', 'citizenship')->name('index');
    Route::get('/citizenship-by-conferral', [PageController::class, 'show'])->defaults('category', 'citizenship', 'slug', 'by-conferral')->name('by-conferral');
    Route::get('/citizenship-by-descent', [PageController::class, 'show'])->defaults('category', 'citizenship', 'slug', 'by-descent')->name('by-descent');
    Route::get('/evidence-of-australian-citizenship', [PageController::class, 'show'])->defaults('category', 'citizenship', 'slug', 'evidence')->name('evidence');
});

// Other Countries Routes
Route::prefix('other-countries')->name('other-countries.')->group(function () {
    Route::get('/canada', [PageController::class, 'show'])->defaults('category', 'other-countries', 'slug', 'canada')->name('canada');
    Route::get('/new-zealand', [PageController::class, 'show'])->defaults('category', 'other-countries', 'slug', 'new-zealand')->name('new-zealand');
    Route::get('/usa', [PageController::class, 'show'])->defaults('category', 'other-countries', 'slug', 'usa')->name('usa');
});
