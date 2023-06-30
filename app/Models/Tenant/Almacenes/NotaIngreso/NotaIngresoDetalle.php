<?php

namespace App\Models\Tenant\Almacenes\NotaIngreso;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant\Almacenes\Producto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class NotaIngresoDetalle extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $fillable=[
        'nota_ingreso_id',
        'producto_id',
        'cantidad',
        'costo',
        'costo_soles',
        'costo_dolares',
        'costo_mas_igv_soles',
        'costo_mas_igv_dolares',
        'valor_ingreso'
    ];

    protected static function booted(){
       static::created(function(NotaIngresoDetalle $detalle){
            $producto = Producto::findOrFail($detalle->producto_id);
            $producto->stock = (float)$producto->stock + (float)$detalle->cantidad;
            $producto->update();
       });
    }
}
