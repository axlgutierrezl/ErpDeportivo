<?php

namespace App\Models\LandLord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModuleLevel extends Model
{
    use HasFactory;
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