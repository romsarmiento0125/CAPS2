<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categoryItems;
use App\Models\customerPickupItems;
use App\Models\customerPickupPickup;
use App\Models\customerPickupComplete;

class CustomerPickupCompleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return customerPickupComplete::with('orders')->get();
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
        $register = new customerPickupComplete();

        $ivNumber = $request->register['InvoiceNumber'];
        $itemCode = customerPickupItems::where('invoiceNumber', $ivNumber)->get(['itemCode', 'quantity']);
        $itemId = null;
        $existingItem = [];

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

        foreach($itemCode as $value){
            $itemId = categoryItems::where('itemCode' , $value->itemCode)->get()->pluck('id');
            $existingItem = categoryItems::find($itemId);
            foreach($existingItem as $item){
                $updateItem = categoryItems::find($item->id);
                $updateItem->quantity = $updateItem->quantity - $value->quantity;
                $updateItem->save();
            }
        }

        $id = $request->userid;

        $existingItem = customerPickupPickup::find($id);

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
