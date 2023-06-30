<?php

namespace App\Exports\Producto;

use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\Tenant\Almacenes\Producto;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductosExport implements ShouldAutoSize, WithHeadings, FromArray, WithEvents
{

    function array(): array
    {
        $data = array();
        $productos = Producto::where("estado","ACTIVO")->orderBy("stock","DESC")->get();
        foreach($productos as $item){
            array_push($data,[
                'Nombre'=>$item->nombre,
                'Descripcion'=>$item->descripcion,
                'Categoria'=>$item->categoria->descripcion,
                'Marca'=>$item->marca->nombre,
                'Almacen'=>$item->almacen->descripcion,
                'Codigo Barra'=>$item->codigo_barra,
                'P. Venta'=>$item->precio_venta,
                'P. Compra'=>$item->precio_compra,
                'Unidad Medida' => unidadMedidas($item->unidad_medida)->descripcion,
                'Stock'=>$item->stock,
                'Estado'=>$item->estado,
            ]);
        }
        return $data;
    }
    public function title(): String
    {
        return "Productos";
    }
    public function headings(): array
    {
        return [
            'Nombre',
            'Descripcion',
            'Categoria',
            'Marca',
            'Almacen',
            'Codigo Barra',
            'P. Venta',
            'P. Compra',
            'Unidad Medida',
            'Stock',
            'Estado',
        ];
    }
    public function registerEvents(): array
    {
        return [

            BeforeWriting::class => [self::class, 'beforeWriting'],
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:K1')->applyFromArray([
                    'font' => [
                        'name'      =>  'Arial',
                        'size'      =>  12,
                        'bold'      =>  true,
                        'color' => ['argb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                        'rotation' => 90,
                        'startColor' => [
                            'argb' => '1ab394',
                        ],
                        'endColor' => [
                            'argb' => '1ab394',
                        ],
                    ],

                ]

                );
            },
        ];
    }
}
