<?php

namespace App\Models;

use App\Models\customerPickupItems;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class customerPickupInfos extends Model
{
    use HasFactory;
    public function orders(){
        return $this->hasMany(customerPickupItems::class,'invoiceNumber','invoiceNumber');
    }
}
