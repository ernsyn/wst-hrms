<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithDrawings;

class EISLampiranExport implements FromView,ShouldAutoSize,WithEvents,WithDrawings
{

    private $data;
    private $dataArr;
    private $totalContributionAmount;

    public function __construct($data,$dataArr,$totalContributionAmount)
    {
        $this->data = $data;
        $this->dataArr = $dataArr;
        $this->totalContributionAmount = $totalContributionAmount;
    }

    public function view(): View
    {
            return view("pages/payroll/governmentreport/eis")->with(
            ['data' => $this->data ,
             'dataArr' => $this->dataArr,
             'totalContributionAmount' => $this->totalContributionAmount
            ]);
    }

    public function registerEvents(): array
    {
        $styleArray = [
            'font' => [
                'bold' => true,
            ]
        ];

        return [
            AfterSheet::class    => function(AfterSheet $event) use ($styleArray){
                $event->sheet->getStyle()->applyFromArray($styleArray);
            },
        ];
    }

    public function drawings()
    {
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Logo');
        $drawing->setPath(public_path('img/report/perkeso_color.png'));
        $drawing->setHeight(100);
        $drawing->setOffsetX(50);
        $drawing->setOffsetY(10);
        $drawing->setCoordinates('A1');
        return $drawing;
    }

}
