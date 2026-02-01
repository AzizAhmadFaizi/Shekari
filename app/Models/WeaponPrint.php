<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeaponPrint extends Model
{
    use HasFactory;

    public function organization_details()
    {
        return $this->hasOne(Organization::class, 'id', 'organization_id');
    }

    public function weapon_table_details()
    {
        return $this->hasOne(Weapon::class, 'id', 'weapon_id');
    }
}
