<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\Employee\EmployeeReportToRepository;

class EmployeeReportToController extends Controller
{
    /**
	 * @var $employee_report_to
	 */
	private $employee_report_to;

	/**
	 * 
	 *
	 * @param App\Repositories\Employee\EmployeeReportToRepository $employee_report_to
	 */
	public function __construct(EmployeeReportToRepository $employee_report_to) 
	{
		$this->employee_report_to = $employee_report_to;
	}

	/**
	 * Get all employee_report_to.
	 *
	 * @return Illuminate\View
	 */
	public function getAllEmployeeReportTo($id = null)
	{
		$reportto = $this->employee_report_to->getAll();
		$editEmployeeReportTo = (isset($id)) ? $this->employee_report_to->getById($id) : null;

		return view('reportto.index', compact('reportto', 'editEmployeeReportTo'));
		//return view('pages.employee.report-to', ['reports'=>$reports]);
	}

	/**
	 * Store a employee_report_to
	 *
	 * @var array $attributes
	 *
	 * @return mixed
	 */
	public function postStoreEmployeeReportTo(Request $request)
	{
		$attributes = $request->only(['emp_id']);
		$this->employee_report_to->create($attributes);

		return redirect()->route('employee_report_to.index');
	}

	/**
	 * Update a employee_report_to
	 *
	 * @var integer $id
	 * @var array 	$attributes
	 *
	 * @return mixed
	 */
	public function postUpdateEmployeeReportTo($id, Request $request)
	{
		$attributes = $request->only(['emp_id']);
		$this->employee_report_to->update($id, $attributes);

		return redirect()->route('employee_report_to.index');
	}

	/**
	 * Delete a employee_report_to
	 *
	 * @var integer $id
	 *
	 * @return mixed
	 */
	public function postDeleteEmployeeReportTo($id)
	{
		$this->employee_report_to->delete($id);

		return redirect()->route('employee_report_to.index');
	}
}