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
        $register = new customerOrderItems();

        $register->InvoiceNumber = $request->register['item_invNumber'];
        $register->ItemName = $request->register['item_Name'];
        $register->ItemDesc = $request->register['item_Desc'];
        $register->Quantity = $request->register['item_Quantity'];
        $register->RetailPrice = $request->register['item_Price'];
        $register->ItemCode = $request->register['item_Code'];
        $register->ItemImage = $request->register['item_Image'];

        $register->save();

        return $register;
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
