<?php

namespace App\Http\Controllers;

use App\Mail\genPass;
use Illuminate\Http\Request;
use App\Models\erichcustomer;
use App\Models\customeraddress;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class adminAddStaff extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return erichcustomer::all();
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
        $pass = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 8);
        // return $pass;

        $details = [
            'name' => $request->register['Email'],
            'code' => $pass,
        ];

        Mail::to($request->register['Email'])->send(new genPass($details));
        // return 'Email sent';

        $email = $request->register['Email'];
        $num = $request->register['Mobile_Number'];

        $getEmail = erichcustomer::where('Email', $email)->get()->pluck('Email');
        $getNum = erichcustomer::where('Mobile_Number', $num)->get()->pluck('Mobile_Number');

        $vemail = count($getEmail);
        $vnum = count($getNum);

        $register = new erichcustomer();
        $address = new customeraddress();

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
            $register->status = 'Active';
            $register->password = Hash::make($pass);

            $address->email = $request->register['Email'];
            $address->municipality = $request->register['Municipality'];
            $address->barangay = $request->register['Barangay'];
            $address->underBarangay = $request->register['UnderBarangay'];
            $address->homeAddress = $request->register['HomeAddress'];
            $address->shipFee = $request->register['ShipFee'];
            $address->default = $request->register['Default'];

            $register->save();
            $address->save();

            return 'success';
        }   
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
