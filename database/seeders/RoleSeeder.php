<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{

    public function run()
    {
        $roles = [
            [
                "name" => "ادمین"
            ],
            [
                "name" => "ثبت کمپنی ها"
            ],
            [
                "name" => "چاپ کارت اسلحه"
            ],
            [
                "name" => "گزارشات"
            ],
            [
                "name" => "تایید"
            ],
        ];

        foreach ($roles as $role)
            Role::create($role);
    }
}
