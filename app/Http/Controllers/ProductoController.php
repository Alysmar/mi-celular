<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Requests\ProductoRequest;
use Illuminate\Http\Request;


class ProductoController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index', 'store', 'show', 'updatecantidadstok']]);
    }
    
    public function index()
    {
        $producto = Producto::get()->toJson(JSON_PRETTY_PRINT);
        return response($producto, 200);
    }

    public function create()
    {
        //
    }

    public function store(ProductoRequest $request)
    {
        //$validator = Validator::make($request->all());
        $producto = new Producto;
        $producto->modelo = $request->modelo;
        $producto->marca = $request->marca;
        $producto->descripcion = $request->descripcion;
        $producto->color = $request->color;
        $producto->estado = $request->estado;
        $producto->cantidad_stok = $request->cantidad_stok;
        $producto->precio_venta = $request->precio_venta;
        $producto->save();
    
        return response()->json([
            "message" => "producto record created"
        ], 201);
    }

    public function show($id)
    {
        if (Producto::where('id', $id)->exists()) {
            $producto = Producto::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($producto, 200);
        }
        else{
            return response()->json([
            "message" => "Producto not found"
            ], 404);
        }
    }

    public function edit(Producto $producto)
    {
        //
    }

    public function updatecantidadstok($id, $cantidad_producto_vendido)
    {
        if (Producto::where('id', $id)->exists()) {
            $producto = Producto::find($id);
            $producto->decrement('cantidad_stok', $cantidad_producto_vendido);
            $producto->save();
            return response()->json([
                "message" => "records updated cantidad_stok"
            ], 200);
            } else {
            return response()->json([
                "message" => "Producto not found"
            ], 404);           
        }
    }

    public function destroy(Producto $producto)
    {
        //
    }
}
