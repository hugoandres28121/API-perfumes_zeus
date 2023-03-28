<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fragance;
use App\Http\Resources\FraganceResource;
use Illuminate\Validation\Rules\Enum;

class FraganceController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function __construct()
     {
         $this->middleware('auth:api');
         $this->middleware('can:show all fragances')->only(['index']);
         $this->middleware('can:show fragance')->only(['show']);  
         $this->middleware('can:edit fragance')->only(['update']);
         $this->middleware('can:create fragance')->only(['store']);
         $this->middleware('can:delete fragance')->only(['destroy']);
     }

    public function index()
    {
        $fragances = Fragance::all();
        return FraganceResource::collection($fragances);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'slug'=>'required|string|max:255|unique:fragances',
            'name'=>'required|string|max:255|unique:fragances',
            'bottle_contents_ml'=>'required|decimal:2,10',
            'price'=>'required|decimal:2,10',
            'gender'=>'required|integer|in:1,2',
            'quantity_stock'=>'required|integer'
        ]);

        $fragance=Fragance::create($request->all());
        return FraganceResource::make($fragance);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fragance=Fragance::findOrFail($id);
        return new FraganceResource($fragance);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fragance $fragance)
    {
        $request->validate([
            'slug'=>'required|string|max:255|unique:fragances,slug,'.$fragance->id,
            'name'=>'required|string|max:255|unique:fragances,name,'.$fragance->id,
            'bottle_contents_ml'=>'required|decimal:2,10',
            'price'=>'required|decimal:2,10',
            'gender'=>'required|integer|in:1,2',
            'quantity_stock'=>'required|integer'
        ]);

        $fragance->update($request->all());
        return FraganceResource::make($fragance);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fragance $fragance)
    {
        $fragance->delete();

        return response()->noContent();
    }
}
