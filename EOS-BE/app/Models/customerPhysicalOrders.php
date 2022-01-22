<?php

namespace App\Models;

use App\Models\customerPhysicalItems;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class customerPhysicalOrders extends Model
{
    use HasFactory;
    public function orders(){
        return $this->hasMany(customerPhysicalItems::class,'invoiceNumber','invoiceNumber');
    }
}
