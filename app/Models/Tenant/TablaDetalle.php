<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TablaDetalle extends Model
{
    use HasFactory;
    protected $fillable = [
        'tabla_id',
        'descripcion',
        'nombre',
        'simbolo',
        'parametro',
        'operacion',
        'tipo',
        'editable',
        'estado',
    ];
    protected $hidden=['created_at', 'updated_at'];
}