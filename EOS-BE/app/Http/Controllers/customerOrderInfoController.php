<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customerOrderInfo;
use App\Models\customerCancelItems;

class customerOrderInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return customerOrderInfo::with('orders')->get();
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
        if(isset($request)){
            $register = new customerOrderInfo();

            $register->email = $request->register['Email'];
            $register->invoiceNumber = $request->register['InvoiceNumber'];
            $register->name = $request->register['Name'];
            $register->mobileNumber = $request->register['Mobilenumber'];
            $register->completeAddress = $request->register['CompleteAddress'];
            $register->status = $request->register['OrderStatus'];
            $register->orderYear = $request->register['OrderYear'];
            $register->orderMonth = $request->register['OrderMonth'];
            $register->orderDay = $request->register['OrderDay'];
            $register->adjustedDate = $request->register['AdjustedDate'];
            $register->shipFee = $request->register['Shipping'];
            $register->discount = $request->register['Discount'];
            $register->tax = $request->register['OrderTax'];
            $register->subTotal = $request->register['SubTotal'];
            $register->total = $request->register['Total'];

            $register->save();

            return $register;
        }
        else{
            return 'false';
        }
        
    }

    public function cancel(Request $request)
    {
        $register = new customerCancelItems();

        $register->email = $request->register['Email'];
        $register->invoiceNumber = $request->register['InvoiceNumber'];
        $register->name = $request->register['Name'];
        $register->mobileNumber = $request->register['Mobilenumber'];
        $register->completeAddress = $request->register['CompleteAddress'];
        $register->status = $request->register['OrderStatus'];
        $register->orderYear = $request->register['OrderYear'];
        $register->orderMonth = $request->register['OrderMonth'];
        $register->orderDay = $request->register['OrderDay'];
        $register->adjustedDate = $request->register['AdjustedDate'];
        $register->shipFee = $request->register['Shipping'];
        $register->discount = $request->register['Discount'];
        $register->tax = $request->register['OrderTax'];
        $register->subTotal = $request->register['SubTotal'];
        $register->total = $request->register['Total'];

        $register->save();

        $id = $request->userid;

        $existingItem = customerOrderInfo::find($id);

        if( $existingItem){
            $existingItem->delete();
            return "Item succesfully deleted.";
        }
        else{
            return "Item not Found";
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
        $existingItem = customerOrderInfo::find($id);

        $existingItem->id = $id;
        $existingItem->email = $request->register['Email'];
        $existingItem->invoiceNumber = $request->register['InvoiceNumber'];
        $existingItem->name = $request->register['Name'];
        $existingItem->mobileNumber = $request->register['Mobilenumber'];
        $existingItem->completeAddress = $request->register['CompleteAddress'];
        $existingItem->status = $request->register['OrderStatus'];
        $existingItem->orderYear = $request->register['OrderYear'];
        $existingItem->orderMonth = $request->register['OrderMonth'];
        $existingItem->orderDay = $request->register['OrderDay'];
        $existingItem->adjustedDate = $request->register['AdjustedDate'];
        $existingItem->shipFee = $request->register['Shipping'];
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
        
    }
}
