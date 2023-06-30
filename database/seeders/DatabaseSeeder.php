<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Multitenancy\Models\Tenant;
use Database\Seeders\Tenant\CajaSeeder;
use Database\Seeders\Tenant\TablaSeeder;
use Database\Seeders\LandLord\UserSeeder;
use Database\Seeders\Tenant\AlmacenSeeder;
use Database\Seeders\LandLord\ModuleSeeder;
use Database\Seeders\Tenant\TablaDetalleSeerder;
use Database\Seeders\Tenant\TipoDocumentoSeeder;
use Database\Seeders\LandLord\ModuleLeverlSeeder;
use Database\Seeders\LandLord\TarjetaMarcaSeeder;
use Database\Seeders\Tenant\MotivoTrasladoSeeder;
use Database\Seeders\LandLord\TipoMetodoPagoSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Tenant::checkCurrent()
           ? $this->runTenantSpecificSeeders()
           : $this->runLandlordSpecificSeeders();
    }

    public function runTenantSpecificSeeders()
    {
        $this->call(TipoDocumentoSeeder::class);
        $this->call(ModuleSeeder::class);
        $this->call(ModuleLeverlSeeder::class);
        $this->call(CajaSeeder::class);
        $this->call(AlmacenSeeder::class);
        $this->call(TablaSeeder::class);
        $this->call(TablaDetalleSeerder::class);
        $this->call(MotivoTrasladoSeeder::class);
    }
    
    public function runLandlordSpecificSeeders()
    {
        $this->call(ModuleSeeder::class);
        $this->call(ModuleLeverlSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TarjetaMarcaSeeder::class);
        $this->call(TipoMetodoPagoSeeder::class);
    }
}