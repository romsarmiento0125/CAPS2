<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customerOrderInfo;
use App\Models\customerCancelItems;
use App\Models\customerDeliverItems;

class userOrderCancel extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return customerCancelItems::with('orders')->get();
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
        $register->cancelReason = $request->cancelReason;

        $register->save();

        $id = $request->userid;

        $existingItem = customerDeliverItems::find($id);

        if( $existingItem){
            $existingItem->delete();
            return response()->json([
                'status' => true,
                'data' => customerDeliverItems::with('orders')->get(),
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'data' => "Item Not Found",
            ]);
        }
    }

    public function customerDelete(Request $request)
    {
        if($request->cancelReason == ""){
            $reasons = "No Reasons from customer";
        }
        else{
            $reasons = $request->cancelReason;
        }

        $register = new customerCancelItems();

        $register->email = $request->register['email'];
        $register->invoiceNumber = $request->register['invoiceNumber'];
        $register->name = $request->register['name'];
        $register->mobileNumber = $request->register['mobileNumber'];
        $register->completeAddress = $request->register['completeAddress'];
        $register->status = "Cancel";
        $register->orderYear = $request->register['orderYear'];
        $register->orderMonth = $request->register['orderMonth'];
        $register->orderDay = $request->register['orderDay'];
        $register->adjustedDate = $request->register['adjustedDate'];
        $register->shipFee = $request->register['shipFee'];
        $register->discount = $request->register['discount'];
        $register->tax = $request->register['tax'];
        $register->subTotal = $request->register['subTotal'];
        $register->total = $request->register['total'];
        $register->cancelReason = $reasons;

        $register->save();

        $id = $request->userid;

        $existingItem = customerOrderInfo::find($id);

        if( $existingItem){
            $existingItem->delete();
            return response()->json([
                'status' => true,
                'data' => customerOrderInfo::with('orders')->where('email', $request->register['email'])->get(),
                'delete' => customerCancelItems::with('orders')->where('email', $request->register['email'])->get(),
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
