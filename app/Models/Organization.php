<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Organization extends Model
{
    use HasFactory;

    public function created_by_details()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
    }


}
