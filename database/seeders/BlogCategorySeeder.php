<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Immigration News',
                'slug' => 'immigration-news',
                'description' => 'Latest updates and news about immigration policies and procedures',
                'status' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Visa Information',
                'slug' => 'visa-information',
                'description' => 'Comprehensive guides about different types of visas',
                'status' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Success Stories',
                'slug' => 'success-stories',
                'description' => 'Real stories from our successful clients',
                'status' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Legal Updates',
                'slug' => 'legal-updates',
                'description' => 'Important legal changes and their impact',
                'status' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Study Abroad',
                'slug' => 'study-abroad',
                'description' => 'Information about studying in different countries',
                'status' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($categories as $categoryData) {
            BlogCategory::create($categoryData);
        }

        // Add some subcategories
        $visaCategory = BlogCategory::where('slug', 'visa-information')->first();
        if ($visaCategory) {
            $subcategories = [
                [
                    'name' => 'Student Visa',
                    'slug' => 'student-visa',
                    'description' => 'Everything about student visas',
                    'parent_id' => $visaCategory->id,
                    'status' => true,
                    'sort_order' => 1,
                ],
                [
                    'name' => 'Work Visa',
                    'slug' => 'work-visa',
                    'description' => 'Work visa information and requirements',
                    'parent_id' => $visaCategory->id,
                    'status' => true,
                    'sort_order' => 2,
                ],
                [
                    'name' => 'Tourist Visa',
                    'slug' => 'tourist-visa',
                    'description' => 'Tourist visa requirements and process',
                    'parent_id' => $visaCategory->id,
                    'status' => true,
                    'sort_order' => 3,
                ],
            ];

            foreach ($subcategories as $subcategoryData) {
                BlogCategory::create($subcategoryData);
            }
        }

        $studyCategory = BlogCategory::where('slug', 'study-abroad')->first();
        if ($studyCategory) {
            $studySubcategories = [
                [
                    'name' => 'Australia',
                    'slug' => 'study-australia',
                    'description' => 'Study opportunities in Australia',
                    'parent_id' => $studyCategory->id,
                    'status' => true,
                    'sort_order' => 1,
                ],
                [
                    'name' => 'Canada',
                    'slug' => 'study-canada',
                    'description' => 'Study opportunities in Canada',
                    'parent_id' => $studyCategory->id,
                    'status' => true,
                    'sort_order' => 2,
                ],
                [
                    'name' => 'UK',
                    'slug' => 'study-uk',
                    'description' => 'Study opportunities in the United Kingdom',
                    'parent_id' => $studyCategory->id,
                    'status' => true,
                    'sort_order' => 3,
                ],
            ];

            foreach ($studySubcategories as $subcategoryData) {
                BlogCategory::create($subcategoryData);
            }
        }
    }
}