<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use OwenIt\Auditing\Contracts\Auditable;
use App\Enums\PayrollPeriodEnum;
use App\Enums\PayrollStatus;

class PayrollMaster extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'payroll_master';
    
    protected $fillable = [
        'status'
    ];

    /*
     * Get payroll trx
     * one-to-many relationship
     */
    public function payrollTrx()
    {
        return $this->hasMany('App\PayrollTrx');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
    
    public function transformAudit(array $data): array
    {   
        if (Arr::has($data, 'new_values.company_id')) {
            if(isset($data['old_values']) && $data['old_values'] != null){
                $data['old_values']['company'] = Company::find($this->getOriginal('company_id'))->name;
            }
            $data['new_values']['company'] = Company::find($this->getAttribute('company_id'))->name;
        }
        
        if (Arr::has($data, 'new_values.period')) {
            if(isset($data['old_values']) && $data['old_values'] != null){
                $data['old_values']['period'] = PayrollPeriodEnum::getDescription($this->getOriginal('period'));
            }
            $data['new_values']['period'] = PayrollPeriodEnum::getDescription($this->getAttribute('period'));
        }
        
        if (Arr::has($data, 'new_values.created_by')) {
            if(isset($data['old_values']) && $data['old_values'] != null){
                $data['old_values']['created_by'] = User::find($this->getOriginal('created_by'));
            }
            $data['new_values']['created_by'] = User::find($this->getAttribute('created_by'))->name;
        }
        
        if (Arr::has($data, 'new_values.updated_by')) {
            if(isset($data['old_values']) && $data['old_values'] != null){
                $data['old_values']['updated_by'] = User::find($this->getOriginal('updated_by'));
            }
            $data['new_values']['updated_by'] = User::find($this->getAttribute('updated_by'))->name;
        }
        
        if (Arr::has($data, 'new_values.status')) {
            if(isset($data['old_values']) && $data['old_values'] != null){
                $data['old_values']['status'] = PayrollStatus::getDescription($this->getOriginal('status'));
            }
            $data['new_values']['status'] = PayrollStatus::getDescription($this->getAttribute('status'));
        }
        
        return $data;
    }
}
