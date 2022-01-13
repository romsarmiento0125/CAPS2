<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customerPhysicalItems;
use App\Models\customerPhysicalOrders;

class physicalCashierOrders extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return customerPhysicalOrders::with('orders')->get();
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
        $register = new customerPhysicalOrders();

        $register->invoiceNumber = $request->orderinfo['InvoiceNumber'];
        $register->completeDate = $request->orderinfo['CompleteDate'];
        $register->discount = $request->orderinfo['Discount'];
        $register->tax = $request->orderinfo['OrderTax'];
        $register->subTotal = $request->orderinfo['SubTotal'];
        $register->total = $request->orderinfo['Total'];

        $register->save();

        // return $register;

        if(isset($request)){
            for($i = 0; $i < count($request->register); $i++){
                $register = new customerPhysicalItems();
                $register->invoiceNumber = $request->orderinfo['InvoiceNumber'];
                $register->itemName = $request->register[$i]['itemName'];
                $register->itemDesc = $request->register[$i]['itemDesc'];
                $register->itemSize = $request->register[$i]['itemSize'];
                $register->discount = $request->register[$i]['itemDiscount'];
                $register->quantity = $request->register[$i]['itemQty'];
                $register->retailPrice = $request->register[$i]['itemPrice'];
                $register->itemCode = $request->register[$i]['itemCode'];
                $register->save();
            }
            return "Success";
        }
        else{
            return 'false';
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
