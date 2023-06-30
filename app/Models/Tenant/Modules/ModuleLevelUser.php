<?php

namespace App\Models\Tenant\Modules;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class ModuleLevelUser extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $table = 'module_level_user';
    protected $fillable=[
        'module_level_id',
        'user_id'  
    ];
}