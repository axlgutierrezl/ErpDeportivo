<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use App\Models\Tenant\Caja\Caja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CajaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Caja::create([
            'nombre'=>'Principal',
            'estado_caja'=>'CERRADA',
            'estado'=>'ACTIVA',
            'is_default'=>1,
        ]);
    }
}
