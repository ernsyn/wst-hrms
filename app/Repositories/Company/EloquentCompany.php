<?php

namespace App\Repositories\Company;

use App\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class EloquentCompany implements CompanyRepository
{

    public function __construct()
    {

    }

    public function query()
    {
        return
        Company::leftjoin('users as U', 'U.id', '=', 'companies.updated_by')
        ->select('companies.*', 'U.name as updated_by',
            DB::raw('
                CASE
                    WHEN companies.logo_media_id IS NULL OR companies.logo_media_id = "" THEN CONCAT("'.env('ADMIN_DOMAIN').env('DUMMY').'")
                    ELSE CONCAT("'.env('ADMIN_DOMAIN').env('COMPANY_PATH').'/", companies.logo_media_id)
                END as image
            ')
        );
    }

    public function all($paginate = false, $request_data = null)
    {
        $search = @$request_data['search'];
        $status = @$request_data['status'];

        $query = $this->query()
                ->where(function($query) use ($search){
                    if($search){
                        $query->where('companies.name', 'like', "%$search%");
                        $query->orwhere('companies.code', 'like', "%$search%");
                        $query->orwhere('companies.description', 'like', "%$search%");
                        $query->orwhere('companies.tax_number', 'like', "%$search%");
                        $query->orwhere('companies.epf_number', 'like', "%$search%");
                        $query->orwhere('companies.socso_number', 'like', "%$search%");
                        $query->orwhere('companies.eis_number', 'like', "%$search%");
                    }
                })
                ->where(function($query) use ($status){
                    if($status) $query->where('companies.status', $status);
                });

        if($paginate){
            $result = $query->paginate(10)->appends(Input::except('page'));
        }else{
            $result = $query->get();
        }
        return $result;
    }

    public function find($id)
    {
        return $this->query()->where('companies.id', $id)->first();
    }

}