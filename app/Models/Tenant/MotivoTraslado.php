<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class MotivoTraslado extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    public $timestamps = false;
    protected $fillable=[
        "nombre",
        "codigo",
        'tipo'
    ];
}