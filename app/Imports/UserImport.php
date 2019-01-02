<?php
namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements WithHeadingRow
{
    use Importable;
    
    public function collection(Collection $collection)
    {
        
    }
}

