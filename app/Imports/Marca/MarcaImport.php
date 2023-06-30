<?php

namespace App\Imports\Marca;

use Illuminate\Support\Collection;
use App\Models\Tenant\Almacenes\Marca;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MarcaImport implements ToCollection,WithHeadingRow
{
    use Importable;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $row){
            $exist = Marca::where("nombre",$row["nombre"])
            ->where("estado","ACTIVO")
            ->first();
            if($row["nombre"]!=null && !$exist){
                $marca = new Marca();
                $marca->nombre = ucwords(strtolower($row["nombre"]));
                $marca->procedencia="Nacional";
                $marca->save();
            }
        }
    }
}