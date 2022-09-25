<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentaRequest extends FormRequest
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
            'fecha_venta'               => 'required',
            'cantidad_producto_vendido' => 'required',
            'monto_total'               => 'required',
            'producto_id'               => 'required',
            'cliente_id'                => 'required'
        ];
    }
}
