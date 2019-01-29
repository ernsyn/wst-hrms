<?php
namespace App\Repositories\Payroll;

use App\Epf;

class EloquentEpf implements EpfRepository
{
    public function findByFilter(array $filter)
    {
//         $age = @$filter['age'];
//         $nationality = @$filter['nationality'];
        
//         // 132 is malaysian based on countries table
//         $epfAge = 60;
//         $category = '';
//         if($age < $epfAge && $nationality == '132') { 
//             /*
//              * Kadar caruman bulanan yang dinyatakan dalam Bahagian ini hendaklah terpakai bagi pekerja yang berikut sehingga pekerja itu mencapai umur enam puluh tahun:
//              * (a) pekerja yang merupakan warganegara Malaysia;
//              * (b) pekerja yang bukan warganegara Malaysia tetapi merupakan pemastautin tetap di Malaysia; dan
//              * (c) pekerja yang bukan warganegara Malaysia yang memilih untuk mencarum sebelum 1 Ogos 1998. 
//              */
//             $category = 'A';
//         } else if($age < $epfAge && $nationality != '132') {
//             /*
//              * Kadar caruman bulanan yang dinyatakan dalam Bahagian ini hendaklah terpakai bagi pekerja yang berikut sehingga pekerja itu mencapai umur enam puluh tahun:
//              * (a) pekerja yang bukan warganegara Malaysia dan telah memilih untuk mencarum pada atau selepas 1 Ogos 1998;
//              * (b) pekerja yang bukan warganegara Malaysia dan telah memilih untuk mencarum di bawah perenggan 3 Jadual Pertama pada atau selepas 1 Ogos 1998; dan
//              * (c) pekerja yang bukan warganegara Malaysia dan telah memilih untuk mencarum di bawah perenggan 6 Jadual Pertama pada atau selepas 1 Ogos 2001.
//              */
//             $category = 'B';
//         } else if($age >= $epfAge && $nationality != '132') {
//             /*
//              * Kadar caruman bulanan yang dinyatakan dalam Bahagian ini hendaklah terpakai bagi pekerja yang berikut yang telah mencapai umur enam puluh tahun:
//              * (a) (Dipotong oleh P.U. (A) 370/ 2018);
//              * (b) pekerja bukan warganegara Malaysia tetapi merupakan pemastautin tetap di Malaysia; dan
//              * (c) pekerja bukan warganegara Malaysia yang memilih untuk mencarum sebelum 1 Ogos 1998.
//              */
//             $category = 'C';
//         } else if($age >= $epfAge && $nationality != '132') {
//             /*
//              * Kadar caruman bulanan yang dinyatakan dalam Bahagian ini hendaklah terpakai bagi pekerja yang berikut yang telah mencapai umur enam puluh tahun:
//              * (a) pekerja yang bukan warganegara Malaysia dan telah memilih untuk mencarum pada atau selepas 1 Ogos 1998;
//              * (b) pekerja yang bukan warganegara Malaysia dan telah memilih untuk mencarum di bawah perenggan 3 Jadual Pertama pada atau selepas 1 Ogos 1998; dan
//              * (c) pekerja yang bukan warganegara Malaysia dan telah memilih untuk mencarum di bawah perenggan 6 Jadual Pertama pada atau selepas 1 Ogos 2001.
//              */
//             $category = 'D';
//         } else if($age >= $epfAge && $nationality == '132') {
//             /*
//              * Kadar caruman bulanan yang dinyatakan dalam Bahagian ini hendaklah terpakai bagi pekerja warganegara Malaysia yang telah mencapai umur enam puluh tahun.
//              */
//             $category = 'E';
//         }
        //         dd($nationality);
        $epf = Epf::where([
            ['salary', '>=', $filter['salary']],
            ['category', $filter['category']],
        ])
//         ->where(function($query) use($category){
//             if($category) $query->where('category', $category);
//         })
        ->orderby('salary', 'ASC')
        ->first();
        
        if(!@$epf) {
            $epf = Epf::where([
                ['salary', '<', $filter['salary']],
                ['category', $filter['category']],
            ])
//             ->where(function($query) use($category){
//                 if($category) $query->where('category', $category);
//             })
            ->orderby('salary', 'DESC')
            ->first();
        }
        
        return $epf;
    }
}

