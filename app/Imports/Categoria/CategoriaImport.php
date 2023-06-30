<?php

namespace App\Imports\Categoria;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use App\Models\Tenant\Almacenes\Categoria;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoriaImport implements ToCollection,WithHeadingRow
{
    use Importable;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $row){
            $exist = Categoria::where("descripcion",$row["rubro"])
            ->where("estado","ACTIVO")
            ->first();
            if($row["rubro"]!=null && !$exist){
                $categoria = new Categoria();
                $categoria->descripcion = ucwords(strtolower($row["rubro"]));
                $categoria->save();
            }
        }
    }
}