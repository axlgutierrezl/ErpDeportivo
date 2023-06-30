<?php

namespace Database\Seeders\LandLord;

use App\Models\LandLord\Module;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::create([
            "descripcion"=>"Panel de control",
            "orden"=>1,
        ]);

        Module::create([
            "descripcion"=>"Alquiler campo",
            "orden"=>2,
        ]);

        Module::create([
            "descripcion"=>"Cajas",
            "orden"=>3,
        ]);

        Module::create([
            "descripcion"=>"Compras",
            "orden"=>4,
        ]);

        Module::create([
            "descripcion"=>"Ventas",
            "orden"=>5,
        ]);

        Module::create([
            "descripcion"=>"Almacen",
            "orden"=>6,
        ]);

        Module::create([
            "descripcion"=>"Configuración",
            "orden"=>7,
        ]);

        Module::create([
            "descripcion"=>"Seguridad",
            "orden"=>8,
        ]);

        Module::create([
            "descripcion"=>"Tienda",
            "orden"=>9,
        ]);
    }
}