<?php

namespace App\Models\Tenant\Almacenes\NotaIngreso;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class NotaIngreso extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $fillable= [
        'user_id',
        'motivo_traslado_id',
        'numero',
        'fecha',
        'origen',
        'destino',
        'moneda',
        'tipo_cambio',
        'dolar',
        'total',
        'total_soles',
        'total_dolares',
        'total_mas_igv_soles',
        'total_mas_igv_dolares',
        'estado',
        'observacion'
    ];
    protected $with = ["detalles"];
    /**
     * Get all of the detalles for the NotaIngreso
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalles(): HasMany
    {
        return $this->hasMany(NotaIngresoDetalle::class);
    }
}
