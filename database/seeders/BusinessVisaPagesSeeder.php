<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class BusinessVisaPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Business Innovation and Investment Permanent Visa (Subclass 888)
        Page::firstOrCreate([
            'category' => 'business-visa',
            'slug' => 'business-innovation-and-investment-permanent-visa-subclass-888'
        ], [
            'title' => 'Business Innovation and Investment Permanent Visa (Subclass 888)',
            'slug' => 'business-innovation-and-investment-permanent-visa-subclass-888',
            'content' => '<h2>Business Innovation and Investment Permanent Visa (Subclass 888)</h2>
            <p>The Business Innovation and Investment (Permanent) visa (subclass 888) is the second stage of the Business Innovation and Investment (Provisional) visa (subclass 188). This visa allows you to stay in Australia permanently.</p>
            
            <h3>Streams Available</h3>
            <ul>
                <li><strong>Business Innovation Stream:</strong> For those who have operated a business in Australia for at least 2 years</li>
                <li><strong>Investor Stream:</strong> For those who have maintained a designated investment for at least 4 years</li>
                <li><strong>Significant Investor Stream:</strong> For those who have maintained a significant investment for at least 4 years</li>
                <li><strong>Premium Investor Stream:</strong> For those who have maintained a premium investment for at least 12 months</li>
                <li><strong>Entrepreneur Stream:</strong> For those who have operated an entrepreneurial activity for at least 2 years</li>
            </ul>

            <h3>Key Requirements</h3>
            <ul>
                <li>Must hold a Business Innovation and Investment (Provisional) visa (subclass 188)</li>
                <li>Meet the specific requirements for your stream</li>
                <li>Have maintained your investment or business activity</li>
                <li>Meet health and character requirements</li>
                <li>Have adequate health insurance</li>
            </ul>

            <h3>Benefits</h3>
            <ul>
                <li>Live and work in Australia permanently</li>
                <li>Study in Australia</li>
                <li>Sponsor eligible relatives for permanent residence</li>
                <li>Travel to and from Australia for 5 years</li>
                <li>Apply for Australian citizenship (subject to residency requirements)</li>
            </ul>',
            'excerpt' => 'Business Innovation and Investment Permanent Visa 888 - the second stage for permanent residence after holding a 188 visa.',
            'template' => 'pages.business-visa',
            'category' => 'business-visa',
            'meta_title' => 'Business Innovation Investment Permanent Visa 888 Australia',
            'meta_description' => 'Complete guide to Business Innovation and Investment Permanent Visa 888 application, requirements, and pathways to permanent residence in Australia.',
            'status' => true,
            'featured' => true,
            'order' => 2
        ]);

        // Business Innovation and Investment Provisional Visa (Subclass 188)
        Page::firstOrCreate([
            'category' => 'business-visa',
            'slug' => 'business-innovation-and-investment-provisional-visa-subclass-188'
        ], [
            'title' => 'Business Innovation and Investment Provisional Visa (Subclass 188)',
            'slug' => 'business-innovation-and-investment-provisional-visa-subclass-188',
            'content' => '<h2>Business Innovation and Investment Provisional Visa (Subclass 188)</h2>
            <p>The Business Innovation and Investment (Provisional) visa (subclass 188) is for people with business skills or investors who want to own and manage a new or existing business in Australia, or invest in Australia.</p>
            
            <h3>Streams Available</h3>
            <ul>
                <li><strong>Business Innovation Stream:</strong> For people with business skills who want to establish, develop and manage a new or existing business</li>
                <li><strong>Investor Stream:</strong> For people who want to make a designated investment of at least AUD 1.5 million in an Australian state or territory</li>
                <li><strong>Significant Investor Stream:</strong> For people who want to invest at least AUD 5 million in complying investments</li>
                <li><strong>Premium Investor Stream:</strong> For people who want to invest at least AUD 15 million in complying premium investments</li>
                <li><strong>Entrepreneur Stream:</strong> For people with a funding agreement from a third party for at least AUD 200,000</li>
            </ul>

            <h3>Key Requirements</h3>
            <ul>
                <li>Be nominated by a state or territory government</li>
                <li>Be invited to apply for this visa</li>
                <li>Meet the specific requirements for your chosen stream</li>
                <li>Meet health and character requirements</li>
                <li>Have adequate health insurance</li>
                <li>Meet English language requirements (some streams)</li>
            </ul>

            <h3>Benefits</h3>
            <ul>
                <li>Live and work in Australia for up to 5 years</li>
                <li>Bring eligible family members</li>
                <li>Pathway to permanent residence through visa subclass 888</li>
                <li>Study in Australia</li>
                <li>Travel to and from Australia</li>
            </ul>',
            'excerpt' => 'Business Innovation and Investment Provisional Visa 188 - first stage for entrepreneurs and investors to establish business or invest in Australia.',
            'template' => 'pages.business-visa',
            'category' => 'business-visa',
            'meta_title' => 'Business Innovation Investment Provisional Visa 188 Australia',
            'meta_description' => 'Complete guide to Business Innovation and Investment Provisional Visa 188 application, requirements, and investment opportunities in Australia.',
            'status' => true,
            'featured' => true,
            'order' => 2
        ]);

        // Business Talent Permanent Visa (Subclass 132)
        Page::firstOrCreate([
            'category' => 'business-visa',
            'slug' => 'business-talent-permanent-visa-subclass-132'
        ], [
            'title' => 'Business Talent Permanent Visa (Subclass 132)',
            'slug' => 'business-talent-permanent-visa-subclass-132',
            'content' => '<h2>Business Talent Permanent Visa (Subclass 132)</h2>
            <p>The Business Talent (Permanent) visa (subclass 132) is for high-caliber business people who want to establish a new or develop an existing business in Australia. This visa provides permanent residence from the start.</p>
            
            <h3>Streams Available</h3>
            <ul>
                <li><strong>Significant Business History Stream:</strong> For people with a high net worth and significant business history</li>
                <li><strong>Venture Capital Entrepreneur Stream:</strong> For people who have received at least AUD 1 million in venture capital funding</li>
            </ul>

            <h3>Key Requirements - Significant Business History Stream</h3>
            <ul>
                <li>Have total net business and personal assets of at least AUD 1.5 million</li>
                <li>Have a total annual business turnover of at least AUD 3 million in at least 2 of the 4 fiscal years immediately before you are invited to apply</li>
                <li>Have an ownership interest of at least 10% in a main business or businesses</li>
                <li>Be nominated by a state or territory government</li>
                <li>Be invited to apply for this visa</li>
            </ul>

            <h3>Key Requirements - Venture Capital Entrepreneur Stream</h3>
            <ul>
                <li>Have received at least AUD 1 million in venture capital funding from an Australian venture capital firm</li>
                <li>The funding must be for the early-stage start-up, product commercialisation or business development of a promising high-value business idea</li>
                <li>Be nominated by a state or territory government</li>
                <li>Be invited to apply for this visa</li>
            </ul>

            <h3>Benefits</h3>
            <ul>
                <li>Live and work in Australia permanently</li>
                <li>Study in Australia</li>
                <li>Sponsor eligible relatives for permanent residence</li>
                <li>Travel to and from Australia for 5 years</li>
                <li>Apply for Australian citizenship (subject to residency requirements)</li>
                <li>No provisional stage required - permanent residence from the start</li>
            </ul>',
            'excerpt' => 'Business Talent Permanent Visa 132 - for high-caliber business people to establish or develop business in Australia with permanent residence from the start.',
            'template' => 'pages.business-visa',
            'category' => 'business-visa',
            'meta_title' => 'Business Talent Permanent Visa 132 Australia - High Net Worth Business',
            'meta_description' => 'Complete guide to Business Talent Permanent Visa 132 application, requirements, and pathways for high-caliber business people in Australia.',
            'status' => true,
            'featured' => true,
            'order' => 2
        ]);

        $this->command->info('✅ Created all business visa pages');
        $this->command->info('📊 Business visa pages created: 3');
    }
}
