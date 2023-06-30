<?php

namespace App\Models\Tenant\Configuracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Empresa extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $fillable=[
        'ruc',
        'razon_social',
        'razon_social_abreviada',
        'ruta_logo',
        'direccion_fiscal',
        'ubigeo',
        'telefono',
        'celular',
        'mail_mailer',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password',
        'mail_encryption',
        'facebook',
        'instagram',
        'web',
        'estado',
    ];
}
