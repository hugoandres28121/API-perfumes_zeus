<?php

use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\FraganceController;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\PaymentController;
use App\Http\Controllers\api\SaleController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



//Login
Route::post('login',[LoginController::class,'login']);

//Payments
Route::get('payments',[PaymentController::class,'index']);
Route::get('payments/{id}',[PaymentController::class,'show']);
Route::post('payments',[PaymentController::class,'paySale']);

//Api resources
Route::apiResource('users', UserController::class)->names("api.v1.users",);
Route::apiResource('customers', CustomerController::class)->names("api.v1.customers",);
Route::apiResource('fragances', FraganceController::class)->names("api.v1.fragances",);
Route::apiResource('sales', SaleController::class)->names("api.v1.sales",);


Route::get('users/{cedula}/sales',[SaleController::class,'showSalesByUser']);

