<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class AdditionalMigrationPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Helper to create a page with minimal placeholder content
        $create = function (string $category, string $slug, string $title, string $template) {
            Page::firstOrCreate([
                'category' => $category,
                'slug' => $slug,
            ], [
                'title' => $title,
                'content' => '<h2>' . e($title) . '</h2><p>Content coming soon. Our team is preparing comprehensive guidance for this visa.</p>',
                'excerpt' => $title . ' — overview, eligibility, process and documents. Content coming soon.',
                'template' => $template,
                'category' => $category,
                'meta_title' => $title . ' Australia',
                'meta_description' => $title . ' — overview, eligibility, process and required documents for Australia.',
                'status' => true,
                'featured' => false,
                'order' => 2,
            ]);
        };

        // ==========================
        // Migrate to Australia (Skilled Migration)
        // ==========================
        $migrateCategory = 'migrate-to-australia';
        $migrateTemplate = 'pages.migrate-to-australia';
        $create($migrateCategory, 'temporary-graduate-visa-subclass-485', 'Temporary Graduate (485)', $migrateTemplate);
        $create($migrateCategory, 'post-study-work-visa-subclass-485', 'Post Study Work (485)', $migrateTemplate);
        $create($migrateCategory, 'skilled-independent-visa-subclass-189', 'Skilled Independent (189)', $migrateTemplate);
        $create($migrateCategory, 'skilled-nominated-visa-subclass-190', 'Skilled Nominated (190)', $migrateTemplate);
        $create($migrateCategory, 'skilled-regional-visa-subclass-887', 'Skilled Regional (887)', $migrateTemplate);
        $create($migrateCategory, 'permanent-residence-skilled-regional-visa-subclass-191', 'PR Skilled Regional (191)', $migrateTemplate);
        $create($migrateCategory, 'skilled-work-regional-provisional-visa-subclass-491', 'Skilled Work Regional (491)', $migrateTemplate);

        // ==========================
        // Family Visa (Partner, Parent, Child, Other Family)
        // ==========================
        $familyCategory = 'family-visa';
        $familyTemplate = 'pages.family-visa';
        // Partner visas
        $create($familyCategory, 'partner-provisional-visa-subclass-309', 'Partner Provisional (309)', $familyTemplate);
        $create($familyCategory, 'partner-permanent-visa-subclass-100', 'Partner Permanent (100)', $familyTemplate);
        $create($familyCategory, 'partner-provisional-visa-subclass-820', 'Partner Provisional (820)', $familyTemplate);
        $create($familyCategory, 'partner-permanent-visa-subclass-801', 'Partner Permanent (801)', $familyTemplate);
        $create($familyCategory, 'prospective-marriage-visa-subclass-300', 'Prospective Marriage (300)', $familyTemplate);
        // Parent visas
        $create($familyCategory, 'contributory-parent-subclass-143', 'Contributory Parent (143)', $familyTemplate);
        $create($familyCategory, 'parent-visa-subclass-103', 'Parent Visa (103)', $familyTemplate);
        $create($familyCategory, 'contributory-aged-parent-temporary-visa-subclass-884', 'Contributory Aged Parent (884)', $familyTemplate);
        $create($familyCategory, 'contributory-aged-parent-visa-subclass-864', 'Contributory Aged Parent (864)', $familyTemplate);
        $create($familyCategory, 'contributory-parent-temporary-visa-subclass-173', 'Contributory Parent (173)', $familyTemplate);
        $create($familyCategory, 'aged-parent-visa-subclass-804', 'Aged Parent (804)', $familyTemplate);
        $create($familyCategory, 'sponsored-parent-temporary-visa-subclass-870', 'Sponsored Parent (870)', $familyTemplate);
        // Child visas
        $create($familyCategory, 'child-visa-subclass-101', 'Child Visa (101)', $familyTemplate);
        $create($familyCategory, 'child-visa-subclass-802', 'Child Visa (802)', $familyTemplate);
        $create($familyCategory, 'adoption-visa-subclass-102', 'Adoption Visa (102)', $familyTemplate);
        $create($familyCategory, 'dependent-child-visa-subclass-445', 'Dependent Child Visa (445)', $familyTemplate);
        $create($familyCategory, 'new-zealand-citizen-family-relationship-visa-subclass-461', 'New Zealand Citizen Family (461)', $familyTemplate);
        // Other family
        $create($familyCategory, 'remaining-relative-visa-subclass-115', 'Remaining Relative (115)', $familyTemplate);
        $create($familyCategory, 'remaining-relative-visa-subclass-835', 'Remaining Relative (835)', $familyTemplate);
        $create($familyCategory, 'orphan-reletive-visa-117', 'Orphan Relative (117)', $familyTemplate);
        $create($familyCategory, 'orphan-relative-visa-837', 'Orphan Relative (837)', $familyTemplate);
        $create($familyCategory, 'dependent-child-visa', 'Dependent Child', $familyTemplate);
        $create($familyCategory, 'carer-visa-offshore-subclass-116', 'Carer Visa (116)', $familyTemplate);
        $create($familyCategory, 'carer-visa-onshore-subclass-836', 'Carer Visa (836)', $familyTemplate);

        // ==========================
        // Visitor & Work
        // ==========================
        $visitorCategory = 'visitor-visa';
        $visitorTemplate = 'pages.visitor-visa';
        $create($visitorCategory, 'visitor-visa-600', 'Visitor Visa (600)', $visitorTemplate);
        $create($visitorCategory, 'electronic-travel-authority-601', 'Electronic Travel Authority (601)', $visitorTemplate);
        $create($visitorCategory, 'evisitor-651', 'eVisitor (651)', $visitorTemplate);
        $create($visitorCategory, 'work-holiday-462', 'Work & Holiday (462)', $visitorTemplate);
        $create($visitorCategory, 'work-holiday-417', 'Work & Holiday (417)', $visitorTemplate);
        $create($visitorCategory, 'sponsored-family', 'Sponsored Family', $visitorTemplate);
        $create($visitorCategory, 'onshore-visitor-visa-extension', 'Onshore Visitor Visa Extension', $visitorTemplate);

        // ==========================
        // Transit & Special Purpose
        // ==========================
        $transitCategory = 'transit-special-purpose';
        $transitTemplate = 'pages.default';
        $create($transitCategory, 'transit-visa-771', 'Transit Visa (771)', $transitTemplate);
        $create($transitCategory, 'special-category-visa-444', 'Special Category Visa (444)', $transitTemplate);
        $create($transitCategory, 'special-purpose-visa', 'Special Purpose Visa', $transitTemplate);
        $create($transitCategory, 'special-purpose-travel-authority-945', 'Special Purpose Travel Authority (945)', $transitTemplate);

        // ==========================
        // Employer Sponsored (additional)
        // ==========================
        $employerCategory = 'employer-sponsored';
        $employerTemplate = 'pages.employer-sponsored';
        $create($employerCategory, 'temporary-work-international-relations-403', 'Temporary Work International Relations (403)', $employerTemplate);

        // ==========================
        // Medical & Humanitarian
        // ==========================
        $medicalCategory = 'medical-humanitarian';
        $medicalTemplate = 'pages.default';
        $create($medicalCategory, 'medical-treatment-visa-602', 'Medical Treatment (602)', $medicalTemplate);
        $create($medicalCategory, 'pacific-engagement-visa-192', 'Pacific Engagement (192)', $medicalTemplate);
        $create($medicalCategory, 'former-resident-visa-151', 'Former Resident (151)', $medicalTemplate);

        // ==========================
        // Maritime & Crew
        // ==========================
        $maritimeCategory = 'maritime-crew';
        $maritimeTemplate = 'pages.default';
        $create($maritimeCategory, 'crew-travel-authority-942', 'Crew Travel Authority (942)', $maritimeTemplate);
        $create($maritimeCategory, 'maritime-crew-visa-988', 'Maritime Crew (988)', $maritimeTemplate);

        // ==========================
        // Bridging & Return Visas
        // ==========================
        $bridgingCategory = 'bridging-return-visas';
        $bridgingTemplate = 'pages.default';
        $create($bridgingCategory, 'bridging-visa-a-010', 'Bridging Visa A (010)', $bridgingTemplate);
        $create($bridgingCategory, 'bridging-visa-b-020', 'Bridging Visa B (020)', $bridgingTemplate);
        $create($bridgingCategory, 'bridging-visa-c-030', 'Bridging Visa C (030)', $bridgingTemplate);
        $create($bridgingCategory, 'bridging-visa-e-050-051', 'Bridging Visa E (050/051)', $bridgingTemplate);
        $create($bridgingCategory, 'resident-return-visa-155-157', 'Resident Return (155/157)', $bridgingTemplate);
    }
}


