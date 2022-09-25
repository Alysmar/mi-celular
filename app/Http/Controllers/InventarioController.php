<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Http\Requests\InventarioRequest;

class InventarioController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index', 'store', 'show', 'update', 'destroy', 'costoinventario']]);
    }
    
    public function index()
    {
        $inventario = Inventario::get()->toJson(JSON_PRETTY_PRINT);
        return response($inventario, 200);
    }
    public function create()
    {
        //
    }
    public function store(InventarioRequest $request)
    {
        $inventario = new Inventario;
        $inventario->cantidad_producto = $request->cantidad_producto;
        $inventario->costo = $request->costo;
        $inventario->producto_id = $request->producto_id;
        $inventario->proveedor_id = $request->proveedor_id;
        $inventario->fecha_inventario = $request->fecha_inventario;
        $inventario->save();
    
        return response()->json([
            "message" => "inventario record created"
        ], 201);
    }
    public function show($id)
    {
        if (Inventario::where('id', $id)->exists()) {
            $inventario = Inventario::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($inventario, 200);
        }
        else{
            return response()->json([
            "message" => "Inventario not found"
            ], 404);
        }
    }
    public function edit(Inventario $inventario)
    {
        //
    }
    public function update(InventarioRequest $request, $id)
    {
        if (Inventario::where('id', $id)->exists()) {
            $inventario = Inventario::find($id);
            $inventario->cantidad_producto = is_null($request->cantidad_producto) ? $inventario->cantidad_producto : $request->cantidad_producto;
            $inventario->costo = is_null($request->costo) ? $inventario->costo : $request->costo;
            $inventario->producto_id = is_null($request->producto_id) ? $inventario->producto_id : $request->producto_id;
            $inventario->proveedor_id = is_null($request->proveedor_id) ? $inventario->proveedor_id : $request->proveedor_id;
            $inventario->fecha_inventario = is_null($request->fecha_inventario) ? $inventario->fecha_inventario : $request->fecha_inventario;
            $inventario->save();
    
            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "Inventario not found"
            ], 404);
            
        }
    }
    
    public function destroy($id)
    {
        if(Inventario::where('id', $id)->exists()) {
            $inventario = Inventario::find($id);
            $inventario->delete();
    
            return response()->json([
              "message" => "records deleted"
            ], 202);
        }else{
            return response()->json([
              "message" => "Inventario not found"
            ], 404);
        }
    }
    
    /**COSTO INVENTARIO EGRESOS*/
    public function costoinventario(Inventario $costo, $fecha_desde, $fecha_hasta)
    {
        
        $costo = Inventario::where('fecha_inventario', '>=', $fecha_desde)
                        ->where('fecha_inventario', '<=', $fecha_hasta)
                        ->sum('costo');
        if($costo != null){
            $inventario = Inventario::where('fecha_inventario', '>=', $fecha_desde)
                            ->where('fecha_inventario', '<=', $fecha_hasta)
                            ->select('cantidad_producto', 'costo', 'producto_id', 'proveedor_id', 'fecha_inventario')
                            ->get();
            
            $response = [
                    'message' => 'Costo de Inventario',
                    'costo' => $costo,
                    'inventario' => $inventario
                ];
            return response()->json($response, 200);
        }
        else{
            return response()->json([
            "message" => "No se encontraron inventarios en esas fechas"
            ], 404);
        }            
        
    }
}
