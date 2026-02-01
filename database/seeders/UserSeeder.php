<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = [
            ["name" => "Admin", "email" => "admin@moi.gov.af", "role_id" => 2, "password" => bcrypt(12345678)],
            ["name" => "Mehrabudin", "email" => "mehrabudin@moi.gov.af", "role_id" => 2, "password" => bcrypt(12345678)],
            ["name" => "Zabiullah", "email" => "zabiullah@moi.gov.af", "role_id" => 2, "password" => bcrypt(12345678)],
        ];

        foreach ($user as $users) {
            User::create($users);
        }
    }
}
