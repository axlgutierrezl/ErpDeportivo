<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Producto\ProductosExport;

class ExportExcelController extends Controller
{
    public function productos(){
        ob_end_clean();
        ob_start();
        $fecha = now();
        $fecha = str_replace(" ","-",$fecha);
        $fecha = str_replace(":","-",$fecha);
        return Excel::download(new ProductosExport(),"productos-$fecha.xlsx");
    }
}
