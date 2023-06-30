<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use App\Models\Tenant\Almacenes\Almacen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlmacenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Almacen::create([
            'descripcion'=>'Principal',
            'ubicacion'=>'Tienda',
            'estado'=>'ACTIVO',
            'is_default'=>1
        ]);

        Almacen::create([
            'descripcion'=>'Mermas',
            'ubicacion'=>'Tienda',
            'estado'=>'ACTIVO',
            'is_default'=>1
        ]);
    }
}