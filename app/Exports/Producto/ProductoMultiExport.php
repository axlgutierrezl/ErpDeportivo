<?php

namespace App\Exports\Producto;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProductoMultiExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            "producto"=>new ProductoExport(),
            "detalle"=>new ProductoListaExport()
        ];
    }
}