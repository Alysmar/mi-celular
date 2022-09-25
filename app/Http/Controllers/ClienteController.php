<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\ClienteRequest;

class ClienteController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index', 'store', 'show']]);
    }
    
    public function index()
    {
        $cliente = Cliente::get()->toJson(JSON_PRETTY_PRINT);
        return response($cliente, 200);
    }
    public function create()
    {
        //
    }
    public function store(ClienteRequest $request)
    {
        $cliente = new Cliente;
        $cliente->nombre = $request->nombre;
        $cliente->cedula = $request->cedula;
        $cliente->direccion = $request->direccion;
        $cliente->telefono = $request->telefono;
        $cliente->correo = $request->correo;
        $cliente->save();
    
        return response()->json([
            "message" => "cliente record created"
        ], 201);
    }
    public function show($id)
    {
        if (Cliente::where('id', $id)->exists()) {
            $cliente = Cliente::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($cliente, 200);
        }
        else{
            return response()->json([
            "message" => "Cliente not found"
            ], 404);
        }
    }
    public function edit(Cliente $cliente)
    {
        //
    }
    public function update(ClienteRequest $request, Cliente $cliente)
    {
        //
    }
    public function destroy(Cliente $cliente)
    {
        //
    }
}
