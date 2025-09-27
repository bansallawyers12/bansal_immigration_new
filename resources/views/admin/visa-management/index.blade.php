@extends('layouts.admin')

@section('title', 'Visa Costs & Processing Times Management')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Visa Costs & Processing Times</h1>
            <p class="text-gray-600 mt-2">Manage costs and processing times for all visa types</p>
        </div>
        <div class="flex space-x-4">
            <button onclick="showBulkUpdateModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-edit mr-2"></i>
                Bulk Update
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    <!-- Category Filter -->
    <div class="mb-6">
        <label for="category-filter" class="block text-sm font-medium text-gray-700 mb-2">Filter by Category:</label>
        <select id="category-filter" class="w-full md:w-64 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option value="">All Categories</option>
            @foreach($categories as $key => $category)
                <option value="{{ $key }}">{{ $category['name'] }}</option>
            @endforeach
        </select>
    </div>

    <!-- Visa Pages List -->
    <div class="space-y-6">
        @foreach($visaPages as $categoryKey => $pages)
            <div class="category-section" data-category="{{ $categoryKey }}">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="{{ $categories[$categoryKey]['icon'] ?? 'fas fa-folder' }} mr-3 text-{{ $categories[$categoryKey]['color'] ?? 'gray' }}-600"></i>
                                {{ $categories[$categoryKey]['name'] ?? ucfirst(str_replace('-', ' ', $categoryKey)) }}
                            </h2>
                            <span class="text-sm text-gray-500">{{ $pages->count() }} visa(s)</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">{{ $categories[$categoryKey]['description'] ?? '' }}</p>
                    </div>
                    
                    <div class="divide-y divide-gray-200">
                        @foreach($pages as $page)
                            <div class="px-6 py-4 hover:bg-gray-50">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-medium text-gray-900">{{ $page->title }}</h3>
                                        <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <!-- Costs Section -->
                                            <div class="bg-blue-50 p-3 rounded-lg">
                                                <h4 class="text-sm font-medium text-blue-900 mb-2">Costs</h4>
                                                @php
                                                    $hasValidCosts = false;
                                                    if ($page->visa_costs && is_array($page->visa_costs)) {
                                                        foreach ($page->visa_costs as $cost) {
                                                            if (is_array($cost) && !empty($cost['label'])) {
                                                                $hasValidCosts = true;
                                                                break;
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                
                                                @if($hasValidCosts)
                                                    <div class="space-y-1">
                                                        @foreach($page->visa_costs as $cost)
                                                            @if(is_array($cost) && !empty($cost['label']))
                                                                <div class="text-sm">
                                                                    <span class="font-medium">{{ $cost['label'] }}:</span>
                                                                    <span class="text-blue-700">{{ $cost['amount'] ?? 'N/A' }}</span>
                                                                    @if(!empty($cost['notes']))
                                                                        <span class="text-blue-600">({{ $cost['notes'] }})</span>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <p class="text-sm text-blue-600 italic">No costs defined</p>
                                                @endif
                                            </div>
                                            
                                            <!-- Processing Times Section -->
                                            <div class="bg-green-50 p-3 rounded-lg">
                                                <h4 class="text-sm font-medium text-green-900 mb-2">Processing Times</h4>
                                                @if($page->visa_processing_times)
                                                    <div class="space-y-1">
                                                        @if(!empty($page->visa_processing_times['standard']))
                                                            <div class="text-sm">
                                                                <span class="font-medium">Standard:</span>
                                                                <span class="text-green-700">{{ $page->visa_processing_times['standard'] }}</span>
                                                            </div>
                                                        @endif
                                                        @if(!empty($page->visa_processing_times['priority']))
                                                            <div class="text-sm">
                                                                <span class="font-medium">Priority:</span>
                                                                <span class="text-green-700">{{ $page->visa_processing_times['priority'] }}</span>
                                                            </div>
                                                        @endif
                                                        @if(!empty($page->visa_processing_times['complex']))
                                                            <div class="text-sm">
                                                                <span class="font-medium">Complex:</span>
                                                                <span class="text-green-700">{{ $page->visa_processing_times['complex'] }}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @else
                                                    <p class="text-sm text-green-600 italic">No processing times defined</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="ml-6 flex space-x-2">
                                        <a href="{{ route('admin.visa-management.edit', $page->id) }}" 
                                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-sm flex items-center">
                                            <i class="fas fa-edit mr-1"></i>
                                            Edit
                                        </a>
                                        <a href="{{ route('pages.dynamic', ['category' => $page->category, 'slug' => $page->slug]) }}" 
                                           target="_blank"
                                           class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded text-sm flex items-center">
                                            <i class="fas fa-external-link-alt mr-1"></i>
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($visaPages->isEmpty())
        <div class="text-center py-12">
            <i class="fas fa-file-alt text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-medium text-gray-900 mb-2">No Visa Pages Found</h3>
            <p class="text-gray-600">There are currently no visa pages to manage.</p>
        </div>
    @endif
</div>

<!-- Bulk Update Modal -->
<div id="bulk-update-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <form action="{{ route('admin.visa-management.bulk-update') }}" method="POST">
                @csrf
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Bulk Update Visa Information</h3>
                    <p class="text-sm text-gray-600 mt-1">Update costs and processing times for multiple visa pages</p>
                </div>
                
                <div class="p-6 space-y-6">
                    <!-- Page Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Pages to Update:</label>
                        <div class="max-h-48 overflow-y-auto border border-gray-300 rounded-lg p-3">
                            @foreach($visaPages as $categoryKey => $pages)
                                <div class="mb-3">
                                    <h4 class="font-medium text-gray-900 mb-2">{{ $categories[$categoryKey]['name'] ?? ucfirst(str_replace('-', ' ', $categoryKey)) }}</h4>
                                    <div class="space-y-1 ml-4">
                                        @foreach($pages as $page)
                                            <label class="flex items-center">
                                                <input type="checkbox" name="page_ids[]" value="{{ $page->id }}" class="page-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                                <span class="ml-2 text-sm text-gray-700">{{ $page->title }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Update Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Update Type:</label>
                        <select name="update_type" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Select update type</option>
                            <option value="costs">Costs Only</option>
                            <option value="processing_times">Processing Times Only</option>
                            <option value="duration">Duration Only</option>
                            <option value="pathways">Pathways Only</option>
                            <option value="all">All Sections</option>
                        </select>
                    </div>

                    <!-- Costs Section -->
                    <div id="costs-section" class="hidden">
                        <h4 class="text-lg font-medium text-gray-900 mb-3">Visa Costs</h4>
                        <div id="costs-container">
                            <div class="cost-item border border-gray-200 rounded-lg p-4 mb-3">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Label</label>
                                        <input type="text" name="visa_costs[0][label]" placeholder="e.g., Application Fee" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                                        <input type="text" name="visa_costs[0][amount]" placeholder="e.g., $4,045, N/A" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Notes (Optional)</label>
                                        <input type="text" name="visa_costs[0][notes]" placeholder="Additional info" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" onclick="addCostField()" class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                            <i class="fas fa-plus mr-1"></i>
                            Add Another Cost
                        </button>
                    </div>

                    <!-- Processing Times Section -->
                    <div id="processing-times-section" class="hidden">
                        <h4 class="text-lg font-medium text-gray-900 mb-3">Processing Times</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Standard Processing</label>
                                <input type="text" name="visa_processing_times[standard]" placeholder="e.g., 6-12 months" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Priority Processing</label>
                                <input type="text" name="visa_processing_times[priority]" placeholder="e.g., 3-6 months" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Complex Cases</label>
                                <input type="text" name="visa_processing_times[complex]" placeholder="e.g., 12+ months" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Duration Section -->
                    <div id="duration-section" class="hidden">
                        <h4 class="text-lg font-medium text-gray-900 mb-3">Visa Duration</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Initial Duration</label>
                                <input type="text" name="visa_duration[initial]" placeholder="e.g., 2 years, 4 years" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Extension Duration</label>
                                <input type="text" name="visa_duration[extension]" placeholder="e.g., 2 years, 1 year, N/A" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Permanent Residency</label>
                                <input type="text" name="visa_duration[permanent]" placeholder="e.g., After 2 years, N/A" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Additional Notes</label>
                                <input type="text" name="visa_duration[notes]" placeholder="Additional duration information" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Pathways Section -->
                    <div id="pathways-section" class="hidden">
                        <h4 class="text-lg font-medium text-gray-900 mb-3">Visa Pathways</h4>
                        <div id="pathways-container">
                            <div class="pathway-item border border-gray-200 rounded-lg p-4 mb-3">
                                <div class="grid grid-cols-1 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Pathway Title</label>
                                        <input type="text" name="visa_pathways[0][title]" placeholder="e.g., Skilled Migration Pathway" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                        <textarea name="visa_pathways[0][description]" rows="2" placeholder="Describe this pathway" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Requirements (Optional)</label>
                                        <textarea name="visa_pathways[0][requirements]" rows="2" placeholder="List requirements" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" onclick="addPathwayField()" class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                            <i class="fas fa-plus mr-1"></i>
                            Add Another Pathway
                        </button>
                    </div>
                </div>
                
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                    <button type="button" onclick="hideBulkUpdateModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                        Update Selected Pages
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let costIndex = 1;
let pathwayIndex = 1;

function showBulkUpdateModal() {
    document.getElementById('bulk-update-modal').classList.remove('hidden');
}

function hideBulkUpdateModal() {
    document.getElementById('bulk-update-modal').classList.add('hidden');
}

// Handle update type change
document.addEventListener('DOMContentLoaded', function() {
    const updateTypeSelect = document.querySelector('select[name="update_type"]');
    if (updateTypeSelect) {
        updateTypeSelect.addEventListener('change', function() {
            const selectedValue = this.value;
            
            // Hide all sections first
            document.getElementById('costs-section').classList.add('hidden');
            document.getElementById('processing-times-section').classList.add('hidden');
            document.getElementById('duration-section').classList.add('hidden');
            document.getElementById('pathways-section').classList.add('hidden');
            
            // Show relevant sections based on selection
            if (selectedValue === 'costs' || selectedValue === 'all') {
                document.getElementById('costs-section').classList.remove('hidden');
            }
            if (selectedValue === 'processing_times' || selectedValue === 'all') {
                document.getElementById('processing-times-section').classList.remove('hidden');
            }
            if (selectedValue === 'duration' || selectedValue === 'all') {
                document.getElementById('duration-section').classList.remove('hidden');
            }
            if (selectedValue === 'pathways' || selectedValue === 'all') {
                document.getElementById('pathways-section').classList.remove('hidden');
            }
        });
    }
});

function addCostField() {
    const container = document.getElementById('costs-container');
    const newCostItem = document.createElement('div');
    newCostItem.className = 'cost-item border border-gray-200 rounded-lg p-4 mb-3';
    newCostItem.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-3 grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Label</label>
                    <input type="text" name="visa_costs[${costIndex}][label]" placeholder="e.g., Application Fee" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                    <input type="text" name="visa_costs[${costIndex}][amount]" placeholder="e.g., $4,045, N/A" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Notes (Optional)</label>
                    <input type="text" name="visa_costs[${costIndex}][notes]" placeholder="Additional info" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>
            <div class="flex items-end">
                <button type="button" onclick="removeCostField(this)" class="text-red-600 hover:text-red-800 p-2">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    `;
    container.appendChild(newCostItem);
    costIndex++;
}

function removeCostField(button) {
    button.closest('.cost-item').remove();
}

function addPathwayField() {
    const container = document.getElementById('pathways-container');
    const newPathwayItem = document.createElement('div');
    newPathwayItem.className = 'pathway-item border border-gray-200 rounded-lg p-4 mb-3';
    newPathwayItem.innerHTML = `
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pathway Title</label>
                <input type="text" name="visa_pathways[${pathwayIndex}][title]" placeholder="e.g., Skilled Migration Pathway" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="visa_pathways[${pathwayIndex}][description]" rows="2" placeholder="Describe this pathway" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Requirements (Optional)</label>
                <textarea name="visa_pathways[${pathwayIndex}][requirements]" rows="2" placeholder="List requirements" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
            </div>
        </div>
    `;
    container.appendChild(newPathwayItem);
    pathwayIndex++;
}

// Handle update type change
document.querySelector('select[name="update_type"]').addEventListener('change', function() {
    const updateType = this.value;
    const costsSection = document.getElementById('costs-section');
    const processingTimesSection = document.getElementById('processing-times-section');
    const durationSection = document.getElementById('duration-section');
    const pathwaysSection = document.getElementById('pathways-section');
    
    // Hide all sections first
    costsSection.classList.add('hidden');
    processingTimesSection.classList.add('hidden');
    durationSection.classList.add('hidden');
    pathwaysSection.classList.add('hidden');
    
    // Show relevant sections based on selection
    if (updateType === 'costs' || updateType === 'all') {
        costsSection.classList.remove('hidden');
    }
    if (updateType === 'processing_times' || updateType === 'all') {
        processingTimesSection.classList.remove('hidden');
    }
    if (updateType === 'duration' || updateType === 'all') {
        durationSection.classList.remove('hidden');
    }
    if (updateType === 'pathways' || updateType === 'all') {
        pathwaysSection.classList.remove('hidden');
    }
});

// Category filter
document.getElementById('category-filter').addEventListener('change', function() {
    const selectedCategory = this.value;
    const sections = document.querySelectorAll('.category-section');
    
    sections.forEach(section => {
        if (selectedCategory === '' || section.dataset.category === selectedCategory) {
            section.style.display = 'block';
        } else {
            section.style.display = 'none';
        }
    });
});

// Select all functionality
function toggleSelectAll(checkbox) {
    const pageCheckboxes = document.querySelectorAll('.page-checkbox');
    pageCheckboxes.forEach(cb => cb.checked = checkbox.checked);
}
</script>
@endsection
