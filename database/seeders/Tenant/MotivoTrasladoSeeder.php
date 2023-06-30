<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use App\Models\Tenant\MotivoTraslado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MotivoTrasladoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inventory_transactions = array(
            array(
                "codigo" => "02",
                "nombre" => "Compra nacional",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "03",
                "nombre" => "Consignación recibida",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "05",
                "nombre" => "Devolución recibida",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "16",
                "nombre" => "Inventario inicial",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "18",
                "nombre" => "Entrada de importación",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "19",
                "nombre" => "Ingreso de producción",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "20",
                "nombre" => "Entrada por devolución de producción",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "21",
                "nombre" => "Entrada por transferencia entre almacenes",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "22",
                "nombre" => "Entrada por identificación erronea",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "24",
                "nombre" => "Entrada por devolución del cliente",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "26",
                "nombre" => "Entrada para servicio de producción",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "29",
                "nombre" => "Entrada de bienes en prestamo",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "31",
                "nombre" => "Entrada de bienes en custodia",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "50",
                "nombre" => "Ingreso temporal",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "52",
                "nombre" => "Ingreso por transformación",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "54",
                "nombre" => "Ingreso de producción",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "55",
                "nombre" => "Entrada de importación",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "57",
                "nombre" => "Entrada por conversión de medida",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "91",
                "nombre" => "Ingreso por transformación",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "93",
                "nombre" => "Ingreso temporal",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "96",
                "nombre" => "Entrada por conversión de medida",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "99",
                "nombre" => "Otros",
                "tipo" => "INGRESO",
            ),
            array(
                "codigo" => "01",
                "nombre" => "Venta nacional",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "04",
                "nombre" => "Consignación entregada",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "06",
                "nombre" => "Devolución entregada",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "07",
                "nombre" => "Bonificación",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "08",
                "nombre" => "Premio",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "09",
                "nombre" => "Donación",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "10",
                "nombre" => "Salida a producción",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "11",
                "nombre" => "Salida por transferencia entre almacenes",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "12",
                "nombre" => "Retiro",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "13",
                "nombre" => "Mermas",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "14",
                "nombre" => "Desmedros",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "15",
                "nombre" => "Destrucción",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "17",
                "nombre" => "Exportación",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "23",
                "nombre" => "Salida por identificación erronea",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "25",
                "nombre" => "Salida por devolución al proveedor",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "27",
                "nombre" => "Salida por servicio de producción",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "28",
                "nombre" => "Ajuste por diferencia de inventario",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "30",
                "nombre" => "Salida de bienes en prestamo",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "32",
                "nombre" => "Salida de bienes en custodia",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "33",
                "nombre" => "Muestras médicas",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "34",
                "nombre" => "Publicidad",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "35",
                "nombre" => "Gastos de representación",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "36",
                "nombre" => "Retiro para entrega a trabajadores",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "37",
                "nombre" => "Retiro por convenio colectivo",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "38",
                "nombre" => "Retiro por sustitución de bien siniestrado",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "51",
                "nombre" => "Salida temporal",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "53",
                "nombre" => "Salida para servicios terceros",
                "tipo" => "EGRESO",
            ),
            array(
                "codigo" => "56",
                "nombre" => "Salida por conversión de medida",
                "tipo" => "EGRESO",
            ),
        );

        foreach($inventory_transactions as $value){
            MotivoTraslado::create($value);
        }
    }
}
