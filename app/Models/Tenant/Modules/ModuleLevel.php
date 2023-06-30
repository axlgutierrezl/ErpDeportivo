<?php

namespace App\Models\Tenant\Modules;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class ModuleLevel extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    
    protected $fillable = ["descripcion","module_id","orden"];

    /**
     * Get the module that owns the ModuleLevel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}