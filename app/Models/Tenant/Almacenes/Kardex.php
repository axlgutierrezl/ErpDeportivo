<?php

namespace App\Models\Tenant\Almacenes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Kardex extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $table="kardex";
}
