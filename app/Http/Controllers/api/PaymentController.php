<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Sale;
use App\Http\Resources\PaymentResource;

class PaymentController extends Controller
{
    public function index()
    {
        $payments= Payment::all();
        return PaymentResource::collection($payments);
    }

    public function paySale(Request $request)
    {
        $data = $request->validate([
            'sale_id'=>'required|integer|exists:sales,id',
            'amount_paid'=>'required|decimal:2,10'
        ]);

        $amount_paid = $data['amount_paid'];

        $payment = Payment::create([
            'payment_date' =>now()->toDateTimeString(),
            'sale_id'=>$data['sale_id'],
            'amount_paid'=>$amount_paid,
        ]);

        

        $amount_paid_sale=$payment->sale->amount_paid;

        $sale = Sale::find($data['sale_id']);
         
        $sale->update([
            'amount_paid'=>$amount_paid_sale+$amount_paid
        ]);



        return PaymentResource::make($payment);
    }

    public function show($id)
    {

    }
}