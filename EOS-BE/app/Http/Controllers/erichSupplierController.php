<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\erichSupplierList;

class erichSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'data' => erichSupplierList::where('status', 'Active')->get()
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
        $register = new erichSupplierList();

        $register->supplierName = $request->register['supplierName'];
        $register->contactNumber = $request->register['contact'];
        $register->address = $request->register['address'];
        $register->product = $request->register['supplierProduct'];
        $register->notes = $request->register['notes'];
        $register->status = 'Active';

        $register->save();

        return response()->json([
            'data' => $register,
            'suppliers' => erichSupplierList::where('status', 'Active')->get()
        ]);
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
    public function edit(Request $request, $id)
    {
        $existingItem = erichSupplierList::find($id);

        $existingItem->status = 'Inactive';

        $existingItem->save();

        return response()->json([
            'data' => erichSupplierList::where('status', 'Active')->get()
        ]);
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
        $existingItem = erichSupplierList::find($id);

        $existingItem->supplierName = $request->register['supplierName'];
        $existingItem->contactNumber = $request->register['contact'];
        $existingItem->address = $request->register['address'];
        $existingItem->product = $request->register['supplierProduct'];
        $existingItem->notes = $request->register['notes'];

        $existingItem->save();

        return response()->json([
            'data' => $existingItem,
            'suppliers' => erichSupplierList::where('status', 'Active')->get()
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
        //
    }
}
