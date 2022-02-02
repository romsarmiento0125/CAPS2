<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\erichnotifications;
use App\Models\customerPickupInfos;
use App\Models\customerPickupPickup;

class CustomerPickupPickupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return customerPickupPickup::with('orders')->get();
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
        $register = new customerPickupPickup();

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

        $register->save();

        $id = $request->userid;

        $existingItem = customerPickupInfos::find($id);

        if( $existingItem){
            $existingItem->delete();

            $notif = new erichnotifications();

            $notif->email = $request->register['Email'];
            $notif->title = "Check your order";
            $notif->description = "Your order #:" . $request->register['InvoiceNumber'] . " has already been packed and ready to pickup.";
            $notif->link = "userOrder";
            $notif->status = "undone";

            $notif->save();

            return response()->json([
                'status' => true,
                'data' => customerPickupInfos::with('orders')->get(),
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'data' => "Item not found.",
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

    }
}
