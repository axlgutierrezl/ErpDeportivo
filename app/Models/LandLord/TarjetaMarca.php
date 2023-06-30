<?php

namespace App\Models\LandLord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarjetaMarca extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=['descripcion'];
}
