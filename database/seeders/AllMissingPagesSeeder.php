<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class AllMissingPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Visitor Visa Category
        Page::firstOrCreate([
            'category' => 'visitor-visa',
            'slug' => 'visitor-visa'
        ], [
            'title' => 'Visitor Visas',
            'slug' => 'visitor-visa',
            'content' => '<h2>Visitor Visas to Australia</h2><p>Australia offers various visitor visa options for tourists, business visitors, and people visiting family and friends.</p><h3>Types of Visitor Visas</h3><ul><li><strong>Tourist Visa (600):</strong> For holiday and recreation</li><li><strong>Work & Holiday (417/462):</strong> For young people to work and travel</li><li><strong>Sponsored Family:</strong> For family-sponsored visits</li></ul>',
            'excerpt' => 'Comprehensive visitor visa services for tourists, business visitors, and family visits to Australia.',
            'template' => 'pages.visitor-visa',
            'category' => 'visitor-visa',
            'meta_title' => 'Visitor Visas Australia - Tourist, Business, Family Visits',
            'meta_description' => 'Expert visitor visa services including tourist visas, work & holiday visas, and family-sponsored visits to Australia.',
            'status' => true,
            'featured' => true,
            'order' => 1
        ]);

        // Business Visa Category
        Page::firstOrCreate([
            'category' => 'business-visa',
            'slug' => 'business-visa'
        ], [
            'title' => 'Business Visas',
            'slug' => 'business-visa',
            'content' => '<h2>Business Investment Visas</h2><p>Australia offers various business and investment visa options for entrepreneurs, investors, and business people looking to establish or invest in Australian businesses.</p><h3>Types of Business Visas</h3><ul><li><strong>Business Innovation (188/888):</strong> For business owners and investors</li><li><strong>Business Talent (132):</strong> For high-caliber business people</li><li><strong>Investor Visas:</strong> For significant investors</li></ul>',
            'excerpt' => 'Comprehensive business visa services for entrepreneurs, investors, and business people in Australia.',
            'template' => 'pages.business-visa',
            'category' => 'business-visa',
            'meta_title' => 'Business Visas Australia - Investment and Entrepreneur Visas',
            'meta_description' => 'Expert business visa services including Business Innovation, Business Talent, and investor visa programs in Australia.',
            'status' => true,
            'featured' => true,
            'order' => 1
        ]);

        // Appeals Category
        Page::firstOrCreate([
            'category' => 'appeals',
            'slug' => 'appeals'
        ], [
            'title' => 'Appeals and Reviews',
            'slug' => 'appeals',
            'content' => '<h2>Immigration Appeals and Reviews</h2><p>If your visa application has been refused or cancelled, you may have options to appeal the decision or request a review.</p><h3>Types of Appeals</h3><ul><li><strong>Visa Refusal Appeals:</strong> AAT review of refused applications</li><li><strong>Visa Cancellation Appeals:</strong> Challenging visa cancellations</li><li><strong>Ministerial Intervention:</strong> Special circumstances cases</li></ul>',
            'excerpt' => 'Expert immigration appeals and review services for refused or cancelled visa applications.',
            'template' => 'pages.appeals',
            'category' => 'appeals',
            'meta_title' => 'Immigration Appeals Australia - Visa Refusal and Cancellation Reviews',
            'meta_description' => 'Expert immigration appeals services including AAT reviews, visa cancellation appeals, and ministerial intervention.',
            'status' => true,
            'featured' => true,
            'order' => 1
        ]);

        // Citizenship Category
        Page::firstOrCreate([
            'category' => 'citizenship',
            'slug' => 'citizenship'
        ], [
            'title' => 'Australian Citizenship',
            'slug' => 'citizenship',
            'content' => '<h2>Australian Citizenship Services</h2><p>Australian citizenship provides you with the rights and responsibilities of being an Australian citizen, including the right to vote and hold an Australian passport.</p><h3>Citizenship Pathways</h3><ul><li><strong>Citizenship by Conferral:</strong> For permanent residents</li><li><strong>Citizenship by Descent:</strong> For children of Australian citizens</li><li><strong>Evidence of Citizenship:</strong> For existing citizens</li></ul>',
            'excerpt' => 'Comprehensive Australian citizenship services including conferral, descent, and evidence applications.',
            'template' => 'pages.citizenship',
            'category' => 'citizenship',
            'meta_title' => 'Australian Citizenship Services - Conferral and Descent',
            'meta_description' => 'Expert Australian citizenship services including conferral applications, citizenship by descent, and evidence of citizenship.',
            'status' => true,
            'featured' => true,
            'order' => 1
        ]);

        // Other Countries Category
        Page::firstOrCreate([
            'category' => 'other-countries',
            'slug' => 'other-countries'
        ], [
            'title' => 'Other Countries',
            'slug' => 'other-countries',
            'content' => '<h2>Immigration Services for Other Countries</h2><p>While we specialize in Australian immigration, we also provide guidance and referrals for immigration to other popular destinations.</p><h3>Countries We Cover</h3><ul><li><strong>Canada:</strong> Express Entry, Provincial Nominee Programs</li><li><strong>New Zealand:</strong> Skilled Migrant Category, Work Visas</li><li><strong>United States:</strong> Work visas, Green Card applications</li></ul>',
            'excerpt' => 'Immigration services and guidance for Canada, New Zealand, and United States immigration programs.',
            'template' => 'pages.other-countries',
            'category' => 'other-countries',
            'meta_title' => 'Other Countries Immigration - Canada, New Zealand, USA',
            'meta_description' => 'Immigration services and guidance for Canada, New Zealand, and United States immigration programs.',
            'status' => true,
            'featured' => true,
            'order' => 1
        ]);

        // Create individual pages for visitor visa subcategories
        $visitorPages = [
            [
                'slug' => 'visitor-visa-600',
                'title' => 'Visitor Visa (600)',
                'content' => '<h2>Visitor Visa (Subclass 600)</h2><p>The Visitor Visa (600) allows you to visit Australia for tourism, business, or to visit family and friends.</p><h3>Streams</h3><ul><li>Tourist stream</li><li>Business visitor stream</li><li>Sponsored family stream</li><li>Frequent traveller stream</li></ul>',
                'excerpt' => 'Visitor Visa 600 for tourism, business, and family visits to Australia.',
                'meta_title' => 'Visitor Visa 600 Australia - Tourist and Business Visitor',
                'meta_description' => 'Complete guide to Visitor Visa 600 application, requirements, and processing times for tourism and business visits.'
            ],
            [
                'slug' => 'work-holiday-462',
                'title' => 'Work & Holiday Visa (462)',
                'content' => '<h2>Work & Holiday Visa (Subclass 462)</h2><p>The 462 visa allows young people from eligible countries to work and holiday in Australia for up to 12 months.</p><h3>Key Requirements</h3><ul><li>Aged 18-30 (inclusive)</li><li>From eligible country</li><li>Sufficient funds for initial stay</li><li>Meet health and character requirements</li></ul>',
                'excerpt' => 'Work & Holiday Visa 462 for young people to work and travel in Australia.',
                'meta_title' => 'Work & Holiday Visa 462 Australia - Working Holiday',
                'meta_description' => 'Complete guide to Work & Holiday Visa 462 application, requirements, and eligibility for young travellers.'
            ],
            [
                'slug' => 'work-holiday-417',
                'title' => 'Work & Holiday Visa (417)',
                'content' => '<h2>Work & Holiday Visa (Subclass 417)</h2><p>The 417 visa allows young people from eligible countries to work and holiday in Australia for up to 12 months.</p><h3>Key Requirements</h3><ul><li>Aged 18-30 (inclusive)</li><li>From eligible country</li><li>Sufficient funds for initial stay</li><li>Meet health and character requirements</li></ul>',
                'excerpt' => 'Work & Holiday Visa 417 for young people to work and travel in Australia.',
                'meta_title' => 'Work & Holiday Visa 417 Australia - Working Holiday',
                'meta_description' => 'Complete guide to Work & Holiday Visa 417 application, requirements, and eligibility for young travellers.'
            ],
            [
                'slug' => 'sponsored-family',
                'title' => 'Sponsored Family Stream',
                'content' => '<h2>Sponsored Family Stream</h2><p>The Sponsored Family stream allows Australian citizens and permanent residents to sponsor family members for visitor visas.</p><h3>Key Features</h3><ul><li>Family sponsorship required</li><li>Longer stay periods</li><li>Multiple entry options</li><li>Family support obligations</li></ul>',
                'excerpt' => 'Sponsored Family stream for family-sponsored visitor visas to Australia.',
                'meta_title' => 'Sponsored Family Visitor Visa Australia - Family Sponsored',
                'meta_description' => 'Complete guide to Sponsored Family visitor visa application and family sponsorship requirements.'
            ],
            [
                'slug' => 'offshore-extension',
                'title' => 'Offshore Tourist Visa Extension',
                'content' => '<h2>Offshore Tourist Visa Extension</h2><p>If you need to extend your stay in Australia as a tourist, you may be able to apply for a visa extension.</p><h3>Key Requirements</h3><ul><li>Currently hold a visitor visa</li><li>Genuine need for extension</li><li>Sufficient funds for extended stay</li><li>Meet health and character requirements</li></ul>',
                'excerpt' => 'Offshore Tourist Visa Extension for extending your stay in Australia.',
                'meta_title' => 'Offshore Tourist Visa Extension Australia - Visa Extension',
                'meta_description' => 'Complete guide to extending your tourist visa while in Australia, requirements and application process.'
            ],
            [
                'slug' => 'travel-exemption',
                'title' => 'Travel Exemption',
                'content' => '<h2>Travel Exemption</h2><p>During COVID-19 restrictions, certain travellers may be eligible for travel exemptions to enter Australia.</p><h3>Exemption Categories</h3><ul><li>Critical skills and sectors</li><li>Medical and health services</li><li>Humanitarian and compassionate grounds</li><li>National interest</li></ul>',
                'excerpt' => 'Travel Exemption for entering Australia during COVID-19 restrictions.',
                'meta_title' => 'Travel Exemption Australia - COVID-19 Travel Restrictions',
                'meta_description' => 'Complete guide to travel exemptions for entering Australia during COVID-19 restrictions.'
            ]
        ];

        foreach ($visitorPages as $pageData) {
            Page::firstOrCreate([
                'category' => 'visitor-visa',
                'slug' => $pageData['slug']
            ], array_merge($pageData, [
                'template' => 'pages.visitor-visa',
                'category' => 'visitor-visa',
                'status' => true,
                'featured' => false,
                'order' => 2
            ]));
        }

        $this->command->info('✅ Created all missing category pages');
        $this->command->info('📊 Total pages created: ' . Page::count());
    }
}
