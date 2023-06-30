<?php

namespace App\Models\Tenant\Modules;

use App\Models\Tenant\Modules\Module;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class ModuleUser extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $fillable = ["module_id","user_id"];
    protected $table = "module_user";
}