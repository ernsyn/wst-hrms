<?php
namespace App\Repositories\Payroll;

use App\Epf;

class EloquentEpf implements EpfRepository
{
    public function findByFilter(array $filter)
    {
        $age = @$filter['age'];
        $citizenship = @$filter['citizenship'];
        
        //todo: move logic to service layer
        $category = '';
        if($age < 60 && $citizenship == '132') {
            $category = 'A';
        } else if($age < 60 && $citizenship != '132') {
            $category = 'B';
        } else if($age >= 60 && $citizenship == '132') {
            $category = 'C';
        } else if($age >= 60 && $citizenship != '132') {
            $category = 'D';
        }
//         dd($citizenship);
        $epf = Epf::select('*')
        ->where('salary', '>=', $filter['salary'])
        ->where(function($query) use($category){
            if($category) $query->where('category', $category);
        })
        ->orderby('salary', 'ASC')
        ->first();
        if(!@$epf) {
            $epf = Epf::select('*')
            ->where('salary', '<', $filter['salary'])
            ->where(function($query) use($category){
                if($category) $query->where('category', $category);
            })
            ->orderby('salary', 'DESC')
            ->first();
        }
        
        return $epf;
    }

}

