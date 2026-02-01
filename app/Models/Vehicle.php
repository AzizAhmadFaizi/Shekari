<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    public function color_details()
    {
        return $this->hasOne(Color::class, 'id', 'color_id');
    }
}
