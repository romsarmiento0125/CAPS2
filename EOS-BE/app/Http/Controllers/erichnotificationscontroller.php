<?php

namespace App\Http\Controllers;

use App\Models\customercart;
use Illuminate\Http\Request;
use App\Models\erichnotifications;

class erichnotificationscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $path = public_path();

        return $path;
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
        $register = new erichnotifications();

        $register->email = $request->clientCred['usersEmail'];
        $register->title = "Verify";
        $register->description = "Verify Your Email";
        $register->link = "verify";
        $register->status = "undone";

        $register->save();

        return $register;
    }

    public function getnotif(Request $request)
    {
        $showQuantity = 0;
        $getQuantity = customercart::where('email', $request->customeremail)->get('quantity');

        foreach($getQuantity as $value){
            $showQuantity += $value->quantity;
        };

        $notif = erichnotifications::all()->where('email', $request->customeremail)->where('status', 'undone')->values();
        
        
        return response()->json([
            'notif' => $notif,
            'quantity' => $showQuantity
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
        $existingItem = erichnotifications::find($id);

        $existingItem->status = $request->userstatus;
        
        $existingItem->save();
        
        return response()->json([
            'status' => true,
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
