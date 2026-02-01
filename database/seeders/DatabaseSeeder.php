<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ProvinceSeeder::class,
            RoleSeeder::class,
            CountrySeeder::class,
            LicenseTypeSeeder::class,
            ColorSeeder::class,
            WeaponTypeSeeder::class,
        ]);
    }
}
