<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customerPickupItems;

class CustomerPickupItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        for($i = 0; $i < count($request->register); $i++){
            $register = new customerPickupItems();
            $register->InvoiceNumber = $request->register[$i]['item_invNumber'];
            $register->ItemName = $request->register[$i]['item_Name'];
            $register->ItemDesc = $request->register[$i]['item_Desc'];
            $register->Discount = $request->register[$i]['item_Discount'];
            $register->Quantity = $request->register[$i]['item_Quantity'];
            $register->RetailPrice = $request->register[$i]['item_Price'];
            $register->ItemCode = $request->register[$i]['item_Code'];
            $register->ItemImage = $request->register[$i]['item_Image'];
            $register->save();
        }

        return "Success";
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
