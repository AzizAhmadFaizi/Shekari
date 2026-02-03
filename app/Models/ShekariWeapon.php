<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShekariWeapon extends Model
{
    use HasFactory;

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function serials()
    {
        return $this->hasMany(ShekariWeaponSerialNumber::class, 'shekari_weapon_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
