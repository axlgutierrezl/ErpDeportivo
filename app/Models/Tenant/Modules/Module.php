<?php

namespace App\Models\Tenant\Modules;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Module extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $fillable = ["descripcion","orden"];
    
    /**
     * Get all of the levels for the Module
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function levels()
    {
        return $this->hasMany(ModuleLevel::class,'module_id');
    }
}