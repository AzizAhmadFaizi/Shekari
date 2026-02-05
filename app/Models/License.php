<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LicenseType;

class License extends Model
{
    use HasFactory;

    public function license_type_details()
    {
        return $this->hasOne(LicenseType::class, 'id', 'license_type_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }


}
