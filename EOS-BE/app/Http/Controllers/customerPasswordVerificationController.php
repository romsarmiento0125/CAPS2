<?php

namespace App\Http\Controllers;

use App\Mail\changePass;
use Illuminate\Http\Request;

use App\Models\erichcustomer;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class customerPasswordVerificationController extends Controller
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

    public function findemail(Request $request)
    {
        $email = $request->find['email'];

        $findEmail = erichcustomer::where('email', $email)->get('email');
        $findId = erichcustomer::where('email', $email)->get('id')->first();
        
        if($findEmail->first()){
            $details = [
                'code' => $request->find['code'],
            ];
    
            Mail::to($request->find['email'])->send(new changePass($details));
            return $findId->id;
        }
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
        $existingItem = erichcustomer::find($id);

        $newPass = Hash::make($request->pass);
        
        $existingItem->password = $newPass;
        $existingItem->save();

        return $existingItem;
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
