<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tenant\Configuracion\Facturacion\TipoDocumento;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDocumento::create([
            'id'=>"01",
            'activo'=>1,
            'abreviatura'=>'FT',
            'descripcion'=>'FACTURA ELECTRÓNICA',
        ]);

        TipoDocumento::create([
            'id'=>"03",
            'activo'=>1,
            'abreviatura'=>'BV',
            'descripcion'=>'BOLETA DE VENTA ELECTRÓNICA',
        ]);

        TipoDocumento::create([
            'id'=>"07",
            'activo'=>1,
            'abreviatura'=>'NC',
            'descripcion'=>'NOTA DE CRÉDITO',
        ]);

        TipoDocumento::create([
            'id'=>"08",
            'activo'=>1,
            'abreviatura'=>'ND',
            'descripcion'=>'NOTA DE DÉBITO',
        ]);


        TipoDocumento::create([
            'id'=>"09",
            'activo'=>1,
            'abreviatura'=>'GRR',
            'descripcion'=>'GUIA DE REMISIÓN REMITENTE',
        ]);


        TipoDocumento::create([
            'id'=>"20",
            'activo'=>1,
            'abreviatura'=>'CRE',
            'descripcion'=>'COMPROBANTE DE RETENCIÓN ELECTRÓNICA',
        ]);


        TipoDocumento::create([
            'id'=>"NE76",
            'activo'=>1,
            'abreviatura'=>'NE',
            'descripcion'=>'NOTA DE ENTRADA',
        ]);

        TipoDocumento::create([
            'id'=>"80",
            'activo'=>1,
            'abreviatura'=>'NV',
            'descripcion'=>'NOTA DE VENTA',
        ]);

        TipoDocumento::create([
            'id'=>"50",
            'activo'=>1,
            'abreviatura'=>'T',
            'descripcion'=>'TICKET',
        ]);

        TipoDocumento::create([
            'id'=>"51",
            'activo'=>1,
            'abreviatura'=>'TC',
            'descripcion'=>'TICKET DE COMPRA',
        ]);

        TipoDocumento::create([
            'id'=>"52",
            'activo'=>1,
            'abreviatura'=>'NI',
            'descripcion'=>'NOTA DE INGRESO',
        ]);

        TipoDocumento::create([
            'id'=>"53",
            'activo'=>1,
            'abreviatura'=>'NS',
            'descripcion'=>'NOTA DE SALIDA',
        ]);
    }
}