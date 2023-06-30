<?php

namespace Database\Seeders\LandLord;

use Illuminate\Database\Seeder;
use App\Models\LandLord\TipoMetodoPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoMetodoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoMetodoPago::create([
            "descripcion"=>'Efectivo',
            'tiene_tarjeta'=>0
        ]);

        TipoMetodoPago::create([
            "descripcion"=>'Transferencia',
            'tiene_tarjeta'=>0
        ]);

        TipoMetodoPago::create([
            "descripcion"=>'Tarjeta de crédito',
            'tiene_tarjeta'=>1
        ]);

        TipoMetodoPago::create([
            "descripcion"=>'Tarjeta de débito',
            'tiene_tarjeta'=>1
        ]);
    }
}
