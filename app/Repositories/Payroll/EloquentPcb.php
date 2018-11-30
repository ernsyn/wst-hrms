<?php
namespace App\Repositories\Payroll;

use App\Pcb;

class EloquentPcb implements PcbRepository
{
    public function findByFilter($filter)
    {
        $pcbGroup = @$filter['pcbGroup']; // SPMW (1) , SNW (2) , SW (3)
        $noOfChildren = @$filter['noOfChildren'];
        
        //todo: move logic to service layer
        //todo: create enum for pcb Group
        if(@$pcbGroup) {
            switch ($pcbGroup) {
                case 'SPMW':
                    $pcbGroup = 1;
                    break;
                case 'SNW':
                    $pcbGroup = 2;
                    break;
                case 'SW':
                    $pcbGroup = 3;
            }
        }
        
        if($noOfChildren > 20) $noOfChildren = 20;
        
        $pcb = Pcb::select('*')
        ->where('salary', '>=', $filter['salary'])
        ->where(function($query) use($pcbGroup){
            if($pcbGroup) $query->where('category', $pcbGroup);
        })
        ->where(function($query) use($noOfChildren){
            if($noOfChildren) $query->where('number_of_children', '<', $noOfChildren);
        })
        ->orderby('salary', 'ASC')
        ->first();
        
        // If no result, meaning that the salary is higher than the setting of eis, so, get the highest salary from DB.
        if(!@$pcb) {
            $pcb = Pcb::select('*')
            ->where('salary', '<', $filter['salary'])
            ->where(function($query) use($pcbGroup){
                if($pcbGroup) $query->where('category', $pcbGroup);
            })
            ->where(function($query) use($noOfChildren){
                if($noOfChildren) $query->where('number_of_children', '<', $noOfChildren);
            })
            ->orderby('salary', 'DESC')
            ->first();
        }
        
        return $pcb;
    }
    
}

