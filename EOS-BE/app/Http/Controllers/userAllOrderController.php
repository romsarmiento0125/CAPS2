<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customerOrderInfo;
use App\Models\customerCancelItems;
use App\Models\customerPickupInfos;
use App\Models\customerDeliverItems;
use App\Models\customerPickupCancel;
use App\Models\customerPickupPickup;
use App\Models\customerCompleteItems;
use App\Models\customerPickupComplete;

class userAllOrderController extends Controller
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
        $dataGet = $request->register;

        $dtpack = customerOrderInfo::with('orders')->where('email', $dataGet)->get();
        $dtdeliver = customerDeliverItems::with('orders')->where('email', $dataGet)->get();
        $dtcomplete = customerCompleteItems::with('orders')->where('email', $dataGet)->get();
        $dtcancel = customerCancelItems::with('orders')->where('email', $dataGet)->get();
        
        $ptpack = customerPickupInfos::with('orders')->where('email', $dataGet)->get();
        $ptpick = customerPickupPickup::with('orders')->where('email', $dataGet)->get();
        $ptcomplete = customerPickupComplete::with('orders')->where('email', $dataGet)->get();
        $ptcancel = customerPickupCancel::with('orders')->where('email', $dataGet)->get();

        return response()->json([
            'dtpack' => $dtpack,
            'dtdel' => $dtdeliver,
            'dtcomp' => $dtcomplete,
            'dtcancel' => $dtcancel,
            'ptpack' => $ptpack,
            'ptpick' => $ptpick,
            'ptcomp' => $ptcomplete,
            'ptcancel' => $ptcancel,
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
