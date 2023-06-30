<?php

namespace Database\Seeders\LandLord;

use Illuminate\Database\Seeder;
use App\Models\LandLord\TarjetaMarca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TarjetaMarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TarjetaMarca::create([
            "descripcion"=>"Visa"
        ]);
        
        TarjetaMarca::create([
            "descripcion"=>"Mastercard"
        ]);
    }
}