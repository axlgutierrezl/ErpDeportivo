<?php

namespace App\Models\Tenant\Maintenance\Sport;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

// CC1: CAMPOS
class Sport extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $fillable=[
        'name',
        'description',
        'state',
        // 'is_default'
    ];
}