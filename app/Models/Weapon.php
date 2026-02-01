<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    use HasFactory;

    public function weapon_type_details(){
        return $this->hasOne(WeaponType::class,'id','weapon_type_id');
    }
}
