<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [
                "name_en" => "Afghanistan",
                "name_dr" => "افغانستان"
            ],
            [
                "name_en" => "United Arab Emirates",
                "name_dr" => "امارات متحده عربی"
            ],
            [
                "name_en" => "Algeria",
                "name_dr" => "الجزایر"
            ],
            [
                "name_en" => "Azerbaijan",
                "name_dr" => "آذربایجان"
            ],
            [
                "name_en" => "Albania",
                "name_dr" => "آلبانی"
            ],
            [
                "name_en" => "Armenia",
                "name_dr" => "ارمنستان"
            ],
            [
                "name_en" => "Argentina",
                "name_dr" => "آرژانتین"
            ],
            [
                "name_en" => "Australia",
                "name_dr" => "استرالیا"
            ],
            [
                "name_en" => "Belgium",
                "name_dr" => "بلژیک"
            ],
            [
                "name_en" => "Bangladesh",
                "name_dr" => "بنگلادش"
            ],
            [
                "name_en" => "Brazil",
                "name_dr" => "برازیل"
            ],
            [
                "name_en" => "Canada",
                "name_dr" => "کانادا"
            ],
            [
                "name_en" => "Sri Lanka",
                "name_dr" => "سری لانکا"
            ],
            [
                "name_en" => "China",
                "name_dr" => "چين"
            ],
            [
                "name_en" => "Colombia",
                "name_dr" => "کلمبیا"
            ],
            [
                "name_en" => "Central African Republic",
                "name_dr" => "جمهوری آفریقای مرکزی"
            ],
            [
                "name_en" => "Cyprus",
                "name_dr" => "قبرس"
            ],
            [
                "name_en" => "Denmark",
                "name_dr" => "دنمارک"
            ],
            [
                "name_en" => "Egypt",
                "name_dr" => "مصر"
            ],
            [
                "name_en" => "France",
                "name_dr" => "فرانسه"
            ],
            [
                "name_en" => "Greece",
                "name_dr" => "یونان"
            ],
            [
                "name_en" => "Iceland",
                "name_dr" => "ایسلند"
            ],
            [
                "name_en" => "Indonesia",
                "name_dr" => "اندونیزیا"
            ],
            [
                "name_en" => "India",
                "name_dr" => "هندوستان"
            ],
            [
                "name_en" => "Iran",
                "name_dr" => "ایران"
            ],
            [
                "name_en" => "Italy",
                "name_dr" => "ایتالیا"
            ],
            [
                "name_en" => "Iraq",
                "name_dr" => "عراق"
            ],
            [
                "name_en" => "Japan",
                "name_dr" => "جاپان"
            ],
            [
                "name_en" => "Jordan",
                "name_dr" => "اردن"
            ],
            [
                "name_en" => "Kyrgyzstan",
                "name_dr" => "قرغزستان"
            ],
            [
                "name_en" => "Kuwait",
                "name_dr" => "کویت"
            ],
            [
                "name_en" => "Kazakhstan",
                "name_dr" => "قزاقستان"
            ],
            [
                "name_en" => "Lebanon",
                "name_dr" => "لبنان"
            ],
            [
                "name_en" => "Morocco",
                "name_dr" => "مراکش"
            ],
            [
                "name_en" => "Oman",
                "name_dr" => "عمان"
            ],
            [
                "name_en" => "Mexico",
                "name_dr" => "مکزیک"
            ],
            [
                "name_en" => "Malaysia",
                "name_dr" => "مالیزیا"
            ],
            [
                "name_en" => "Nepal",
                "name_dr" => "نیپال"
            ],
            [
                "name_en" => "New Zealand",
                "name_dr" => "نیوزلند"
            ],
            [
                "name_en" => "Pakistan",
                "name_dr" => "پاکستان"
            ],
            [
                "name_en" => "Portugal",
                "name_dr" => "پرتغال"
            ],
            [
                "name_en" => "Qatar",
                "name_dr" => "قطر"
            ],
            [
                "name_en" => "Serbia",
                "name_dr" => "صربستان"
            ],
            [
                "name_en" => "Philippines",
                "name_dr" => "فیلیپین"
            ],
            [
                "name_en" => "Russia",
                "name_dr" => "روسیه"
            ],
            [
                "name_en" => "Saudi Arabia",
                "name_dr" => "عربستان سعودی"
            ],
            [
                "name_en" => "South Africa",
                "name_dr" => "آفریقای جنوبی"
            ],
            [
                "name_en" => "Singapore",
                "name_dr" => "سنگاپور"
            ],
            [
                "name_en" => "Spain",
                "name_dr" => "اسپانیا"
            ],
            [
                "name_en" => "Sweden",
                "name_dr" => "سویدن"
            ],
            [
                "name_en" => "Syrian Arab Republic",
                "name_dr" => "جمهوری عربی سوریه"
            ],
            [
                "name_en" => "Switzerland",
                "name_dr" => "سوئیس"
            ],
            [
                "name_en" => "Thailand",
                "name_dr" => "تایلند"
            ],
            [
                "name_en" => "Tajikistan",
                "name_dr" => "تاجیکستان"
            ],
            [
                "name_en" => "Tunisia",
                "name_dr" => "تونس"
            ],
            [
                "name_en" => "Taiwan",
                "name_dr" => "تایوان"
            ],
            [
                "name_en" => "Turkmenistan",
                "name_dr" => "ترکمنستان"
            ],
            [
                "name_en" => "United Kingdom",
                "name_dr" => "انگلستان"
            ],
            [
                "name_en" => "Ukraine",
                "name_dr" => "اوکراین"
            ],
            [
                "name_en" => "United States",
                "name_dr" => "ایالات متحده"
            ],
            [
                "name_en" => "Uzbekistan",
                "name_dr" => "ازبکستان"
            ],
            [
                "name_en" => "Venezuela",
                "name_dr" => "ونزوئلا"
            ],
            [
                "name_en" => "Vietnam",
                "name_dr" => "ویتنام"
            ],
            [
                "name_en" => "Swaziland",
                "name_dr" => "سوازیلند"
            ],
            [
                "name_en" => "Yemen",
                "name_dr" => "یمن"
            ]
        ];

        foreach ($countries as $country)
            Country::create($country);
    }
}
