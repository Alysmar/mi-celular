<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Http\Requests\ProveedorRequest;

class ProveedorController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index', 'store', 'show']]);
    }

    public function index()
    {
        $proveedor = Proveedor::get()->toJson(JSON_PRETTY_PRINT);
        return response($proveedor, 200);
    }
    public function create()
    {
        //
    }
    public function store(ProveedorRequest $request)
    {
        $proveedor = new Proveedor;
        $proveedor->nombre = $request->nombre;
        $proveedor->rif = $request->rif;
        $proveedor->razon_social = $request->razon_social;
        $proveedor->direccion = $request->direccion;
        $proveedor->telefono = $request->telefono;
        $proveedor->correo = $request->correo;
        $proveedor->save();
    
        return response()->json([
            "message" => "Proveedor record created"
        ], 201);
    }
    public function show($id)
    {
        if (Proveedor::where('id', $id)->exists()) {
            $proveedor = Proveedor::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($proveedor, 200);
        }
        else{
            return response()->json([
            "message" => "Proveedor not found"
            ], 404);
        }
    }
    public function edit(Proveedor $proveedor)
    {
        //
    }
    public function update(ProveedorRequest $request, Proveedor $proveedor)
    {
        //
    }
    public function destroy(Proveedor $proveedor)
    {
        //
    }
}
