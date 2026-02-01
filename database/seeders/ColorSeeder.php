<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            [
                "name" => "سفید",
            ],
            [
                "name" => "سیاه",
            ],
            [
                "name" => "نقره یی",
            ],
            [
                "name" => "طلایی",
            ],

            [
                "name" => "جگری",
            ],
            [
                "name" => "سبز",
            ],

        ];

        foreach ($colors as $color)
            Color::create($color);
    }
}
