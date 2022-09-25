<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cantidad_producto' => 'required', 
            'costo'             => 'required', 
            'producto_id'       => 'required', 
            'proveedor_id'      => 'required',
            'fecha_inventario'  => 'required'
        ];
    }
}
