<?php

namespace App\Models\Tenant\Configuracion\Facturacion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class TipoDocumento extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $fillable=[
        'activo',
        'abreviatura',
        'descripcion',
    ];
}
