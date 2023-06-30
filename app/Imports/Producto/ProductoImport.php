<?php

namespace App\Imports\Producto;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use App\Models\Tenant\Almacenes\Marca;
use App\Models\Tenant\Almacenes\Almacen;
use App\Models\Tenant\Almacenes\Producto;
use App\Models\Tenant\Almacenes\Categoria;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductoImport implements ToCollection,WithHeadingRow
{
    use Importable;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $row){
            $exists = Producto::where("nombre",$row["nombre"])
            ->where("estado","ACTIVO")
            ->first();

            if(!empty($row["nombre"]) && !$exists){
                $almacen = Almacen::where("descripcion",$row["almacen"])->first();
                $categoria = Categoria::where("descripcion",$row["categoria"])->first();
                $marca = Marca::where("nombre",$row["marca"])->first();
                $unidadMedida = explode("-",$row["unidadmedida"]);

                $producto = new Producto();
                $producto->almacen_id= $almacen->id;
                $producto->categoria_id=$categoria->id;
                $producto->marca_id=$marca->id;
                $producto->nombre=$row["nombre"];
                $producto->descripcion=$row["descripcion"];
                $producto->codigo_barra=$row["codigobarra"];
                $producto->precio_venta=$row["precioventa"];
                $producto->precio_compra=$row["preciocompra"];
                $producto->stock=$row["stock"];
                $producto->stock_minimo=$row["stockminimo"];
                $producto->unidad_medida=$unidadMedida[0];
                $producto->tiene_igv = $row["igv"]=="SI" ? 1 : 0;
                $producto->save();
            }
        }
    }
}
