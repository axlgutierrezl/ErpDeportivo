<?php

use Carbon\Carbon;
use App\Models\Tenant\Tabla;
use Illuminate\Support\Facades\DB;
use App\Models\Tenant\Almacenes\Marca;
use App\Models\Tenant\Almacenes\Almacen;
use App\Models\Tenant\Almacenes\Categoria;
if (!function_exists("unidadMedidas")) {
    /**
     * Lista las unidades de medidas
     */
    function unidadMedidas($simbolo="")
    {
        $unidades=null;
        if(empty($simbolo)){
            $unidades = DB::table("tabla_detalles")
            ->select(['descripcion','simbolo'])
            ->where("tabla_id",13)
            ->whereIn("simbolo",['LTR','NIU','ZZ','BO','BG','KGM','GRM'])
            ->orderBy("id",'DESC')
            ->get();
        }else{
            $unidades = DB::table("tabla_detalles")
            ->select(['descripcion','simbolo'])
            ->where("tabla_id",13)
            ->whereIn("simbolo",['LTR','NIU','ZZ','BO','BG','KGM','GRM'])
            ->where("simbolo",$simbolo)
            ->first();
        }
       
       return $unidades;
    }
}
if (!function_exists('precio_dolar')) {
    function precio_dolar()
    {
        $fecha =  Carbon::now()->toDateString();
        $ctx = stream_context_create(array('http'=>
            array(
                'timeout' => 1200,  //1200 Seconds is 20 Minutes
            )
        ));
        $data = file_get_contents("https://api.apis.net.pe/v1/tipo-cambio-sunat?fecha=".$fecha,false,$ctx);
        $infodata = json_decode($data,false);
        return response()->json($infodata);
    }
}
if(!function_exists("categorias")){
    /** 
     * Lista todas las categorias
     */
    function categorias(){
        $categorias = Categoria::where("estado","ACTIVO")->get();
        return $categorias;
    }
}

if(!function_exists("almacenes")){
    /** 
     * Lista todas las almacenes
     */
    function almacenes(){
        $almacenes = Almacen::where("estado","ACTIVO")->get();
        return $almacenes;
    }
}

if(!function_exists("marcas")){
    /** 
     * Lista todas las marcas
     */
    function marcas(){
        $marcas = Marca::where("estado","ACTIVO")->get();
        return $marcas;
    }
}

if(!function_exists("tieneIgv")){
    /** 
     * Lista todas las tieneIgv
     */
    function tieneIgv(){
        $tieneIgv = ["SI","NO"];
        return $tieneIgv;
    }
}