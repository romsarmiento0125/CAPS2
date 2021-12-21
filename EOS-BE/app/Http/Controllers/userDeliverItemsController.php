<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customerDeliverItems;

class userDeliverItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return customerDeliverItems::with('orders')->get();
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
        $register = new customerDeliverItems();

        $register->Email = $request->register['Email'];
        $register->InvoiceNumber = $request->register['InvoiceNumber'];
        $register->Name = $request->register['Name'];
        $register->MobileNumber = $request->register['Mobilenumber'];
        $register->CompleteAddress = $request->register['CompleteAddress'];
        $register->Status = $request->register['OrderStatus'];
        $register->OrderYear = $request->register['OrderYear'];
        $register->OrderMonth = $request->register['OrderMonth'];
        $register->OrderDay = $request->register['OrderDay'];
        $register->AdjustedDate = $request->register['AdjustedDate'];
        $register->ShipFee = $request->register['Shipping'];
        $register->Discount = $request->register['Discount'];
        $register->Tax = $request->register['OrderTax'];
        $register->SubTotal = $request->register['SubTotal'];
        $register->Total = $request->register['Total'];

        $register->save();

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
        $existingItem = customerDeliverItems::find($id);

        if( $existingItem){
            $existingItem->delete();
            return "Item succesfully deleted.";
        }

        return "Item not Found";
    }
}
