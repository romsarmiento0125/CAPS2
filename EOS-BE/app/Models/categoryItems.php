<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoryItems extends Model
{
    use HasFactory;
    public static function imagesSrc()
    {
        return asset('assets/itemPhotos');
    }
}
