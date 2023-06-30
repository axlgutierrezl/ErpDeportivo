<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\Tabla;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TablaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tabla = new Tabla();
        $tabla->descripcion = 'TIPOS DE MONEDA';
        $tabla->sigla = 'TIPOS DE MONEDA';
        $tabla->editable = 1;
        $tabla->save();

        // 2
        $tabla = new Tabla();
        $tabla->descripcion = 'BANCOS';
        $tabla->sigla = 'BANCOS';
        $tabla->save();

        // 3
        $tabla = new Tabla();
        $tabla->descripcion = 'TIPOS DE DOCUMENTO';
        $tabla->sigla = 'TIPOS DE DOCUMENTO';
        $tabla->save();

        // 4
        $tabla = new Tabla();
        $tabla->descripcion = 'TIPOS DE SEXO';
        $tabla->sigla = 'SEXO';
        $tabla->save();

        // 5
        $tabla = new Tabla();
        $tabla->descripcion = 'TIPOS DE ESTADO CIVIL';
        $tabla->sigla = 'ESTADO CIVIL';
        $tabla->save();

        // 6
        $tabla = new Tabla();
        $tabla->descripcion = 'ZONAS';
        $tabla->sigla = 'ZONAS';
        $tabla->save();

        // 7
        $tabla = new Tabla();
        $tabla->descripcion = 'AREAS';
        $tabla->sigla = 'AREAS';
        $tabla->save();

        // 8
        $tabla = new Tabla();
        $tabla->descripcion = 'CARGOS';
        $tabla->sigla = 'CARGOS';
        $tabla->save();

        // 9
        $tabla = new Tabla();
        $tabla->descripcion = 'PROFESIONES';
        $tabla->sigla = 'PROFESIONES';
        $tabla->save();

       // 10
       $tabla = new Tabla();
       $tabla->descripcion = 'PRESENTACIONES';
       $tabla->sigla = 'PRESENTACIONES';
       $tabla->save();

       // 11
       $tabla = new Tabla();
       $tabla->descripcion = 'TIPOS DE PERSONAS';
       $tabla->sigla = 'PERSONAS';
       $tabla->save();

       // 12
       $tabla = new Tabla();
       $tabla->descripcion = 'GRUPOS SANGUINEOS';
       $tabla->sigla = 'GRUPOS SANGUINEOS';
       $tabla->save();

       // 13
       $tabla = new Tabla();
       $tabla->descripcion = 'UNIDAD MEDIDA';
       $tabla->sigla = 'UNIDAD MEDIDA';
       $tabla->editable = 1;
       $tabla->save();
       //14
       $tabla = new Tabla();
       $tabla->descripcion = 'MODO DE COMPRA';
       $tabla->sigla = 'MODO DE COMPRA';
       $tabla->save();

       //15
       $tabla = new Tabla();
       $tabla->descripcion = 'TIPOS DE DOCUMENTOS TRIBUTARIOS';
       $tabla->sigla = 'TIPO DOCUMENTO TRIBUTARIO';
       $tabla->save();

       //16
       $tabla = new Tabla();
       $tabla->descripcion = 'TIPOS DE DOCUMENTOS DE COMPRA';
       $tabla->sigla = 'TIPO DOCUMENTO COMPRA';
       $tabla->save();

       //17
       $tabla = new Tabla();
       $tabla->descripcion = 'TIPO DE CLIENTE';
       $tabla->sigla = 'TIPO DE CLIENTE';
       $tabla->save();

       //18
       $tabla = new Tabla();
       $tabla->descripcion = 'CONDICION DE REPARTO';
       $tabla->sigla = 'CONDICION DE REPARTO';
       $tabla->editable = 1;
       $tabla->save();

       //19
       $tabla = new Tabla();
       $tabla->descripcion = 'TIPOS DE PAGO (CAJA CHICA)';
       $tabla->sigla = 'TIPO DE PAGO CAJA CHICA';
       $tabla->editable = 1;
       $tabla->save();

       //20
       $tabla = new Tabla();
       $tabla->descripcion = 'HERRAMIENTAS DE PLANTA';
       $tabla->sigla = 'HERRAMIENTAS DE PLANTA';
       $tabla->save();

       //21
       $tabla = new Tabla();
       $tabla->descripcion = 'TIPOS DE VENTA';
       $tabla->sigla = 'TIPO DE VENTA';
       //$tabla->editable = 1;
       $tabla->save();

       //22
       $tabla = new Tabla();
       $tabla->descripcion = 'TIPOS DE TIENDA';
       $tabla->sigla = 'TIPO DE TIENDA';
       $tabla->save();

       //23
       $tabla = new Tabla();
       $tabla->descripcion = 'TIPOS DE NEGOCIO';
       $tabla->sigla = 'TIPO DE NEGOCIO';
       $tabla->save();

       //24
       $tabla = new Tabla();
       $tabla->descripcion = 'RESPONSABLE DE PAGO';
       $tabla->sigla = 'RESPONSABLE DE PAGO';
       $tabla->save();

       //25
       $tabla = new Tabla();
       $tabla->descripcion = 'LINEA COMERCIAL';
       $tabla->sigla = 'LINEA COMERCIAL';
       $tabla->save();

       //26
       $tabla = new Tabla();
       $tabla->descripcion = 'PLAN FATURACION ELECTRONICA';
       $tabla->sigla = 'PFE';
       $tabla->editable = 1;
       $tabla->save();

       //27
       $tabla = new Tabla();
       $tabla->descripcion = 'AMBIENTE DE PRODUCCION FATURACION ELECTRONICA';
       $tabla->sigla = 'APFE';
       $tabla->editable = 1;
       $tabla->save();

       //28
       $tabla = new Tabla();
       $tabla->descripcion = 'ORÍGENES';
       $tabla->sigla = 'OR';
       $tabla->save();

       //29
       $tabla = new Tabla();
       $tabla->descripcion = 'DESTINOS';
       $tabla->sigla = 'DE';
       $tabla->save();

       //30
       $tabla = new Tabla();
       $tabla->descripcion = 'FORMAS DE PAGO';
       $tabla->sigla = 'FP';
       $tabla->save();

       //31
       $tabla = new Tabla();
       $tabla->descripcion = 'TURNOS';
       $tabla->sigla = 'TURNO';
       $tabla->save();

       //32
       $tabla = new Tabla();
       $tabla->descripcion = 'CUENTAS';
       $tabla->sigla = 'CUENTAS';
       $tabla->save();

       //33
       $tabla = new Tabla();
       $tabla->descripcion = 'TIPOS NOTA DE CREDITO';
       $tabla->sigla = 'CODMOTIVO';       
       $tabla->editable = 1;
       $tabla->save();

        //34
        $tabla = new Tabla();
        $tabla->descripcion = 'MOTIVOS DE TRASLADO';
        $tabla->sigla = 'MTRASLADO';
        $tabla->editable = 1;
        $tabla->save();
    }
}
