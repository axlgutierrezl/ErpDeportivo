<?php

namespace App\Models\Tenant\Almacenes;

use App\Models\Tenant\Almacenes\Marca;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant\Almacenes\Almacen;
use App\Models\Tenant\Almacenes\Categoria;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Producto extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $fillable = [
        'almacen_id',
        'categoria_id',
        'marca_id',
        'nombre',
        'descripcion',
        'codigo_barra',
        'precio_venta',
        'precio_compra',
        'stock',
        'stock_minimo',
        'unidad_medida',
        'tiene_igv',
        'estado',
    ];
    protected $with = ['almacen','categoria','marca'];

    public function precioVenta():Attribute{
        return new Attribute(
            get:fn($value) => floatval($value)
        );
    }
    /**
     * Get the almacen that owns the Producto
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'almacen_id');
    }
    /**
     * Get the categoria that owns the Producto
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    /**
     * Get the marca that owns the Producto
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
}
