<?php

namespace App\Http\Controllers;

use App\Mail\Testing;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;

class testemailcontroller extends Controller
{
    public function email(Request $request){
        $details = [
            'name' => $request->email['name'],
            'message' => 'This is a verification code for your email',
            'code' => $request->email['code'],
        ];

        Mail::to($request->email['email'])->send(new Testing($details));
        return 'Email sent';
    }
}
