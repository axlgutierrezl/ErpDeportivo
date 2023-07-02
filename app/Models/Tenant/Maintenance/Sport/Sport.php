<?php

namespace App\Models\Tenant\Maintenance\Sport;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
use App\Models\Tenant\Configuration\Field\Field;

// CC1: DEPORTE
class Sport extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $fillable=[
        'name',
        'description',
        'state',
    ];

    public function fields(){
        return $this->hasMany(Field::class);
    }
}