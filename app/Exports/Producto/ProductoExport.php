<?php

namespace App\Exports\Producto;

use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class ProductoExport implements FromArray, WithHeadings, ShouldAutoSize, WithEvents,WithColumnWidths
{
    function array(): array{
        $data = array();
        return $data;
    }

    public function title(): String
    {
        return "Productos";
    }

    public function columnWidths():array{
        return [
            'A'=>20,
            'B'=>20,
            'C'=>20,
            'D'=>20,
            'E'=>20,
            'F'=>20,
            'G'=>20,
            'H'=>15,
            'I'=>15,
            'J'=>15,
            'K'=>10,
            'L'=>15
        ];
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Descripcion',
            'Almacen',
            'Categoria',
            'Marca',
            'UnidadMedida',
            'CodigoBarra',
            'PrecioVenta',
            'PrecioCompra',
            'Stock',
            'Igv',
            'StockMinimo'
        ];
    }
    public function registerEvents():array{
        return [
            BeforeWriting::class => [self::class, 'beforeWriting'],
            AfterSheet::class    => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:L1')->applyFromArray(
                    [
                        'fill' => [
                            'fillType' => Fill::FILL_GRADIENT_LINEAR,
                            'rotation' => 90,
                            'startColor' => [
                                'argb' => '80CBC4',
                            ],
                            'endColor' => [
                                'argb' => '80CBC4',
                            ],
                        ],
                    ]

                );
                for($j=2;$j<1000;$j++){

                    /** ALMACENES */
                    $validation = $event->sheet->getCell("C$j")->getDataValidation();
                    $validation->setType(DataValidation::TYPE_LIST);
                    $validation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $validation->setAllowBlank(true);
                    $validation->setShowInputMessage(false);
                    $validation->setShowErrorMessage(true);
                    $validation->setShowDropDown(true);
                    $validation->setErrorTitle('Error en escritura');
                    $validation->setError('El valor no esta en la lista');
                    $validation->setFormula1('detalles!$A$2:$A$' . (almacenes()->count() + 1));

                    /** CATEGORIAS */
                    $validation = $event->sheet->getCell("D$j")->getDataValidation();
                    $validation->setType(DataValidation::TYPE_LIST);
                    $validation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $validation->setAllowBlank(true);
                    $validation->setShowInputMessage(false);
                    $validation->setShowErrorMessage(true);
                    $validation->setShowDropDown(true);
                    $validation->setErrorTitle('Error en escritura');
                    $validation->setError('El valor no esta en la lista');
                    $validation->setFormula1('detalles!$B$2:$B$' . (categorias()->count() + 1));


                    /** MARCAS */
                    $validation = $event->sheet->getCell("E$j")->getDataValidation();
                    $validation->setType(DataValidation::TYPE_LIST);
                    $validation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $validation->setAllowBlank(true);
                    $validation->setShowInputMessage(false);
                    $validation->setShowErrorMessage(true);
                    $validation->setShowDropDown(true);
                    $validation->setErrorTitle('Error en escritura');
                    $validation->setError('El valor no esta en la lista');
                    $validation->setFormula1('detalles!$C$2:$C$' . (marcas()->count() + 1));


                    /** UNIDADES DE MEDIDA */
                    $validation = $event->sheet->getCell("F$j")->getDataValidation();
                    $validation->setType(DataValidation::TYPE_LIST);
                    $validation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $validation->setAllowBlank(true);
                    $validation->setShowInputMessage(false);
                    $validation->setShowErrorMessage(true);
                    $validation->setShowDropDown(true);
                    $validation->setErrorTitle('Error en escritura');
                    $validation->setError('El valor no esta en la lista');
                    $validation->setFormula1('detalles!$D$2:$D$' . (unidadMedidas()->count() + 1));

                    /** TIENE IGV */
                    $validation = $event->sheet->getCell("K$j")->getDataValidation();
                    $validation->setType(DataValidation::TYPE_LIST);
                    $validation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $validation->setAllowBlank(true);
                    $validation->setShowInputMessage(false);
                    $validation->setShowErrorMessage(true);
                    $validation->setShowDropDown(true);
                    $validation->setErrorTitle('Error en escritura');
                    $validation->setError('El valor no esta en la lista');
                    $validation->setFormula1('detalles!$E$2:$E$' . (count(tieneIgv()) + 1));
                }
            }
        ];
    }
}
