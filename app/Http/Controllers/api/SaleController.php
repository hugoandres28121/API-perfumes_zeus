<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Fragance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Resources\SaleResource;
use Error;
use App\Http\Resources\SaleDetailResource;
use App\Models\User;
use Exception;

class SaleController extends Controller
{

    public function __construct()
    {
       // $this->middleware('auth:api')->except('index','show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales =Sale::all();
        return $sales;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fragances' => 'required|array',
            'fragances.*.id' => 'required|integer|exists:fragances,id',
            'fragances.*.quantity' => 'required|integer',
            ]);

        DB::beginTransaction();

        try {
            // Crear la venta
            //$user_id=auth()->user()->id;
            $sale = Sale::create([
                'slug' => Str::slug(Str::random(10).' '.Str::random(10)), // Generar un código aleatorio de 10 caracteres
                'sale_date' =>  now()->toDateTimeString(),
                //'user_id' => $user_id,
                'user_id' => $request->user_id,
                'sale_status'=>1,
                'total_amount' => 0.00,
                'amount_paid' => 0.00,
            ]);

            // Crear el detalle de fragancias
            foreach ($validatedData['fragances'] as $fraganceData) {
                $id_fragance=$fraganceData['id'];
                $fragrances_solicited=$fraganceData['quantity'];

                $fragance=Fragance::findOrFail($id_fragance);

                $fragance_price=$fragance->price;
                $fragance_quantity_stock=$fragance->quantity_stock;

                if($fragrances_solicited<=$fragance_quantity_stock){
                    $sale->fragances()->attach($id_fragance, [
                        'quantity_fragrance' => $fragrances_solicited,
                        'amount' => $fragrances_solicited * $fragance_price, // Supongo que cada fragancia tiene un precio
                    ]);

                    $fragance->update([
                        'quantity_stock'=>$fragance_quantity_stock-$fragrances_solicited
                    ]);
                }  
                else{
                    throw new Error('La cantidad de unidades solicitadas de '.$fragance->name.' Supera el stock' );
                }
                
            }
            $total_amount=0;
            foreach($sale->fragances as $details){
                $total_amount+=$details->pivot->amount;
            }
            $sale->update([
                'total_amount'=>$total_amount
            ]);
            
            DB::commit();

            return SaleResource::make($sale);

            // return response()->json([
            //     'message' => 'La venta se creó correctamente',
            //      'sale' => 
            //     SaleResource::make($sale),
            // ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Hubo un error al crear la venta',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    

    public function showSalesByUser($cedula){

        try {
            $user=User::where('number_document', $cedula)->firstOrFail();
            $user_id=$user->id;
            $sales = Sale::where('user_id', $user_id)->get();
            if ($sales->isEmpty()) {
                Throw new Exception();
            }
            return SaleDetailResource::collection($sales);
    
        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
            ],status:404);
        }
        
    }

    /**
     * Display the specified resource..
     */
    public function show(string $id)
    {
        $sale=Sale::findOrFail($id);
        return new SaleDetailResource($sale);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'amount_paid'=>'required|decimal:2,10'
        ]);
            

        try {
            $sale = Sale::findOrFail($id);

            $sale_amount=$sale->total_amount;
            $amount_paid =$request->amount_paid;

            if($amount_paid<=$sale_amount){
                if ($amount_paid == $sale_amount) {
                    $sale_status= Sale::PAID;
                }
                if ($amount_paid > 0 && $amount_paid <$sale_amount) {
                    $sale_status= Sale::PARTIALLYPAID;   
                };

                $sale->update([
                    'amount_paid'=>$request->amount_paid,
                    'sale_status'=>$sale_status
                ]);

                return SaleDetailResource::make($sale);
        }
                 throw new Error('Monto No Valido, Verifique el Monto a Pagar');
    
        } catch (\Exception $e) {
            return response()->json(["error"=>$e->getMessage()],500);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
