<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_venta',
        'cantidad_producto_vendido',
        'monto_total',
        'producto_id',
        'cliente_id'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'producto_id', 'id');
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'cliente_id', 'id');
    }
}
