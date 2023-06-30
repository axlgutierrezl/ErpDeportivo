<?php

namespace App\Models\Tenant\Almacenes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Servicio extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $fillable=[
        'nombre',
        'precio',
        'estado_alquiler',
        'estado',
    ];
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['fecha_creacion'];
    
    public function FechaCreacion():Attribute{
        return new Attribute(
            get:fn() =>$this->created_at ? date_format($this->created_at,'d/m/Y H:i A') : null,
        );
    }
}
