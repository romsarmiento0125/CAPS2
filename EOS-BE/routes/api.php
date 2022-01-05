<?php

use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\erichgetcartitems;
use App\Http\Controllers\userOrderController;
use App\Http\Controllers\erichlogincontroller;
use App\Http\Controllers\customercartcontroller;
use App\Http\Controllers\loginaddresscontroller;
use App\Http\Controllers\erichcustomercontroller;
use App\Http\Controllers\customeraddresscontroller;
use App\Http\Controllers\erichheadercartcontroller;
use App\Http\Controllers\userOrderPickupController;
use App\Http\Controllers\userDeliverItemsController;
use App\Http\Controllers\customerOrderInfoController;
use App\Http\Controllers\userCompleteItemsController;
use App\Http\Controllers\userOrderCompleteController;
use App\Http\Controllers\userOrderDeliveryController;
use App\Http\Controllers\userOrderToPickupController;
use App\Http\Controllers\customerOrderItemsController;
use App\Http\Controllers\erichcategoryitemscontroller;
use App\Http\Controllers\CustomerPickupInfosController;
use App\Http\Controllers\CustomerPickupItemsController;
use App\Http\Controllers\CustomerPickupPickupController;
use App\Http\Controllers\erichnotificationscontroller;

use App\Http\Controllers\CustomerPickupCompleteController;
use App\Http\Controllers\userOrderToPickupCompleteController;

use App\Http\Controllers\verifyemailcontroller;
use App\Http\Controllers\testemailcontroller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group( function (){
    Route::get('/loginaddress', [loginaddresscontroller::class, 'index']);
    Route::post('loginaddress/store', [loginaddresscontroller::class, 'store']);

    Route::get('/headercart', [erichheadercartcontroller::class, 'index']);
    Route::post('/headercart/store', [erichheadercartcontroller::class, 'store']);
    Route::put('/headercart/{id}', [erichheadercartcontroller::class, 'update']);

    Route::get('/userorder', [userOrderController::class, 'index']);
    Route::post('/userorder/store', [userOrderController::class, 'store']);
    Route::post('/userorderdelivery/store', [userOrderDeliveryController::class, 'store']);
    Route::post('/userordercomplete/store', [userOrderCompleteController::class, 'store']);
    Route::post('/userorderpickup/store', [userOrderPickupController::class, 'store']);
    Route::post('/userpickuppickup/store', [userOrderToPickupController::class, 'store']);
    Route::post('/userpickupcomplete/store', [userOrderToPickupCompleteController::class, 'store']);

    Route::get('/customercart', [customercartcontroller::class, 'index']);
    Route::post('/customercart/store', [customercartcontroller::class, 'store']);
    Route::put('/customercart/{id}', [customercartcontroller::class, 'update']);

    Route::get('/headercart', [erichheadercartcontroller::class, 'index']);
    Route::post('/headercart/store', [erichheadercartcontroller::class, 'store']);
    Route::put('/headercart/{id}', [erichheadercartcontroller::class, 'update']);
    Route::get('/getcart', [erichgetcartitems::class, 'index']);
    Route::post('/getcart/store', [erichgetcartitems::class, 'store']);
    Route::put('/getcart/{id}', [erichgetcartitems::class, 'update']);
    Route::delete('/getcart/{id}', [erichgetcartitems::class, 'destroy']);

    Route::get('/customerpickup', [CustomerPickupInfosController::class, 'index']);
    Route::post('/customerpickup/store', [CustomerPickupInfosController::class, 'store']);
    Route::put('/customerpickup/{id}', [CustomerPickupInfosController::class, 'update']);
    Route::delete('/customerpickup/{id}', [CustomerPickupInfosController::class, 'destroy']);
    Route::post('/customerpickupitems/store', [CustomerPickupItemsController::class, 'store']);

    Route::get('/customerorder', [customerOrderInfoController::class, 'index']);
    Route::post('/customerorder/store', [customerOrderInfoController::class, 'store']);
    Route::put('/customerorder/{id}', [customerOrderInfoController::class, 'update']);
    Route::delete('/customerorder/{id}', [customerOrderInfoController::class, 'destroy']);
    Route::get('/customerorderitems', [customerOrderItemsController::class, 'index']);
    Route::post('/customerorderitems/store', [customerOrderItemsController::class, 'store']);

    Route::get('/customerdeliveritems', [userDeliverItemsController::class, 'index']);
    Route::post('/customerdeliveritems/store', [userDeliverItemsController::class, 'store']);
    Route::delete('/customerdeliveritems/{id}', [userDeliverItemsController::class, 'destroy']);
    Route::get('/customercompleteitems', [userCompleteItemsController::class, 'index']);
    Route::post('/customercompleteitems/store', [userCompleteItemsController::class, 'store']);
    Route::get('/customerpickuppickup', [CustomerPickupPickupController::class, 'index']);
    Route::post('/customerpickuppickup/store', [CustomerPickupPickupController::class, 'store']);
    Route::delete('/customerpickuppickup/{id}', [CustomerPickupPickupController::class, 'destroy']);
    Route::get('/customerpickupcomplete', [CustomerPickupCompleteController::class, 'index']);
    Route::post('/customerpickupcomplete/store', [CustomerPickupCompleteController::class, 'store']);

    Route::post('/emailverification', [testemailcontroller::class, 'email']);
    Route::put('/verifyemail/{id}', [verifyemailcontroller::class, 'verify']);

    Route::post('/customernotif/getnotif', [erichnotificationscontroller::class, 'getnotif']);
    Route::put('/customernotifstatus/{id}', [erichnotificationscontroller::class, 'update']);
});

Route::post('/customerlogin',[erichlogincontroller::class,'login']);

Route::get('/categoryitem', [erichcategoryitemscontroller::class, 'index']);

Route::get('/customers', [erichcustomercontroller::class, 'index']);
Route::post('/customers/store', [erichcustomercontroller::class, 'store']);

Route::get('/customeraddress', [customeraddresscontroller::class, 'index']);
Route::post('/customeraddress/store', [customeraddresscontroller::class, 'store']);

Route::post('/customernotif/store', [erichnotificationscontroller::class, 'store']);

// // Route::get('/customerlogin', [erichlogincontroller::class, 'index']);
// // Route::prefix('/customerlogin')->group( function () {
// //     Route::post('/store', [erichlogincontroller::class, 'store']);
// // });

// Route::get('/categoryitem', [erichcategoryitemscontroller::class, 'index']);

// Route::get('/customercart', [customercartcontroller::class, 'index']);
// Route::prefix('/customercart')->group( function () {
//     Route::post('/store', [customercartcontroller::class, 'store']);
//     Route::put('/{id}', [customercartcontroller::class, 'update']);
// });

// Route::get('/headercart', [erichheadercartcontroller::class, 'index']);
// Route::prefix('/headercart')->group( function () {
//     Route::post('/store', [erichheadercartcontroller::class, 'store']);
//     Route::put('/{id}', [erichheadercartcontroller::class, 'update']);
// });

// Route::get('/getcart', [erichgetcartitems::class, 'index']);
// Route::prefix('/getcart')->group( function () {
//     Route::post('/store', [erichgetcartitems::class, 'store']);
//     Route::put('/{id}', [erichgetcartitems::class, 'update']);
//     Route::delete('/{id}', [erichgetcartitems::class, 'destroy']);
// });

// Route::get('/customeraddress', [customeraddresscontroller::class, 'index']);
// Route::prefix('/customeraddress')->group( function () {
//     Route::post('/store', [customeraddresscontroller::class, 'store']);
// });

// Route::get('/loginaddress', [loginaddresscontroller::class, 'index']);
// Route::prefix('/loginaddress')->group( function () {
//     Route::post('/store', [loginaddresscontroller::class, 'store']);
// });

// Route::get('/customerorder', [customerOrderInfoController::class, 'index']);
// Route::prefix('/customerorder')->group( function () {
//     Route::post('/store', [customerOrderInfoController::class, 'store']);
//     Route::put('/{id}', [customerOrderInfoController::class, 'update']);
//     Route::delete('/{id}', [customerOrderInfoController::class, 'destroy']);
// });

// Route::get('/customerorderitems', [customerOrderItemsController::class, 'index']);
// Route::prefix('/customerorderitems')->group( function () {
//     Route::post('/store', [customerOrderItemsController::class, 'store']);
// });

// Route::get('/userorder', [userOrderController::class, 'index']);
// Route::prefix('/userorder')->group( function () {
//     Route::post('/store', [userOrderController::class, 'store']);
// });

// Route::get('/userorderdelivery', [userOrderDeliveryController::class, 'index']);
// Route::prefix('/userorderdelivery')->group( function () {
//     Route::post('/store', [userOrderDeliveryController::class, 'store']);
// });

// Route::get('/userordercomplete', [userOrderCompleteController::class, 'index']);
// Route::prefix('/userordercomplete')->group( function () {
//     Route::post('/store', [userOrderCompleteController::class, 'store']);
// });

// Route::get('/customerdeliveritems', [userDeliverItemsController::class, 'index']);
// Route::prefix('/customerdeliveritems')->group( function () {
//     Route::post('/store', [userDeliverItemsController::class, 'store']);
//     Route::delete('/{id}', [userDeliverItemsController::class, 'destroy']);
// });

// Route::get('/customercompleteitems', [userCompleteItemsController::class, 'index']);
// Route::prefix('/customercompleteitems')->group( function () {
//     Route::post('/store', [userCompleteItemsController::class, 'store']);
// });

// Route::get('/customerpickup', [CustomerPickupInfosController::class, 'index']);
// Route::prefix('/customerpickup')->group( function () {
//     Route::post('/store', [CustomerPickupInfosController::class, 'store']);
//     Route::put('/{id}', [CustomerPickupInfosController::class, 'update']);
//     Route::delete('/{id}', [CustomerPickupInfosController::class, 'destroy']);
// });

// Route::get('/customerpickupitems', [CustomerPickupItemsController::class, 'index']);
// Route::prefix('/customerpickupitems')->group( function () {
//     Route::post('/store', [CustomerPickupItemsController::class, 'store']);
// });

// Route::get('/customerpickuppickup', [CustomerPickupPickupController::class, 'index']);
// Route::prefix('/customerpickuppickup')->group( function () {
//     Route::post('/store', [CustomerPickupPickupController::class, 'store']);
//     Route::delete('/{id}', [CustomerPickupPickupController::class, 'destroy']);
// });

// Route::get('/customerpickupcomplete', [CustomerPickupCompleteController::class, 'index']);
// Route::prefix('/customerpickupcomplete')->group( function () {
//     Route::post('/store', [CustomerPickupCompleteController::class, 'store']);
// });

// Route::get('/userorderpickup', [userOrderPickupController::class, 'index']);
// Route::prefix('/userorderpickup')->group( function () {
//     Route::post('/store', [userOrderPickupController::class, 'store']);
// });

// Route::get('/userpickuppickup', [userOrderToPickupController::class, 'index']);
// Route::prefix('/userpickuppickup')->group( function () {
//     Route::post('/store', [userOrderToPickupController::class, 'store']);
// });

// Route::get('/userpickupcomplete', [userOrderToPickupCompleteController::class, 'index']);
// Route::prefix('/userpickupcomplete')->group( function () {
//     Route::post('/store', [userOrderToPickupCompleteController::class, 'store']);
// });