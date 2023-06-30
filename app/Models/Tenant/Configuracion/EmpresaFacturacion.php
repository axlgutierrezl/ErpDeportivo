<?php

namespace App\Models\Tenant\Configuracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class EmpresaFacturacion extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $fillable=[
        'empresa_id',
        'ruta_certificado_pfx',
        'nombre_certificado_pfx',
        'password_certificado_pfx',
        'sol_user',
        'sol_password',
        'plan',
        'ambiente',
        'ruta_certificado_pem',
        'certificado',
        'token',
        'estado',
    ];
}
