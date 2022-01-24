<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categoryItems;

class adminAddItem extends Controller
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
        // guessExtension()     getClientOriginalName()
        // getMimeType()        getClientNameType()
        // store()              guessClientExtension()
        // asStore()            getSize()
        // storePublicly()      getError()
        // move()               isValid()

        $pathToFile = $request->file('image')->store('images', 'public');
        $imageName = time() . "-" . $request->file('image')->getClientOriginalName();
        $pathToSave = public_path('assets\itemPhotos');

        $addItem = new categoryItems();

        $addItem->name = $request->get('name');
        $addItem->description = $request->get('desc');
        $addItem->supplierPrice = $request->get('supplierPrice');
        $addItem->retailPrice = $request->get('retailPrice');
        $addItem->size = $request->get('size');
        $addItem->quantity = $request->get('quantity');
        $addItem->qtyLimit = $request->get('qtyLimit');
        $addItem->itemCode = $request->get('itemCode');
        $addItem->category = $request->get('category');
        $addItem->expirationDate = $request->get('expirationDate');
        $addItem->image = $imageName;
        $addItem->discount = $request->get('discount');
        $addItem->underCategory = $request->get('underCategory');

        $addItem->save();
        
        $imageSave = $request->file('image')->move($pathToSave, $imageName);

        return response()->json([
            'data' => $addItem,
            'image' => $imageSave,
            'allItems' => categoryItems::all(),
            'path' => categoryItems::imagesSrc()
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
