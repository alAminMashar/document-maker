<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use romanzipp\QueueMonitor\Traits\IsMonitored;
// use IsMonitored;


use App\Models\Gear;
use App\Models\GearItem;
use App\Models\GearDeduction as GrDed;

use App\Models\CustomerContract as Contract;
use App\Models\EmployeeDeployment as Deployment;
use App\Models\Modification;
use App\Models\Employee;
use App\Models\PaymentInstallment as Payment;
use App\Models\CustomerStatementItem;
use App\Models\BankAccount as Account;
use App\Models\AssignmentAttendanceRecord as PatrolRecord;
use App\Models\Deduction;
use App\Models\Location;
use App\Models\Payroll;
use App\Models\MonthlyBill as Bill;

use App\Jobs\SystemUpdates;
use App\Jobs\UpdateEmployeeDetails;
use App\Jobs\GenerateCustomerMonthlyReport as RunReport;

use App\Models\MassDeduction;
use App\Models\RecurrentSalaryBonus;
use App\Models\RecurrentSalaryDeduction;

use Illuminate\Support\Str;
use Auth;

class RunMaintenance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 3300;

    public $task;
    /**
     * Create a new task instance.
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        switch ($this->task) {
            case "approveAllPending":
                $this->approveAllPending();
                break;

            case "updateEmployeeDetails":
                $this->updateEmployeeDetails();
                break;
            case "runCustomerMonthlyReport":
                    $this->runCustomerMonthlyReport();
                    break;
            default:
                $this->updateEmployeeDetails();
                break;
        }
    }

    private function runCustomerMonthlyReport()
    {
        dispatch(new RunReport());
        return true;
    }

    private function approveAllPending()
    {
        foreach(Modification::where('active','=',1)->get() as $modification){
            $modification->execute();
        }
    }

    private function setPeriods()
    {
        //Find the previous Payroll Id
        $latest_payroll = Payroll::orderBy('created_at','DESC')->first();
        $prev_payroll_id = $latest_payroll->id - 1;
        $prev_payroll = Payroll::find($prev_payroll_id);
        foreach(Bill::get() as $bill){$bill->setMonth();}
        foreach(Payroll::get() as $payroll){$payroll->setMonth();}
    }

    private function resetRecurrentMassDeductions()
    {
        //Pick all recurrent mass deductions
        foreach(MassDeduction::get() as $deduction)
        {
            $deduction->update([
                'last_run_period_id'    =>   $this->prev_payroll->period['id'],
            ]);
        }
    }

    private function resetRecurrentDeductions()
    {
        //Pick all recurrent deductions
        foreach(RecurrentSalaryDeduction::get() as $deduction)
        {
            $deduction->update([
                'last_period_run_id'    =>   $this->prev_payroll->period['id'],
            ]);
        }
    }

    private function resetRecurrentBonus()
    {
        //Pick all recurrent Bonuss
        foreach(RecurrentSalaryBonus::get() as $bonus)
        {
            $bonus->update([
                'last_period_run_id'    =>   $this->prev_payroll->period['id'],
            ]);
        }
    }

    private function updateEmployeeDetails()
    {
        foreach(Employee::where('status_id','=',3)->get() as $employee){
            dispatch(new UpdateEmployeeDetails($employee));
        }
        return true;
    }


    private function approveBankAccounts()
    {
        $bank_accounts = Account::all();

        foreach($bank_accounts as $account){
            $account->update([
                'approved'  => 1
            ]);
        }

        return true;

    }

    private function matchPaymentDates()
    {
        //Match the date_paid field on payment installments to their corresponding customer statement item's date
        foreach(Payment::get() as $payment)
        {
            // find the corresponding statement item
            $statement_item = CustomerStatementItem::where('reference_number','=',$payment->reference)->first();

            //check if statement item exists
            if($statement_item){
                //Update the payment installment to match the statement date
                $payment->update([
                    'date_paid' =>  $statement_item->date,
                ]);
            }
        }

    }

    private function updateMods()
    {
        foreach(Modification::whereActive(1)->get() as $mod){
            $mod->describe();
        }
    }

    private function cleanNumbers()
    {
        // Phone prefix
        $prefix = "+254";

        //Notification type for all.
        $notification_type = 'sensitive';

        foreach(Employee::get() as $employee){
            // clean up the number and add +254
            $clean_number = substr($employee->phone, -9);

            //Check if any other employee shares the phone number
            $check = Employee::where('serial_number','<>',$employee->serial_number)->where('phone','like','%'.$clean_number)->count();

            if($check > 0){

                $employee_2 = Employee::where('serial_number','<>',$employee->serial_number)->where('phone','like','%'.$clean_number.'%')->first();

                //This current employee's details
                $employee_details = $employee->serial_number.' '.$employee->name().' National ID:'.$employee->id_number;

                //Second employee with matching number
                $employee_2_details = $employee_2->serial_number.' '.$employee_2->name().' National ID:'.$employee_2->id_number;

                $message = "$employee_details phone number $employee->phone matches $employee_2_details phone number $employee_2->phone";

                //Create Notification
                $phone_change_notification = new SystemUpdates($notification_type, $message);

                //Send the notification
                dispatch($phone_change_notification);
            }

            //Update the phone number
            $employee->update([
                'phone' =>  $prefix.$clean_number
            ]);

        }

    }

}
