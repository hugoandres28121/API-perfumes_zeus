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
            //Customers Data
            'type_document'=>'required|integer|in:1,2',
            'number_document'=>'required|integer',
            'address'=>'required|string|max:255',
            'lastName'=>'required|string|max:255'
            
        ]);

        $user = User::create([
            'name'=>$request->name,
            'number_document'=>$request->number_document,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'confirmed'=>$request->password
        ]);

        Customer::create([
            'slug'=>Str::slug(request('name').' '.request('lastName').' '.request('number_document')),
            'name'=>$request->name,
            'lastName'=>$request->lastName,
            'address'=>$request->address,
            'type_document'=>$request->type_document,
            'number_document'=>$request->number_document
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
