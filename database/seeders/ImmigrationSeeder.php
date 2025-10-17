<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeContent;
use App\Models\Slider;
use App\Models\Blog;
use App\Models\Service;
use App\Models\Page;
use Carbon\Carbon;

class ImmigrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Home Content
        $homeContent = [
            ['meta_key' => 'meta_title', 'meta_value' => 'Bansal Immigration Consultants - Your Future, Our Priority'],
            ['meta_key' => 'meta_description', 'meta_value' => 'Expert Australian immigration consultants providing visa services, migration advice, and pathway guidance for students, skilled workers, and families.'],
            ['meta_key' => 'sliderstatus', 'meta_value' => '1'],
            ['meta_key' => 'meet_link', 'meta_value' => '/contact'],
        ];

        foreach ($homeContent as $content) {
            HomeContent::updateOrCreate(
                ['meta_key' => $content['meta_key']],
                ['meta_value' => $content['meta_value']]
            );
        }

        // Sample Pages - Study in Australia
        Page::firstOrCreate(['slug' => 'study-australia'], [
            'title' => 'Study in Australia',
            'slug' => 'study-australia',
            'content' => '<h2>Why Study in Australia?</h2><p>Australia offers world-class education with globally recognized qualifications.</p>',
            'excerpt' => 'Discover world-class education opportunities in Australia with pathways to permanent residency.',
            'template' => 'pages.study-australia',
            'category' => 'study-australia',
            'meta_title' => 'Study in Australia - Education and Student Visa Services',
            'meta_description' => 'Explore study opportunities in Australia with expert guidance on admissions, student visas, and pathways to permanent residency.',
            'status' => true,
            'featured' => true,
            'order' => 1
        ]);

        Page::firstOrCreate(['slug' => 'migration'], [
            'title' => 'Australian Migration Services',
            'slug' => 'migration',
            'content' => '<h2>Your Pathway to Australian Permanent Residency</h2><p>Australia offers various migration pathways for skilled workers, graduates, and professionals seeking permanent residency.</p>',
            'excerpt' => 'Expert migration services to help you achieve Australian permanent residency through skilled migration pathways.',
            'template' => 'pages.migration',
            'category' => 'migration',
            'meta_title' => 'Australian Migration Services - Permanent Residency Pathways',
            'meta_description' => 'Expert Australian migration services for skilled workers seeking permanent residency through various visa pathways.',
            'status' => true,
            'featured' => true,
            'order' => 1
        ]);

        Page::firstOrCreate(['slug' => 'family-visa'], [
            'title' => 'Family Visa Services',
            'slug' => 'family-visa',
            'content' => '<h2>Reunite with Your Loved Ones in Australia</h2><p>Australia\'s family migration program allows Australian citizens and permanent residents to sponsor eligible family members for permanent residence.</p>',
            'excerpt' => 'Comprehensive family visa services to help you reunite with your loved ones in Australia.',
            'template' => 'pages.family-visa',
            'category' => 'family-visa',
            'meta_title' => 'Family Visa Services Australia - Partner, Parent, Child Visas',
            'meta_description' => 'Expert family visa services for partner visas, parent visas, child visas and other family migration options in Australia.',
            'status' => true,
            'featured' => true,
            'order' => 1
        ]);

        // Sample Sliders
        $sliders = [
            [
                'title' => 'Your Australian Dream Starts Here',
                'subtitle' => 'Expert Immigration Consultants with 10+ Years Experience',
                'image' => 'slider1.jpg',
                'image_alt' => 'Australian Immigration Consultants',
                'link' => '/contact',
                'order' => 1,
                'status' => true
            ],
            [
                'title' => 'Study in Australia',
                'subtitle' => 'World-Class Education with Pathway to Permanent Residency',
                'image' => 'slider2.jpg',
                'image_alt' => 'Study in Australia',
                'link' => '/study-australia',
                'order' => 2,
                'status' => true
            ],
            [
                'title' => 'Skilled Migration Services',
                'subtitle' => 'Navigate Your Path to Australian Permanent Residency',
                'image' => 'slider3.jpg',
                'image_alt' => 'Australian Skilled Migration',
                'link' => '/migration',
                'order' => 3,
                'status' => true
            ]
        ];

        foreach ($sliders as $slider) {
            Slider::firstOrCreate(['title' => $slider['title']], $slider);
        }

        // Sample Services
        $services = [
            [
                'title' => 'Student Visa Services',
                'slug' => 'student-visa-services',
                'short_description' => 'Complete student visa application support for studying in Australia',
                'description' => '<p>Our comprehensive student visa services include course selection, university applications, visa documentation, and ongoing support throughout your studies.</p>',
                'image' => 'service-student.jpg',
                'image_alt' => 'Student Visa Services',
                'icon' => 'fas fa-graduation-cap',
                'category' => 'education',
                'meta_title' => 'Student Visa Services Australia - Complete Application Support',
                'meta_description' => 'Expert student visa services for Australia including course selection, applications, and ongoing support.',
                'status' => true,
                'featured' => true,
                'order' => 1
            ],
            [
                'title' => 'Skilled Migration',
                'slug' => 'skilled-migration',
                'short_description' => 'Permanent residency through skilled migration pathways',
                'description' => '<p>Navigate the complex skilled migration process with our expert guidance. We help with skills assessments, EOI submissions, and visa applications.</p>',
                'image' => 'service-skilled.jpg',
                'image_alt' => 'Skilled Migration Services',
                'icon' => 'fas fa-briefcase',
                'category' => 'migration',
                'meta_title' => 'Skilled Migration Australia - Permanent Residency Services',
                'meta_description' => 'Expert skilled migration services for Australian permanent residency through various skilled visa pathways.',
                'status' => true,
                'featured' => true,
                'order' => 2
            ],
            [
                'title' => 'Partner Visa Applications',
                'slug' => 'partner-visa-applications',
                'short_description' => 'Reunite with your partner in Australia through family migration',
                'description' => '<p>Complete support for partner visa applications including documentation preparation, relationship evidence compilation, and application lodgement.</p>',
                'image' => 'service-partner.jpg',
                'image_alt' => 'Partner Visa Services',
                'icon' => 'fas fa-heart',
                'category' => 'family',
                'meta_title' => 'Partner Visa Australia - Family Migration Services',
                'meta_description' => 'Expert partner visa services to help you reunite with your loved one in Australia.',
                'status' => true,
                'featured' => true,
                'order' => 3
            ]
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(['slug' => $service['slug']], $service);
        }

        // Sample Blogs
        $blogs = [
            [
                'title' => 'Australian Student Visa Requirements 2025',
                'slug' => 'australian-student-visa-requirements-2025',
                'short_description' => 'Complete guide to Australian student visa requirements and application process for international students.',
                'description' => '<h2>Student Visa Requirements</h2><p>Planning to study in Australia? Here\'s everything you need to know about student visa requirements, documentation, and the application process.</p><h3>Key Requirements</h3><ul><li>Genuine Temporary Entrant (GTE) requirement</li><li>English language proficiency</li><li>Financial capacity</li><li>Health and character requirements</li></ul>',
                'image' => 'blog-student-visa.jpg',
                'image_alt' => 'Australian Student Visa Requirements',
                'meta_title' => 'Australian Student Visa Requirements 2025 - Complete Guide',
                'meta_description' => 'Complete guide to Australian student visa requirements, documentation, and application process for international students in 2025.',
                'status' => true,
                'featured' => true,
                'author' => 'Arun Bansal',
                'published_at' => Carbon::now()->subDays(7)
            ],
            [
                'title' => 'Skilled Migration Points Calculator Guide',
                'slug' => 'skilled-migration-points-calculator-guide',
                'short_description' => 'Learn how to calculate your points for Australian skilled migration and improve your chances.',
                'description' => '<h2>Understanding the Points System</h2><p>The Australian skilled migration points system is crucial for determining your eligibility for permanent residency.</p><h3>Point Categories</h3><ul><li>Age (up to 30 points)</li><li>English proficiency (up to 20 points)</li><li>Skilled employment (up to 20 points)</li><li>Educational qualifications (up to 20 points)</li></ul>',
                'image' => 'blog-points-calculator.jpg',
                'image_alt' => 'Skilled Migration Points Calculator',
                'meta_title' => 'Skilled Migration Points Calculator Guide - Australian PR',
                'meta_description' => 'Complete guide to calculating your points for Australian skilled migration and improving your chances of permanent residency.',
                'status' => true,
                'featured' => false,
                'author' => 'Vipul Goyal',
                'published_at' => Carbon::now()->subDays(14)
            ],
            [
                'title' => 'Partner Visa Application Timeline and Process',
                'slug' => 'partner-visa-application-timeline-process',
                'short_description' => 'Understanding the partner visa application process and expected timelines for Australian family migration.',
                'description' => '<h2>Partner Visa Process</h2><p>The Australian partner visa allows the spouse or de facto partner of an Australian citizen or permanent resident to live in Australia.</p><h3>Application Stages</h3><ul><li>Temporary partner visa (subclass 820/309)</li><li>Permanent partner visa (subclass 801/100)</li></ul>',
                'image' => 'blog-partner-visa.jpg',
                'image_alt' => 'Partner Visa Application Process',
                'meta_title' => 'Partner Visa Application Timeline and Process - Australia',
                'meta_description' => 'Complete guide to partner visa application process, timeline, and requirements for Australian family migration.',
                'status' => true,
                'featured' => false,
                'author' => 'Maleesha Thawalampola',
                'published_at' => Carbon::now()->subDays(21)
            ]
        ];

        foreach ($blogs as $blog) {
            Blog::firstOrCreate(['slug' => $blog['slug']], $blog);
        }
    }
}
