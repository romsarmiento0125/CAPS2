<?php

namespace App\Http\Controllers;

use App\Models\customercart;
use Illuminate\Http\Request;
use App\Models\customerOrderInfo;
use App\Models\customerOrderItems;
use App\Models\erichnotifications;
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

        for($i = 0; $i < count($request->items); $i++){
            $item = new customerOrderItems();
            $existingItem = customercart::find($request->items[$i]['id']);
            $item->invoiceNumber = $request->items[$i]['item_invNumber'];
            $item->itemName = $request->items[$i]['item_Name'];
            $item->itemDesc = $request->items[$i]['item_Desc'];
            $item->itemSize = $request->items[$i]['item_Size'];
            $item->discount = $request->items[$i]['item_Discount'];
            $item->quantity = $request->items[$i]['item_Quantity'];
            $item->retailPrice = $request->items[$i]['item_Price'];
            $item->itemCode = $request->items[$i]['item_Code'];
            $item->itemImage = $request->items[$i]['item_Image'];
            $existingItem->delete();
            $item->save();
        }

        $notif = new erichnotifications();

        $notif->email = $request->register['Email'];
        $notif->title = "Check your order";
        $notif->description = "Your order #:" . $request->register['InvoiceNumber'] . " has already been place.";
        $notif->link = "userOrder";
        $notif->status = "undone";

        $notif->save();

        return response()->json([
            'status' => true,
        ]);
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
        
        $existingItem->status = $request->register['OrderStatus'];

        $existingItem->save();

        $notif = new erichnotifications();

        $notif->email = $request->register['Email'];
        $notif->title = "Check your order";
        $notif->description = "Your order #:" . $request->register['InvoiceNumber'] . " has already been accepted.";
        $notif->link = "userOrder";
        $notif->status = "undone";

        $notif->save();

        //return $existingItem;
        return response()->json([
            'data' => customerOrderInfo::with('orders')->get(),
        ]);
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
