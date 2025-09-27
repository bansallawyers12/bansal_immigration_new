@extends('layouts.admin')

@section('title', 'Edit Visa Costs & Processing Times - ' . $page->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Edit Visa Information</h1>
                <p class="text-gray-600 mt-2">{{ $page->title }}</p>
                <div class="flex items-center mt-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ \App\Constants\CategoryConstants::getCategoryName($page->category) }}
                    </span>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.visa-management.index') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to List
                </a>
                <a href="{{ route('pages.dynamic', ['category' => $page->category, 'slug' => $page->slug]) }}" 
                   target="_blank"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-external-link-alt mr-2"></i>
                    View Page
                </a>
            </div>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.visa-management.update', $page->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Visa Costs Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-blue-50 px-6 py-4 border-b border-blue-200">
                    <h2 class="text-xl font-semibold text-blue-900 flex items-center">
                        <i class="fas fa-dollar-sign mr-3"></i>
                        Visa Costs
                    </h2>
                    <p class="text-blue-700 mt-1">Define the costs associated with this visa type</p>
                </div>
                
                <div class="p-6">
                    <div id="costs-container">
                        @if($page->visa_costs && is_array($page->visa_costs) && count($page->visa_costs) > 0)
                            @foreach($page->visa_costs as $index => $cost)
                                @if(is_array($cost))
                                    <div class="cost-item border border-gray-200 rounded-lg p-4 mb-4">
                                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                            <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Cost Label</label>
                                                    <input type="text" 
                                                           name="visa_costs[{{ $index }}][label]" 
                                                           value="{{ old('visa_costs.'.$index.'.label', $cost['label'] ?? '') }}"
                                                           placeholder="e.g., Application Fee, Visa Fee, etc." 
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                                                <input type="text" 
                                                       name="visa_costs[{{ $index }}][amount]" 
                                                       value="{{ old('visa_costs.'.$index.'.amount', $cost['amount'] ?? '') }}"
                                                       placeholder="e.g., $4,045, $1,500 AUD, N/A, etc." 
                                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Notes (Optional)</label>
                                                    <input type="text" 
                                                           name="visa_costs[{{ $index }}][notes]" 
                                                           value="{{ old('visa_costs.'.$index.'.notes', $cost['notes'] ?? '') }}"
                                                           placeholder="Additional information" 
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                </div>
                                            </div>
                                            <div class="flex items-end">
                                                <button type="button" onclick="removeCostField(this)" 
                                                        class="text-red-600 hover:text-red-800 p-2 border border-red-300 rounded-lg hover:bg-red-50">
                                                    <i class="fas fa-trash"></i>
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div class="cost-item border border-gray-200 rounded-lg p-4 mb-4">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Cost Label</label>
                                            <input type="text" 
                                                   name="visa_costs[0][label]" 
                                                   value="{{ old('visa_costs.0.label') }}"
                                                   placeholder="e.g., Application Fee, Visa Fee, etc." 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                                                    <input type="text" 
                                                           name="visa_costs[0][amount]" 
                                                           value="{{ old('visa_costs.0.amount') }}"
                                                           placeholder="e.g., $4,045, $1,500 AUD, N/A, etc." 
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Notes (Optional)</label>
                                            <input type="text" 
                                                   name="visa_costs[0][notes]" 
                                                   value="{{ old('visa_costs.0.notes') }}"
                                                   placeholder="Additional information" 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                    </div>
                                    <div class="flex items-end">
                                        <button type="button" onclick="removeCostField(this)" 
                                                class="text-red-600 hover:text-red-800 p-2 border border-red-300 rounded-lg hover:bg-red-50">
                                            <i class="fas fa-trash"></i>
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <button type="button" onclick="addCostField()" 
                            class="text-blue-600 hover:text-blue-800 flex items-center text-sm font-medium">
                        <i class="fas fa-plus mr-2"></i>
                        Add Another Cost
                    </button>
                    
                    <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-900 mb-2">Tips for Cost Information:</h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Use clear, descriptive labels (e.g., "Application Fee", "Visa Fee", "Medical Examination")</li>
                            <li>• Include currency symbols and amounts (e.g., "$4,045 AUD", "€2,500")</li>
                            <li>• Use "N/A" for costs that don't apply to this visa type</li>
                            <li>• Add notes for additional costs like health insurance or skills assessments</li>
                            <li>• Keep amounts up-to-date with current government fees</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Processing Times Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-green-50 px-6 py-4 border-b border-green-200">
                    <h2 class="text-xl font-semibold text-green-900 flex items-center">
                        <i class="fas fa-clock mr-3"></i>
                        Processing Times
                    </h2>
                    <p class="text-green-700 mt-1">Define the processing times for different application types</p>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Standard Processing</label>
                            <input type="text" 
                                   name="visa_processing_times[standard]" 
                                   value="{{ old('visa_processing_times.standard', $page->visa_processing_times['standard'] ?? '') }}"
                                   placeholder="e.g., 6-12 months, 3-4 months" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">For regular applications</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Priority Processing</label>
                            <input type="text" 
                                   name="visa_processing_times[priority]" 
                                   value="{{ old('visa_processing_times.priority', $page->visa_processing_times['priority'] ?? '') }}"
                                   placeholder="e.g., 3-6 months, 1-2 months" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">For priority applications (if applicable)</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Complex Cases</label>
                            <input type="text" 
                                   name="visa_processing_times[complex]" 
                                   value="{{ old('visa_processing_times.complex', $page->visa_processing_times['complex'] ?? '') }}"
                                   placeholder="e.g., 12+ months, 6-18 months" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">For complex or complicated cases</p>
                        </div>
                    </div>
                    
                    <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-900 mb-2">Tips for Processing Times:</h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Use realistic timeframes based on current government processing times</li>
                            <li>• Include ranges (e.g., "6-12 months") to account for variations</li>
                            <li>• Mention that times may vary based on individual circumstances</li>
                            <li>• Update regularly as processing times change</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Visa Duration Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-purple-50 px-6 py-4 border-b border-purple-200">
                    <h2 class="text-xl font-semibold text-purple-900 flex items-center">
                        <i class="fas fa-calendar-alt mr-3"></i>
                        Visa Duration
                    </h2>
                    <p class="text-purple-700 mt-1">Define the duration and validity periods for this visa type</p>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Initial Duration</label>
                            <input type="text" 
                                   name="visa_duration[initial]" 
                                   value="{{ old('visa_duration.initial', $page->visa_duration['initial'] ?? '') }}"
                                   placeholder="e.g., 2 years, 4 years, 18 months" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Initial visa validity period</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Extension Duration</label>
                            <input type="text" 
                                   name="visa_duration[extension]" 
                                   value="{{ old('visa_duration.extension', $page->visa_duration['extension'] ?? '') }}"
                                   placeholder="e.g., 2 years, 1 year, N/A" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Extension period (if applicable)</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Permanent Residency</label>
                            <input type="text" 
                                   name="visa_duration[permanent]" 
                                   value="{{ old('visa_duration.permanent', $page->visa_duration['permanent'] ?? '') }}"
                                   placeholder="e.g., After 2 years, After 3 years, N/A" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Pathway to permanent residency</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Additional Notes</label>
                            <input type="text" 
                                   name="visa_duration[notes]" 
                                   value="{{ old('visa_duration.notes', $page->visa_duration['notes'] ?? '') }}"
                                   placeholder="Additional duration information" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Optional additional information</p>
                        </div>
                    </div>
                    
                    <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-900 mb-2">Tips for Duration Information:</h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Be specific about time periods (e.g., "2 years", "18 months")</li>
                            <li>• Include extension possibilities if applicable</li>
                            <li>• Mention permanent residency pathways if available</li>
                            <li>• Use "N/A" for fields that don't apply to this visa type</li>
                            <li>• Keep information current with latest visa regulations</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Visa Pathways Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-orange-50 px-6 py-4 border-b border-orange-200">
                    <h2 class="text-xl font-semibold text-orange-900 flex items-center">
                        <i class="fas fa-route mr-3"></i>
                        Visa Pathways
                    </h2>
                    <p class="text-orange-700 mt-1">Define the different pathways and progression options for this visa</p>
                </div>
                
                <div class="p-6">
                    <div id="pathways-container">
                        @if($page->visa_pathways && is_array($page->visa_pathways) && count($page->visa_pathways) > 0)
                            @foreach($page->visa_pathways as $index => $pathway)
                                @if(is_array($pathway))
                                    <div class="pathway-item border border-gray-200 rounded-lg p-4 mb-4">
                                        <div class="grid grid-cols-1 gap-4">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Pathway Title</label>
                                                    <input type="text" 
                                                           name="visa_pathways[{{ $index }}][title]" 
                                                           value="{{ old('visa_pathways.'.$index.'.title', $pathway['title'] ?? '') }}"
                                                           placeholder="e.g., Skilled Migration Pathway, Family Reunion Pathway" 
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                                </div>
                                                <div class="flex items-end">
                                                    <button type="button" onclick="removePathwayField(this)" 
                                                            class="text-red-600 hover:text-red-800 p-2 border border-red-300 rounded-lg hover:bg-red-50">
                                                        <i class="fas fa-trash"></i>
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                                <textarea name="visa_pathways[{{ $index }}][description]" 
                                                          rows="3" 
                                                          placeholder="Describe this pathway and what it involves"
                                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">{{ old('visa_pathways.'.$index.'.description', $pathway['description'] ?? '') }}</textarea>
                                            </div>
                                            
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Requirements (Optional)</label>
                                                <textarea name="visa_pathways[{{ $index }}][requirements]" 
                                                          rows="2" 
                                                          placeholder="List specific requirements for this pathway"
                                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">{{ old('visa_pathways.'.$index.'.requirements', $pathway['requirements'] ?? '') }}</textarea>
                                            </div>
                                            
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Steps (Optional)</label>
                                                <div id="steps-container-{{ $index }}">
                                                    @if(!empty($pathway['steps']) && is_array($pathway['steps']))
                                                        @foreach($pathway['steps'] as $stepIndex => $step)
                                                            <div class="step-item flex items-center gap-2 mb-2">
                                                                <input type="text" 
                                                                       name="visa_pathways[{{ $index }}][steps][]" 
                                                                       value="{{ $step }}"
                                                                       placeholder="Step description"
                                                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                                                <button type="button" onclick="removeStepField(this)" 
                                                                        class="text-red-600 hover:text-red-800 p-1">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <button type="button" onclick="addStepField({{ $index }})" 
                                                        class="text-orange-600 hover:text-orange-800 text-sm">
                                                    <i class="fas fa-plus mr-1"></i>Add Step
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div class="pathway-item border border-gray-200 rounded-lg p-4 mb-4">
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Pathway Title</label>
                                            <input type="text" 
                                                   name="visa_pathways[0][title]" 
                                                   value="{{ old('visa_pathways.0.title') }}"
                                                   placeholder="e.g., Skilled Migration Pathway, Family Reunion Pathway" 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                        </div>
                                        <div class="flex items-end">
                                            <button type="button" onclick="removePathwayField(this)" 
                                                    class="text-red-600 hover:text-red-800 p-2 border border-red-300 rounded-lg hover:bg-red-50">
                                                <i class="fas fa-trash"></i>
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                        <textarea name="visa_pathways[0][description]" 
                                                  rows="3" 
                                                  placeholder="Describe this pathway and what it involves"
                                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">{{ old('visa_pathways.0.description') }}</textarea>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Requirements (Optional)</label>
                                        <textarea name="visa_pathways[0][requirements]" 
                                                  rows="2" 
                                                  placeholder="List specific requirements for this pathway"
                                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">{{ old('visa_pathways.0.requirements') }}</textarea>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Steps (Optional)</label>
                                        <div id="steps-container-0">
                                        </div>
                                        <button type="button" onclick="addStepField(0)" 
                                                class="text-orange-600 hover:text-orange-800 text-sm">
                                            <i class="fas fa-plus mr-1"></i>Add Step
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <button type="button" onclick="addPathwayField()" 
                            class="text-orange-600 hover:text-orange-800 flex items-center text-sm font-medium">
                        <i class="fas fa-plus mr-2"></i>
                        Add Another Pathway
                    </button>
                    
                    <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-900 mb-2">Tips for Pathways Information:</h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Use clear, descriptive titles for each pathway</li>
                            <li>• Provide detailed descriptions of what each pathway involves</li>
                            <li>• List specific requirements and eligibility criteria</li>
                            <li>• Include step-by-step processes where applicable</li>
                            <li>• Keep pathways current with latest immigration policies</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.visa-management.index') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    Update Visa Information
                </button>
            </div>
        </form>
    </div>
</div>

<script>
@php
    $validCostCount = 0;
    if ($page->visa_costs && is_array($page->visa_costs)) {
        foreach ($page->visa_costs as $cost) {
            if (is_array($cost)) {
                $validCostCount++;
            }
        }
    }
    
    $validPathwayCount = 0;
    if ($page->visa_pathways && is_array($page->visa_pathways)) {
        foreach ($page->visa_pathways as $pathway) {
            if (is_array($pathway)) {
                $validPathwayCount++;
            }
        }
    }
@endphp
let costIndex = {{ $validCostCount > 0 ? $validCostCount : 1 }};
let pathwayIndex = {{ $validPathwayCount > 0 ? $validPathwayCount : 1 }};

function addCostField() {
    const container = document.getElementById('costs-container');
    const newCostItem = document.createElement('div');
    newCostItem.className = 'cost-item border border-gray-200 rounded-lg p-4 mb-4';
    newCostItem.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cost Label</label>
                    <input type="text" name="visa_costs[${costIndex}][label]" placeholder="e.g., Application Fee, Visa Fee, etc." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                    <input type="text" name="visa_costs[${costIndex}][amount]" placeholder="e.g., $4,045, $1,500 AUD, N/A, etc." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Notes (Optional)</label>
                    <input type="text" name="visa_costs[${costIndex}][notes]" placeholder="Additional information" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>
            <div class="flex items-end">
                <button type="button" onclick="removeCostField(this)" class="text-red-600 hover:text-red-800 p-2 border border-red-300 rounded-lg hover:bg-red-50">
                    <i class="fas fa-trash"></i>
                    Remove
                </button>
            </div>
        </div>
    `;
    container.appendChild(newCostItem);
    costIndex++;
}

function removeCostField(button) {
    const costItems = document.querySelectorAll('.cost-item');
    if (costItems.length > 1) {
        button.closest('.cost-item').remove();
    } else {
        alert('You must have at least one cost field. Clear the fields instead of removing them.');
    }
}

function addPathwayField() {
    const container = document.getElementById('pathways-container');
    const newPathwayItem = document.createElement('div');
    newPathwayItem.className = 'pathway-item border border-gray-200 rounded-lg p-4 mb-4';
    newPathwayItem.innerHTML = `
        <div class="grid grid-cols-1 gap-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pathway Title</label>
                    <input type="text" name="visa_pathways[${pathwayIndex}][title]" placeholder="e.g., Skilled Migration Pathway, Family Reunion Pathway" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                </div>
                <div class="flex items-end">
                    <button type="button" onclick="removePathwayField(this)" class="text-red-600 hover:text-red-800 p-2 border border-red-300 rounded-lg hover:bg-red-50">
                        <i class="fas fa-trash"></i>
                        Remove
                    </button>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="visa_pathways[${pathwayIndex}][description]" rows="3" placeholder="Describe this pathway and what it involves" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"></textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Requirements (Optional)</label>
                <textarea name="visa_pathways[${pathwayIndex}][requirements]" rows="2" placeholder="List specific requirements for this pathway" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"></textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Steps (Optional)</label>
                <div id="steps-container-${pathwayIndex}">
                </div>
                <button type="button" onclick="addStepField(${pathwayIndex})" class="text-orange-600 hover:text-orange-800 text-sm">
                    <i class="fas fa-plus mr-1"></i>Add Step
                </button>
            </div>
        </div>
    `;
    container.appendChild(newPathwayItem);
    pathwayIndex++;
}

function removePathwayField(button) {
    const pathwayItems = document.querySelectorAll('.pathway-item');
    if (pathwayItems.length > 1) {
        button.closest('.pathway-item').remove();
    } else {
        alert('You must have at least one pathway field. Clear the fields instead of removing them.');
    }
}

function addStepField(pathwayIndex) {
    const container = document.getElementById(`steps-container-${pathwayIndex}`);
    const newStepItem = document.createElement('div');
    newStepItem.className = 'step-item flex items-center gap-2 mb-2';
    newStepItem.innerHTML = `
        <input type="text" name="visa_pathways[${pathwayIndex}][steps][]" placeholder="Step description" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
        <button type="button" onclick="removeStepField(this)" class="text-red-600 hover:text-red-800 p-1">
            <i class="fas fa-times"></i>
        </button>
    `;
    container.appendChild(newStepItem);
}

function removeStepField(button) {
    button.closest('.step-item').remove();
}
</script>
@endsection
