<?php
namespace App\Providers;

use App\Repositories\Payroll\AdditionRepository;
use App\Repositories\Payroll\DeductionRepository;
use App\Repositories\Payroll\EisRepository;
use App\Repositories\Payroll\EloquentAddition;
use App\Repositories\Payroll\EloquentDeduction;
use App\Repositories\Payroll\EloquentEis;
use App\Repositories\Payroll\EloquentEpf;
use App\Repositories\Payroll\EloquentPayroll;
use App\Repositories\Payroll\EloquentPayrollTrx;
use App\Repositories\Payroll\EloquentPayrollTrxAddition;
use App\Repositories\Payroll\EloquentPayrollTrxDeduction;
use App\Repositories\Payroll\EloquentPcb;
use App\Repositories\Payroll\EloquentSocso;
use App\Repositories\Payroll\EpfRepository;
use App\Repositories\Payroll\PayrollRepository;
use App\Repositories\Payroll\PayrollTrxAdditionRepository;
use App\Repositories\Payroll\PayrollTrxDeductionRepository;
use App\Repositories\Payroll\PayrollTrxRepository;
use App\Repositories\Payroll\PcbRepository;
use App\Repositories\Payroll\SocsoRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Employee\EmployeeReportToRepository;
use App\Repositories\Employee\EloquentEmployeeReportTo;
use App\Repositories\Employee\EmployeeRepository;
use App\Repositories\Employee\EloquentEmployee;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(PayrollRepository::class, EloquentPayroll::class);
        $this->app->singleton(EpfRepository::class, EloquentEpf::class);
        $this->app->singleton(EisRepository::class, EloquentEis::class);
        $this->app->singleton(AdditionRepository::class, EloquentAddition::class);
        $this->app->singleton(DeductionRepository::class, EloquentDeduction::class);
        $this->app->singleton(PcbRepository::class, EloquentPcb::class);
        $this->app->singleton(SocsoRepository::class, EloquentSocso::class);
        $this->app->singleton(PayrollTrxRepository::class, EloquentPayrollTrx::class);
        $this->app->singleton(PayrollTrxAdditionRepository::class, EloquentPayrollTrxAddition::class);
        $this->app->singleton(PayrollTrxDeductionRepository::class, EloquentPayrollTrxDeduction::class);
        $this->app->singleton(EmployeeReportToRepository::class, EloquentEmployeeReportTo::class);
        $this->app->singleton(EmployeeRepository::class, EloquentEmployee::class);
        $this->app->singleton(PayrollTrxAdditionRepository::class, EloquentPayrollTrxAddition::class);
        $this->app->singleton(PayrollTrxDeductionRepository::class, EloquentPayrollTrxDeduction::class);
    }
}

