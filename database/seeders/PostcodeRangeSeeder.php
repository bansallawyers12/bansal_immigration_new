<?php

namespace Database\Seeders;

use App\Models\PostcodeRange;
use App\Models\Suburb;
use Illuminate\Database\Seeder;

class PostcodeRangeSeeder extends Seeder
{
    public function run(): void
    {
        PostcodeRange::truncate();

        $ranges = [
            // NSW Category 2 (Newcastle, Wollongong etc.)
            ['start_postcode' => 2264, 'end_postcode' => 2308, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 2500, 'end_postcode' => 2526, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 2528, 'end_postcode' => 2535, 'category' => 'Category 2, Cities and Major Regional Centres'],
            // NSW Category 3
            ['start_postcode' => 2250, 'end_postcode' => 2258, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 2260, 'end_postcode' => 2263, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 2311, 'end_postcode' => 2490, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 2527, 'end_postcode' => 2527, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 2536, 'end_postcode' => 2551, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 2575, 'end_postcode' => 2739, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 2753, 'end_postcode' => 2754, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 2756, 'end_postcode' => 2758, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 2773, 'end_postcode' => 2898, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],

            // ACT Category 2 (all ACT)
            ['start_postcode' => 2600, 'end_postcode' => 2619, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 2900, 'end_postcode' => 2920, 'category' => 'Category 2, Cities and Major Regional Centres'],

            // TAS Category 2 (Hobart area ranges)
            ['start_postcode' => 7000, 'end_postcode' => 7000, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 7004, 'end_postcode' => 7026, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 7030, 'end_postcode' => 7109, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 7140, 'end_postcode' => 7151, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 7170, 'end_postcode' => 7177, 'category' => 'Category 2, Cities and Major Regional Centres'],

            // VIC Category 2 (Geelong, Ballarat fringe etc.)
            ['start_postcode' => 3211, 'end_postcode' => 3232, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 3235, 'end_postcode' => 3235, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 3240, 'end_postcode' => 3240, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 3328, 'end_postcode' => 3328, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 3330, 'end_postcode' => 3333, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 3340, 'end_postcode' => 3340, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 3342, 'end_postcode' => 3342, 'category' => 'Category 2, Cities and Major Regional Centres'],

            // VIC Category 3 (granular, excludes metro like 3150)
            ['start_postcode' => 3097, 'end_postcode' => 3099, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 3139, 'end_postcode' => 3139, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 3233, 'end_postcode' => 3234, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 3236, 'end_postcode' => 3239, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 3241, 'end_postcode' => 3325, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 3329, 'end_postcode' => 3329, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 3334, 'end_postcode' => 3334, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 3341, 'end_postcode' => 3341, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 3345, 'end_postcode' => 3424, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 3430, 'end_postcode' => 3799, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 3809, 'end_postcode' => 3909, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 3912, 'end_postcode' => 3971, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 3978, 'end_postcode' => 3996, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],

            // QLD Category 2 (Gold Coast, Sunshine Coast, Ipswich etc.)
            ['start_postcode' => 4019, 'end_postcode' => 4022, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 4025, 'end_postcode' => 4025, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 4037, 'end_postcode' => 4037, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 4074, 'end_postcode' => 4074, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 4076, 'end_postcode' => 4078, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 4207, 'end_postcode' => 4275, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 4300, 'end_postcode' => 4305, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 4500, 'end_postcode' => 4519, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 4521, 'end_postcode' => 4521, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 4550, 'end_postcode' => 4575, 'category' => 'Category 2, Cities and Major Regional Centres'],
            // QLD Category 3
            ['start_postcode' => 4124, 'end_postcode' => 4125, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 4133, 'end_postcode' => 4133, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 4183, 'end_postcode' => 4184, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 4280, 'end_postcode' => 4287, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 4306, 'end_postcode' => 4498, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 4507, 'end_postcode' => 4507, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 4552, 'end_postcode' => 4552, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 4563, 'end_postcode' => 4563, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 4570, 'end_postcode' => 4570, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],
            ['start_postcode' => 4580, 'end_postcode' => 4895, 'category' => 'Category 3, Regional Centres and Other Regional Areas'],

            // SA Category 2 (Adelaide region specific) — see reference list
            ['start_postcode' => 5000, 'end_postcode' => 5171, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 5173, 'end_postcode' => 5174, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 5231, 'end_postcode' => 5235, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 5240, 'end_postcode' => 5252, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 5351, 'end_postcode' => 5351, 'category' => 'Category 2, Cities and Major Regional Centres'],
            ['start_postcode' => 5950, 'end_postcode' => 5960, 'category' => 'Category 2, Cities and Major Regional Centres'],

            // WA Category 2 (reference provides an explicit list; treat 6000–6999 as cat 2 fallback if needed)
            ['start_postcode' => 6000, 'end_postcode' => 6999, 'category' => 'Category 2, Cities and Major Regional Centres'],
        ];

        foreach ($ranges as $range) {
            PostcodeRange::create($range);
        }

        // For states where Category 2 is defined, mark remaining postcodes as Category 3, else keep gaps for Category 1
        $states = ['NSW','VIC','QLD','SA','WA','TAS','ACT','NT'];
        foreach ($states as $state) {
            $all = Suburb::where('state', $state)->pluck('postcode')->unique()->toArray();

            $categorized = [];
            foreach ($ranges as $range) {
                for ($p = $range['start_postcode']; $p <= $range['end_postcode']; $p++) {
                    $categorized[$p] = true;
                }
            }

            foreach ($all as $pc) {
                if (!isset($categorized[$pc])) {
                    // Not present in 2 or 3: Category 1 by rule
                    PostcodeRange::create([
                        'start_postcode' => $pc,
                        'end_postcode' => $pc,
                        'category' => 'Category 1, Not Regional – Major Cities',
                    ]);
                }
            }
        }
    }
}


