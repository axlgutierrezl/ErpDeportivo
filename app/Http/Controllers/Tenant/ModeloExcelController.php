<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use App\Exports\Marca\MarcaExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Categoria\CategoriaExport;
use App\Exports\Producto\ProductoMultiExport;

class ModeloExcelController extends Controller
{
    public function categoria(){
        ob_end_clean();
        ob_start();
        return Excel::download(new CategoriaExport(),'modelo_categoria.xlsx');
    }
    
    public function marca(){
        ob_end_clean();
        ob_start();
        return Excel::download(new MarcaExport(),'modelo_marca.xlsx');
    }
    public function producto(){
        ob_end_clean();
        ob_start();
        return Excel::download(new ProductoMultiExport(),'modelo_producto.xlsx');
    }
}