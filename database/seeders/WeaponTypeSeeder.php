<?php

namespace Database\Seeders;

use App\Models\WeaponType;
use Illuminate\Database\Seeder;

class WeaponTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weaponTypes = [
            [
                "name_dr" => "شیشه کوف",
                "name_en" => "Cove Glass",
            ],
            [
                "name_dr" => "کرینکوف",
                "name_en" => "Krinkov",
            ],
            [
                "name_dr" => "مکاروف",
                "name_en" => "Makarov",
            ],
            [
                "name_dr" => "ام فور",
                "name_en" => "M4",
            ],
            [
                "name_dr" => "تورس",
                "name_en" => "Torus",
            ],
            [
                "name_dr" => " اس دبل یو امریکایی",
                "name_en" => " American SW",
            ],
            [
                "name_dr" => "بریتا",
                "name_en" => "Britta",
            ],
            [
                "name_dr" => "تفنگچه تی تی",
                "name_en" => "TT Pistol",
            ],
            [
                "name_dr" => "کله کوف",
                "name_en" => "Kole Kov",
            ],
            [
                "name_dr" => "تفنگچه سی زید",
                "name_en" => "CZ Pistol",
            ],
            [
                "name_dr" => "کلاشینکوف",
                "name_en" => "AK47",
            ],
            [
                "name_dr" => "تفنگچه کمری",
                "name_en" => "تفنگچه کمری",
            ],
            [
                "name_dr" => "تفنگچه ام 16",
                "name_en" => "تفنگچه ام 16",
            ],
            [
                "name_dr" => "تفنگچه زیگانا",
                "name_en" => "Ziagana Pistol",
            ],
            [
                "name_dr" => "تفنگچه گلاگ",
                "name_en" => "Glog Pistol",
            ],
            [
                "name_dr" => "سی زید اسکورپین",
                "name_en" => "CZ Scorpion",
            ],
            [
                "name_dr" => "تفنگچه ترکی",
                "name_en" => "Turkish Pistol",
            ],
            [
                "name_dr" => "تفنگچه چینایی",
                "name_en" => "China Pistol",
            ],
            [
                "name_dr" => "ام پی فایف",
                "name_en" => "MP5",
            ],
            [
                "name_dr" => "تفنگچه والتر جرمنی",
                "name_en" => "Germen Walter Pistol",
            ],
            [
                "name_dr" => "تفنگچه ایتالیایی",
                "name_en" => "Italian Pistol",
            ],
            [
                "name_dr" => "تفنگچه لاما",
                "name_en" => "Lama Pistol",
            ],
            [
                "name_dr" => "چهل تکه",
                "name_en" => "40 Pcs",
            ]
        ];

        foreach ($weaponTypes as $weaponType)
            WeaponType::create($weaponType);
    }
}
