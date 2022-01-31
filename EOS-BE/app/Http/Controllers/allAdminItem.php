<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\erichcustomer;
use App\Models\erichSupplierList;
use App\Models\customerCompleteItems;
use App\Models\customerPhysicalOrders;
use App\Models\customerPickupComplete;

class allAdminItem extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliverComplete = customerCompleteItems::with('orders')->get();
        $pickupComplete = customerPickupComplete::with('orders')->get();
        $physicalComplete = customerPhysicalOrders::with('orders')->get();
        $user = erichcustomer::all();
        $supplier = erichSupplierList::where('status', 'Active')->get();
        
        return response()->json([
            'deliver' => $deliverComplete,
            'pickup' => $pickupComplete,
            'physical' => $physicalComplete,
            'user' => $user,
            'supplier' => $supplier

        ]);
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
        //
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
