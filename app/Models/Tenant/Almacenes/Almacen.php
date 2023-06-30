<?php

namespace App\Models\Tenant\Almacenes;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant\Almacenes\Producto;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Almacen extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $table="almacenes";
    protected $fillable=[
        'descripcion',
        'ubicacion',
        'estado',
        'is_default'
    ];
    protected $appends =[
        'total_productos',
        'fecha_creacion',
    ];
    protected $hidden=['created_at', 'updated_at'];
    /**
     * Get all of the productos for the Almacen
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productos()
    {
        return $this->hasMany(Producto::class, 'almacen_id', 'id');
    }
    public function descripcion():Attribute{
        return new Attribute(
            get:fn($value) => strtoupper(\strtolower($value)),
            set:fn($value) => strtoupper($value)
        );
    }
    public function TotalProductos():Attribute{
        return new Attribute(
            get:fn() => $this->productos()->count(),
        );
    }
    public function FechaCreacion():Attribute{
        return new Attribute(
            get:fn() => $this->created_at ? date_format($this->created_at,'d/m/Y H:i A') : null,
        );
    }
}