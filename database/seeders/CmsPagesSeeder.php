<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Page;

class CmsPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = base_path('database/seeders/data/pages.json');
        if (!File::exists($jsonPath)) {
            $this->command?->warn('CmsPagesSeeder: pages.json not found, skipping.');
            return;
        }

        $data = json_decode(File::get($jsonPath), true);
        if (!is_array($data)) {
            $this->command?->error('CmsPagesSeeder: Invalid JSON structure.');
            return;
        }

        $this->command?->info('Importing CMS pages from JSON...');

        DB::transaction(function () use ($data) {
            foreach ($data as $row) {
                // Upsert by slug
                $slug = $row['slug'] ?? null;
                if (!$slug) {
                    continue;
                }

                // Remove keys that are not fillable or could conflict
                $payload = $row;
                unset($payload['id']);

                Page::updateOrCreate(['slug' => $slug], $payload);
            }
        });

        $this->command?->info('CMS pages import complete.');
    }
}



