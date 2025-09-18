<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuccessStory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminSuccessStoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SuccessStory::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('client_name', 'like', "%{$search}%")
                  ->orWhere('visa_type', 'like', "%{$search}%");
            });
        }

        // Filter by visa type
        if ($request->filled('visa_type')) {
            $query->where('visa_type', $request->visa_type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by featured
        if ($request->filled('featured')) {
            $query->where('featured', $request->featured);
        }

        $successStories = $query->ordered()->paginate(20);

        // Get visa types for filter
        $visaTypes = SuccessStory::distinct()->pluck('visa_type')->filter()->sort()->values();

        return view('admin.success-stories.index', compact('successStories', 'visaTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $visaTypes = [
            'Visitor Visa',
            'Student Visa',
            'Skilled Migration',
            'Business Visa',
            'Family Visa',
            'Work Visa',
            'Permanent Residency',
            'Citizenship'
        ];

        return view('admin.success-stories.create', compact('visaTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'client_name' => 'required|string|max:255',
            'client_country' => 'nullable|string|max:100',
            'visa_type' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_alt' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'status' => 'required|boolean',
            'featured' => 'boolean',
            'order' => 'nullable|integer|min:0',
            'success_date' => 'nullable|date'
        ]);

        $data = $request->all();
        
        // Generate slug from title
        $data['slug'] = Str::slug($request->title);
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('success-stories', 'public');
            $data['image'] = $imagePath;
        }

        // Set default values
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['featured'] = $request->has('featured') ? 1 : 0;
        $data['order'] = $request->order ?? 0;
        $data['success_date'] = $request->success_date ?? now();

        SuccessStory::create($data);

        return redirect()->route('admin.success-stories.index')->with('success', 'Success story created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuccessStory $successStory)
    {
        return view('admin.success-stories.show', compact('successStory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuccessStory $successStory)
    {
        $visaTypes = [
            'Visitor Visa',
            'Student Visa',
            'Skilled Migration',
            'Business Visa',
            'Family Visa',
            'Work Visa',
            'Permanent Residency',
            'Citizenship'
        ];

        return view('admin.success-stories.edit', compact('successStory', 'visaTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuccessStory $successStory)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'client_name' => 'required|string|max:255',
            'client_country' => 'nullable|string|max:100',
            'visa_type' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_alt' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'status' => 'required|boolean',
            'featured' => 'boolean',
            'order' => 'nullable|integer|min:0',
            'success_date' => 'nullable|date'
        ]);

        $data = $request->all();
        
        // Generate slug from title if title changed
        if ($request->title !== $successStory->title) {
            $data['slug'] = Str::slug($request->title);
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($successStory->image) {
                \Storage::disk('public')->delete($successStory->image);
            }
            
            $imagePath = $request->file('image')->store('success-stories', 'public');
            $data['image'] = $imagePath;
        }

        // Set boolean values
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['featured'] = $request->has('featured') ? 1 : 0;
        $data['order'] = $request->order ?? 0;

        $successStory->update($data);

        return redirect()->route('admin.success-stories.index')->with('success', 'Success story updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuccessStory $successStory)
    {
        // Delete image if exists
        if ($successStory->image) {
            \Storage::disk('public')->delete($successStory->image);
        }

        $successStory->delete();

        return redirect()->route('admin.success-stories.index')->with('success', 'Success story deleted successfully.');
    }

    /**
     * Update success story status
     */
    public function updateStatus(Request $request, SuccessStory $successStory)
    {
        $request->validate([
            'status' => 'required|boolean'
        ]);

        $successStory->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Success story status updated successfully.');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(SuccessStory $successStory)
    {
        $successStory->update(['featured' => !$successStory->featured]);

        $status = $successStory->featured ? 'featured' : 'unfeatured';
        return redirect()->back()->with('success', "Success story {$status} successfully.");
    }

    /**
     * Reorder success stories
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'stories' => 'required|array',
            'stories.*.id' => 'required|exists:success_stories,id',
            'stories.*.order' => 'required|integer|min:0'
        ]);

        foreach ($request->stories as $storyData) {
            SuccessStory::where('id', $storyData['id'])->update(['order' => $storyData['order']]);
        }

        return response()->json(['success' => true, 'message' => 'Success stories reordered successfully.']);
    }
}