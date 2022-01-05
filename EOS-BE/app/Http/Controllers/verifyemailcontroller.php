<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\erichcustomer;

class verifyemailcontroller extends Controller
{
    public function verify(Request $request, $id){
        $existingItem = erichcustomer::find($id);

        $existingItem->tag = $request->usertag;
        
        $existingItem->save();
        return "Success";
    }
}
