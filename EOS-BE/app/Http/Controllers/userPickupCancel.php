<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customerPickupInfos;
use App\Models\customerPickupCancel;
use App\Models\customerPickupPickup;

class userPickupCancel extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return customerPickupCancel::with('orders')->get();
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
        $register = new customerPickupCancel();

        $register->email = $request->register['Email'];
        $register->invoiceNumber = $request->register['InvoiceNumber'];
        $register->name = $request->register['Name'];
        $register->mobileNumber = $request->register['Mobilenumber'];
        $register->status = $request->register['OrderStatus'];
        $register->pickupDate = $request->register['PickupDate'];
        $register->pickupTime = $request->register['PickupTime'];
        $register->discount = $request->register['Discount'];
        $register->tax = $request->register['OrderTax'];
        $register->subTotal = $request->register['SubTotal'];
        $register->total = $request->register['Total'];
        $register->cancelReason = $request->cancelReason;

        $register->save();

        $id = $request->userid;

        $existingItem = customerPickupPickup::find($id);

        if( $existingItem){
            $existingItem->delete();
            return response()->json([
                'status' => true,
                'data' => customerPickupPickup::with('orders')->get(),
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'data' => "Item not found.",
            ]);
        }
    }

    public function customerPDelete(Request $request)
    {
        if($request->cancelReason == ""){
            $reasons = "No Reasons from customer";
        }
        else{
            $reasons = $request->cancelReason;
        }

        $register = new customerPickupCancel();

        $register->email = $request->register['email'];
        $register->invoiceNumber = $request->register['invoiceNumber'];
        $register->name = $request->register['name'];
        $register->mobileNumber = $request->register['mobileNumber'];
        $register->status = "Cancel";
        $register->pickupDate = $request->register['pickupDate'];
        $register->pickupTime = $request->register['pickupTime'];
        $register->discount = $request->register['discount'];
        $register->tax = $request->register['tax'];
        $register->subTotal = $request->register['subTotal'];
        $register->total = $request->register['total'];
        $register->cancelReason = $reasons;

        $register->save();

        $id = $request->userid;

        $existingItem = customerPickupInfos::find($id);

        if( $existingItem){
            $existingItem->delete();
            return response()->json([
                'status' => true,
                'data' => customerPickupInfos::with('orders')->where('email', $request->register['email'])->get(),
                'delete' => customerPickupCancel::with('orders')->where('email', $request->register['email'])->get(),
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'data' => "Item Not Found",
            ]);
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
