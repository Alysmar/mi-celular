<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $fillable = [
        'cantidad_producto',
        'costo',
        'producto_id',
        'proveedor_id',
        'fecha_inventario'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'producto_id', 'id');
    }

    public function proveedores()
    {
        return $this->hasMany(Proveedor::class, 'proveedor_id', 'id');
    }
}
