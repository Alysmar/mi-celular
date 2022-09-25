<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Http\Requests\VentaRequest;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index', 'store', 'show', 'estadocuenta']]);
    }

    public function index()
    {
        $venta = Venta::get()->toJson(JSON_PRETTY_PRINT);
        return response($venta, 200);
    }
    public function create()
    {
        //
    }
    public function store(VentaRequest $request)
    {
        $venta = new Venta;
        if(!(Producto::where('id', $request->producto_id)->exists())){
            return response()->json('Producto not exist', 404);
        }else{
        $producto = Producto::where('cantidad_stok', '=', $request->cantidad_stok)->first();
        if($producto > $request->cantidad_producto_vendido){
            return response()->json('cantidad_stok menor a la cantidad solicitada', 401);
        }else{
                $venta = new Venta;
                $venta->fecha_venta = $request->fecha_venta;
                $venta->cantidad_producto_vendido = $request->cantidad_producto_vendido;
                $venta->monto_total = $request->monto_total;
                $venta->producto_id = $request->producto_id;
                $venta->cliente_id = $request->cliente_id;
                $venta->save();
                $a = new ProductoController();
                $a->updatecantidadstok($venta->producto_id, $venta->cantidad_producto_vendido);
                return response()->json([
                    "message" => "venta record created", 
                ], 201);
            } 
        }
        
    }              
    
    public function show($id)
    {
        if (Venta::where('id', $id)->exists()) {
            $venta = Venta::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($venta, 200);
        }
        else{
            return response()->json([
            "message" => "Venta not found"
            ], 404);
        }
    }
    public function edit(Venta $venta)
    {
        //
    }
    public function update(VentaRequest $request, Venta $venta)
    {
        //
    }
    public function destroy(Venta $venta)
    {
        //
    }
    
    /**ESTADO DE CUENTA INGRESOS*/
    public function estadocuenta(Venta $monto_total, $fecha_desde, $fecha_hasta)
    {
        
        $monto_total = Venta::where('fecha_venta', '>=', $fecha_desde)
                        ->where('fecha_venta', '<=', $fecha_hasta)
                        ->sum('monto_total');
        if($monto_total != null){
            $movimientos = Venta::where('fecha_venta', '>=', $fecha_desde)
                            ->where('fecha_venta', '<=', $fecha_hasta)
                            ->select('fecha_venta', 'monto_total', 'producto_id')
                            ->get();
            
            $response = [
                    'message' => 'Monto total y Movimientos',
                    'monto_total' => $monto_total,
                    'movimientos' => $movimientos
                ];
            return response()->json($response, 200);
        }
        else{
            return response()->json([
            "message" => "No se encontraron movimientos en esas fechas"
            ], 404);
        }            
        
    }
}
