<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Constants\CategoryConstants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisaManagementController extends Controller
{
    /**
     * Display a listing of all visa pages with their costs and processing times
     */
    public function index()
    {
        $visaPages = Page::whereNotNull('category')
            ->whereIn('category', CategoryConstants::getCategoryKeys())
            ->where('status', true)
            ->orderBy('category')
            ->orderBy('title')
            ->get()
            ->groupBy('category');

        $categories = CategoryConstants::getCategoriesWithMetadata();
        
        return view('admin.visa-management.index', compact('visaPages', 'categories'));
    }

    /**
     * Show the form for editing visa costs and processing times
     */
    public function edit($id)
    {
        $page = Page::findOrFail($id);
        
        // Ensure this is a visa page
        if (!in_array($page->category, CategoryConstants::getCategoryKeys())) {
            return redirect()->route('admin.visa-management.index')
                ->with('error', 'This page is not a visa page.');
        }

        return view('admin.visa-management.edit', compact('page'));
    }

    /**
     * Update visa costs and processing times
     */
    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'visa_costs' => 'nullable|array',
            'visa_costs.*.label' => 'required_with:visa_costs|string|max:255',
            'visa_costs.*.amount' => 'required_with:visa_costs|string|max:255',
            'visa_costs.*.notes' => 'nullable|string|max:500',
            'visa_processing_times' => 'nullable|array',
            'visa_processing_times.standard' => 'nullable|string|max:255',
            'visa_processing_times.priority' => 'nullable|string|max:255',
            'visa_processing_times.complex' => 'nullable|string|max:255',
            'visa_duration' => 'nullable|array',
            'visa_duration.initial' => 'nullable|string|max:255',
            'visa_duration.extension' => 'nullable|string|max:255',
            'visa_duration.permanent' => 'nullable|string|max:255',
            'visa_duration.notes' => 'nullable|string|max:500',
            'visa_pathways' => 'nullable|array',
            'visa_pathways.*.title' => 'required_with:visa_pathways|string|max:255',
            'visa_pathways.*.description' => 'required_with:visa_pathways|string|max:1000',
            'visa_pathways.*.requirements' => 'nullable|string|max:1000',
            'visa_pathways.*.steps' => 'nullable|array',
            'visa_pathways.*.steps.*' => 'string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [];
        
        // Handle visa costs
        if ($request->has('visa_costs')) {
            $costs = [];
            foreach ($request->input('visa_costs', []) as $cost) {
                if (!empty($cost['label'])) {
                    $costs[] = [
                        'label' => trim($cost['label']),
                        'amount' => trim($cost['amount'] ?? 'N/A'),
                        'notes' => trim($cost['notes'] ?? '')
                    ];
                }
            }
            $data['visa_costs'] = !empty($costs) ? $costs : null;
        }

        // Handle processing times
        if ($request->has('visa_processing_times')) {
            $processingTimes = [];
            $times = $request->input('visa_processing_times', []);
            
            if (!empty($times['standard'])) {
                $processingTimes['standard'] = trim($times['standard']);
            }
            if (!empty($times['priority'])) {
                $processingTimes['priority'] = trim($times['priority']);
            }
            if (!empty($times['complex'])) {
                $processingTimes['complex'] = trim($times['complex']);
            }
            
            $data['visa_processing_times'] = !empty($processingTimes) ? $processingTimes : null;
        }

        // Handle visa duration
        if ($request->has('visa_duration')) {
            $duration = [];
            $durationData = $request->input('visa_duration', []);
            
            if (!empty($durationData['initial'])) {
                $duration['initial'] = trim($durationData['initial']);
            }
            if (!empty($durationData['extension'])) {
                $duration['extension'] = trim($durationData['extension']);
            }
            if (!empty($durationData['permanent'])) {
                $duration['permanent'] = trim($durationData['permanent']);
            }
            if (!empty($durationData['notes'])) {
                $duration['notes'] = trim($durationData['notes']);
            }
            
            $data['visa_duration'] = !empty($duration) ? $duration : null;
        }

        // Handle visa pathways
        if ($request->has('visa_pathways')) {
            $pathways = [];
            foreach ($request->input('visa_pathways', []) as $pathway) {
                if (!empty($pathway['title'])) {
                    $pathwayData = [
                        'title' => trim($pathway['title']),
                        'description' => trim($pathway['description'] ?? ''),
                        'requirements' => trim($pathway['requirements'] ?? ''),
                        'steps' => []
                    ];
                    
                    // Handle steps array
                    if (!empty($pathway['steps']) && is_array($pathway['steps'])) {
                        foreach ($pathway['steps'] as $step) {
                            if (!empty(trim($step))) {
                                $pathwayData['steps'][] = trim($step);
                            }
                        }
                    }
                    
                    $pathways[] = $pathwayData;
                }
            }
            $data['visa_pathways'] = !empty($pathways) ? $pathways : null;
        }

        $page->update($data);

        return redirect()->route('admin.visa-management.index')
            ->with('success', 'Visa information updated successfully.');
    }

    /**
     * Bulk update visa costs and processing times for multiple pages
     */
    public function bulkUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page_ids' => 'required|array',
            'page_ids.*' => 'exists:pages,id',
            'visa_costs' => 'nullable|array',
            'visa_costs.*.label' => 'required_with:visa_costs|string|max:255',
            'visa_costs.*.amount' => 'required_with:visa_costs|string|max:255',
            'visa_costs.*.notes' => 'nullable|string|max:500',
            'visa_processing_times' => 'nullable|array',
            'visa_processing_times.standard' => 'nullable|string|max:255',
            'visa_processing_times.priority' => 'nullable|string|max:255',
            'visa_processing_times.complex' => 'nullable|string|max:255',
            'visa_duration' => 'nullable|array',
            'visa_duration.initial' => 'nullable|string|max:255',
            'visa_duration.extension' => 'nullable|string|max:255',
            'visa_duration.permanent' => 'nullable|string|max:255',
            'visa_duration.notes' => 'nullable|string|max:500',
            'visa_pathways' => 'nullable|array',
            'visa_pathways.*.title' => 'required_with:visa_pathways|string|max:255',
            'visa_pathways.*.description' => 'required_with:visa_pathways|string|max:1000',
            'visa_pathways.*.requirements' => 'nullable|string|max:1000',
            'visa_pathways.*.steps' => 'nullable|array',
            'visa_pathways.*.steps.*' => 'string|max:500',
            'update_type' => 'required|in:costs,processing_times,duration,pathways,all'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $pages = Page::whereIn('id', $request->input('page_ids'))->get();
        $updatedCount = 0;

        foreach ($pages as $page) {
            $data = [];
            
            // Update costs if requested
            if (in_array($request->input('update_type'), ['costs', 'all'])) {
                if ($request->has('visa_costs')) {
                    $costs = [];
                    foreach ($request->input('visa_costs', []) as $cost) {
                        if (!empty($cost['label'])) {
                            $costs[] = [
                                'label' => trim($cost['label']),
                                'amount' => trim($cost['amount'] ?? 'N/A'),
                                'notes' => trim($cost['notes'] ?? '')
                            ];
                        }
                    }
                    $data['visa_costs'] = !empty($costs) ? $costs : null;
                }
            }

            // Update processing times if requested
            if (in_array($request->input('update_type'), ['processing_times', 'all'])) {
                if ($request->has('visa_processing_times')) {
                    $processingTimes = [];
                    $times = $request->input('visa_processing_times', []);
                    
                    if (!empty($times['standard'])) {
                        $processingTimes['standard'] = trim($times['standard']);
                    }
                    if (!empty($times['priority'])) {
                        $processingTimes['priority'] = trim($times['priority']);
                    }
                    if (!empty($times['complex'])) {
                        $processingTimes['complex'] = trim($times['complex']);
                    }
                    
                    $data['visa_processing_times'] = !empty($processingTimes) ? $processingTimes : null;
                }
            }

            // Update duration if requested
            if (in_array($request->input('update_type'), ['duration', 'all'])) {
                if ($request->has('visa_duration')) {
                    $duration = [];
                    $durationData = $request->input('visa_duration', []);
                    
                    if (!empty($durationData['initial'])) {
                        $duration['initial'] = trim($durationData['initial']);
                    }
                    if (!empty($durationData['extension'])) {
                        $duration['extension'] = trim($durationData['extension']);
                    }
                    if (!empty($durationData['permanent'])) {
                        $duration['permanent'] = trim($durationData['permanent']);
                    }
                    if (!empty($durationData['notes'])) {
                        $duration['notes'] = trim($durationData['notes']);
                    }
                    
                    $data['visa_duration'] = !empty($duration) ? $duration : null;
                }
            }

            // Update pathways if requested
            if (in_array($request->input('update_type'), ['pathways', 'all'])) {
                if ($request->has('visa_pathways')) {
                    $pathways = [];
                    foreach ($request->input('visa_pathways', []) as $pathway) {
                        if (!empty($pathway['title'])) {
                            $pathwayData = [
                                'title' => trim($pathway['title']),
                                'description' => trim($pathway['description'] ?? ''),
                                'requirements' => trim($pathway['requirements'] ?? ''),
                                'steps' => []
                            ];
                            
                            // Handle steps array
                            if (!empty($pathway['steps']) && is_array($pathway['steps'])) {
                                foreach ($pathway['steps'] as $step) {
                                    if (!empty(trim($step))) {
                                        $pathwayData['steps'][] = trim($step);
                                    }
                                }
                            }
                            
                            $pathways[] = $pathwayData;
                        }
                    }
                    $data['visa_pathways'] = !empty($pathways) ? $pathways : null;
                }
            }

            if (!empty($data)) {
                $page->update($data);
                $updatedCount++;
            }
        }

        return redirect()->route('admin.visa-management.index')
            ->with('success', "Successfully updated {$updatedCount} visa pages.");
    }

    /**
     * Get visa pages by category for AJAX requests
     */
    public function getByCategory(Request $request)
    {
        $category = $request->input('category');
        
        if (!$category || !CategoryConstants::categoryExists($category)) {
            return response()->json(['error' => 'Invalid category'], 400);
        }

        $pages = Page::where('category', $category)
            ->where('status', true)
            ->orderBy('title')
            ->select('id', 'title', 'visa_costs', 'visa_processing_times', 'visa_duration', 'visa_pathways')
            ->get();

        return response()->json($pages);
    }
}
