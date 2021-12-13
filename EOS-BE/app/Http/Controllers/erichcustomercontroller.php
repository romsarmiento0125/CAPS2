<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\erichcustomer;

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
        $func = $this->index();
        $email = $request->register['Email'];

        $cond = false;

        $register = new erichcustomer();

        $register->First_Name = $request->register['First_Name'];
        $register->Last_Name = $request->register['Last_Name'];
        $register->Mobile_Number = $request->register['Mobile_Number'];
        $register->Email = $request->register['Email'];
        $register->Gender = $request->register['Gender'];
        $register->Birthday = $request->register['Birthday'];
        $register->Tag = $request->register['Tag'];
        $register->Password = $request->register['Password'];

        foreach($func as $value){
            //$rvalue = $rvalue.$value;
            if($email == $value){
                return 'emailInvalid';
            }
            else{
                $cond = true;
            }
        }

        if($cond){
            $register->save();
        }
        
        return $register;
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
