<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\erichcustomer;

use App\Models\customeraddress;
use App\Models\erichnotifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class erichlogincontroller extends Controller
{
    public function index()
    {
        return erichcustomer::with('address')->get();
    }

    public function signup(Request $request)
    {
        $email = $request->register['Email'];
        $num = $request->register['Mobile_Number'];

        $getEmail = erichcustomer::where('Email', $email)->get()->pluck('Email');
        $getNum = erichcustomer::where('Mobile_Number', $num)->get()->pluck('Mobile_Number');

        $vemail = count($getEmail);
        $vnum = count($getNum);

        $returndata = "";

        $register = new erichcustomer();
        $registerAddress = new customeraddress();
        $registerNotif = new erichnotifications();

        if($vemail == 1){
            $returndata = "wrongemail";
        }
        else if(false){
            $returndata = "wrongnumber";
        }
        else{

            $register->first_Name = $request->register['First_Name'];
            $register->last_Name = $request->register['Last_Name'];
            $register->mobile_Number = $request->register['Mobile_Number'];
            $register->email = $request->register['Email'];
            $register->gender = $request->register['Gender'];
            $register->birthday = $request->register['Birthday'];
            $register->tag = $request->register['Tag'];
            $register->status = 'Active';
            $register->password = Hash::make($request->register['Password']);
            
            $register->save();

            $returndata = $register;

            $registerAddress->email = $request->register['Email'];
            $registerAddress->municipality = $request->register['Municipality'];
            $registerAddress->barangay = $request->register['Barangay'];
            $registerAddress->underBarangay = $request->register['UnderBarangay'];
            $registerAddress->homeAddress = $request->register['HomeAddress'];
            $registerAddress->shipFee = $request->register['ShipFee'];
            $registerAddress->default = $request->register['Default'];

            $registerAddress->save();

            $registerNotif->email = $request->register['Email'];
            $registerNotif->title = "Verify";
            $registerNotif->description = "Verify Your Email";
            $registerNotif->link = "verify";
            $registerNotif->status = "undone";

            $registerNotif->save();
        }   

        if($returndata == "wrongemail"){
            return response()->json([
                "status" => false,
                "message" => "Your email has been already use. Try to forgot your password to recover your account.",
            ],200);
        }
        else{
            $credentials = ["email" => $request->register['Email'],"password" => $request->register['Password'],];
            $user = erichcustomer::where('email', $credentials['email'])->first();

            if(Hash::check($request->register['Password'],$user->password)){
                $token = $user->createToken('auth-token');
                return response()->json([
                    "status" => true,
                    "token" => $token->plainTextToken,
                    "user" => $user,
                    'data' => $returndata,
                ],200);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "Wrong login credentials",
                ],200);
            }
        }
    }
    public function login(Request $request)
    {
        // $credentials = filter_var($request->get('username'), FILTER_VALIDATE_EMAIL) ?  ['email' => $request->get('username')] : ['username' => $request->get('username')];
        // $credentials['password'] = $request->get('password');
        
        $credentials = ["email" => $request->clientCred['usersEmail'],"password" => $request->clientCred['usersPassword'],];
        //$user = erichcustomer::where(array_key_exists('Email',$credentials) ? "username" : "email",$request->get('username'))->first();
        $user = erichcustomer::where('email', $credentials['email'])->first();

        if(!$user){
            return response()->json([
                "status" => true,
                "message" => "No account found",
            ],200);
        }

        if(Hash::check($request->clientCred['usersPassword'],$user->password)){
            $token = $user->createToken('auth-token');
            return response()->json([
                "status" => false,
                "token" => $token->plainTextToken,
                "user" => $user,
            ],200);
        } else {
            return response()->json([
                "status" => true,
                "message" => "Wrong login credentials",
            ],200);
        }
    }

    /**
     * This is to check if the token is valid
     * if the spa is refreshed
     * 
     * @param Illuminate\Http\Request
     * 
     * @return response json
     */
    public function check_token(Request $request)
    {
        $user = Auth::user();
        if($user){
            return response()->json([
                "status" => true,
                "user" => $user,
            ],200);
        }
    }
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     return erichcustomer::all();
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $validator = erichcustomer::all();
    //     $email = $request->clientCred['usersEmail'];
    //     $pass = $request->clientCred['usersPassword'];
    //     $validator = json_decode($validator, true);
    //     $index = false;
    //     $counter = 0;

    //     for($i = 0; $i < count($validator); $i++){
    //         if($validator[$i]['Email'] == $email && $validator[$i]['Password'] == $pass){
    //             $index = true;
    //             $counter = $i;
    //             $i = count($validator) + 1;
    //         }
    //     }

    //     if($index){
    //         return $validator[$counter];
    //     }
    //     else{
    //         //"Wrong credentials" string is use for validation in vue js
    //         return "InvalidCredentials";
    //     }
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }
}
