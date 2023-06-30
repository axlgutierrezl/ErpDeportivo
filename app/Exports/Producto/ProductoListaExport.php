<?php

namespace App\Exports\Producto;

use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\HasReferencesToOtherSheets;

class ProductoListaExport implements WithEvents,WithColumnWidths,WithTitle,HasReferencesToOtherSheets
{
    public function title():String{
        return "Detalles";
    }

    public function columnWidths():array{
        return [
            'A'=>50,
            'B'=>50,
            'C'=>50,
            'D'=>50,
            'E'=>20
        ];
    }

    public function registerEvents():array{
        return [
            BeforeWriting::class => [self::class, 'beforeWriting'],
            AfterSheet::class    => function (AfterSheet $event) {

                $event->sheet->getStyle('A1:E1')->applyFromArray(
                    [
                        'fill'=>[
                            'fillType'=>Fill::FILL_GRADIENT_LINEAR,
                            'rotation'=>90,
                            'startColor' => [
                                'argb' => 'FFF9C4',
                            ],
                            'endColor' => [
                                'argb' => 'FFF9C4',
                            ],
                        ]
                    ]
                );

                /** LLenar Lista en la celda A1 para Almacenes */
                $event->sheet->setCellValue("A1","Almacenes");
                $i=2;
                foreach(\almacenes() as $almacen){
                    $event->sheet->setCellValue('A' . $i,  $almacen->descripcion );
                    $i++;
                }

                /** LLenar Lista en la celda B1 para categorias */
                $event->sheet->setCellValue("B1","Categorias");
                $i=2;
                foreach(\categorias() as $categoria){
                    $event->sheet->setCellValue('B' . $i,  $categoria->descripcion);
                    $i++;
                }

                /** LLenar Lista en la celda C1 para marcas */
                $event->sheet->setCellValue("C1","Marcas");
                $i=2;
                foreach(\marcas() as $marca){
                    $event->sheet->setCellValue('C' . $i,  $marca->nombre);
                    $i++;
                }


                /** LLenar Lista en la celda D1 para Unidades de Medida */
                $event->sheet->setCellValue("D1","Unidades");
                $i=2;
                foreach(\unidadMedidas() as $unidad){
                    $event->sheet->setCellValue('D' . $i,  $unidad->simbolo.'-'.$unidad->descripcion );
                    $i++;
                }

                /** LLenar Lista en la celda E1 para Tiene IGV */
                $event->sheet->setCellValue("E1","Igv");
                $i=2;
                foreach(tieneIgv() as $igv){
                    $event->sheet->setCellValue('E' . $i,  $igv);
                    $i++;
                }

            }
        ];
    }
}
