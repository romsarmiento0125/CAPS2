<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\erichcustomer;

class erichlogincontroller extends Controller
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
        $validator = erichcustomer::all();
        $email = $request->clientCred['usersEmail'];
        $pass = $request->clientCred['usersPassword'];
        $validator = json_decode($validator, true);
        $index = false;
        $counter = 0;

        for($i = 0; $i < count($validator); $i++){
            if($validator[$i]['Email'] == $email && $validator[$i]['Password'] == $pass){
                $index = true;
                $counter = $i;
                $i = count($validator) + 1;
            }
        }

        if($index){
            return $validator[$counter];
        }
        else{
            //"Wrong credentials" string is use for validation in vue js
            return "Wrong credentials";
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
