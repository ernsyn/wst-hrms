<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BankCreditDetailExport implements FromView, WithEvents, ShouldAutoSize
{
    private $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    public function view(): View
    {
        return view('pages.payroll.payrollreport.doc6', [
            'data' => $this->data
        ]);
    }
    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                
                $cellArray = ['A2','A3','B2','B3','C2', 'C3','D2', 'D3','E2', 'E3','F2', 'F3','G2', 'G3','H2', 'H3','I2', 'I3','J2', 'J3','K2', 'K3'];
                foreach($cellArray as $cell){
                    $event->sheet->styleCells(
                        $cell,
                        [
                            'borders' => [
                                'outline' => [
                                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                    'color' => ['argb' => '000000'],
                                ],
                            ],
                            'font' => [
                                'bold' => true,
                            ],
                            'alignment' => [
                                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                            ],
                        ]
                    );
                }
                
                //payment date
                $event->sheet->styleCells(
                    'A1',
                    [
                        'font' => [
                            'bold' => true,
                        ],
                    ]
                );
                
                $event->sheet->styleCells(
                    'B1',
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ],
                    ]
                );
                
                foreach (range('A', 'K') as $char) {
                    $event->sheet->styleCells(
                        $char,
                        [
                            'alignment' => [
                                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                            ],
                        ]
                        );
                }
            },
            ];
    }


}
