<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Blog::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by featured
        if ($request->filled('featured')) {
            $query->where('featured', $request->featured);
        }

        $blogs = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::active()->parent()->with('subcategories')->orderBy('sort_order')->get();
        return view('admin.blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug',
            'parent_category' => 'nullable|exists:blog_categories,id',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_alt' => 'nullable|string|max:255',
            'pdf_doc' => 'nullable|file|mimes:pdf,mp4,avi,mov,wmv|max:10240',
            'youtube_url' => 'nullable|url',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'author' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'featured' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        $data = $request->all();
        
        // Generate slug from title if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($request->title);
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
            $data['image'] = $imagePath;
        }

        // Handle PDF/Video upload
        if ($request->hasFile('pdf_doc')) {
            $pdfPath = $request->file('pdf_doc')->store('blogs', 'public');
            $data['pdf_doc'] = $pdfPath;
        }

        // Set default values
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['featured'] = $request->has('featured') ? 1 : 0;
        $data['published_at'] = $request->published_at ?? now();

        Blog::create($data);

        return redirect()->route('admin.blog.index')->with('success', 'Blog post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('admin.blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $categories = BlogCategory::active()->parent()->with('subcategories')->orderBy('sort_order')->get();
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug,' . $blog->id,
            'parent_category' => 'nullable|exists:blog_categories,id',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_alt' => 'nullable|string|max:255',
            'pdf_doc' => 'nullable|file|mimes:pdf,mp4,avi,mov,wmv|max:10240',
            'youtube_url' => 'nullable|url',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'author' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'featured' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        $data = $request->all();
        
        // Generate slug from title if title changed and slug is empty
        if ($request->title !== $blog->title && empty($data['slug'])) {
            $data['slug'] = Str::slug($request->title);
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($blog->image) {
                \Storage::disk('public')->delete($blog->image);
            }
            
            $imagePath = $request->file('image')->store('blogs', 'public');
            $data['image'] = $imagePath;
        }

        // Handle PDF/Video upload
        if ($request->hasFile('pdf_doc')) {
            // Delete old PDF/Video
            if ($blog->pdf_doc) {
                \Storage::disk('public')->delete($blog->pdf_doc);
            }
            
            $pdfPath = $request->file('pdf_doc')->store('blogs', 'public');
            $data['pdf_doc'] = $pdfPath;
        }

        // Set boolean values
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['featured'] = $request->has('featured') ? 1 : 0;

        $blog->update($data);

        return redirect()->route('admin.blog.index')->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        // Delete image if exists
        if ($blog->image) {
            \Storage::disk('public')->delete($blog->image);
        }

        // Delete PDF/Video if exists
        if ($blog->pdf_doc) {
            \Storage::disk('public')->delete($blog->pdf_doc);
        }

        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Blog post deleted successfully.');
    }

    /**
     * Update blog status
     */
    public function updateStatus(Request $request, Blog $blog)
    {
        $request->validate([
            'status' => 'required|boolean'
        ]);

        $blog->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Blog post status updated successfully.');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Blog $blog)
    {
        $blog->update(['featured' => !$blog->featured]);

        $status = $blog->featured ? 'featured' : 'unfeatured';
        return redirect()->back()->with('success', "Blog post {$status} successfully.");
    }
}