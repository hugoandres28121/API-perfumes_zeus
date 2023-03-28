<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function __construct()
     {
         $this->middleware('auth:api');
         $this->middleware('can:show all customers')->only(['index']);
         $this->middleware('can:show customer')->only(['show']);
         $this->middleware('can:edit customer')->only(['update']);
         $this->middleware('can:create customer')->only(['store']);
     }

    public function index()
    {
        $customers= Customer::all();
        return CustomerResource::collection($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'slug'=>'required|string|max:255|unique:customers',
            'name'=>'required|string|max:255',
            'lastName'=>'required|string|max:255',
            'address'=>'required|string|max:255'
        ]);

        $customer=Customer::create($request->all());
        return CustomerResource::make($customer);


    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);
        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'lastName'=>'required|string|max:255',
            'address'=>'required|string|max:255'
        ]);

        $customer->update($request->all());
        return CustomerResource::make($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->noContent();
    }
}
