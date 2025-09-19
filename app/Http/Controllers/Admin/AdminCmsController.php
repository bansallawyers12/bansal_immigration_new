<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Constants\CategoryConstants;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Page::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pages = $query->with('parent')->orderBy('order')->orderBy('created_at', 'desc')->paginate(20);

        // Get categories for filter - use constants for consistency
        $categories = CategoryConstants::getCategoriesForDropdown();

        return view('admin.cms.index', compact('pages', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentPages = Page::whereNull('parent_id')->where('status', true)->orderBy('title')->get();
        $categories = CategoryConstants::getCategoriesForDropdown();
        
        return view('admin.cms.create', compact('parentPages', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug',
            'route_name' => 'nullable|string|max:255|unique:pages,route_name',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100|in:' . implode(',', CategoryConstants::getCategoryKeys()),
            'subcategory' => 'nullable|string|max:100',
            'template' => 'nullable|string|max:100',
            'parent_id' => 'nullable|exists:pages,id',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'status' => 'required|boolean',
            'featured' => 'boolean',
            'order' => 'nullable|integer|min:0'
        ], [
            'title.required' => 'The page title is required.',
            'title.max' => 'The page title cannot exceed 255 characters.',
            'slug.unique' => 'This URL slug is already in use. Please choose a different one.',
            'slug.max' => 'The URL slug cannot exceed 255 characters.',
            'content.required' => 'The page content is required.',
            'category.in' => 'Please select a valid category from the dropdown.',
            'subcategory.max' => 'The subcategory cannot exceed 100 characters.',
            'template.max' => 'The template name cannot exceed 100 characters.',
            'parent_id.exists' => 'The selected parent page does not exist.',
            'excerpt.max' => 'The short description cannot exceed 500 characters.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image size cannot exceed 2MB.',
            'meta_title.max' => 'The SEO title cannot exceed 255 characters.',
            'meta_description.max' => 'The SEO description cannot exceed 500 characters.',
            'meta_keywords.max' => 'The SEO keywords cannot exceed 500 characters.',
            'status.required' => 'Please specify whether the page should be published.',
            'order.integer' => 'The display order must be a number.',
            'order.min' => 'The display order cannot be negative.'
        ]);

        $data = $request->all();
        
        // Generate slug from title if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($request->title);
        }
        
        // Generate route_name if not provided
        if (empty($data['route_name'])) {
            $page = new Page($data);
            $data['route_name'] = $page->generateRouteName();
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pages', 'public');
            $data['image'] = $imagePath;
        }

        // Set default values
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['featured'] = $request->has('featured') ? 1 : 0;
        $data['order'] = $request->order ?? 0;

        Page::create($data);

        return redirect()->route('admin.cms.index')->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        $page->load('parent', 'children');
        return view('admin.cms.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        $parentPages = Page::whereNull('parent_id')
            ->where('status', true)
            ->where('id', '!=', $page->id)
            ->orderBy('title')
            ->get();
        
        $categories = CategoryConstants::getCategoriesForDropdown();
        
        return view('admin.cms.edit', compact('page', 'parentPages', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug,' . $page->id,
            'route_name' => 'nullable|string|max:255|unique:pages,route_name,' . $page->id,
            'content' => 'required|string',
            'category' => 'nullable|string|max:100|in:' . implode(',', CategoryConstants::getCategoryKeys()),
            'subcategory' => 'nullable|string|max:100',
            'template' => 'nullable|string|max:100',
            'parent_id' => 'nullable|exists:pages,id',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'status' => 'required|boolean',
            'featured' => 'boolean',
            'order' => 'nullable|integer|min:0'
        ], [
            'title.required' => 'The page title is required.',
            'title.max' => 'The page title cannot exceed 255 characters.',
            'slug.unique' => 'This URL slug is already in use. Please choose a different one.',
            'slug.max' => 'The URL slug cannot exceed 255 characters.',
            'content.required' => 'The page content is required.',
            'category.in' => 'Please select a valid category from the dropdown.',
            'subcategory.max' => 'The subcategory cannot exceed 100 characters.',
            'template.max' => 'The template name cannot exceed 100 characters.',
            'parent_id.exists' => 'The selected parent page does not exist.',
            'excerpt.max' => 'The short description cannot exceed 500 characters.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image size cannot exceed 2MB.',
            'meta_title.max' => 'The SEO title cannot exceed 255 characters.',
            'meta_description.max' => 'The SEO description cannot exceed 500 characters.',
            'meta_keywords.max' => 'The SEO keywords cannot exceed 500 characters.',
            'status.required' => 'Please specify whether the page should be published.',
            'order.integer' => 'The display order must be a number.',
            'order.min' => 'The display order cannot be negative.'
        ]);

        $data = $request->all();
        
        // Generate slug from title if slug is empty or title changed
        if (empty($data['slug']) || $request->title !== $page->title) {
            $data['slug'] = Str::slug($request->title);
        }
        
        // Generate route_name if not provided or if category/slug changed
        if (empty($data['route_name']) || 
            $request->category !== $page->category || 
            $request->slug !== $page->slug) {
            $tempPage = new Page($data);
            $data['route_name'] = $tempPage->generateRouteName();
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($page->image) {
                \Storage::disk('public')->delete($page->image);
            }
            
            $imagePath = $request->file('image')->store('pages', 'public');
            $data['image'] = $imagePath;
        }

        // Set boolean values
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['featured'] = $request->has('featured') ? 1 : 0;
        $data['order'] = $request->order ?? 0;

        $page->update($data);

        return redirect()->route('admin.cms.index')->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        // Check if page has children
        if ($page->children()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete page with child pages. Please move or delete child pages first.');
        }

        // Delete image if exists
        if ($page->image) {
            \Storage::disk('public')->delete($page->image);
        }

        $page->delete();

        return redirect()->route('admin.cms.index')->with('success', 'Page deleted successfully.');
    }

    /**
     * Update page status
     */
    public function updateStatus(Request $request, Page $page)
    {
        $request->validate([
            'status' => 'required|boolean'
        ]);

        $page->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Page status updated successfully.');
    }

    /**
     * Reorder pages
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'pages' => 'required|array',
            'pages.*.id' => 'required|exists:pages,id',
            'pages.*.order' => 'required|integer|min:0'
        ]);

        foreach ($request->pages as $pageData) {
            Page::where('id', $pageData['id'])->update(['order' => $pageData['order']]);
        }

        return response()->json(['success' => true, 'message' => 'Pages reordered successfully.']);
    }

}