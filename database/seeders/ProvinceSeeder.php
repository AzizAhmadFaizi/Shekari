<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provices = [
            [
                "id" => "1",
                "name_en" => "Kabul",
                "name_dr" => "کابل",
            ],
            [
                "id" => "2",
                "name_en" => "Kapisa",
                "name_dr" => "کاپيسا",
            ],
            [
                "id" => "3",
                "name_en" => "Parwan",
                "name_dr" => "پروان",
            ],
            [
                "id" => "4",
                "name_en" => "Wardak",
                "name_dr" => "میدان وردک",
            ],
            [
                "id" => "5",
                "name_en" => "Logar",
                "name_dr" => "لوگر",
            ],
            [
                "id" => "6",
                "name_en" => "Ghazni",
                "name_dr" => "غزني",
            ],
            [
                "id" => "7",
                "name_en" => "Paktia",
                "name_dr" => "پکتيا",
            ],
            [
                "id" => "8",
                "name_en" => "Nangarhar",
                "name_dr" => "ننگرهار",
            ],
            [
                "id" => "9",
                "name_en" => "Laghman",
                "name_dr" => "لغمان",
            ],
            [
                "id" => "10",
                "name_en" => "Kunar",
                "name_dr" => "کنر",
            ],
            [
                "id" => "11",
                "name_en" => "Badakhshan",
                "name_dr" => "بدخشان",
            ],
            [
                "id" => "12",
                "name_en" => "Takhar",
                "name_dr" => "تخار",
            ],
            [
                "id" => "13",
                "name_en" => "Baghlan",
                "name_dr" => "بغلان",
            ],
            [
                "id" => "14",
                "name_en" => "Kunduz",
                "name_dr" => "کندوز",
            ],
            [
                "id" => "15",
                "name_en" => "Samangan",
                "name_dr" => "سمنگان",
            ],
            [
                "id" => "16",
                "name_en" => "Balkh",
                "name_dr" => "بلخ",
            ],
            [
                "id" => "17",
                "name_en" => "Jawzjan",
                "name_dr" => "جوزجان",
            ],
            [
                "id" => "18",
                "name_en" => "Faryab",
                "name_dr" => "فارياب",
            ],
            [
                "id" => "19",
                "name_en" => "Badghis",
                "name_dr" => "بادغيس",
            ],
            [
                "id" => "20",
                "name_en" => "Herat",
                "name_dr" => "هرات",
            ],
            [
                "id" => "21",
                "name_en" => "Farah",
                "name_dr" => "فراه",
            ],
            [
                "id" => "22",
                "name_en" => "Nimroz",
                "name_dr" => "نيمروز",
            ],
            [
                "id" => "23",
                "name_en" => "Hilmand",
                "name_dr" => "هلمند",
            ],
            [
                "id" => "24",
                "name_en" => "Kandahar",
                "name_dr" => "کندهار",
            ],
            [
                "id" => "25",
                "name_en" => "Zabul",
                "name_dr" => "زابل",
            ],
            [
                "id" => "26",
                "name_en" => "Uruzgan",
                "name_dr" => "ارزگان",
            ],
            [
                "id" => "27",
                "name_en" => "Ghor",
                "name_dr" => "غور",
            ],
            [
                "id" => "28",
                "name_en" => "Bamyan",
                "name_dr" => "باميان",
            ],
            [
                "id" => "29",
                "name_en" => "Paktika",
                "name_dr" => "پکتيکا",
            ],
            [
                "id" => "30",
                "name_en" => "Nuristan",
                "name_dr" => "نورستان",
            ],
            [
                "id" => "31",
                "name_en" => "Sar i Pul",
                "name_dr" => "سرپل",
            ],
            [
                "id" => "32",
                "name_en" => "Khost",
                "name_dr" => "خوست",
            ],
            [
                "id" => "33",
                "name_en" => "Panjshir",
                "name_dr" => "پنجشير",
            ],
            [
                "id" => "34",
                "name_en" => "Daikundi",
                "name_dr" => "دايکندي",
            ]
        ];

        $districts = [
            [
                "id" => "1",
                "province_id" => 1,
                "name_en" => "Deh Sabz",
                "name_dr" => "ده سبز"
            ],
            [
                "id" => "2",
                "province_id" => 1,
                "name_en" => "Mir Bacha Kot",
                "name_dr" => "مير بچه کوت"
            ],
            [
                "id" => "3",
                "province_id" => 1,
                "name_en" => "Kalakan",
                "name_dr" => "کلکان"
            ],
            [
                "id" => "4",
                "province_id" => 1,
                "name_en" => "Qara Bagh",
                "name_dr" => "قره باغ"
            ],
            [
                "id" => "5",
                "province_id" => 1,
                "name_en" => "Istalif",
                "name_dr" => "استالف"
            ],
            [
                "id" => "6",
                "province_id" => 1,
                "name_en" => "Sharkar Dara",
                "name_dr" => "شکردره"
            ],
            [
                "id" => "7",
                "province_id" => 1,
                "name_en" => "Paghman",
                "name_dr" => "پغمان"
            ],
            [
                "id" => "8",
                "province_id" => 1,
                "name_en" => "Char Asyab",
                "name_dr" => "چهارآسياب"
            ],
            [
                "id" => "9",
                "province_id" => 1,
                "name_en" => "Bagrami",
                "name_dr" => "بگرامي"
            ],
            [
                "id" => "10",
                "province_id" => 1,
                "name_en" => "Khak Jabbar",
                "name_dr" => "خاک جبار"
            ],
            [
                "id" => "11",
                "province_id" => 1,
                "name_en" => "Sorobi",
                "name_dr" => "سروبي"
            ],
            [
                "id" => "12",
                "province_id" => 1,
                "name_en" => "Guldara",
                "name_dr" => "گلدره"
            ],
            [
                "id" => "13",
                "province_id" => 1,
                "name_en" => "Mosahi",
                "name_dr" => "موسهي"
            ],
            [
                "id" => "14",
                "province_id" => 1,
                "name_en" => "Farza",
                "name_dr" => "فرزه"
            ],
            [
                "id" => "15",
                "province_id" => 2,
                "name_en" => "Mahmood Raqi",
                "name_dr" => "محمود راقي"
            ],
            [
                "id" => "16",
                "province_id" => 2,
                "name_en" => "Hisa i Awal i Kohistan",
                "name_dr" => "حصه اول کوهستان"
            ],
            [
                "id" => "17",
                "province_id" => 2,
                "name_en" => "Koh Band",
                "name_dr" => "کوه بند"
            ],
            [
                "id" => "18",
                "province_id" => 2,
                "name_en" => "Nijrab",
                "name_dr" => "نجراب"
            ],
            [
                "id" => "19",
                "province_id" => 2,
                "name_en" => "Tagab",
                "name_dr" => "تگاب"
            ],
            [
                "id" => "20",
                "province_id" => 2,
                "name_en" => "Ala Saay",
                "name_dr" => "اله ساي"
            ],
            [
                "id" => "21",
                "province_id" => 2,
                "name_en" => "Hisa i Dowom i Kohistan",
                "name_dr" => "حصه دوم کوهستان"
            ],
            [
                "id" => "22",
                "province_id" => 3,
                "name_en" => "Charikar",
                "name_dr" => "چاريکار"
            ],
            [
                "id" => "23",
                "province_id" => 3,
                "name_en" => "Jabal u Saraj",
                "name_dr" => "جبل السراج"
            ],
            [
                "id" => "24",
                "province_id" => 3,
                "name_en" => "Salang",
                "name_dr" => "سا لنگ"
            ],
            [
                "id" => "25",
                "province_id" => 3,
                "name_en" => "Shinwari",
                "name_dr" => "شينواري"
            ],
            [
                "id" => "26",
                "province_id" => 3,
                "name_en" => "Ghorband",
                "name_dr" => "غوربند"
            ],
            [
                "id" => "27",
                "province_id" => 3,
                "name_en" => "Shikh Ali",
                "name_dr" => "شيخ علي"
            ],
            [
                "id" => "28",
                "province_id" => 3,
                "name_en" => "Surkh Parsa",
                "name_dr" => "سُرخ پارسا"
            ],
            [
                "id" => "29",
                "province_id" => 3,
                "name_en" => "Bagram",
                "name_dr" => "بگرام"
            ],
            [
                "id" => "30",
                "province_id" => 3,
                "name_en" => "Koh i Safi",
                "name_dr" => "کوه صافي"
            ],
            [
                "id" => "31",
                "province_id" => 3,
                "name_en" => "Sayed Khail",
                "name_dr" => "سيد خيل"
            ],
            [
                "id" => "32",
                "province_id" => 4,
                "name_en" => "Maidan Shahr",
                "name_dr" => "ميدان شهر"
            ],
            [
                "id" => "33",
                "province_id" => 4,
                "name_en" => "Jalreez",
                "name_dr" => "جلريز"
            ],
            [
                "id" => "34",
                "province_id" => 4,
                "name_en" => "Hisa i Awal i Behsud",
                "name_dr" => "حصه اول  بهسود"
            ],
            [
                "id" => "35",
                "province_id" => 4,
                "name_en" => "Markaz Behsud",
                "name_dr" => " مرکز بهسود"
            ],
            [
                "id" => "36",
                "province_id" => 4,
                "name_en" => "Dai Mirdad",
                "name_dr" => "دايمير داد"
            ],
            [
                "id" => "37",
                "province_id" => 4,
                "name_en" => "Sayed Abad",
                "name_dr" => "سيد آباد"
            ],
            [
                "id" => "38",
                "province_id" => 4,
                "name_en" => "Nirkh",
                "name_dr" => "نرخ"
            ],
            [
                "id" => "39",
                "province_id" => 4,
                "name_en" => "Jaghato",
                "name_dr" => "جغتو"
            ],
            [
                "id" => "40",
                "province_id" => 4,
                "name_en" => "Chak",
                "name_dr" => "چک"
            ],
            [
                "id" => "41",
                "province_id" => 4,
                "name_en" => "Jalga",
                "name_dr" => "جلگه"
            ],
            [
                "id" => "42",
                "province_id" => 5,
                "name_en" => "Pul i Alam Kulangar",
                "name_dr" => "پل علم   کلنگار "
            ],
            [
                "id" => "43",
                "province_id" => 5,
                "name_en" => "Charkh",
                "name_dr" => "چرخ"
            ],
            [
                "id" => "44",
                "province_id" => 5,
                "name_en" => "Baraki Barak",
                "name_dr" => "بره کي برک"
            ],
            [
                "id" => "45",
                "province_id" => 5,
                "name_en" => "Khoshi",
                "name_dr" => "خوشي"
            ],
            [
                "id" => "46",
                "province_id" => 5,
                "name_en" => "Mohammad Agha",
                "name_dr" => "محمد آغه"
            ],
            [
                "id" => "47",
                "province_id" => 5,
                "name_en" => "Kharwar",
                "name_dr" => "خروار"
            ],
            [
                "id" => "48",
                "province_id" => 5,
                "name_en" => "Azra",
                "name_dr" => "ازره"
            ],
            [
                "id" => "49",
                "province_id" => 6,
                "name_en" => "Ghazni",
                "name_dr" => "غزني"
            ],
            [
                "id" => "50",
                "province_id" => 6,
                "name_en" => "Jaghato",
                "name_dr" => "جغتو"
            ],
            [
                "id" => "51",
                "province_id" => 6,
                "name_en" => "Nahor",
                "name_dr" => "ناهور"
            ],
            [
                "id" => "52",
                "province_id" => 6,
                "name_en" => "Ajristan",
                "name_dr" => "اجرستان"
            ],
            [
                "id" => "53",
                "province_id" => 6,
                "name_en" => "Malistan",
                "name_dr" => "مالستان"
            ],
            [
                "id" => "54",
                "province_id" => 6,
                "name_en" => "Jaghori",
                "name_dr" => "جاغوري"
            ],
            [
                "id" => "55",
                "province_id" => 6,
                "name_en" => "Muqur",
                "name_dr" => "مقر"
            ],
            [
                "id" => "56",
                "province_id" => 6,
                "name_en" => "Gilan",
                "name_dr" => "گيلان"
            ],
            [
                "id" => "57",
                "province_id" => 6,
                "name_en" => "Nawa",
                "name_dr" => "ناوه"
            ],
            [
                "id" => "58",
                "province_id" => 6,
                "name_en" => "Ab Band",
                "name_dr" => "آب بند"
            ],
            [
                "id" => "59",
                "province_id" => 6,
                "name_en" => "Giro",
                "name_dr" => "گيرو"
            ],
            [
                "id" => "60",
                "province_id" => 6,
                "name_en" => "Qara Bagh",
                "name_dr" => "قره باغ"
            ],
            [
                "id" => "61",
                "province_id" => 6,
                "name_en" => "Andar",
                "name_dr" => "اندړ"
            ],
            [
                "id" => "62",
                "province_id" => 6,
                "name_en" => "Deh Yak",
                "name_dr" => "ده يک"
            ],
            [
                "id" => "63",
                "province_id" => 6,
                "name_en" => "Zana Khan",
                "name_dr" => "زنه خان"
            ],
            [
                "id" => "64",
                "province_id" => 6,
                "name_en" => "Waghaz",
                "name_dr" => "واغظ"
            ],
            [
                "id" => "65",
                "province_id" => 6,
                "name_en" => "KhogyaniWali Mohammad Shahid",
                "name_dr" => "خوگياني ولی محمد شهید"
            ],
            [
                "id" => "66",
                "province_id" => 6,
                "name_en" => "Rashidan",
                "name_dr" => "رشيدان"
            ],
            [
                "id" => "67",
                "province_id" => 6,
                "name_en" => "Khawaja Umari",
                "name_dr" => "خواجه عمري"
            ],
            [
                "id" => "68",
                "province_id" => 7,
                "name_en" => "Gardeez",
                "name_dr" => "گرديز"
            ],
            [
                "id" => "69",
                "province_id" => 7,
                "name_en" => "Zurmat",
                "name_dr" => "زرمت"
            ],
            [
                "id" => "70",
                "province_id" => 7,
                "name_en" => "Shawak",
                "name_dr" => "شواک"
            ],
            [
                "id" => "71",
                "province_id" => 7,
                "name_en" => "Wazi Zadran",
                "name_dr" => "وزی ځدران"
            ],
            [
                "id" => "72",
                "province_id" => 7,
                "name_en" => "Dand Pattan",
                "name_dr" => "دند پټان"
            ],
            [
                "id" => "73",
                "province_id" => 7,
                "name_en" => "Laja wa Mangal",
                "name_dr" => "لجه منگل"
            ],
            [
                "id" => "74",
                "province_id" => 7,
                "name_en" => "Jani Khail Mangal",
                "name_dr" => "جاني خيل منگل"
            ],
            [
                "id" => "75",
                "province_id" => 7,
                "name_en" => "Samkani",
                "name_dr" => "څمكني"
            ],
            [
                "id" => "76",
                "province_id" => 7,
                "name_en" => "Laja Ahmad Khail",
                "name_dr" => "لجه احمد خيل"
            ],
            [
                "id" => "77",
                "province_id" => 7,
                "name_en" => "Sayed Karam",
                "name_dr" => "سيد کرم"
            ],
            [
                "id" => "78",
                "province_id" => 7,
                "name_en" => "Jaji Aryob",
                "name_dr" => "ځاځي  آريوب"
            ],
            [
                "id" => "79",
                "province_id" => 7,
                "name_en" => "Road Ahmad Abad",
                "name_dr" => "رود احمد آبا"
            ],
            [
                "id" => "80",
                "province_id" => 7,
                "name_en" => "Gerda Serai",
                "name_dr" => "گرده څيړي"
            ],
            [
                "id" => "81",
                "province_id" => 7,
                "name_en" => "Mirzakah",
                "name_dr" => "میرزاکا"
            ],
            [
                "id" => "82",
                "province_id" => 8,
                "name_en" => "Jalalabad",
                "name_dr" => "جلال آباد"
            ],
            [
                "id" => "83",
                "province_id" => 8,
                "name_en" => "Surkhrud",
                "name_dr" => "سرخرود"
            ],
            [
                "id" => "84",
                "province_id" => 8,
                "name_en" => "Hisarak",
                "name_dr" => "حصارک"
            ],
            [
                "id" => "85",
                "province_id" => 8,
                "name_en" => "Shirzad",
                "name_dr" => "شيرازد"
            ],
            [
                "id" => "86",
                "province_id" => 8,
                "name_en" => "Khogyani",
                "name_dr" => "خوگياني"
            ],
            [
                "id" => "87",
                "province_id" => 8,
                "name_en" => "Chaparhar",
                "name_dr" => "چپرهار"
            ],
            [
                "id" => "88",
                "province_id" => 8,
                "name_en" => "Pachir wa Agam",
                "name_dr" => "پچير و اگام"
            ],
            [
                "id" => "89",
                "province_id" => 8,
                "name_en" => "Rudat",
                "name_dr" => "رودات"
            ],
            [
                "id" => "90",
                "province_id" => 8,
                "name_en" => "Achin",
                "name_dr" => "اچين"
            ],
            [
                "id" => "91",
                "province_id" => 8,
                "name_en" => "Naziyan",
                "name_dr" => "نازيان"
            ],
            [
                "id" => "92",
                "province_id" => 8,
                "name_en" => "Door Baba",
                "name_dr" => "دور بابا"
            ],
            [
                "id" => "93",
                "province_id" => 8,
                "name_en" => "Shinwar Ghani Khail",
                "name_dr" => "شينوار غني خيل "
            ],
            [
                "id" => "94",
                "province_id" => 8,
                "name_en" => "Mohmand Dara",
                "name_dr" => "مهمند دره"
            ],
            [
                "id" => "95",
                "province_id" => 8,
                "name_en" => "Lal Pur",
                "name_dr" => "لعل پور"
            ],
            [
                "id" => "96",
                "province_id" => 8,
                "name_en" => "Goshta",
                "name_dr" => "گوشته"
            ],
            [
                "id" => "97",
                "province_id" => 8,
                "name_en" => "Bati Kot",
                "name_dr" => "بټي كوټ"
            ],
            [
                "id" => "98",
                "province_id" => 8,
                "name_en" => "Kama",
                "name_dr" => "کامه"
            ],
            [
                "id" => "99",
                "province_id" => 8,
                "name_en" => "Dara i Noor",
                "name_dr" => "دره نور"
            ],
            [
                "id" => "100",
                "province_id" => 8,
                "name_en" => "Koz Kunar Khiwa",
                "name_dr" => "کوزکنړ خيوه"
            ],
            [
                "id" => "101",
                "province_id" => 8,
                "name_en" => "Deh Bala Haska Mina",
                "name_dr" => "ده بالاهسکه مينه"
            ],
            [
                "id" => "102",
                "province_id" => 8,
                "name_en" => "Behsud",
                "name_dr" => "بهسود"
            ],
            [
                "id" => "103",
                "province_id" => 8,
                "name_en" => "Kot",
                "name_dr" => "كوټ"
            ],
            [
                "id" => "104",
                "province_id" => 8,
                "name_en" => "Spin Ghar",
                "name_dr" => "سپین غر"
            ],
            [
                "id" => "105",
                "province_id" => 9,
                "name_en" => "Mehtarlam Baba",
                "name_dr" => "مهترلام"
            ],
            [
                "id" => "106",
                "province_id" => 9,
                "name_en" => "Qarghayee",
                "name_dr" => "قرغه يي"
            ],
            [
                "id" => "107",
                "province_id" => 9,
                "name_en" => "Alinigar",
                "name_dr" => "علينگار"
            ],
            [
                "id" => "108",
                "province_id" => 9,
                "name_en" => "Dawlat Shah",
                "name_dr" => "دولت شاه"
            ],
            [
                "id" => "109",
                "province_id" => 9,
                "name_en" => "Alishing",
                "name_dr" => "عليشنگ"
            ],
            [
                "id" => "110",
                "province_id" => 9,
                "name_en" => "Badpakh",
                "name_dr" => "بادپښ"
            ],
            [
                "id" => "111",
                "province_id" => 10,
                "name_en" => "Asad Abad",
                "name_dr" => "اسعد آباد"
            ],
            [
                "id" => "112",
                "province_id" => 10,
                "name_en" => "Marawara",
                "name_dr" => "مروره"
            ],
            [
                "id" => "113",
                "province_id" => 10,
                "name_en" => "Dangam",
                "name_dr" => "دانگام"
            ],
            [
                "id" => "114",
                "province_id" => 10,
                "name_en" => "Nari",
                "name_dr" => "ناړي"
            ],
            [
                "id" => "115",
                "province_id" => 10,
                "name_en" => "Wata Purta",
                "name_dr" => "وته پور"
            ],
            [
                "id" => "116",
                "province_id" => 10,
                "name_en" => "Chapa Dara",
                "name_dr" => "چپه دره"
            ],
            [
                "id" => "117",
                "province_id" => 10,
                "name_en" => "Dara i Paich",
                "name_dr" => "درهُ پيچ"
            ],
            [
                "id" => "118",
                "province_id" => 10,
                "name_en" => "Narang",
                "name_dr" => "نرنگ"
            ],
            [
                "id" => "119",
                "province_id" => 10,
                "name_en" => "Sawkai",
                "name_dr" => "څوكي"
            ],
            [
                "id" => "120",
                "province_id" => 10,
                "name_en" => "Noor Gul",
                "name_dr" => "نورگل"
            ],
            [
                "id" => "121",
                "province_id" => 10,
                "name_en" => "Khas Kunar",
                "name_dr" => "خاص کنړ"
            ],
            [
                "id" => "122",
                "province_id" => 10,
                "name_en" => "Sar Kani",
                "name_dr" => "سركاڼي"
            ],
            [
                "id" => "123",
                "province_id" => 10,
                "name_en" => "Sheegal Sheltan",
                "name_dr" => "شيگل شلتن"
            ],
            [
                "id" => "124",
                "province_id" => 10,
                "name_en" => "Asmar Bar Kunar",
                "name_dr" => "برکنړ اسمار"
            ],
            [
                "id" => "125",
                "province_id" => 10,
                "name_en" => "Ghazi Abad",
                "name_dr" => "غازي آباد"
            ],
            [
                "id" => "126",
                "province_id" => 11,
                "name_en" => "Tagab",
                "name_dr" => "تگاب"
            ],
            [
                "id" => "127",
                "province_id" => 11,
                "name_en" => "Faiz Abad",
                "name_dr" => "فيض آباد"
            ],
            [
                "id" => "128",
                "province_id" => 11,
                "name_en" => "Kishm",
                "name_dr" => "کشم"
            ],
            [
                "id" => "129",
                "province_id" => 11,
                "name_en" => "Jurm",
                "name_dr" => "جرم"
            ],
            [
                "id" => "130",
                "province_id" => 11,
                "name_en" => "Kiran wa Munjan",
                "name_dr" => "کران و منجان"
            ],
            [
                "id" => "131",
                "province_id" => 11,
                "name_en" => "Zebak",
                "name_dr" => "زيباک"
            ],
            [
                "id" => "132",
                "province_id" => 11,
                "name_en" => "Wakhan",
                "name_dr" => "واخان"
            ],
            [
                "id" => "133",
                "province_id" => 11,
                "name_en" => "Ishkashim",
                "name_dr" => "اشکاشم"
            ],
            [
                "id" => "134",
                "province_id" => 11,
                "name_en" => "Baharak",
                "name_dr" => "بهارک"
            ],
            [
                "id" => "135",
                "province_id" => 11,
                "name_en" => "Shighnan",
                "name_dr" => "شغنان"
            ],
            [
                "id" => "136",
                "province_id" => 11,
                "name_en" => "Darwaz",
                "name_dr" => "درواز"
            ],
            [
                "id" => "137",
                "province_id" => 11,
                "name_en" => "Khawahan",
                "name_dr" => "خواهان"
            ],
            [
                "id" => "138",
                "province_id" => 11,
                "name_en" => "Raghistan",
                "name_dr" => "راغستان"
            ],
            [
                "id" => "139",
                "province_id" => 11,
                "name_en" => "Shahr i Buzurg",
                "name_dr" => "شهربزرگ"
            ],
            [
                "id" => "140",
                "province_id" => 11,
                "name_en" => "Khash",
                "name_dr" => "خاش"
            ],
            [
                "id" => "141",
                "province_id" => 11,
                "name_en" => "Yawan",
                "name_dr" => "ياوان"
            ],
            [
                "id" => "142",
                "province_id" => 11,
                "name_en" => "Nasi",
                "name_dr" => "نسي"
            ],
            [
                "id" => "143",
                "province_id" => 11,
                "name_en" => "Argo",
                "name_dr" => "ارگو "
            ],
            [
                "id" => "144",
                "province_id" => 11,
                "name_en" => "Drayem",
                "name_dr" => "درائم"
            ],
            [
                "id" => "145",
                "province_id" => 11,
                "name_en" => "Wardoj",
                "name_dr" => "وردوج"
            ],
            [
                "id" => "146",
                "province_id" => 11,
                "name_en" => "Tashkan",
                "name_dr" => "تشکان"
            ],
            [
                "id" => "147",
                "province_id" => 11,
                "name_en" => "Yamgan Girwan",
                "name_dr" => "يمگان گیروان"
            ],
            [
                "id" => "148",
                "province_id" => 11,
                "name_en" => "Shuhada ZarDew Sarghilan",
                "name_dr" => "شهدا زردیو و سر غیلان"
            ],
            [
                "id" => "149",
                "province_id" => 11,
                "name_en" => "Yaftal Bala wa Payan",
                "name_dr" => "يفتل  بالا پايان"
            ],
            [
                "id" => "150",
                "province_id" => 11,
                "name_en" => "Darwaz i Bala",
                "name_dr" => "درواز بالا"
            ],
            [
                "id" => "151",
                "province_id" => 11,
                "name_en" => "Kof Ab",
                "name_dr" => "کوف آب"
            ],
            [
                "id" => "152",
                "province_id" => 11,
                "name_en" => "Sheki",
                "name_dr" => "شکي"
            ],
            [
                "id" => "153",
                "province_id" => 11,
                "name_en" => "Arghang Khwah",
                "name_dr" => "ارغنج خواه"
            ],
            [
                "id" => "154",
                "province_id" => 11,
                "name_en" => "Kohistan",
                "name_dr" => "کوهستان"
            ],
            [
                "id" => "155",
                "province_id" => 11,
                "name_en" => "Darwazi Payeen Mayemi",
                "name_dr" => "درواز پایین مایمی"
            ],
            [
                "id" => "156",
                "province_id" => 12,
                "name_en" => "Taliqan",
                "name_dr" => "تالقان"
            ],
            [
                "id" => "157",
                "province_id" => 12,
                "name_en" => "Bangi",
                "name_dr" => "بنگي"
            ],
            [
                "id" => "158",
                "province_id" => 12,
                "name_en" => "Ishkamish",
                "name_dr" => "اشکمش"
            ],
            [
                "id" => "159",
                "province_id" => 12,
                "name_en" => "Chal",
                "name_dr" => "چال"
            ],
            [
                "id" => "160",
                "province_id" => 12,
                "name_en" => "Warsaj",
                "name_dr" => "ورسج"
            ],
            [
                "id" => "161",
                "province_id" => 12,
                "name_en" => "Farkhar",
                "name_dr" => "فرخار"
            ],
            [
                "id" => "162",
                "province_id" => 12,
                "name_en" => "Kalafgan",
                "name_dr" => "کلفگان"
            ],
            [
                "id" => "163",
                "province_id" => 12,
                "name_en" => "Rustaq",
                "name_dr" => "رستاق "
            ],
            [
                "id" => "164",
                "province_id" => 12,
                "name_en" => "Chah i Ab",
                "name_dr" => "چاه آب"
            ],
            [
                "id" => "165",
                "province_id" => 12,
                "name_en" => "Yangi Qala",
                "name_dr" => "ينگي قلعه"
            ],
            [
                "id" => "166",
                "province_id" => 12,
                "name_en" => "Dar Qad",
                "name_dr" => "درقد"
            ],
            [
                "id" => "167",
                "province_id" => 12,
                "name_en" => "Khwaja Ghar",
                "name_dr" => "خواجه غار"
            ],
            [
                "id" => "168",
                "province_id" => 12,
                "name_en" => "Khwaja Bahawoddin",
                "name_dr" => "خواجه بهاوالدين"
            ],
            [
                "id" => "169",
                "province_id" => 12,
                "name_en" => "Dasht Qala",
                "name_dr" => "دشت قلعه"
            ],
            [
                "id" => "170",
                "province_id" => 12,
                "name_en" => "Baharak",
                "name_dr" => "بهارک"
            ],
            [
                "id" => "171",
                "province_id" => 12,
                "name_en" => "Namak Ab",
                "name_dr" => "نمک آب"
            ],
            [
                "id" => "172",
                "province_id" => 12,
                "name_en" => "Hazar Sumuch",
                "name_dr" => "هزار سمچ"
            ],
            [
                "id" => "173",
                "province_id" => 13,
                "name_en" => "Puli Khomri",
                "name_dr" => "پلخمري"
            ],
            [
                "id" => "174",
                "province_id" => 13,
                "name_en" => "Dahana i Ghori",
                "name_dr" => "دهنه غوري"
            ],
            [
                "id" => "175",
                "province_id" => 13,
                "name_en" => "Doshi",
                "name_dr" => "دوشي"
            ],
            [
                "id" => "176",
                "province_id" => 13,
                "name_en" => "Tala wa Barfak",
                "name_dr" => "تاله و برفک"
            ],
            [
                "id" => "177",
                "province_id" => 13,
                "name_en" => "Khinjan",
                "name_dr" => "خنجان"
            ],
            [
                "id" => "178",
                "province_id" => 13,
                "name_en" => "Andarab",
                "name_dr" => "اندراب"
            ],
            [
                "id" => "179",
                "province_id" => 13,
                "name_en" => "Khost",
                "name_dr" => "خوست"
            ],
            [
                "id" => "180",
                "province_id" => 13,
                "name_en" => "Nahreen",
                "name_dr" => "نهرين"
            ],
            [
                "id" => "181",
                "province_id" => 13,
                "name_en" => "Booraka",
                "name_dr" => "بورکه"
            ],
            [
                "id" => "182",
                "province_id" => 13,
                "name_en" => "Baghalan i Jadid",
                "name_dr" => "بغلان جديد"
            ],
            [
                "id" => "183",
                "province_id" => 13,
                "name_en" => "Khwaja Hijran Jalga Nahrin",
                "name_dr" => "خواجه هجران جلگه نهرین"
            ],
            [
                "id" => "184",
                "province_id" => 13,
                "name_en" => "Deh Salah",
                "name_dr" => "ده صلاح"
            ],
            [
                "id" => "185",
                "province_id" => 13,
                "name_en" => "Fereng",
                "name_dr" => "فرنگ"
            ],
            [
                "id" => "186",
                "province_id" => 13,
                "name_en" => "Pul i Hisar",
                "name_dr" => "پل حصار"
            ],
            [
                "id" => "187",
                "province_id" => 13,
                "name_en" => "Guzargah i Noor",
                "name_dr" => "گذر گاه نور"
            ],
            [
                "id" => "188",
                "province_id" => 14,
                "name_en" => "Kunduz",
                "name_dr" => "کندز"
            ],
            [
                "id" => "189",
                "province_id" => 14,
                "name_en" => "Imam Sahib",
                "name_dr" => "امام صاحب"
            ],
            [
                "id" => "190",
                "province_id" => 14,
                "name_en" => "Qala i Zal",
                "name_dr" => "قلعه زال"
            ],
            [
                "id" => "191",
                "province_id" => 14,
                "name_en" => "Chahar Dara",
                "name_dr" => "چهاردره"
            ],
            [
                "id" => "192",
                "province_id" => 14,
                "name_en" => "Ali Abad",
                "name_dr" => "علي آباد"
            ],
            [
                "id" => "193",
                "province_id" => 14,
                "name_en" => "Khan Abad",
                "name_dr" => "خان اباد"
            ],
            [
                "id" => "194",
                "province_id" => 14,
                "name_en" => "Dasht Archi",
                "name_dr" => "دشت ارچي"
            ],
            [
                "id" => "195",
                "province_id" => 14,
                "name_en" => "Kalbad",
                "name_dr" => "کلباد"
            ],
            [
                "id" => "196",
                "province_id" => 14,
                "name_en" => "Gul Tipa",
                "name_dr" => "گل تیپه"
            ],
            [
                "id" => "197",
                "province_id" => 14,
                "name_en" => "Aftash",
                "name_dr" => "افتاش"
            ],
            [
                "id" => "198",
                "province_id" => 15,
                "name_en" => "Aybak",
                "name_dr" => "آيبک"
            ],
            [
                "id" => "199",
                "province_id" => 15,
                "name_en" => "Hazrat Sultan",
                "name_dr" => "حضرت سلطان"
            ],
            [
                "id" => "200",
                "province_id" => 15,
                "name_en" => "Dara i Suf Bala",
                "name_dr" => "دره صوف بالا"
            ],
            [
                "id" => "201",
                "province_id" => 15,
                "name_en" => "Dara i Suf i Payan",
                "name_dr" => "دره صوف پائين"
            ],
            [
                "id" => "202",
                "province_id" => 15,
                "name_en" => "Roy do Ab",
                "name_dr" => "روي دوآب"
            ],
            [
                "id" => "203",
                "province_id" => 15,
                "name_en" => "Khuram wa Sarbagh",
                "name_dr" => "خرم سارباغ"
            ],
            [
                "id" => "204",
                "province_id" => 15,
                "name_en" => "Feeroz Nakhcheer",
                "name_dr" => "فيروز نخچير"
            ],
            [
                "id" => "205",
                "province_id" => 16,
                "name_en" => "Mazar Sharif",
                "name_dr" => "مزار شریف"
            ],
            [
                "id" => "206",
                "province_id" => 16,
                "name_en" => "Nahri Shahi",
                "name_dr" => "نهرشاهي"
            ],
            [
                "id" => "207",
                "province_id" => 16,
                "name_en" => "Shor Teepa",
                "name_dr" => "شورتپه"
            ],
            [
                "id" => "208",
                "province_id" => 16,
                "name_en" => "Dawlat Abad",
                "name_dr" => "دولت آباد"
            ],
            [
                "id" => "209",
                "province_id" => 16,
                "name_en" => "Balkh",
                "name_dr" => "بلخ"
            ],
            [
                "id" => "210",
                "province_id" => 16,
                "name_en" => "Char Boolak",
                "name_dr" => "چاربولک"
            ],
            [
                "id" => "211",
                "province_id" => 16,
                "name_en" => "Chamtal",
                "name_dr" => "چمتال"
            ],
            [
                "id" => "212",
                "province_id" => 16,
                "name_en" => "Sholgara",
                "name_dr" => "شولگره"
            ],
            [
                "id" => "213",
                "province_id" => 16,
                "name_en" => "Kishindeh",
                "name_dr" => "کشنده"
            ],
            [
                "id" => "214",
                "province_id" => 16,
                "name_en" => "Char Kent",
                "name_dr" => "چارکنت"
            ],
            [
                "id" => "215",
                "province_id" => 16,
                "name_en" => "Deh Dadi",
                "name_dr" => "دهدادي"
            ],
            [
                "id" => "216",
                "province_id" => 16,
                "name_en" => "Kaldar",
                "name_dr" => "کلدار"
            ],
            [
                "id" => "217",
                "province_id" => 16,
                "name_en" => "Khulm",
                "name_dr" => "خلم"
            ],
            [
                "id" => "218",
                "province_id" => 16,
                "name_en" => "Marmul",
                "name_dr" => "مارمل"
            ],
            [
                "id" => "219",
                "province_id" => 16,
                "name_en" => "Hayratan",
                "name_dr" => "حيرتان"
            ],
            [
                "id" => "220",
                "province_id" => 16,
                "name_en" => "Chahi",
                "name_dr" => "چاهي"
            ],
            [
                "id" => "221",
                "province_id" => 16,
                "name_en" => "Zari",
                "name_dr" => "زارع"
            ],
            [
                "id" => "222",
                "province_id" => 16,
                "name_en" => "Alburz",
                "name_dr" => "البرز"
            ],
            [
                "id" => "223",
                "province_id" => 17,
                "name_en" => "Shibirghan",
                "name_dr" => "شبرغان"
            ],
            [
                "id" => "224",
                "province_id" => 17,
                "name_en" => "Khawaja Do Koh",
                "name_dr" => "خواجه دوکوه"
            ],
            [
                "id" => "225",
                "province_id" => 17,
                "name_en" => "Darz Ab",
                "name_dr" => "درزآب"
            ],
            [
                "id" => "226",
                "province_id" => 17,
                "name_en" => "Mardeyan",
                "name_dr" => "مرديان"
            ],
            [
                "id" => "227",
                "province_id" => 17,
                "name_en" => "Qarqeen",
                "name_dr" => "قرقين"
            ],
            [
                "id" => "228",
                "province_id" => 17,
                "name_en" => "Aaqcha",
                "name_dr" => "آقچه"
            ],
            [
                "id" => "229",
                "province_id" => 17,
                "name_en" => "Mengajik wa Ferari",
                "name_dr" => "منکچک وفراري"
            ],
            [
                "id" => "230",
                "province_id" => 17,
                "name_en" => "Faiz Abad",
                "name_dr" => "فيض آباد"
            ],
            [
                "id" => "231",
                "province_id" => 17,
                "name_en" => "Khamyab",
                "name_dr" => "خمياب"
            ],
            [
                "id" => "232",
                "province_id" => 17,
                "name_en" => "Qush Tipa",
                "name_dr" => "قوش تیپه"
            ],
            [
                "id" => "233",
                "province_id" => 17,
                "name_en" => "Khaniqa",
                "name_dr" => "خانقاه"
            ],
            [
                "id" => "234",
                "province_id" => 18,
                "name_en" => "Maimana",
                "name_dr" => "ميمنه"
            ],
            [
                "id" => "235",
                "province_id" => 18,
                "name_en" => "Pashtun Kot",
                "name_dr" => "پشتون کوت"
            ],
            [
                "id" => "236",
                "province_id" => 18,
                "name_en" => "Almar",
                "name_dr" => "المار"
            ],
            [
                "id" => "237",
                "province_id" => 18,
                "name_en" => "Qaisar",
                "name_dr" => "قيصار"
            ],
            [
                "id" => "238",
                "province_id" => 18,
                "name_en" => "Kohistan",
                "name_dr" => "کوهستان"
            ],
            [
                "id" => "239",
                "province_id" => 18,
                "name_en" => "Belcheragh",
                "name_dr" => "بلچراغ"
            ],
            [
                "id" => "240",
                "province_id" => 18,
                "name_en" => "Garzeewan",
                "name_dr" => "گرزيوان"
            ],
            [
                "id" => "241",
                "province_id" => 18,
                "name_en" => "Shirin Tagab",
                "name_dr" => "شيرين تگاب"
            ],
            [
                "id" => "242",
                "province_id" => 18,
                "name_en" => "Dawlat Abad",
                "name_dr" => "دولت آباد"
            ],
            [
                "id" => "243",
                "province_id" => 18,
                "name_en" => "Qaramqol",
                "name_dr" => "قرمقول"
            ],
            [
                "id" => "244",
                "province_id" => 18,
                "name_en" => "Khan Charbagh",
                "name_dr" => "خان چارباغ"
            ],
            [
                "id" => "245",
                "province_id" => 18,
                "name_en" => "And Khoy",
                "name_dr" => "اندخوي"
            ],
            [
                "id" => "246",
                "province_id" => 18,
                "name_en" => "Khwaja Sabz Posh",
                "name_dr" => "خواجه سبز پوش"
            ],
            [
                "id" => "247",
                "province_id" => 18,
                "name_en" => "Qarghan",
                "name_dr" => "قرغان"
            ],
            [
                "id" => "248",
                "province_id" => 18,
                "name_en" => "Ghormach",
                "name_dr" => "غورماچ"
            ],
            [
                "id" => "249",
                "province_id" => 19,
                "name_en" => "Qala i Now",
                "name_dr" => "قلعه نو"
            ],
            [
                "id" => "250",
                "province_id" => 19,
                "name_en" => "Ab Kamari",
                "name_dr" => "آب کمري"
            ],
            [
                "id" => "251",
                "province_id" => 19,
                "name_en" => "Qadis",
                "name_dr" => "قادس"
            ],
            [
                "id" => "252",
                "province_id" => 19,
                "name_en" => "Jawand",
                "name_dr" => "جوند"
            ],
            [
                "id" => "253",
                "province_id" => 19,
                "name_en" => "Murghab",
                "name_dr" => "مرغاب"
            ],
            [
                "id" => "254",
                "province_id" => 19,
                "name_en" => "Muqur",
                "name_dr" => "مقر"
            ],
            [
                "id" => "255",
                "province_id" => 20,
                "name_en" => "Herat",
                "name_dr" => "هرات"
            ],
            [
                "id" => "256",
                "province_id" => 20,
                "name_en" => "Injil",
                "name_dr" => "انجيل"
            ],
            [
                "id" => "257",
                "province_id" => 20,
                "name_en" => "Guzara",
                "name_dr" => "گذره"
            ],
            [
                "id" => "258",
                "province_id" => 20,
                "name_en" => "Pashtoon Zarghoon",
                "name_dr" => "پشتون زرغون"
            ],
            [
                "id" => "259",
                "province_id" => 20,
                "name_en" => "Kurkh",
                "name_dr" => "کرخ"
            ],
            [
                "id" => "260",
                "province_id" => 20,
                "name_en" => "Gulran",
                "name_dr" => "گلران"
            ],
            [
                "id" => "261",
                "province_id" => 20,
                "name_en" => "Kuhsan",
                "name_dr" => "کهسان"
            ],
            [
                "id" => "262",
                "province_id" => 20,
                "name_en" => "Ghoreyan",
                "name_dr" => "غوريان"
            ],
            [
                "id" => "263",
                "province_id" => 20,
                "name_en" => "Zenda Jan",
                "name_dr" => "زنده جان"
            ],
            [
                "id" => "264",
                "province_id" => 20,
                "name_en" => "Adreskan",
                "name_dr" => "ادرسکن"
            ],
            [
                "id" => "265",
                "province_id" => 20,
                "name_en" => "Oba",
                "name_dr" => "اوبه"
            ],
            [
                "id" => "266",
                "province_id" => 20,
                "name_en" => "Farsi",
                "name_dr" => "فرسي"
            ],
            [
                "id" => "267",
                "province_id" => 20,
                "name_en" => "Shindand",
                "name_dr" => "شيندند"
            ],
            [
                "id" => "268",
                "province_id" => 20,
                "name_en" => "Chesht i Sharif",
                "name_dr" => "چشت شريف"
            ],
            [
                "id" => "269",
                "province_id" => 20,
                "name_en" => "Kushk i Kuhna",
                "name_dr" => "کشک کهنه"
            ],
            [
                "id" => "270",
                "province_id" => 20,
                "name_en" => "Kushk Rubatak i Sangi",
                "name_dr" => "کشک رباط سنگي"
            ],
            [
                "id" => "271",
                "province_id" => 20,
                "name_en" => "Zir Koh",
                "name_dr" => "زیرکوه"
            ],
            [
                "id" => "272",
                "province_id" => 20,
                "name_en" => "Poht e Koh",
                "name_dr" => "پشت کوه"
            ],
            [
                "id" => "273",
                "province_id" => 20,
                "name_en" => "Koh Zor",
                "name_dr" => "کوه زور"
            ],
            [
                "id" => "274",
                "province_id" => 20,
                "name_en" => "Zawal",
                "name_dr" => "زاول"
            ],
            [
                "id" => "275",
                "province_id" => 21,
                "name_en" => "Farah",
                "name_dr" => "فرا ه"
            ],
            [
                "id" => "276",
                "province_id" => 21,
                "name_en" => "Bakwa",
                "name_dr" => "بکواه"
            ],
            [
                "id" => "277",
                "province_id" => 21,
                "name_en" => "Gulistan",
                "name_dr" => "گلستان"
            ],
            [
                "id" => "278",
                "province_id" => 21,
                "name_en" => "Purchaman",
                "name_dr" => "پرچمن"
            ],
            [
                "id" => "279",
                "province_id" => 21,
                "name_en" => "Bala Buluk",
                "name_dr" => "بالا بلوک"
            ],
            [
                "id" => "280",
                "province_id" => 21,
                "name_en" => "Khak i Safid",
                "name_dr" => "خاک سفيد"
            ],
            [
                "id" => "281",
                "province_id" => 21,
                "name_en" => "Anar Dara",
                "name_dr" => "اناردره"
            ],
            [
                "id" => "282",
                "province_id" => 21,
                "name_en" => "Pusht koh Qala i Kah",
                "name_dr" => "پشت کوه قلعه کاه"
            ],
            [
                "id" => "283",
                "province_id" => 21,
                "name_en" => "Lash Jowayn",
                "name_dr" => "لاش جوين"
            ],
            [
                "id" => "284",
                "province_id" => 21,
                "name_en" => "Shib Koh Qala i Kah",
                "name_dr" => "شيب کوه قلعه کاه"
            ],
            [
                "id" => "285",
                "province_id" => 21,
                "name_en" => "Pusht i Road",
                "name_dr" => "پشترود"
            ],
            [
                "id" => "286",
                "province_id" => 22,
                "name_en" => "Zaranj",
                "name_dr" => "زرنج"
            ],
            [
                "id" => "287",
                "province_id" => 22,
                "name_en" => "Kung",
                "name_dr" => "کنگ"
            ],
            [
                "id" => "288",
                "province_id" => 22,
                "name_en" => "Char Burjak",
                "name_dr" => "چاربرجک"
            ],
            [
                "id" => "289",
                "province_id" => 22,
                "name_en" => "Chakhansur",
                "name_dr" => "چخانسور"
            ],
            [
                "id" => "290",
                "province_id" => 22,
                "name_en" => "Khashroad",
                "name_dr" => "خاشرود"
            ],
            [
                "id" => "291",
                "province_id" => 22,
                "name_en" => "Dilaram",
                "name_dr" => "دلارام"
            ],
            [
                "id" => "292",
                "province_id" => 23,
                "name_en" => "Nawa Mesh",
                "name_dr" => "ناوه میش"
            ],
            [
                "id" => "293",
                "province_id" => 23,
                "name_en" => "Lashkargah",
                "name_dr" => "لشکر گاه"
            ],
            [
                "id" => "294",
                "province_id" => 23,
                "name_en" => "Kajaki",
                "name_dr" => "کجکي"
            ],
            [
                "id" => "295",
                "province_id" => 23,
                "name_en" => "Musa Qala",
                "name_dr" => "موسي قلعه"
            ],
            [
                "id" => "296",
                "province_id" => 23,
                "name_en" => "Baghran",
                "name_dr" => "باغران"
            ],
            [
                "id" => "297",
                "province_id" => 23,
                "name_en" => "Nawa Barakzayee",
                "name_dr" => "ناوه بارکزايي"
            ],
            [
                "id" => "298",
                "province_id" => 23,
                "name_en" => "Washir",
                "name_dr" => "واشير"
            ],
            [
                "id" => "299",
                "province_id" => 23,
                "name_en" => "Nad Ali",
                "name_dr" => "نادعلي"
            ],
            [
                "id" => "300",
                "province_id" => 23,
                "name_en" => "Nawzad",
                "name_dr" => "نوزاد"
            ],
            [
                "id" => "301",
                "province_id" => 23,
                "name_en" => "Garmseer Hazar Juft",
                "name_dr" => "گرمسير هزار جفت"
            ],
            [
                "id" => "302",
                "province_id" => 23,
                "name_en" => "Sangeen",
                "name_dr" => "سنگين"
            ],
            [
                "id" => "303",
                "province_id" => 23,
                "name_en" => "Marja",
                "name_dr" => "مارجه"
            ],
            [
                "id" => "304",
                "province_id" => 23,
                "name_en" => "Baghni",
                "name_dr" => "بغني"
            ],
            [
                "id" => "305",
                "province_id" => 23,
                "name_en" => "Girishk Nahr i Saraj",
                "name_dr" => "گرشگ نهر سراج"
            ],
            [
                "id" => "306",
                "province_id" => 23,
                "name_en" => "Disho Khanshin",
                "name_dr" => " ديشوخانشين"
            ],
            [
                "id" => "307",
                "province_id" => 23,
                "name_en" => "Reg",
                "name_dr" => "ریگ"
            ],
            [
                "id" => "308",
                "province_id" => 24,
                "name_en" => "Kandahar",
                "name_dr" => "کندهار"
            ],
            [
                "id" => "309",
                "province_id" => 24,
                "name_en" => "Daman",
                "name_dr" => "دامان"
            ],
            [
                "id" => "310",
                "province_id" => 24,
                "name_en" => "Shah Wali Kot",
                "name_dr" => "شاه ولي کوټ"
            ],
            [
                "id" => "311",
                "province_id" => 24,
                "name_en" => "Arghandab",
                "name_dr" => "ارغنداب"
            ],
            [
                "id" => "312",
                "province_id" => 24,
                "name_en" => "Khakreez",
                "name_dr" => "خاکريز"
            ],
            [
                "id" => "313",
                "province_id" => 24,
                "name_en" => "Ghorak",
                "name_dr" => "غورک"
            ],
            [
                "id" => "314",
                "province_id" => 24,
                "name_en" => "Maiwand",
                "name_dr" => "ميوند"
            ],
            [
                "id" => "315",
                "province_id" => 24,
                "name_en" => "Panjwayee",
                "name_dr" => "پنجوائي"
            ],
            [
                "id" => "316",
                "province_id" => 24,
                "name_en" => "Reegistan",
                "name_dr" => " ريگستان"
            ],
            [
                "id" => "317",
                "province_id" => 24,
                "name_en" => "Speen Boldak",
                "name_dr" => "سپين بولدک"
            ],
            [
                "id" => "318",
                "province_id" => 24,
                "name_en" => "Arghistan",
                "name_dr" => "ارغستان"
            ],
            [
                "id" => "319",
                "province_id" => 24,
                "name_en" => "Maroof",
                "name_dr" => "معروف"
            ],
            [
                "id" => "320",
                "province_id" => 24,
                "name_en" => "Nish",
                "name_dr" => "نيش"
            ],
            [
                "id" => "321",
                "province_id" => 24,
                "name_en" => "Zeray",
                "name_dr" => "ژړي"
            ],
            [
                "id" => "322",
                "province_id" => 24,
                "name_en" => "Meyan Nishin",
                "name_dr" => "ميان نشين"
            ],
            [
                "id" => "323",
                "province_id" => 24,
                "name_en" => "Dand Shorabak",
                "name_dr" => " شورابک دند"
            ],
            [
                "id" => "324",
                "province_id" => 24,
                "name_en" => "Takhta Pul Reg",
                "name_dr" => " ریگ تخته پل"
            ],
            [
                "id" => "325",
                "province_id" => 25,
                "name_en" => "Qalat",
                "name_dr" => "قلات"
            ],
            [
                "id" => "326",
                "province_id" => 25,
                "name_en" => "Shah Joy",
                "name_dr" => "شاه جوي"
            ],
            [
                "id" => "327",
                "province_id" => 25,
                "name_en" => "Arghandab",
                "name_dr" => "ارغنداب"
            ],
            [
                "id" => "328",
                "province_id" => 25,
                "name_en" => "Dai Chopan",
                "name_dr" => "دايچوپان"
            ],
            [
                "id" => "329",
                "province_id" => 25,
                "name_en" => "Mizan",
                "name_dr" => "ميزان"
            ],
            [
                "id" => "330",
                "province_id" => 25,
                "name_en" => "Tarnak wa Jaldak",
                "name_dr" => "ترنک و جلدک"
            ],
            [
                "id" => "331",
                "province_id" => 25,
                "name_en" => "Shinkay",
                "name_dr" => "شنکي"
            ],
            [
                "id" => "332",
                "province_id" => 25,
                "name_en" => "Atghar",
                "name_dr" => "اټغر"
            ],
            [
                "id" => "333",
                "province_id" => 25,
                "name_en" => "Shamulzai",
                "name_dr" => "شمل زائي"
            ],
            [
                "id" => "334",
                "province_id" => 25,
                "name_en" => "Naw Bahar",
                "name_dr" => "نو بهار"
            ],
            [
                "id" => "335",
                "province_id" => 25,
                "name_en" => "Khak Afghan Kakar",
                "name_dr" => " کاکړ خاک افغان"
            ],
            [
                "id" => "336",
                "province_id" => 25,
                "name_en" => "Seyoray",
                "name_dr" => "سيوري"
            ],
            [
                "id" => "337",
                "province_id" => 26,
                "name_en" => "Trinkot",
                "name_dr" => "ترين کوټ"
            ],
            [
                "id" => "338",
                "province_id" => 26,
                "name_en" => "Chora",
                "name_dr" => "چوره"
            ],
            [
                "id" => "339",
                "province_id" => 26,
                "name_en" => "Khas Uruzgan",
                "name_dr" => "خاص ارزکان"
            ],
            [
                "id" => "340",
                "province_id" => 26,
                "name_en" => "Gizab",
                "name_dr" => "گيزاب"
            ],
            [
                "id" => "341",
                "province_id" => 26,
                "name_en" => "Dehrawood",
                "name_dr" => "دهراود"
            ],
            [
                "id" => "342",
                "province_id" => 26,
                "name_en" => "Shahid Hasas Char Cheena",
                "name_dr" => "شهید حساس چارچينه"
            ],
            [
                "id" => "343",
                "province_id" => 26,
                "name_en" => "Chinarto",
                "name_dr" => "چنارتو"
            ],
            [
                "id" => "344",
                "province_id" => 27,
                "name_en" => "Lal o Sar Jangal",
                "name_dr" => "لعل و سرجنگل"
            ],
            [
                "id" => "345",
                "province_id" => 27,
                "name_en" => "Dawlatyaar",
                "name_dr" => "دولتيار"
            ],
            [
                "id" => "346",
                "province_id" => 27,
                "name_en" => "Dolina",
                "name_dr" => "دولينه"
            ],
            [
                "id" => "347",
                "province_id" => 27,
                "name_en" => "Charsada",
                "name_dr" => "چارسده"
            ],
            [
                "id" => "348",
                "province_id" => 27,
                "name_en" => "Cheghcheran",
                "name_dr" => "چغچران"
            ],
            [
                "id" => "349",
                "province_id" => 27,
                "name_en" => "Shahrak",
                "name_dr" => "شهرک"
            ],
            [
                "id" => "350",
                "province_id" => 27,
                "name_en" => "Tulak",
                "name_dr" => "تولک"
            ],
            [
                "id" => "351",
                "province_id" => 27,
                "name_en" => "Saghar",
                "name_dr" => "ساغر"
            ],
            [
                "id" => "352",
                "province_id" => 27,
                "name_en" => "Teywara",
                "name_dr" => "تيوره"
            ],
            [
                "id" => "353",
                "province_id" => 27,
                "name_en" => "Pasaband",
                "name_dr" => "پسابند"
            ],
            [
                "id" => "354",
                "province_id" => 28,
                "name_en" => "Bamyan",
                "name_dr" => "باميان"
            ],
            [
                "id" => "355",
                "province_id" => 28,
                "name_en" => "Shebar",
                "name_dr" => "شيبر"
            ],
            [
                "id" => "356",
                "province_id" => 28,
                "name_en" => "Yakawlang",
                "name_dr" => "يکاولنگ"
            ],
            [
                "id" => "357",
                "province_id" => 28,
                "name_en" => "Panjab",
                "name_dr" => "پنجاب"
            ],
            [
                "id" => "358",
                "province_id" => 28,
                "name_en" => "Waras",
                "name_dr" => "ورس"
            ],
            [
                "id" => "359",
                "province_id" => 28,
                "name_en" => "Saighan",
                "name_dr" => "سيغان"
            ],
            [
                "id" => "360",
                "province_id" => 28,
                "name_en" => "Kahmard",
                "name_dr" => "کهمرد"
            ],
            [
                "id" => "361",
                "province_id" => 28,
                "name_en" => "Yakawlang No 2",
                "name_dr" => "یکاولنگ نمبر2"
            ],
            [
                "id" => "362",
                "province_id" => 29,
                "name_en" => "Sharan",
                "name_dr" => "شرن"
            ],
            [
                "id" => "363",
                "province_id" => 29,
                "name_en" => "Della",
                "name_dr" => "ډيله"
            ],
            [
                "id" => "364",
                "province_id" => 29,
                "name_en" => "Waza Khwah",
                "name_dr" => "وازه خواه"
            ],
            [
                "id" => "365",
                "province_id" => 29,
                "name_en" => "Wormami",
                "name_dr" => "وړممی"
            ],
            [
                "id" => "366",
                "province_id" => 29,
                "name_en" => "Gomal",
                "name_dr" => "گومل"
            ],
            [
                "id" => "367",
                "province_id" => 29,
                "name_en" => "Umna",
                "name_dr" => "اومنه"
            ],
            [
                "id" => "368",
                "province_id" => 29,
                "name_en" => "Surubi",
                "name_dr" => "سروبي"
            ],
            [
                "id" => "369",
                "province_id" => 29,
                "name_en" => "Barmal",
                "name_dr" => "برمل"
            ],
            [
                "id" => "370",
                "province_id" => 29,
                "name_en" => "Geyan",
                "name_dr" => "گيان"
            ],
            [
                "id" => "371",
                "province_id" => 29,
                "name_en" => "Urugun",
                "name_dr" => "ارگون"
            ],
            [
                "id" => "372",
                "province_id" => 29,
                "name_en" => "Zerok",
                "name_dr" => "زيروک"
            ],
            [
                "id" => "373",
                "province_id" => 29,
                "name_en" => "Neka",
                "name_dr" => "نیکه"
            ],
            [
                "id" => "374",
                "province_id" => 29,
                "name_en" => "Sar Rowza",
                "name_dr" => "سرروضه"
            ],
            [
                "id" => "375",
                "province_id" => 29,
                "name_en" => "Matta Khan",
                "name_dr" => "مټاخان"
            ],
            [
                "id" => "376",
                "province_id" => 29,
                "name_en" => "Usuf Khail",
                "name_dr" => "يوسف خيل"
            ],
            [
                "id" => "377",
                "province_id" => 29,
                "name_en" => "Yahya Khail",
                "name_dr" => "يحي خيل"
            ],
            [
                "id" => "378",
                "province_id" => 29,
                "name_en" => "Terway",
                "name_dr" => "تروي"
            ],
            [
                "id" => "379",
                "province_id" => 29,
                "name_en" => "Jani Khail",
                "name_dr" => "جاني خيل"
            ],
            [
                "id" => "380",
                "province_id" => 29,
                "name_en" => "Khair Kot Zarghon Shahr",
                "name_dr" => "خیرکوټ زرغون  شهر"
            ],
            [
                "id" => "381",
                "province_id" => 30,
                "name_en" => "Noristan Paroon",
                "name_dr" => "نورستان پارون"
            ],
            [
                "id" => "382",
                "province_id" => 30,
                "name_en" => "Kamdeesh",
                "name_dr" => "کامديش"
            ],
            [
                "id" => "383",
                "province_id" => 30,
                "name_en" => "Waygal",
                "name_dr" => "وايگل"
            ],
            [
                "id" => "384",
                "province_id" => 30,
                "name_en" => "Mandool",
                "name_dr" => "منډول"
            ],
            [
                "id" => "385",
                "province_id" => 30,
                "name_en" => "Barg i Matal",
                "name_dr" => "برگمټال"
            ],
            [
                "id" => "386",
                "province_id" => 30,
                "name_en" => "Wama",
                "name_dr" => "واما"
            ],
            [
                "id" => "387",
                "province_id" => 30,
                "name_en" => "Noor Geram Yaningiraj",
                "name_dr" => "نورگرام یاننگراج"
            ],
            [
                "id" => "388",
                "province_id" => 30,
                "name_en" => "Doo Ab",
                "name_dr" => "دوآب"
            ],
            [
                "id" => "389",
                "province_id" => 31,
                "name_en" => "Sar i Pul",
                "name_dr" => "سرپل"
            ],
            [
                "id" => "390",
                "province_id" => 31,
                "name_en" => "Sang Charak",
                "name_dr" => "سنچارک"
            ],
            [
                "id" => "391",
                "province_id" => 31,
                "name_en" => "Kohistanat",
                "name_dr" => "کوهستانات"
            ],
            [
                "id" => "392",
                "province_id" => 31,
                "name_en" => "Balkhab",
                "name_dr" => "بلخاب"
            ],
            [
                "id" => "393",
                "province_id" => 31,
                "name_en" => "Sozma Qala",
                "name_dr" => "سوزمه قلعه"
            ],
            [
                "id" => "394",
                "province_id" => 31,
                "name_en" => "Sayaad",
                "name_dr" => "صياد"
            ],
            [
                "id" => "395",
                "province_id" => 31,
                "name_en" => "Gosfandi",
                "name_dr" => "گوسفندي"
            ],
            [
                "id" => "396",
                "province_id" => 31,
                "name_en" => "Seori",
                "name_dr" => "سیوری"
            ],
            [
                "id" => "397",
                "province_id" => 32,
                "name_en" => "Matoon Khost",
                "name_dr" => "متون خوست"
            ],
            [
                "id" => "398",
                "province_id" => 32,
                "name_en" => "Jaji Maidan",
                "name_dr" => "ځاځي ميدان"
            ],
            [
                "id" => "399",
                "province_id" => 32,
                "name_en" => "Tanai Daragi",
                "name_dr" => "ټني  دره گي "
            ],
            [
                "id" => "400",
                "province_id" => 32,
                "name_en" => "Sepera",
                "name_dr" => "سپيره"
            ],
            [
                "id" => "401",
                "province_id" => 32,
                "name_en" => "Musa Khail",
                "name_dr" => "موسي خيل"
            ],
            [
                "id" => "402",
                "province_id" => 32,
                "name_en" => "Terzayee",
                "name_dr" => "تيرزائي"
            ],
            [
                "id" => "403",
                "province_id" => 32,
                "name_en" => "Nadir Shah Kot",
                "name_dr" => "نادر شاه كوټ"
            ],
            [
                "id" => "404",
                "province_id" => 32,
                "name_en" => "Sabri",
                "name_dr" => "صبري"
            ],
            [
                "id" => "405",
                "province_id" => 32,
                "name_en" => "Bak",
                "name_dr" => "باک"
            ],
            [
                "id" => "406",
                "province_id" => 32,
                "name_en" => "Gurbuz",
                "name_dr" => "گربز"
            ],
            [
                "id" => "407",
                "province_id" => 32,
                "name_en" => "Qalandar",
                "name_dr" => "قلندر"
            ],
            [
                "id" => "408",
                "province_id" => 32,
                "name_en" => "Ismail Khail Mandozayee",
                "name_dr" => "اسمعيل خيل مندوزایی"
            ],
            [
                "id" => "409",
                "province_id" => 32,
                "name_en" => "Dowa Manda Shamal",
                "name_dr" => "شمل دوه منډه"
            ],
            [
                "id" => "410",
                "province_id" => 33,
                "name_en" => "Bazarak",
                "name_dr" => "بازارک"
            ],
            [
                "id" => "411",
                "province_id" => 33,
                "name_en" => "Rukha",
                "name_dr" => "رخه"
            ],
            [
                "id" => "412",
                "province_id" => 33,
                "name_en" => "Hisa i Awali Khinj",
                "name_dr" => "حصه اول خينج"
            ],
            [
                "id" => "413",
                "province_id" => 33,
                "name_en" => "Unaba",
                "name_dr" => "عنابه"
            ],
            [
                "id" => "414",
                "province_id" => 33,
                "name_en" => "Paryan",
                "name_dr" => "پريان"
            ],
            [
                "id" => "415",
                "province_id" => 33,
                "name_en" => "Dara",
                "name_dr" => "دره"
            ],
            [
                "id" => "416",
                "province_id" => 33,
                "name_en" => "Shutul",
                "name_dr" => "شتل"
            ],
            [
                "id" => "417",
                "province_id" => 33,
                "name_en" => "Abshar",
                "name_dr" => "آبشار"
            ],
            [
                "id" => "418",
                "province_id" => 34,
                "name_en" => "Nili",
                "name_dr" => "نيلي"
            ],
            [
                "id" => "419",
                "province_id" => 34,
                "name_en" => "Ushturlai",
                "name_dr" => "اشترلي"
            ],
            [
                "id" => "420",
                "province_id" => 34,
                "name_en" => "Kijran",
                "name_dr" => "کجران"
            ],
            [
                "id" => "421",
                "province_id" => 34,
                "name_en" => "Khadeer",
                "name_dr" => "خدير"
            ],
            [
                "id" => "422",
                "province_id" => 34,
                "name_en" => "Kiti",
                "name_dr" => "کيتي"
            ],
            [
                "id" => "423",
                "province_id" => 34,
                "name_en" => "Miramoor",
                "name_dr" => "ميرامور"
            ],
            [
                "id" => "424",
                "province_id" => 34,
                "name_en" => "Sang i Takht",
                "name_dr" => "سنگ تخت"
            ],
            [
                "id" => "425",
                "province_id" => 34,
                "name_en" => "Shahristan",
                "name_dr" => "شهرستان"
            ],
            [
                "id" => "426",
                "province_id" => 34,
                "name_en" => "Pato",
                "name_dr" => "پاتو"
            ],
            [
                "id" => "427",
                "province_id" => 1,
                "name_en" => "Nahia 1",
                "name_dr" => "کابل ناحيه 1"
            ],
            [
                "id" => "428",
                "province_id" => 1,
                "name_en" => "Nahia 2",
                "name_dr" => "کابل ناحيه 2"
            ],
            [
                "id" => "429",
                "province_id" => 1,
                "name_en" => "Nahia 3",
                "name_dr" => "کابل ناحيه 3"
            ],
            [
                "id" => "430",
                "province_id" => 1,
                "name_en" => "Nahia 4",
                "name_dr" => "کابل ناحيه 4"
            ],
            [
                "id" => "431",
                "province_id" => 1,
                "name_en" => "Nahia 5",
                "name_dr" => "کابل ناحيه 5"
            ],
            [
                "id" => "432",
                "province_id" => 1,
                "name_en" => "Nahia 6",
                "name_dr" => "کابل ناحيه 6"
            ],
            [
                "id" => "433",
                "province_id" => 1,
                "name_en" => "Nahia 7",
                "name_dr" => "کابل ناحيه 7"
            ],
            [
                "id" => "434",
                "province_id" => 1,
                "name_en" => "Nahia 8",
                "name_dr" => "کابل ناحيه 8"
            ],
            [
                "id" => "435",
                "province_id" => 1,
                "name_en" => "Nahia 9",
                "name_dr" => "کابل ناحيه 9"
            ],
            [
                "id" => "436",
                "province_id" => 1,
                "name_en" => "Nahia 10",
                "name_dr" => "کابل ناحيه 10"
            ],
            [
                "id" => "437",
                "province_id" => 1,
                "name_en" => "Nahia 11",
                "name_dr" => "کابل ناحيه 11"
            ],
            [
                "id" => "438",
                "province_id" => 1,
                "name_en" => "Nahia 12",
                "name_dr" => "کابل ناحيه 12"
            ],
            [
                "id" => "439",
                "province_id" => 1,
                "name_en" => "Nahia 13",
                "name_dr" => "کابل ناحيه 13"
            ],
            [
                "id" => "440",
                "province_id" => 1,
                "name_en" => "Nahia 15",
                "name_dr" => "کابل ناحيه 15"
            ],
            [
                "id" => "441",
                "province_id" => 1,
                "name_en" => "Nahia 16",
                "name_dr" => "کابل ناحيه 16"
            ],
            [
                "id" => "442",
                "province_id" => 1,
                "name_en" => "Nahia 17",
                "name_dr" => "کابل ناحيه 17"
            ],
            [
                "id" => "443",
                "province_id" => 1,
                "name_en" => "Center",
                "name_dr" => "مرکز"
            ],
            [
                "id" => "444",
                "province_id" => 1,
                "name_en" => "Nahia 18",
                "name_dr" => "کابل ناحيه 18"
            ],
            [
                "id" => "445",
                "province_id" => 1,
                "name_en" => "Nahia 19",
                "name_dr" => "کابل ناحيه 19"
            ],
            [
                "id" => "446",
                "province_id" => 1,
                "name_en" => "Nahia 21",
                "name_dr" => "کابل ناحيه 21"
            ],
            [
                "id" => "447",
                "province_id" => 1,
                "name_en" => "Nahia 22",
                "name_dr" => "کابل ناحيه 22"
            ],
            [
                "id" => "448",
                "province_id" => 8,
                "name_en" => "Kot",
                "name_dr" => "کوت"
            ],
        ];

        foreach ($provices as $province)
            Province::create($province);

        foreach ($districts as $district)
            District::create($district);
    }
}
