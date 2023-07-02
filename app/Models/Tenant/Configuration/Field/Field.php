<?php

namespace App\Models\Tenant\Configuration\Field;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
use App\Models\Tenant\Maintenance\Sport\Sport;

// CC1: CAMPOS
class Field extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $fillable=[
        'name',
        'description',
        'sport_id',
        'state',
    ];

    public function sport()
    {
      return $this->belongsTo(Sport::class);
    }
}