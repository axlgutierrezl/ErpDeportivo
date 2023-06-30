<?php

namespace App\Exports\Marca;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MarcaExport implements FromArray, WithHeadings, ShouldAutoSize, WithEvents,WithTitle
{
    public function array():array{
        $data = array();
        array_push($data,[
            "Nombre"=>"nombre de la marca"
        ]);
        return $data;
    }
    public function title():String{
        return "Marcas";
    }
    public function headings(): array
    {
        return [
            [
                'Nombre',
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
