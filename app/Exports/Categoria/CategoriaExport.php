<?php

namespace App\Exports\Categoria;


use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CategoriaExport implements FromArray, WithHeadings, ShouldAutoSize, WithEvents,WithTitle
{
    public function array():array{
        $data = array();
        array_push($data,[
            "RUBRO"=>"Bebidas"
        ]);
        return $data;
    }
    public function title():String{
        return "Categorias";
    }
    public function headings(): array
    {
        return [
            [
                'RUBRO',
            ]
        ];
    }
    public function registerEvents():array{
        return[
            BeforeWriting::class => [self::class,'beforeWriting'],
            AfterSheet::class => function(AfterSheet $afterEvent){
                $afterEvent->sheet->getStyle('A1:A1')->applyFromArray(
                    [
                        'fill'=>[
                            'fillType'=>Fill::FILL_GRADIENT_LINEAR,
                            'rotation'=>90,
                            'startColor' => [
                                'argb' => '1ab394',
                            ],
                            'endColor' => [
                                'argb' => '1ab394',
                            ],
                        ]
                    ]
                );
            }
        ];
    }
}
