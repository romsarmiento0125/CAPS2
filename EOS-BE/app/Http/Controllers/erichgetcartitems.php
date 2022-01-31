<?php

namespace App\Http\Controllers;

use App\Models\customercart;
use Illuminate\Http\Request;
use App\Models\categoryItems;

class erichgetcartitems extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return customercart::all();
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
        return customercart::where('email', $dataGet)->get();
    }

    public function deleteCartItem(Request $request)
    {
        $id = $request->id;
        $email = $request->register;

        $existingItem = customercart::find($id);
        

        if($existingItem){
            $existingItem->delete();
            return response()->json([
                'cart' => customercart::where('email', $email)->get(),
                'message' => "Item remove."
            ]);
        }
        else{
            return response()->json([
                'cart' => customercart::where('email', $email)->get(),
                'message' => "Item cannot be remove."
            ]);
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
        $item = $request->itemCode;

        $itemQty = categoryItems::where('itemCode', $item)->get('quantity')->first();
        $qtyLimit = categoryItems::where('itemCode', $item)->get('qtyLimit')->first();

        $existingItem = customercart::find($id);

        if($existingItem->quantity < 1){
            $existingItem->delete();
            return "Item succesfully deleted.";
        }
        else{
            $cond = $request->updateCond;
            $dataGet = $request->customerEmail;

            if($cond == "increase"){
                if($itemQty->quantity < (1 + $qtyLimit->qtyLimit + $existingItem->quantity)){
                    $existingItem->quantity = ($itemQty->quantity - $qtyLimit->qtyLimit);
                    $existingItem->save();
                }
                else{
                    $existingItem->quantity = $existingItem->quantity + 1;
                    $existingItem->save();
                }
                return customercart::where('email', $dataGet)->get();
            }
            else if($cond == "decrease"){
                $existingItem->quantity = $existingItem->quantity - 1;
                $existingItem->save();

                return customercart::where('email', $dataGet)->get();
            }
            else{
                return "something wrong";
            }
        }
        
        
        // $getData = customercart::all();
        // $dataGet = $request->itemupdate["item_email"];
        // $existingItem = customercart::find($id);
        // $existingQty = customercart::where('id', $id)->pluck('Quantity');
        // foreach($existingQty as $value){
        //     $qty = $value;
        // }
        // $add = $request->itemupdate["item_quantity"]+1;

        // if(true){
        //     $existingItem->id = $id;
        //     $existingItem->email = $request->itemupdate["item_email"];
        //     $existingItem->quantity = $add;
        //     $existingItem->itemCode = $request->itemupdate["item_code"];
        //     $existingItem->save();

        //     //return $existingItem;
        //     return $getData->where('email', $dataGet)->values();
        // }
        // else{
        //     return $getData->where('email', $dataGet)->values();;
        // }

        //return $request->itemupdate;
    }

    public function updateQty(Request $request, $id)
    {
        $qty = $request->updateQty;
        $email = $request->customerEmail;
        $item = $request->itemCode;

        $itemQty = categoryItems::where('itemCode', $item)->get('quantity')->first();
        $qtyLimit = categoryItems::where('itemCode', $item)->get('qtyLimit')->first();
        $existingItem = customercart::find($id);

        if($itemQty->quantity < ($qtyLimit->qtyLimit + ($qty * 1))){
            $existingItem->quantity = ($itemQty->quantity - $qtyLimit->qtyLimit);
            $existingItem->save();
        }
        else{
            $existingItem->quantity = $qty;
            $existingItem->save();
        }
        
        return response()->json([
            'data' => customercart::where('email', $email)->get(),
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
        $existingItem = customercart::find($id);

        if( $existingItem){
            $existingItem->delete();
            return "Item succesfully deleted.";
        }

        return "Item not Found";
        //return $existingItem;
        //return $id;
    }
}
