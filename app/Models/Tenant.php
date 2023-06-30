<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Spatie\Multitenancy\Models\Tenant as BaseTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends BaseTenant
{
    use HasFactory;
    protected $guarded = [];
    public static function booted(){
        static::creating(fn (Tenant $tenant) => $tenant->createDatabase($tenant));
        static::created(fn (Tenant $tenant) => $tenant->runMigrationsSeeders($tenant));
    }
   

    public function createDatabase($tenant){

        // $url = Str::of($tenant->domain)->replace("-",".");
        // $database_name = $url.'_'.Str::random(4);
        $database_name = "tenancy_".$tenant->domain;
        $database = Str::of($database_name)->replace('.','_')->lower()->__toString();
       
        $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?";
        $db = DB::select($query,[$database]);
        if(empty($db)){
            DB::connection('tenant')->statement("CREATE DATABASE {$database};");
            $tenant->database = $database;
        }
    }
    public function runMigrationsSeeders($tenant){
        $tenant->refresh();
        Artisan::call('tenants:artisan',[
            'artisanCommand'=>'migrate --path=database/migrations/tenant --database=tenant --seed --force',
            '--tenant'=> "{$tenant->id}"
        ]);
    }
}