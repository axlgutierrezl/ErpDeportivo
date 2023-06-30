<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Usuario extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $table="users";
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}