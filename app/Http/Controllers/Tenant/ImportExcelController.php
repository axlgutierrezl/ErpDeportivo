<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use App\Imports\Marca\MarcaImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Producto\ProductoSheet;
use App\Imports\Categoria\CategoriaImport;

class ImportExcelController extends Controller
{
    public function categoria(Request $request)
    {
        try {
            
            $file = $request->file();
            $archivo = $file['fileCategoria'];
            Excel::import(new CategoriaImport, $archivo);
            return redirect()->back()->with('success', "Categorias subidas correctamentes");
        } catch (\Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }
    public function marca(Request $request)
    {
        try {
            
            $file = $request->file();
            $archivo = $file['fileMarca'];
            Excel::import(new MarcaImport, $archivo);
            return redirect()->back()->with('success', "Marcas subidas correctamentes");
        } catch (\Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }
    public function producto(Request $request)
    {
        try {
            
            $file = $request->file();
            $archivo = $file['fileProducto'];
            Excel::import(new ProductoSheet, $archivo);
            return redirect()->back()->with('success', "Productos subidas correctamentes");
        } catch (\Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }
}