<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customerPickupInfos;

class CustomerPickupInfosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return customerPickupInfos::with('orders')->get();
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
        $register = new customerPickupInfos();

        $register->email = $request->register['Email'];
        $register->invoiceNumber = $request->register['InvoiceNumber'];
        $register->name = $request->register['Name'];
        $register->mobileNumber = $request->register['Mobilenumber'];
        $register->status = $request->register['Status'];
        $register->pickupDate = $request->register['pickupDate'];
        $register->pickupTime = $request->register['pickupTime'];
        $register->discount = $request->register['Discount'];
        $register->tax = $request->register['OrderTax'];
        $register->subTotal = $request->register['SubTotal'];
        $register->total = $request->register['Total'];

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
        $existingItem = customerPickupInfos::find($id);

        $existingItem->id = $id;
        $existingItem->email = $request->register['Email'];
        $existingItem->invoiceNumber = $request->register['InvoiceNumber'];
        $existingItem->name = $request->register['Name'];
        $existingItem->mobileNumber = $request->register['Mobilenumber'];
        $existingItem->status = $request->register['OrderStatus'];
        $existingItem->pickupDate = $request->register['PickupDate'];
        $existingItem->pickupTime = $request->register['PickupTime'];
        $existingItem->discount = $request->register['Discount'];
        $existingItem->tax = $request->register['OrderTax'];
        $existingItem->subTotal = $request->register['SubTotal'];
        $existingItem->total = $request->register['Total'];
        $existingItem->save();

        //return $existingItem;
        return "goods";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingItem = customerPickupInfos::find($id);

        if( $existingItem){
            $existingItem->delete();
            return "Item succesfully deleted.";
        }

        return "Item not Found";
    }
}
