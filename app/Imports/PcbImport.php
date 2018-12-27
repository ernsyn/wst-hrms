<?php

namespace App\Imports;

use App\Pcb;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class PcbImport implements ToCollection, WithBatchInserts, WithChunkReading, ShouldQueue, WithCalculatedFormulas
{
    use Importable;
    
    public function model(array $row)
    {
        return new Pcb([
            'category' => $row[0],
            'total_children' => $row[1],
            'salary' => $row[2],
            'amount' => $row[3]
        ]);
    }
    
    public function batchSize(): int
    {
        return 1000;
    }
    
    public function chunkSize(): int
    {
        return 1000;
    }
    
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            Pcb::create([
                'category' => $row[0],
                'total_children' => $row[1],
                'salary' => $row[2],
                'amount' => $row[3]
            ]);
        }
    }

    
}