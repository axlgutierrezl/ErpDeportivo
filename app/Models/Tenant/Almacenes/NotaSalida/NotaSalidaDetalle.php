<?php

namespace App\Models\Tenant\Almacenes\NotaSalida;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class NotaSalidaDetalle extends Model
{
    use HasFactory;
    use UsesTenantConnection;
}
