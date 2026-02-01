<?php

namespace Database\Seeders;

use App\Models\LicenseType;
use Illuminate\Database\Seeder;

class LicenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $licenseTypes = [
            [
                "name_dr" => "جدید",
                "name_en" => "New"
            ],
            [
                "name_dr" => "تمدید",
                "name_en" => "Update"
            ],
            [
                "name_dr" => "مثنی",
                "name_en" => "Duplicate"
            ]
        ];

        foreach ($licenseTypes as $licenseType)
            LicenseType::create($licenseType);
    }
}
