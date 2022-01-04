<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\erichcustomer;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class erichlogincontroller extends Controller
{
    public function index()
    {
        return erichcustomer::with('address')->get();
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
