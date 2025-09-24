<?php

namespace Database\Seeders;

use App\Models\Suburb;
use Illuminate\Database\Seeder;

class SuburbSeeder extends Seeder
{
    public function run(): void
    {
        Suburb::truncate();

        $csvPath = storage_path('app/australian_postcodes.csv');
        if (!file_exists($csvPath)) {
            throw new \RuntimeException('CSV file not found at: ' . $csvPath);
        }

        $data = array_map('str_getcsv', file($csvPath));
        array_shift($data);

        $records = [];
        foreach ($data as $row) {
            if (count($row) >= 3 && is_numeric($row[0])) {
                $records[] = [
                    'postcode' => (int) $row[0],
                    'suburb' => $row[1],
                    'state' => $row[2] ?: null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        foreach (array_chunk($records, 1000) as $chunk) {
            Suburb::insert($chunk);
        }
    }
}


