<?php

namespace App\Models\LandLord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMetodoPago extends Model
{
    use HasFactory;
    protected $fillable=['descripcion','tiene_tarjeta'];
    public $timestamps = false;
}
