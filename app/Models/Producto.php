<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'modelo',
        'marca',
        'descripcion',
        'color',
        'estado',
        'cantidad_stok',
        'precio_venta'
    ];
    
    public function ventas()
    {
        return $this->belongsTo(Venta::class);
    }

    public function inventarios()
    {
        return $this->belongsTo(Inventario::class);
    }
}
