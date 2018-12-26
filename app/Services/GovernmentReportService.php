<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 12/14/18
 * Time: 2:57 PM
 */

namespace App\Services;

use App\Repositories\Payroll\GovernmentReportRepository;

class GovernmentReportService
{
    protected $governmentReportRepository;

    public function __construct(GovernmentReportRepository $governmentReportRepository){
        $this->governmentReportRepository = $governmentReportRepository;
    }

    public function getUserLogonCompanyInformation(){
        return $this->governmentReportRepository->getUserLogonCompanyInformation();
    }

    public function getCompanyInformation($companyId){
        return $this->governmentReportRepository->getCompanyInformation($companyId);
    }

    public function getCostCentre(){
        return $this->governmentReportRepository->getCostCentre();
    }

    public function getDepartments(){
        return $this->governmentReportRepository->getDepartments();
    }

    public function getBranches(){
        return $this->governmentReportRepository->getBranches();
    }

    public function getPosition(){
        return $this->governmentReportRepository->getPosition();
    }
}
