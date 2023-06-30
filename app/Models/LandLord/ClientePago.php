<?php

namespace App\Models\LandLord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientePago extends Model
{
    use HasFactory;
    protected $fillable=[
        'client_id',
        'tipo_metodo_pago_id',
        'tarjeta_marca_id',
        'fecha_pago',
        'tiene_tarjeta',
        'referencia',
        'monto',
        'estado',
    ];
}
