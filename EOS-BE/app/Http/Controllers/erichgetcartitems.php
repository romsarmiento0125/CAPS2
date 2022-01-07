<?php

namespace App\Http\Controllers;

use App\Models\customercart;
use Illuminate\Http\Request;

class erichgetcartitems extends Controller
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
        $dataGet = $request->register;
        return customercart::where('email', $dataGet)->get();
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
        $cond = $request->updateCond;
        $dataGet = $request->customerEmail;

        if($cond == "increase"){
            $existingItem->quantity = $existingItem->quantity + 1;
            $existingItem->save();
            
            return customercart::where('email', $dataGet)->get();
        }
        else if($cond == "decrease"){
            $existingItem->quantity = $existingItem->quantity - 1;
            $existingItem->save();

            return customercart::where('email', $dataGet)->get();
        }
        else{
            return "something wrong";
        }
        
        // $getData = customercart::all();
        // $dataGet = $request->itemupdate["item_email"];
        // $existingItem = customercart::find($id);
        // $existingQty = customercart::where('id', $id)->pluck('Quantity');
        // foreach($existingQty as $value){
        //     $qty = $value;
        // }
        // $add = $request->itemupdate["item_quantity"]+1;

        // if(true){
        //     $existingItem->id = $id;
        //     $existingItem->email = $request->itemupdate["item_email"];
        //     $existingItem->quantity = $add;
        //     $existingItem->itemCode = $request->itemupdate["item_code"];
        //     $existingItem->save();

        //     //return $existingItem;
        //     return $getData->where('email', $dataGet)->values();
        // }
        // else{
        //     return $getData->where('email', $dataGet)->values();;
        // }

        //return $request->itemupdate;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingItem = customercart::find($id);

        if( $existingItem){
            $existingItem->delete();
            return "Item succesfully deleted.";
        }

        return "Item not Found";
        //return $existingItem;
        //return $id;
    }
}
