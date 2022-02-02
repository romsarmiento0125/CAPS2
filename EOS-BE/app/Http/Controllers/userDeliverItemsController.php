<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customerOrderInfo;
use App\Models\erichnotifications;
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
            
            $notif = new erichnotifications();

            $notif->email = $request->register['Email'];
            $notif->title = "Check your order";
            $notif->description = "Your order #:" . $request->register['InvoiceNumber'] . " has already been packed and ready to deliver.";
            $notif->link = "userOrder";
            $notif->status = "undone";

            $notif->save();

            return response()->json([
                'status' => true,
                'data' => customerOrderInfo::with('orders')->get(),
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
        
    }
}
