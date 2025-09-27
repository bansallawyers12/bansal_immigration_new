<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class EmployerSponsoredPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Main Employer Sponsored Index Page
        Page::firstOrCreate([
            'category' => 'employer-sponsored',
            'slug' => 'employer-sponsored'
        ], [
            'title' => 'Employer Sponsored Visas',
            'slug' => 'employer-sponsored',
            'content' => '<h2>Employer Sponsored Visas</h2><p>Australia offers various employer-sponsored visa options for skilled workers who have an Australian employer willing to sponsor them. These visas provide pathways to both temporary and permanent residence in Australia.</p><h3>Types of Employer Sponsored Visas</h3><ul><li><strong>Temporary Visas:</strong> Skill in Demand Visa (482), DAMA, Skilled Regional (494)</li><li><strong>Permanent Visas:</strong> ENS 186, National Innovation Visa (858)</li><li><strong>Global Talent:</strong> GTES Program</li></ul>',
            'excerpt' => 'Comprehensive employer-sponsored visa services for skilled workers with Australian employer sponsorship.',
            'template' => 'pages.employer-sponsored',
            'category' => 'employer-sponsored',
            'meta_title' => 'Employer Sponsored Visas Australia - Employer Nomination Services',
            'meta_description' => 'Expert employer-sponsored visa services including Skill in Demand Visa 482, ENS 186, and Global Talent programs for skilled workers with Australian employer sponsorship.',
            'status' => true,
            'featured' => true,
            'order' => 1
        ]);

        // Skill in Demand Visa 482
        Page::firstOrCreate([
            'category' => 'employer-sponsored',
            'slug' => 'sid-visa-482'
        ], [
            'title' => 'Skill in Demand Visa (482)',
            'slug' => 'sid-visa-482',
            'content' => '<h2>Skill in Demand Visa (Subclass 482)</h2><p>The Skill in Demand visa (formerly TSS visa) allows skilled workers to work in Australia for up to 4 years when sponsored by an approved employer. This visa has three streams: Short-term, Medium-term, and Labour Agreement.</p><h3>Key Requirements</h3><ul><li>Sponsored by an approved employer</li><li>Meet skill and English requirements</li><li>Work in an occupation on the relevant list</li><li>Meet health and character requirements</li></ul>',
            'excerpt' => 'Skill in Demand Visa 482 allows skilled workers to work in Australia for up to 4 years with employer sponsorship.',
            'template' => 'pages.employer-sponsored',
            'category' => 'employer-sponsored',
            'meta_title' => 'Skill in Demand Visa 482 - SID Visa Australia',
            'meta_description' => 'Complete guide to Skill in Demand Visa 482 application process, requirements, and pathways to permanent residency through employer sponsorship.',
            'status' => true,
            'featured' => false,
            'order' => 2
        ]);

        // DAMA
        Page::firstOrCreate([
            'category' => 'employer-sponsored',
            'slug' => 'dama'
        ], [
            'title' => 'Designated Area Migration Agreements (DAMA)',
            'slug' => 'dama',
            'content' => '<h2>Designated Area Migration Agreements (DAMA)</h2><p>DAMA provides a pathway for regional employers to sponsor skilled and semi-skilled overseas workers where there is a demonstrated need that cannot be met by the Australian labour market.</p><h3>Benefits of DAMA</h3><ul><li>Access to occupations not on standard lists</li><li>Concessions for English and skills requirements</li><li>Pathway to permanent residency</li><li>Regional development focus</li></ul>',
            'excerpt' => 'DAMA provides regional employers access to skilled workers with concessions for English and skills requirements.',
            'template' => 'pages.employer-sponsored',
            'category' => 'employer-sponsored',
            'meta_title' => 'DAMA Visa Australia - Designated Area Migration Agreements',
            'meta_description' => 'Complete guide to DAMA visa applications, regional employer sponsorship, and pathways to permanent residency in designated areas.',
            'status' => true,
            'featured' => false,
            'order' => 3
        ]);

        // Skilled Regional 494
        Page::firstOrCreate([
            'category' => 'employer-sponsored',
            'slug' => 'skilled-regional-494'
        ], [
            'title' => 'Skilled Employer Sponsored Regional (494)',
            'slug' => 'skilled-regional-494',
            'content' => '<h2>Skilled Employer Sponsored Regional Visa (Subclass 494)</h2><p>The 494 visa allows regional employers to sponsor skilled workers for up to 5 years. This visa provides a pathway to permanent residency through the 191 visa after 3 years.</p><h3>Key Features</h3><ul><li>5-year temporary visa</li><li>Must work in regional Australia</li><li>Pathway to permanent residency (191)</li><li>Family members included</li></ul>',
            'excerpt' => 'Skilled Regional 494 visa allows regional employers to sponsor skilled workers with pathway to permanent residency.',
            'template' => 'pages.employer-sponsored',
            'category' => 'employer-sponsored',
            'meta_title' => 'Skilled Regional 494 Visa - Employer Sponsored Regional Australia',
            'meta_description' => 'Complete guide to Skilled Regional 494 visa application, regional employer sponsorship, and pathway to permanent residency.',
            'status' => true,
            'featured' => false,
            'order' => 4
        ]);

        // Temporary Activity 408
        Page::firstOrCreate([
            'category' => 'employer-sponsored',
            'slug' => 'temporary-activity-408'
        ], [
            'title' => 'Temporary Activity Visa (408)',
            'slug' => 'temporary-activity-408',
            'content' => '<h2>Temporary Activity Visa (Subclass 408)</h2><p>The 408 visa allows people to come to Australia temporarily to participate in specific activities or work in critical sectors during COVID-19 recovery.</p><h3>Activity Types</h3><ul><li>Entertainment industry</li><li>Religious work</li><li>Research activities</li><li>Special program participants</li><li>COVID-19 critical work</li></ul>',
            'excerpt' => 'Temporary Activity 408 visa for specific activities and critical sector work in Australia.',
            'template' => 'pages.employer-sponsored',
            'category' => 'employer-sponsored',
            'meta_title' => 'Temporary Activity 408 Visa Australia - Activity and Work Visa',
            'meta_description' => 'Complete guide to Temporary Activity 408 visa for entertainment, research, religious work, and critical sector activities.',
            'status' => true,
            'featured' => false,
            'order' => 5
        ]);

        // Short Stay 400
        Page::firstOrCreate([
            'category' => 'employer-sponsored',
            'slug' => 'short-stay-400'
        ], [
            'title' => 'Temporary Work Short Stay Specialist (400)',
            'slug' => 'short-stay-400',
            'content' => '<h2>Temporary Work Short Stay Specialist Visa (Subclass 400)</h2><p>The 400 visa allows highly skilled workers to come to Australia for up to 6 months to do short-term, highly specialized work.</p><h3>Key Requirements</h3><ul><li>Highly specialized work</li><li>Cannot be done by Australian workers</li><li>Maximum 6 months stay</li><li>No family members included</li></ul>',
            'excerpt' => 'Short Stay 400 visa for highly skilled workers doing short-term specialized work in Australia.',
            'template' => 'pages.employer-sponsored',
            'category' => 'employer-sponsored',
            'meta_title' => 'Short Stay 400 Visa Australia - Temporary Work Specialist',
            'meta_description' => 'Complete guide to Short Stay 400 visa for highly skilled workers doing short-term specialized work in Australia.',
            'status' => true,
            'featured' => false,
            'order' => 6
        ]);

        // ENS 186 TRT
        Page::firstOrCreate([
            'category' => 'employer-sponsored',
            'slug' => 'ens-186-trt'
        ], [
            'title' => 'Employer Nomination Scheme 186 (TRT)',
            'slug' => 'ens-186-trt',
            'content' => '<h2>Employer Nomination Scheme 186 (Temporary Residence Transition)</h2><p>The ENS 186 TRT stream allows Skill in Demand visa holders to transition to permanent residency after working for their sponsoring employer for at least 3 years.</p><h3>Key Requirements</h3><ul><li>Hold Skill in Demand visa for at least 3 years</li><li>Worked for sponsoring employer for 3 years</li><li>Meet age, English, and skill requirements</li><li>Employer must nominate the position</li></ul>',
            'excerpt' => 'ENS 186 TRT allows Skill in Demand visa holders to transition to permanent residency after 3 years of work.',
            'template' => 'pages.employer-sponsored',
            'category' => 'employer-sponsored',
            'meta_title' => 'ENS 186 TRT Visa - Employer Nomination Scheme Transition',
            'meta_description' => 'Complete guide to ENS 186 TRT visa application, requirements, and pathway from Skill in Demand visa to permanent residency.',
            'status' => true,
            'featured' => false,
            'order' => 7
        ]);

        // ENS 186 Direct
        Page::firstOrCreate([
            'category' => 'employer-sponsored',
            'slug' => 'ens-186-direct'
        ], [
            'title' => 'Employer Nomination Scheme 186 (Direct Entry)',
            'slug' => 'ens-186-direct',
            'content' => '<h2>Employer Nomination Scheme 186 (Direct Entry)</h2><p>The ENS 186 Direct Entry stream allows skilled workers to obtain permanent residency directly without holding a Skill in Demand visa first.</p><h3>Key Requirements</h3><ul><li>Nominated by approved employer</li><li>Meet skill and English requirements</li><li>Under 45 years of age (with exceptions)</li><li>Work in nominated position for 2 years</li></ul>',
            'excerpt' => 'ENS 186 Direct Entry allows skilled workers to obtain permanent residency directly through employer nomination.',
            'template' => 'pages.employer-sponsored',
            'category' => 'employer-sponsored',
            'meta_title' => 'ENS 186 Direct Entry Visa - Employer Nomination Scheme',
            'meta_description' => 'Complete guide to ENS 186 Direct Entry visa application, requirements, and direct pathway to permanent residency.',
            'status' => true,
            'featured' => false,
            'order' => 8
        ]);

        // National Innovation Visa (858)
        Page::firstOrCreate([
            'category' => 'employer-sponsored',
            'slug' => 'national-innovation-visa'
        ], [
            'title' => 'National Innovation Visa (858)',
            'slug' => 'national-innovation-visa',
            'content' => '<h2>National Innovation Visa (Subclass 858)</h2><p>The National Innovation Visa (NIV) is Australia\'s premier pathway for exceptional individuals who can drive innovation and contribute significantly to the country\'s knowledge economy. This permanent visa replaced the Distinguished Talent visas (124 and 858) and the Global Talent Independent (GTI) program on December 6, 2024.</p><h3>Key Features</h3><ul><li>Internationally recognized record of exceptional achievement</li><li>Outstanding talent in priority sectors</li><li>Expression of Interest (EOI) required</li><li>Nomination by Australian citizen, permanent resident, or organization</li><li>Permanent residency pathway</li><li>No age limit</li></ul><h3>Priority Sectors</h3><ul><li>Critical technologies</li><li>Health industries</li><li>Renewable and low-emission technologies</li><li>Agri-food and AgTech</li><li>Defense and space</li><li>Education</li><li>Financial services and FinTech</li><li>Infrastructure and transport</li><li>Resources</li></ul><h3>Application Process</h3><ol><li>Submit Expression of Interest (EOI)</li><li>Receive invitation to apply</li><li>Submit full application with supporting documents</li><li>Provide nomination from eligible Australian citizen, permanent resident, or organization</li><li>Attend interview if required</li><li>Await decision</li></ol>',
            'excerpt' => 'National Innovation Visa (858) for exceptional individuals who can drive innovation in Australia\'s priority sectors.',
            'template' => 'pages.employer-sponsored',
            'category' => 'employer-sponsored',
            'meta_title' => 'National Innovation Visa 858 Australia - Exceptional Talent Pathway',
            'meta_description' => 'Complete guide to National Innovation Visa (858) for exceptional individuals who can drive innovation in Australia\'s priority sectors.',
            'status' => true,
            'featured' => false,
            'order' => 10
        ]);

        // GTI Program
        Page::firstOrCreate([
            'category' => 'employer-sponsored',
            'slug' => 'gti'
        ], [
            'title' => 'Global Talent Independent Program (GTI)',
            'slug' => 'gti',
            'content' => '<h2>Global Talent Independent Program (GTI)</h2><p>The GTI program targets highly skilled individuals in specific sectors to help grow Australia\'s innovation and tech economy.</p><h3>Target Sectors</h3><ul><li>AgTech, Space and Advanced Digital</li><li>FinTech</li><li>Energy and Mining Technology</li><li>MedTech</li><li>Cyber Security</li><li>Quantum Information, Advanced Digital, Data Science and ICT</li></ul>',
            'excerpt' => 'GTI program for highly skilled individuals in specific sectors to grow Australia\'s innovation economy.',
            'template' => 'pages.employer-sponsored',
            'category' => 'employer-sponsored',
            'meta_title' => 'GTI Program Australia - Global Talent Independent Visa',
            'meta_description' => 'Complete guide to GTI program application, target sectors, and pathway to permanent residency for highly skilled individuals.',
            'status' => true,
            'featured' => false,
            'order' => 11
        ]);

        // GTES Program
        Page::firstOrCreate([
            'category' => 'employer-sponsored',
            'slug' => 'gtes'
        ], [
            'title' => 'Global Talent Employer Sponsored (GTES)',
            'slug' => 'gtes',
            'content' => '<h2>Global Talent Employer Sponsored (GTES)</h2><p>The GTES program allows approved employers to sponsor highly skilled workers in specific sectors with streamlined processing.</p><h3>Key Benefits</h3><ul><li>Streamlined processing</li><li>Priority processing</li><li>Access to highly skilled talent</li><li>Innovation sector focus</li></ul>',
            'excerpt' => 'GTES program allows approved employers to sponsor highly skilled workers with streamlined processing.',
            'template' => 'pages.employer-sponsored',
            'category' => 'employer-sponsored',
            'meta_title' => 'GTES Program Australia - Global Talent Employer Sponsored',
            'meta_description' => 'Complete guide to GTES program for employers to sponsor highly skilled workers with streamlined processing.',
            'status' => true,
            'featured' => false,
            'order' => 12
        ]);

        $this->command->info('✅ Created employer-sponsored pages');
        $this->command->info('📊 Total employer-sponsored pages: ' . Page::where('category', 'employer-sponsored')->count());
    }
}


