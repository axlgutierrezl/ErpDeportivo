<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabla extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'sigla',
        'editable',
    ];

   
    public function detalles()
    {
        return $this->hasMany(TablaDetalle::class);
    }
}