<?php

namespace Database\Seeders\LandLord;

use Illuminate\Database\Seeder;
use App\Models\LandLord\ModuleLevel;
use Database\Seeders\LandLord\ModuleSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModuleLeverlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** PARA MODULO ALQUILER CAMPOS */
        ModuleLevel::create([
            "descripcion" => "Campos",
            "orden" => 1,
            "module_id" => 2
        ]);

        /** PARA MODULO CAJAS */
        ModuleLevel::create([
            "descripcion" => "Cajas",
            "orden" => 1,
            "module_id" => 3
        ]);

        ModuleLevel::create([
            "descripcion" => "Apertura y Cierre",
            "orden" => 1,
            "module_id" => 3
        ]);

        ModuleLevel::create([
            "descripcion" => "Egresos",
            "orden" => 1,
            "module_id" => 3
        ]);

        /** PARA EL MODULO COMPRAS */
        ModuleLevel::create([
            "descripcion" => "Proveedores",
            "orden" => 1,
            "module_id" => 4
        ]);
        ModuleLevel::create([
            "descripcion" => "Orden de compra",
            "orden" => 2,
            "module_id" => 4
        ]);
        ModuleLevel::create([
            "descripcion" => "Documento de compra",
            "orden" => 3,
            "module_id" => 4
        ]);

        /** PARA MODULO DE VENTAS */
        ModuleLevel::create([
            "descripcion" => "Clientes",
            "orden" => 1,
            "module_id" => 5
        ]);

        ModuleLevel::create([
            "descripcion" => "Cotizaciones",
            "orden" => 2,
            "module_id" => 5
        ]);

        ModuleLevel::create([
            "descripcion" => "Documentos de ventas",
            "orden" => 3,
            "module_id" => 5
        ]);

        ModuleLevel::create([
            "descripcion" => "Guias de remisión",
            "orden" => 4,
            "module_id" => 5
        ]);

        /** PARA EL MODULO ALMACEN */
        ModuleLevel::create([
            "descripcion" => "Almacenes",
            "orden" => 1,
            "module_id" => 6
        ]);
        ModuleLevel::create([
            "descripcion" => "Categorias",
            "orden" => 2,
            "module_id" => 6
        ]);
        ModuleLevel::create([
            "descripcion" => "Marcas",
            "orden" => 3,
            "module_id" => 6
        ]);

        ModuleLevel::create([
            "descripcion" => "Productos",
            "orden" => 4,
            "module_id" => 6
        ]);

        ModuleLevel::create([
            "descripcion" => "Servicios",
            "orden" => 5,
            "module_id" => 6
        ]);

        ModuleLevel::create([
            "descripcion" => "Nota de ingreso",
            "orden" => 6,
            "module_id" => 6
        ]);

        ModuleLevel::create([
            "descripcion" => "Nota de salida",
            "orden" => 7,
            "module_id" => 6
        ]);

        /** PARA EL MODULO CONFIGURACION */
        ModuleLevel::create([
            "descripcion" => "Campos",
            "orden" => 1,
            "module_id" => 7
        ]);

        ModuleLevel::create([
            "descripcion" => "Horario de trabajo",
            "orden" => 2,
            "module_id" => 7
        ]);

        ModuleLevel::create([
            "descripcion" => "Empresa",
            "orden" => 3,
            "module_id" => 7
        ]);

        ModuleLevel::create([
            "descripcion" => "Mantenimientos",
            "orden" => 4,
            "module_id" => 7
        ]);

        /** MODULO PARA SEGURIDAD */
        ModuleLevel::create([
            "descripcion" => "Usuarios",
            "orden" => 1,
            "module_id" => 8
        ]);
        ModuleLevel::create([
            "descripcion" => "Roles",
            "orden" => 2,
            "module_id" => 8
        ]);

        /** MODULOS PARA TIENDA */

        /** CC1: CAMPOS - BEGIN */
        ModuleLevel::create([
            "descripcion" => "Deportes",
            "orden" => 1,
            "module_id" => 10
        ]);
        /** CC1: CAMPOS - BEGIN */
    }
}
