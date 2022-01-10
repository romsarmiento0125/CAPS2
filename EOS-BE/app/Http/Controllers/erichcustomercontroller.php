<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\erichcustomer;

use Illuminate\Support\Facades\Hash;

class erichcustomercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $email = erichcustomer::pluck('Email');
        return $email;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $email = $request->register['Email'];
        $num = $request->register['Mobile_Number'];

        $getEmail = erichcustomer::where('Email', $email)->get()->pluck('Email');
        $getNum = erichcustomer::where('Mobile_Number', $num)->get()->pluck('Mobile_Number');

        $vemail = count($getEmail);
        $vnum = count($getNum);

        $register = new erichcustomer();

        if($vemail == 1){
            return "wrongemail";
        }
        else if(false){
            return "wrongnumber";
        }
        else{
            $register->first_Name = $request->register['First_Name'];
            $register->last_Name = $request->register['Last_Name'];
            $register->mobile_Number = $request->register['Mobile_Number'];
            $register->email = $request->register['Email'];
            $register->gender = $request->register['Gender'];
            $register->birthday = $request->register['Birthday'];
            $register->tag = $request->register['Tag'];
            $register->password = Hash::make($request->register['Password']);
            $register->save();

            return $register;
        }   

        // if($cond){
        //     //$register->save();
        //     return $register;
        // }
        // else{
        //     return "emailInvalid";
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
