<?php

use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\FraganceController;
use App\Http\Controllers\api\LoginController;
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

Route::post('login',[LoginController::class,'login']);
Route::get('users/{cedula}/sales',[SaleController::class,'showSalesByUser']);
Route::apiResource('users', UserController::class)->names("api.v1.users",);
Route::apiResource('customers', CustomerController::class)->names("api.v1.customers",);
Route::apiResource('fragances', FraganceController::class)->names("api.v1.fragances",);
Route::apiResource('sales', SaleController::class)->names("api.v1.sales",);



