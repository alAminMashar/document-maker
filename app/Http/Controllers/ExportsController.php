<?php

namespace App\Http\Controllers;


use Maatwebsite\Excel\Facades\Excel;

use App\Exports\UsersExport;
use App\Exports\AssignmentsExport;
use App\Exports\SalaryAdvanceExport;
use App\Exports\DeploymentsExport;
use App\Exports\EmployeesExport;
use App\Exports\ExportLocations;
use App\Exports\ExportCustomerMonthlyReports;
use App\Jobs\GenerateEmployeeBankAccountByAssignmentReport;

use App\Models\MonthlyBill as Bill;

use Auth;


class ExportsController extends Controller
{

    public function exportLocations()
    {
        $file_name = 'Locations'.date('d M Y H i s').'.xlsx';
        return Excel::download(new ExportLocations, $file_name);
    }

    public function exportEmployeeBankAssignment()
    {

        //Generate Bank Account Report
        $create_report_task = new GenerateEmployeeBankAccountByAssignmentReport(Auth::user());
        dispatch($create_report_task);

        notify()->success('We will notify you once we finish.⚡️', 'Your file is being processed');

        return redirect()->back();

    }

    public function exportCustomerMonthlyReports(Bill $bill)
    {
        $file_name = date('d M Y H m s').' Customers Report for Month'.$bill->slug.'.xlsx';
        return Excel::download(new ExportCustomerMonthlyReports($bill), $file_name);
    }

    public function exportDeployments($status = null)
    {
        $file_name = date('d M Y H m s').' Exported Employee Deployments.xlsx';
        return Excel::download(new DeploymentsExport($status), $file_name);
    }

    public function exportEmployees($status = null)
    {
        $file_name = date('d M Y H m s').' Exported Employees.xlsx';
        return Excel::download(new EmployeesExport($status), $file_name);
    }

    public function exportAssignments($status = null)
    {
        $file_name = date('d M Y H m s').' Exported Assignments.xlsx';
        return Excel::download(new AssignmentsExport($status), $file_name);
    }

    public function exportSalaryAdvances($status = null)
    {
        $file_name = date('d M Y H m s').' Exported Salary Advance Report.xlsx';
        return Excel::download(new SalaryAdvanceExport($status), $file_name);
    }

    public function exportUsers()
    {
        $file_name = 'users-exported-'.date('d M Y H m s').'.xlsx';
        return Excel::download(new UsersExport, $file_name);
    }
}
