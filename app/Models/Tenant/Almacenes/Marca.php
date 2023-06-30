<?php

namespace App\Models\Tenant\Almacenes;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant\Almacenes\Producto;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Marca extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $fillable=[
        'nombre',
        'procedencia',
        'estado',
    ];

    protected $hidden=['created_at', 'updated_at'];

    protected $appends =[
        'total_productos',
        'fecha_creacion',
    ];
    /**
     * Get all of the productos for the Categoria
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
    public function getNombreAttribute($value){
        return \strtoupper($value);
    }

    public function TotalProductos():Attribute{
        return new Attribute(
            get:fn() => $this->productos()->count(),
        );
    }
    public function FechaCreacion():Attribute{
        return new Attribute(
            get:fn() =>$this->created_at ? date_format($this->created_at,'d/m/Y H:i A') : null,
        );
    }
}