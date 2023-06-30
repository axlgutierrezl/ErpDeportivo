<?php

namespace App\Models\Tenant\Caja;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Caja extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $fillable=[
        'nombre',
        'estado_caja',
        'estado',
        'is_default'
    ];
}