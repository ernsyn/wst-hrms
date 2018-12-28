<?php
namespace App\Repositories\Payroll;

use App\Pcb;
use App\Constants\PcbSchedule;
use Illuminate\Support\Facades\Log;

class EloquentPcb implements PcbRepository
{
    public function findByFilter($filter)
    {
        Log::debug($filter);
        $pcbGroup = @$filter['pcbGroup']; // SPMW (1) , SNW (2) , SW (3)
        $noOfChildren = @$filter['noOfChildren'];
        
        if($noOfChildren > 20) { 
            $noOfChildren = 20;
        }
        
        $operand = '>=';
        $sort = 'ASC';
        
        if( ($noOfChildren < 11 && $filter['salary'] > PcbSchedule::K_KA10_MAX) || ($noOfChildren > 10 && $filter['salary'] > PcbSchedule::KA11_KA20_MAX) ){
            $operand = '<';
            $sort = 'DESC';
        } 
        
        $pcb = Pcb::select('*')
        ->where('salary', $operand, $filter['salary'])
        ->where(function($query) use($pcbGroup){
            if($pcbGroup) $query->where('category', $pcbGroup);
        })
        ->where(function($query) use($noOfChildren){
            if($noOfChildren) $query->where('total_children', $noOfChildren);
        })
        ->orderby('salary', $sort)
        ->first();
        Log::debug("pcb: ".$pcb);
        
        // formula 86085 & above = int((basic-86085) * 0.28) + pcb for 86085)
        // KA11-KA20 87755 & above = int((basic-87755) * 0.28) + pcb for 87755)
        if(@$pcb) {
            if( $noOfChildren < 11 && $filter['salary'] > PcbSchedule::K_KA10_MAX){ 
                $pcb->amount = ($filter['salary'] - PcbSchedule::K_KA10_MAX) * PcbSchedule::DEDUCTION_PERCENT + $pcb->amount;
                Log::debug("K_KA10_MAX: ".$pcb->amount);
            } else if($noOfChildren > 10 && $filter['salary'] > PcbSchedule::KA11_KA20_MAX){
                $pcb->amount = ($filter['salary'] - PcbSchedule::KA11_KA20_MAX) * PcbSchedule::DEDUCTION_PERCENT + $pcb->amount;
                Log::debug("KA11_KA20_MAX: ".$pcb->amount);
            }
        }
        
        return $pcb;
    }
    
}

