<?php

namespace App\Http\Controllers;
use App\Models\customerOrderItems;

use Illuminate\Http\Request;

class customerOrderItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return customerOrderItems::all();
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
            for($i = 0; $i < count($request->register); $i++){
                $register = new customerOrderItems();
                $register->invoiceNumber = $request->register[$i]['item_invNumber'];
                $register->itemName = $request->register[$i]['item_Name'];
                $register->itemDesc = $request->register[$i]['item_Desc'];
                $register->itemSize = $request->register[$i]['item_Size'];
                $register->discount = $request->register[$i]['item_Discount'];
                $register->quantity = $request->register[$i]['item_Quantity'];
                $register->retailPrice = $request->register[$i]['item_Price'];
                $register->itemCode = $request->register[$i]['item_Code'];
                $register->itemImage = $request->register[$i]['item_Image'];
                $register->save();
            }
        }
        else{
            return 'false';
        }
        

        // $register->InvoiceNumber = $request->register['item_invNumber'];
        // $register->ItemName = $request->register['item_Name'];
        // $register->ItemDesc = $request->register['item_Desc'];
        // $register->Quantity = $request->register['item_Quantity'];
        // $register->RetailPrice = $request->register['item_Price'];
        // $register->ItemCode = $request->register['item_Code'];
        // $register->ItemImage = $request->register['item_Image'];

        

        return "Success";
       // return $request->register[0]['item_invNumber'];
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
