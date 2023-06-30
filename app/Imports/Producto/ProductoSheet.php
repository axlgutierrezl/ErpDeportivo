<?php

namespace App\Imports\Producto;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProductoSheet implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            0 => new ProductoImport()
        ];
    }
}