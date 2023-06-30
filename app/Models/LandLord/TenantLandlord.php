<?php

namespace App\Models\LandLord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantLandlord extends Model
{
    use HasFactory;
    protected $table = "tenants";
    protected $fillable = ["name","domain","domain"];
    
}