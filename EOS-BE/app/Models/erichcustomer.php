<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class erichcustomer extends Model
{
    use HasApiTokens, HasFactory;

    protected $hidden = ['password'];
}
