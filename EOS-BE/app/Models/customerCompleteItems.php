<?php

namespace App\Models;

use App\Models\customerOrderItems;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class customerCompleteItems extends Model
{
    use HasFactory;
    public function orders(){
        return $this->hasMany(customerOrderItems::class,'invoiceNumber','invoiceNumber');
    }
}
