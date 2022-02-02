<?php

namespace App\Http\Controllers;

use App\Models\customercart;
use Illuminate\Http\Request;
use App\Models\erichnotifications;
use App\Models\customerPickupInfos;
use App\Models\customerPickupItems;

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
        $info = $request->register;
        $items = $request->items;

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

        for($i = 0; $i < count($request->items); $i++){
            $item = new customerPickupItems();
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

            // $register = new customerPickupInfos();

            // $register->email = $request->register['Email'];
            // $register->invoiceNumber = $request->register['InvoiceNumber'];
            // $register->name = $request->register['Name'];
            // $register->mobileNumber = $request->register['Mobilenumber'];
            // $register->status = $request->register['Status'];
            // $register->pickupDate = $request->register['pickupDate'];
            // $register->pickupTime = $request->register['pickupTime'];
            // $register->discount = $request->register['Discount'];
            // $register->tax = $request->register['OrderTax'];
            // $register->subTotal = $request->register['SubTotal'];
            // $register->total = $request->register['Total'];

            // // $register->save();

            // return $register;


            // for($i = 0; $i < count($request->register); $i++){
            //     $register = new customerPickupItems();
            //     $register->invoiceNumber = $request->register[$i]['item_invNumber'];
            //     $register->itemName = $request->register[$i]['item_Name'];
            //     $register->itemDesc = $request->register[$i]['item_Desc'];
            //     $register->itemSize = $request->register[$i]['item_Size'];
            //     $register->discount = $request->register[$i]['item_Discount'];
            //     $register->quantity = $request->register[$i]['item_Quantity'];
            //     $register->retailPrice = $request->register[$i]['item_Price'];
            //     $register->itemCode = $request->register[$i]['item_Code'];
            //     $register->itemImage = $request->register[$i]['item_Image'];
            //     // $register->save();
            // }

            // $existingItem = customercart::find($id);

            // if( $existingItem){
            //     // $existingItem->delete();
            //     return "Item succesfully deleted.";
            // }

    
        
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

        $existingItem->status = $request->register['OrderStatus'];

        $existingItem->save();

        $notif = new erichnotifications();

        $notif->email = $request->register['Email'];
        $notif->title = "Check your order";
        $notif->description = "Your order #:" . $request->register['InvoiceNumber'] . " has already been accepted";
        $notif->link = "userOrder";
        $notif->status = "undone";

        $notif->save();

        //return $existingItem;
        return response()->json([
            'data' => customerPickupInfos::with('orders')->get(),
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
