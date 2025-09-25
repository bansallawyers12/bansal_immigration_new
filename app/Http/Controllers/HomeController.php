<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\HomeContent;
use App\Models\Blog;
use App\Models\Service;
use App\Models\SuccessStory;
use App\Models\Contact;

class HomeController extends Controller
{
    public function index()
    {
        // Cache key for home page data
        $cacheKey = 'home_page_data';
        
        // Get cached data or fetch fresh data
        $homeData = Cache::remember($cacheKey, 3600, function () {
            return [
                'seoTitle' => HomeContent::where('meta_key', 'meta_title')->first()?->meta_value ?? 'Bansal Immigration - Expert Australian Migration Services',
                'seoDesc' => HomeContent::where('meta_key', 'meta_description')->first()?->meta_value ?? 'Professional Australian immigration consultants helping you achieve permanent residency, study abroad, and family reunification in Australia. MARA registered migration agents.',
                'meetLink' => HomeContent::where('meta_key', 'meet_link')->first()?->meta_value ?? '/contact',
                'blogLists' => Blog::active()->select('id', 'title', 'slug', 'short_description', 'image', 'image_alt', 'created_at')->latest()->take(3)->get(),
                'serviceLists' => Service::active()->select('id', 'title', 'slug', 'short_description', 'icon', 'order')->orderBy('order')->get(),
                'successStories' => SuccessStory::active()->select('id', 'title', 'slug', 'excerpt', 'image', 'visa_type')->take(3)->get(),
                'statistics' => $this->getStatistics(),
                'testimonials' => $this->getTestimonials(),
            ];
        });

        // Add structured data for SEO
        $structuredData = $this->generateStructuredData($homeData);

        return view('index', array_merge($homeData, ['structuredData' => $structuredData]));
    }

    /**
     * Get statistics for the home page
     */
    private function getStatistics()
    {
        return Cache::remember('home_statistics', 1800, function () {
            return [
                'successful_cases' => Contact::where('status', 'resolved')->count(),
                'success_rate' => 95, // This can be calculated based on actual data
                'years_experience' => 10,
                'countries_served' => 50,
            ];
        });
    }

    /**
     * Get testimonials for the home page
     */
    private function getTestimonials()
    {
        return Cache::remember('home_testimonials', 3600, function () {
            // This would come from a testimonials table in a real implementation
            return [
                [
                    'name' => 'Sarah Johnson',
                    'rating' => 5,
                    'text' => 'Bansal Immigration made my dream of studying in Australia a reality. Their expertise and support throughout the process was exceptional.',
                    'avatar' => 'avatars/1.jpg',
                    'visa_type' => 'Student Visa'
                ],
                [
                    'name' => 'Michael Chen',
                    'rating' => 5,
                    'text' => 'Professional, reliable, and knowledgeable. They helped me get my PR visa in record time. Highly recommended!',
                    'avatar' => 'avatars/2.jpg',
                    'visa_type' => 'Permanent Residency'
                ],
                [
                    'name' => 'Priya Sharma',
                    'rating' => 5,
                    'text' => 'The team\'s attention to detail and personalized approach made all the difference. Thank you for making our family reunion possible.',
                    'avatar' => 'avatars/3.jpg',
                    'visa_type' => 'Family Visa'
                ],
            ];
        });
    }

    /**
     * Generate structured data for SEO
     */
    private function generateStructuredData($data)
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'ProfessionalService',
            'name' => 'Bansal Immigration Consultants',
            'description' => $data['seoDesc'],
            'url' => url('/'),
            'telephone' => '+61 3 9602 1330',
            'email' => 'info@bansalimmigration.com.au',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Level 8/278 Collins St',
                'addressLocality' => 'Melbourne',
                'addressRegion' => 'VIC',
                'postalCode' => '3000',
                'addressCountry' => 'AU'
            ],
            'areaServed' => [
                '@type' => 'Country',
                'name' => 'Australia'
            ],
            'serviceType' => 'Immigration Services',
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name' => 'Immigration Services',
                'itemListElement' => [
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => 'Study Visa Applications',
                            'description' => 'Student visa applications for Australian universities'
                        ]
                    ],
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => 'Skilled Migration',
                            'description' => 'Permanent residency through skilled migration programs'
                        ]
                    ],
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => 'Family Visa',
                            'description' => 'Family reunification visa services'
                        ]
                    ]
                ]
            ],
            'aggregateRating' => [
                '@type' => 'AggregateRating',
                'ratingValue' => '4.9',
                'reviewCount' => $data['statistics']['successful_cases']
            ],
            'openingHours' => 'Mo-Fr 09:00-17:00',
            'priceRange' => '$$'
        ];
    }

    /**
     * Clear home page cache
     */
    public function clearCache()
    {
        Cache::forget('home_page_data');
        Cache::forget('home_statistics');
        Cache::forget('home_testimonials');
        
        return response()->json(['success' => true, 'message' => 'Home page cache cleared']);
    }

    // Stub other methods (about, services, etc.) – return view('about'); for now
    public function about() { return view('about'); }
    public function blogs(Request $request) { 
        try {
            // Cache total count separately to avoid expensive COUNT(*) on every request
            $blogTotal = Cache::remember('blog_total_count', 300, function () {
                return Blog::active()->count();
            });

            // Build query with search and filters
            $query = Blog::active()
                ->select('id', 'title', 'slug', 'short_description', 'image', 'image_alt', 'author', 'featured', 'published_at', 'created_at');

            // Search functionality
            if ($request->filled('search')) {
                $search = trim($request->search);
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('short_description', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhere('author', 'like', "%{$search}%");
                });
            }

            // Filter by featured
            if ($request->filled('featured')) {
                $query->where('featured', $request->featured);
            }

            // Order by published date or created date
            $bloglists = $query->orderByDesc(DB::raw('COALESCE(published_at, created_at)'))
                ->simplePaginate(12);

            return view('blogs', compact('bloglists', 'blogTotal')); 
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Blog listing error: ' . $e->getMessage());
            
            // Return empty results on error
            $bloglists = collect()->paginate(12);
            $blogTotal = 0;
            return view('blogs', compact('bloglists', 'blogTotal')); 
        }
    }
    public function blogDetail($slug) { 
        try {
            $blogdetails = Blog::active()->where('slug', $slug)->firstOrFail();
            
            // Increment view count if needed (optional)
            // $blogdetails->increment('views');
            
            return view('blogdetail', compact('blogdetails')); 
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Blog post not found');
        }
    }
    public function appointment() { return view('bookappointment'); }
    public function storeAppointment(Request $request) { /* Handle form */ return response()->json(['success' => true, 'message' => 'Appointment booked!']); }
    public function contact() { return view('contact'); }
    
    // Utility Pages
    public function testimonials() { return view('pages.testimonials'); }
    public function team() { return view('pages.team'); }
    public function whyChoose() { return view('pages.why-choose'); }
    public function missionVision() { return view('pages.mission-vision'); }
    
    // Legal Pages
    public function privacyPolicy() { return view('legal.privacy-policy'); }
    public function termsConditions() { return view('legal.terms-conditions'); }
    public function disclaimer() { return view('legal.disclaimer'); }
    public function cookiePolicy() { return view('legal.cookie-policy'); }
    
    // Success Stories
    public function successStories() { 
        $successStories = SuccessStory::active()->with('category')->ordered()->paginate(12);
        return view('success-stories', compact('successStories')); 
    }
    public function successStoryDetail($slug) { 
        $story = SuccessStory::active()->with('category')->where('slug', $slug)->firstOrFail();
        $relatedStories = SuccessStory::active()->with('category')->where('visa_type', $story->visa_type)->where('id', '!=', $story->id)->take(3)->get();
        return view('success-story-detail', compact('story', 'relatedStories')); 
    }
}