<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = 'pages';

    protected $fillable = [
        'title',
        'slug',
        'route_name',
        'content',
        'excerpt',
        'template',
        'category',
        'subcategory',
        'image',
        'image_alt',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'featured',
        'order',
        'parent_id',
        'visa_highlights',
        'visa_eligibility',
        'visa_benefits',
        'visa_steps',
        'visa_faqs',
        'visa_processing_times',
        'visa_costs',
        'visa_duration',
        'visa_pathways'
    ];

    protected $casts = [
        'status' => 'boolean',
        'featured' => 'boolean',
        'order' => 'integer',
        'parent_id' => 'integer',
        'visa_highlights' => 'array',
        'visa_eligibility' => 'array',
        'visa_benefits' => 'array',
        'visa_steps' => 'array',
        'visa_faqs' => 'array',
        'visa_processing_times' => 'array',
        'visa_costs' => 'array',
        'visa_duration' => 'array',
        'visa_pathways' => 'array'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeBySubcategory($query, $subcategory)
    {
        return $query->where('subcategory', $subcategory);
    }

    public function parent()
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the route name for this page, generating it if not set
     */
    public function getRouteNameAttribute($value)
    {
        if ($value) {
            return $value;
        }

        // Auto-generate route name based on category and slug
        return $this->generateRouteName();
    }

    /**
     * Generate route name based on category and slug
     */
    public function generateRouteName()
    {
        $category = $this->category;
        $slug = $this->slug;

        // Handle special cases for known route patterns
        $routeMappings = [
            'citizenship' => [
                'citizenship-by-conferral' => 'citizenship.by-conferral',
                'citizenship-by-descent' => 'citizenship.by-descent',
                'evidence-of-australian-citizenship' => 'citizenship.evidence',
                'citizenship' => 'citizenship.index',
            ],
            'study-australia' => [
                'admission-in-australia' => 'study-australia.admission',
                'new-coe' => 'study-australia.new-coe',
                'course-change-in-australia' => 'study-australia.course-change',
                'what-is-recognized-prior-learning-rpl-australia' => 'study-australia.rpl',
                'professional-year-program' => 'study-australia.professional-year',
                'request-to-defer-your-studies' => 'study-australia.defer-studies',
                'our-affiliations' => 'study-australia.affiliations',
                'student-dependent-visa-to-student-visa-subclass-500' => 'study-australia.student-dependent',
                'student-visa-extension' => 'study-australia.student-extension',
                'student-guardian-visa-subclass-590' => 'study-australia.student-guardian',
                'student-visa-journey' => 'study-australia.student-journey',
                'student-subsequent-entrant-visa-information' => 'study-australia.student-subsequent',
                'student-visa-information' => 'study-australia.student-info',
                'training-visa-407' => 'study-australia.training-visa',
                'tourist-to-student-visa' => 'study-australia.tourist-to-student',
                'master-to-diploma-student-visa-subclass-500' => 'study-australia.master-to-diploma',
                'apply-afp-ipc-form' => 'study-australia.afp-ipc',
                'study-australia' => 'study-australia.index',
            ],
            'visitor-visa' => [
                'visitor-visa-600' => 'visitor-visa.600',
                'onshore-visitor-visa-extension' => 'visitor-visa.onshore-extension',
                'work-holiday-462' => 'visitor-visa.work-holiday-462',
                'work-holiday-417' => 'visitor-visa.work-holiday-417',
                'sponsored-family' => 'visitor-visa.sponsored-family',
                'visitor-visa' => 'visitor-visa.index',
            ],
            'migrate-to-australia' => [
                'temporary-graduate-visa-subclass-485' => 'migrate-to-australia.temporary-graduate',
                'post-study-work-visa-subclass-485' => 'migrate-to-australia.post-study-work',
                'skilled-recognised-graduate-visa-476' => 'migrate-to-australia.skilled-graduate',
                'skilled-independent-visa-subclass-189' => 'migrate-to-australia.skilled-independent',
                'skilled-nominated-visa-subclass-190' => 'migrate-to-australia.skilled-nominated',
                'skilled-regional-visa-subclass-887' => 'migrate-to-australia.skilled-regional',
                'permanent-residence-skilled-regional-visa-subclass-191' => 'migrate-to-australia.pr-skilled-regional',
                'skilled-work-regional-provisional-visa-subclass-491' => 'migrate-to-australia.skilled-work-regional',
                'acs-skill-assessment' => 'migrate-to-australia.acs-assessment',
                'vetassess-skill-assessment' => 'migrate-to-australia.vetassess-assessment',
                'job-ready-program' => 'migrate-to-australia.job-ready-program',
                'ea-skill-assessment' => 'migrate-to-australia.ea-assessment',
                'accountant-skill-assessment' => 'migrate-to-australia.accountant-assessment',
                'nursing-aphara-registration-and-anmac-skill-assessment' => 'migrate-to-australia.nursing-assessment',
                'regional-points' => 'migrate-to-australia.regional-points',
                'english-points' => 'migrate-to-australia.english-points',
                'migrate-to-australia' => 'migrate-to-australia.index',
            ],
            'family-visa' => [
                'partner-provisional-visa-subclass-309' => 'family-visa.partner-provisional-309',
                'partner-permanent-visa-subclass-100' => 'family-visa.partner-permanent-100',
                'partner-provisional-visa-subclass-820' => 'family-visa.partner-provisional-820',
                'partner-permanent-visa-subclass-801' => 'family-visa.partner-permanent-801',
                'prospective-marriage-visa-subclass-300' => 'family-visa.prospective-marriage',
                'contributory-aged-parent-temporary-visa-subclass-884' => 'family-visa.contributory-aged-parent-884',
                'contributory-aged-parent-visa-subclass-864' => 'family-visa.contributory-aged-parent-864',
                'contributory-parent-temporary-visa-subclass-173' => 'family-visa.contributory-parent-173',
                'contributory-parent-subclass-143' => 'family-visa.contributory-parent-143',
                'parent-visa-subclass-103' => 'family-visa.parent-visa-103',
                'aged-parent-visa-subclass-804' => 'family-visa.aged-parent-804',
                'sponsored-parent-temporary-visa-subclass-870' => 'family-visa.sponsored-parent-870',
                'child-visa-subclass-101' => 'family-visa.child-visa-101',
                'child-visa-subclass-802' => 'family-visa.child-visa-802',
                'adoption-visa' => 'family-visa.adoption-visa',
                'remaining-relative-visa-subclass-115' => 'family-visa.remaining-relative-115',
                'remaining-relative-visa-subclass-835' => 'family-visa.remaining-relative-835',
                'orphan-reletive-visa-117' => 'family-visa.orphan-relative-117',
                'orphan-relative-visa-837' => 'family-visa.orphan-relative-837',
                'dependent-child-visa' => 'family-visa.dependent-child',
                'aged-dependent-114' => 'family-visa.aged-dependent-114',
                'aged-dependent-offshore-114' => 'family-visa.aged-dependent-offshore-114',
                'aged-dependent-onshore-838' => 'family-visa.aged-dependent-onshore-838',
                'carer-visa-offshore-subclass-116' => 'family-visa.carer-offshore-116',
                'carer-visa-onshore-subclass-836' => 'family-visa.carer-onshore-836',
                'cost-for-contributory-visas' => 'family-visa.contributory-costs',
                'family-visa' => 'family-visa.index',
            ],
            'employer-sponsored' => [
                'sid-visa-482' => 'employer-sponsored.sid-482',
                'dama' => 'employer-sponsored.dama',
                'skilled-regional-494' => 'employer-sponsored.skilled-regional-494',
                'temporary-activity-408' => 'employer-sponsored.temporary-activity-408',
                'short-stay-400' => 'employer-sponsored.short-stay-400',
                'ens-186-trt' => 'employer-sponsored.ens-186-trt',
                'ens-186-direct' => 'employer-sponsored.ens-186-direct',
                'national-innovation-visa' => 'employer-sponsored.national-innovation-visa',
                'gti' => 'employer-sponsored.gti',
                'gtes' => 'employer-sponsored.gtes',
                'employer-sponsored' => 'employer-sponsored.index',
            ],
            'business-visa' => [
                'business-innovation-and-investment-permanent-visa-subclass-888' => 'business-visa.business-permanent-888',
                'business-innovation-and-investment-provisional-visa-subclass-188' => 'business-visa.business-provisional-188',
                'business-talent-permanent-visa-subclass-132' => 'business-visa.business-talent-132',
                'business-visa' => 'business-visa.index',
            ],
            'appeals' => [
                'art-appeals' => 'appeals.art-appeals',
                'federal-court-appeals' => 'appeals.federal-court-appeals',
                'ministerial-intervention' => 'appeals.ministerial-intervention',
                'review-process' => 'appeals.review-process',
                'visa-refusal' => 'appeals.visa-refusal',
                'visa-cancellation' => 'appeals.visa-cancellation',
                'notice-cancellation' => 'appeals.notice-cancellation',
                'noicc' => 'appeals.noicc',
                'waiver-request' => 'appeals.waiver-request',
                'work-rights' => 'appeals.work-rights',
                'study-rights' => 'appeals.study-rights',
                'appeals' => 'appeals.index',
            ],
            'other-countries' => [
                'canada' => 'other-countries.canada',
                'new-zealand' => 'other-countries.new-zealand',
                'usa' => 'other-countries.usa',
                'other-countries' => 'other-countries.index',
            ],
            'celebrity-visas' => [
                'celebrity-visas' => 'celebrity-visas.index',
            ],
            'skill-assessment' => [
                'skill-assessment' => 'skill-assessment.index',
            ],
            'transit-special-purpose' => [
                'transit-special-purpose' => 'transit-special-purpose.index',
            ],
            'medical-humanitarian' => [
                'medical-humanitarian' => 'medical-humanitarian.index',
            ],
            'maritime-crew' => [
                'maritime-crew' => 'maritime-crew.index',
            ],
            'bridging-return-visas' => [
                'bridging-return-visas' => 'bridging-return-visas.index',
            ],
        ];

        // Check if we have a specific mapping for this category and slug
        if (isset($routeMappings[$category][$slug])) {
            return $routeMappings[$category][$slug];
        }

        // Fallback: generate route name using category and slug
        // Convert slug to route-friendly format
        $routeSlug = str_replace(['-', '_'], '.', $slug);
        return $category . '.' . $routeSlug;
    }
}
