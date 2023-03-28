<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;
use App\Models\Customer;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('store');
        $this->middleware('can:show all users')->only(['index']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
        
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255|',
            'email'=>'required|email|max:255|unique:users',
            'password'=>'required|string|max:255|',
            'confirmed'=>'required|string|max:255|',
            'number_document'=>'required|integer',

            //Customers Data
            'mobile_number'=>'required|integer',
            'address'=>'required|string|max:255',            
        ]);

        $user = User::create([
            'name'=>$request->name,
            'number_document'=>$request->number_document,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'confirmed'=>$request->password
        ]);

        if($user->is_admin){
            $user->assignRole('admin');
        }
        $user->assignRole('customer');



        Customer::create([
            'address'=>$request->address,
            'mobile_number'=>$request->mobile_number,
            'user_id'=>$user->id
        ]);

        return UserResource::make($user);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
