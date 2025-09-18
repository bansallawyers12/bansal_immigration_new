<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Blog;
use App\Models\Service;
use App\Models\SuccessStory;
use App\Models\Contact;

class HomeApiController extends Controller
{
    /**
     * Get home page statistics
     */
    public function getStatistics()
    {
        $statistics = Cache::remember('api_home_statistics', 1800, function () {
            return [
                'successful_cases' => Contact::where('status', 'resolved')->count(),
                'success_rate' => 95,
                'years_experience' => 10,
                'countries_served' => 50,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $statistics
        ]);
    }

    /**
     * Get latest blog posts
     */
    public function getLatestBlogs(Request $request)
    {
        $limit = $request->get('limit', 3);
        
        $blogs = Cache::remember("api_latest_blogs_{$limit}", 3600, function () use ($limit) {
            return Blog::active()
                ->select('id', 'title', 'slug', 'short_description', 'image', 'image_alt', 'created_at')
                ->latest()
                ->take($limit)
                ->get()
                ->map(function ($blog) {
                    return [
                        'id' => $blog->id,
                        'title' => $blog->title,
                        'slug' => $blog->slug,
                        'description' => $blog->short_description,
                        'image' => asset('img/blog/' . $blog->image),
                        'image_alt' => $blog->image_alt,
                        'date' => $blog->created_at->format('M d, Y'),
                        'url' => route('blog.detail', $blog->slug)
                    ];
                });
        });

        return response()->json([
            'success' => true,
            'data' => $blogs
        ]);
    }

    /**
     * Get services list
     */
    public function getServices()
    {
        $services = Cache::remember('api_services', 3600, function () {
            return Service::active()
                ->select('id', 'title', 'slug', 'short_description', 'icon', 'order')
                ->orderBy('order')
                ->get()
                ->map(function ($service) {
                    return [
                        'id' => $service->id,
                        'title' => $service->title,
                        'slug' => $service->slug,
                        'description' => $service->short_description,
                        'icon' => $service->icon,
                        'url' => route('service.detail', $service->slug)
                    ];
                });
        });

        return response()->json([
            'success' => true,
            'data' => $services
        ]);
    }

    /**
     * Get success stories
     */
    public function getSuccessStories(Request $request)
    {
        $limit = $request->get('limit', 3);
        
        $stories = Cache::remember("api_success_stories_{$limit}", 3600, function () use ($limit) {
            return SuccessStory::active()
                ->select('id', 'title', 'slug', 'excerpt', 'image', 'visa_type')
                ->take($limit)
                ->get()
                ->map(function ($story) {
                    return [
                        'id' => $story->id,
                        'title' => $story->title,
                        'slug' => $story->slug,
                        'description' => $story->excerpt,
                        'image' => asset('img/success-stories/' . $story->image),
                        'visa_type' => $story->visa_type,
                        'url' => route('success-story.detail', $story->slug)
                    ];
                });
        });

        return response()->json([
            'success' => true,
            'data' => $stories
        ]);
    }

    /**
     * Get testimonials
     */
    public function getTestimonials()
    {
        $testimonials = Cache::remember('api_testimonials', 3600, function () {
            // This would come from a testimonials table in a real implementation
            return [
                [
                    'name' => 'Sarah Johnson',
                    'rating' => 5,
                    'text' => 'Bansal Immigration made my dream of studying in Australia a reality. Their expertise and support throughout the process was exceptional.',
                    'avatar' => asset('img/avatars/1.jpg'),
                    'visa_type' => 'Student Visa'
                ],
                [
                    'name' => 'Michael Chen',
                    'rating' => 5,
                    'text' => 'Professional, reliable, and knowledgeable. They helped me get my PR visa in record time. Highly recommended!',
                    'avatar' => asset('img/avatars/2.jpg'),
                    'visa_type' => 'Permanent Residency'
                ],
                [
                    'name' => 'Priya Sharma',
                    'rating' => 5,
                    'text' => 'The team\'s attention to detail and personalized approach made all the difference. Thank you for making our family reunion possible.',
                    'avatar' => asset('img/avatars/3.jpg'),
                    'visa_type' => 'Family Visa'
                ],
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $testimonials
        ]);
    }

    /**
     * Search functionality
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([
                'success' => true,
                'data' => []
            ]);
        }

        $results = Cache::remember("api_search_{$query}", 1800, function () use ($query) {
            $blogs = Blog::active()
                ->where('title', 'like', "%{$query}%")
                ->orWhere('short_description', 'like', "%{$query}%")
                ->select('id', 'title', 'slug', 'short_description')
                ->take(5)
                ->get()
                ->map(function ($blog) {
                    return [
                        'type' => 'blog',
                        'title' => $blog->title,
                        'description' => $blog->short_description,
                        'url' => route('blog.detail', $blog->slug)
                    ];
                });

            $services = Service::active()
                ->where('title', 'like', "%{$query}%")
                ->orWhere('short_description', 'like', "%{$query}%")
                ->select('id', 'title', 'slug', 'short_description')
                ->take(5)
                ->get()
                ->map(function ($service) {
                    return [
                        'type' => 'service',
                        'title' => $service->title,
                        'description' => $service->short_description,
                        'url' => route('service.detail', $service->slug)
                    ];
                });

            return $blogs->concat($services)->take(10);
        });

        return response()->json([
            'success' => true,
            'data' => $results
        ]);
    }

    /**
     * Newsletter subscription
     */
    public function subscribeNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'name' => 'nullable|string|max:255'
        ]);

        // Here you would integrate with your email service provider
        // For now, we'll just return success
        
        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing to our newsletter!'
        ]);
    }
}
