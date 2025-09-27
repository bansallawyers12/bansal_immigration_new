<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class AppealsNewPagesSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'ART Appeals',
                'slug' => 'art-appeals',
            ],
            [
                'title' => 'Federal Court Appeals',
                'slug' => 'federal-court-appeals',
            ],
            [
                'title' => 'Ministerial Intervention',
                'slug' => 'ministerial-intervention',
            ],
            [
                'title' => 'Review Process',
                'slug' => 'review-process',
            ],
        ];

        foreach ($pages as $data) {
            Page::firstOrCreate(
                ['category' => 'appeals', 'slug' => $data['slug']],
                [
                    'title' => $data['title'],
                    'content' => '<h1>'.$data['title'].'</h1><p>Placeholder content. Update via CMS.</p>',
                    'excerpt' => 'Overview of '.$data['title'],
                    'status' => true,
                ]
            );
        }
    }
}


