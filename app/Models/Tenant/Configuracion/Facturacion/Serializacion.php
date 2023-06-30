<?php

namespace App\Models\Tenant\Configuracion\Facturacion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Serializacion extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $fillable=[
        'empresa_id',
        'tipo_documento_id',
        'serie',
        'cantidad_numeros',
        'destino',
        'por_defecto',
        'numero_fin',
    ];
}