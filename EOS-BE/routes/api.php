<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\erichcustomercontroller;
use App\Http\Controllers\erichlogincontroller;
use App\Http\Controllers\erichcategoryitemscontroller;
use App\Http\Controllers\customercartcontroller;
use App\Http\Controllers\erichgetcartitems;
use App\Http\Controllers\erichheadercartcontroller;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/customers', [erichcustomercontroller::class, 'index']);
Route::prefix('/customers')->group( function () {
    Route::post('/store', [erichcustomercontroller::class, 'store']);
    Route::put('/{id}', [erichcustomercontroller::class, 'update']);
    Route::delete('/{id}', [erichcustomercontroller::class, 'destroy']);
});

Route::get('/customerlogin', [erichlogincontroller::class, 'index']);
Route::prefix('/customerlogin')->group( function () {
    Route::post('/store', [erichlogincontroller::class, 'store']);
    Route::put('/{id}', [erichlogincontroller::class, 'update']);
    Route::delete('/{id}', [erichlogincontroller::class, 'destroy']);
});

Route::get('/categoryitem', [erichcategoryitemscontroller::class, 'index']);
Route::prefix('/categoryitem')->group( function () {
    Route::post('/store', [erichcategoryitemscontroller::class, 'store']);
    Route::put('/{id}', [erichcategoryitemscontroller::class, 'update']);
    Route::delete('/{id}', [erichcategoryitemscontroller::class, 'destroy']);
});

Route::get('/customercart', [customercartcontroller::class, 'index']);
Route::prefix('/customercart')->group( function () {
    Route::post('/store', [customercartcontroller::class, 'store']);
    Route::put('/{id}', [customercartcontroller::class, 'update']);
    Route::delete('/{id}', [customercartcontroller::class, 'destroy']);
});

Route::get('/headercart', [erichheadercartcontroller::class, 'index']);
Route::prefix('/headercart')->group( function () {
    Route::post('/store', [erichheadercartcontroller::class, 'store']);
    Route::put('/{id}', [erichheadercartcontroller::class, 'update']);
    Route::delete('/{id}', [erichheadercartcontroller::class, 'destroy']);
});

Route::get('/getcart', [erichgetcartitems::class, 'index']);
Route::prefix('/getcart')->group( function () {
    Route::post('/store', [erichgetcartitems::class, 'store']);
    Route::put('/{id}', [erichgetcartitems::class, 'update']);
    Route::delete('/{id}', [erichgetcartitems::class, 'destroy']);
});