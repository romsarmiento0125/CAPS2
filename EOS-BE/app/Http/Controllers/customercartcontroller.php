<?php

namespace App\Http\Controllers;

use App\Models\customercart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class customercartcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return customercart::all();
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
        // $existingEmail = customercart::find($request->register['Email']);
        if(isset($request)){
            $existingId = customercart::where('email', $request->register['Email'])
            ->where('itemCode', $request->register['ItemCode'])->get('id')->first();

            if(!$existingId){
                $register = new customercart();
                $register->email = $request->register['Email'];
                $register->quantity = $request->register['Quantity'];
                $register->itemCode = $request->register['ItemCode'];

                $register->save();

                return $register;
            }
            else{
                $existingItem = customercart::find($existingId->id);
                
                $existingItem->quantity =  $existingItem->quantity + 1;

                $existingItem->save();

                return $existingItem;
            }
        }
        else{
            return "false";
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
        $existingItem = customercart::find($id);

        // return $existingItem->id;

        if($existingItem->id == null){
            $register = new customercart();
            $register->email = $request->register['Email'];
            $register->quantity = $request->register['Quantity'];
            $register->itemCode = $request->register['ItemCode'];

            $register->save();

            return $register;
        }
        else{
            $existingItem->quantity = $existingItem->quantity + 1;

            $existingItem->save();

            return $existingItem;
        }
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
