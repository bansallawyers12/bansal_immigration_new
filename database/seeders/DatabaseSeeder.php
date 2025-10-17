<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@bansalimmigration.com',
        ]);

        // Run immigration data seeder and postcode data
        $this->call([
            ImmigrationSeeder::class,
            AppointmentSeeder::class,
            BusinessVisaPagesSeeder::class,
            EmployerSponsoredPagesSeeder::class,
            AllMissingPagesSeeder::class,
            AdditionalMigrationPagesSeeder::class,
            SuburbSeeder::class,
            PostcodeRangeSeeder::class,
            CmsPagesSeeder::class,
        ]);
    }
}
