<?php

namespace App\Http\Controllers;

use App\Models\customercart;
use Illuminate\Http\Request;

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
        $getAll = customercart::all();
        $Email = $request->register['Email'];
        $ItemCode = $request->register['ItemCode'];
        $validatorEmail = customercart::pluck('Email');
        $validatorItemCode = customercart::where('Email', $Email)->pluck('ItemCode');

        $emailCond = "true";
        $itemCodeCond = "true";

        foreach($validatorEmail as $value){
            //$rvalue = $rvalue.$value;
            if($Email == $value){
                $emailCond = "false";
                //$emailCond = $value;
            }
        }

        foreach($validatorItemCode as $value){
            //$rvalue = $rvalue.$value;
            if($ItemCode == $value){
                $itemCodeCond = "false";
                //$itemCodeCond = $value;
            }
        }

        //return $emailCond.$itemCodeCond.$Email.$ItemCode;
        //return $validatorItemCode;

        if(($emailCond == "true") || ($itemCodeCond == "true")){
            $register = new customercart();

            $register->Email = $request->register['Email'];
            $register->Quantity = $request->register['Quantity'];
            $register->ItemCode = $request->register['ItemCode'];

            $register->save();

            return "addSuccess";
            
        }
        else{
            $filtered = $getAll->where('Email', $Email)
                                ->where('ItemCode', $ItemCode);
            foreach($filtered as $value){
                $data = $value;
            }
            return $data;
            //return "this is else";
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
        $getData = customercart::all();
        $dataGet = $request->itemupdate["Email"];
        $existingItem = customercart::find($id);
        $existingQty = customercart::where('id', $id)->pluck('Quantity');
        foreach($existingQty as $value){
            $qty = $value;
        }
        $add = $request->itemupdate["Quantity"]+$qty;

        if(true){
            $existingItem->id = $id;
            $existingItem->Email = $request->itemupdate["Email"];
            $existingItem->Quantity = $add;
            $existingItem->ItemCode = $request->itemupdate["ItemCode"];
            $existingItem->save();

            //return $existingItem;
            return $getData->where('Email', $dataGet)->values();
        }
        else{
            return "di success";
        }
        

        // if($existingItem) {
        //     $existingItem->Quantity = $request->
        // }

        //return $existingItem;
       
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
