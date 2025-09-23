<?php

namespace App\Constants;

class CategoryConstants
{
    /**
     * Available page categories
     */
    public const CATEGORIES = [
        'study-australia' => [
            'name' => 'Study in Australia',
            'description' => 'Student visas, education, and study-related content',
            'icon' => 'fas fa-graduation-cap',
            'color' => 'blue'
        ],
        'family-visa' => [
            'name' => 'Family Visa',
            'description' => 'Family reunion and partner visa information',
            'icon' => 'fas fa-users',
            'color' => 'green'
        ],
        'migration' => [
            'name' => 'Migration',
            'description' => 'General migration and permanent residency content',
            'icon' => 'fas fa-home',
            'color' => 'purple'
        ],
        'other-countries' => [
            'name' => 'Other Countries',
            'description' => 'Visa information for countries other than Australia',
            'icon' => 'fas fa-globe',
            'color' => 'orange'
        ],
        'employer-sponsored' => [
            'name' => 'Employer Sponsored',
            'description' => 'Work visa and employment sponsorship content',
            'icon' => 'fas fa-briefcase',
            'color' => 'indigo'
        ],
        'visitor-visa' => [
            'name' => 'Visitor Visa',
            'description' => 'Tourist and visitor visa information',
            'icon' => 'fas fa-plane',
            'color' => 'teal'
        ],
        'appeals' => [
            'name' => 'Appeals',
            'description' => 'Visa appeals and review processes',
            'icon' => 'fas fa-gavel',
            'color' => 'red'
        ],
        'business-visa' => [
            'name' => 'Business Visa',
            'description' => 'Business and investment visa content',
            'icon' => 'fas fa-chart-line',
            'color' => 'yellow'
        ],
        'citizenship' => [
            'name' => 'Citizenship',
            'description' => 'Australian citizenship information',
            'icon' => 'fas fa-flag',
            'color' => 'pink'
        ]
    ];

    /**
     * Get all category keys
     */
    public static function getCategoryKeys(): array
    {
        return array_keys(self::CATEGORIES);
    }

    /**
     * Get category information by key
     */
    public static function getCategoryInfo(string $key): ?array
    {
        return self::CATEGORIES[$key] ?? null;
    }

    /**
     * Get category name by key
     */
    public static function getCategoryName(string $key): string
    {
        return self::CATEGORIES[$key]['name'] ?? ucfirst(str_replace('-', ' ', $key));
    }

    /**
     * Get category description by key
     */
    public static function getCategoryDescription(string $key): string
    {
        return self::CATEGORIES[$key]['description'] ?? '';
    }

    /**
     * Get category icon by key
     */
    public static function getCategoryIcon(string $key): string
    {
        return self::CATEGORIES[$key]['icon'] ?? 'fas fa-folder';
    }

    /**
     * Get category color by key
     */
    public static function getCategoryColor(string $key): string
    {
        return self::CATEGORIES[$key]['color'] ?? 'gray';
    }

    /**
     * Check if category exists
     */
    public static function categoryExists(string $key): bool
    {
        return array_key_exists($key, self::CATEGORIES);
    }

    /**
     * Get categories for dropdown
     */
    public static function getCategoriesForDropdown(): array
    {
        $categories = [];
        foreach (self::CATEGORIES as $key => $info) {
            $categories[$key] = $info['name'];
        }
        return $categories;
    }

    /**
     * Get categories with metadata
     */
    public static function getCategoriesWithMetadata(): array
    {
        return self::CATEGORIES;
    }
}
