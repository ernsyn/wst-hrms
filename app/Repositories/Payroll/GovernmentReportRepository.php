<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 12/14/18
 * Time: 3:12 PM
 */

namespace App\Repositories\Payroll;

interface GovernmentReportRepository
{
    public function getUserLogonCompanyInformation();

    public function getCompanyInformation($companyId);

    public function getCostCentre();

    public function getDepartments();

    public function getBranches();

    public function getPosition();

    public function getLHDNYearlyReport($companyId,$filter);
}
