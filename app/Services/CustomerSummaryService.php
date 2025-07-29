<?php


namespace App\Services;

use App\Models\CustomerMonthlyReportItem as ReportItem;
use App\Models\FinancialPeriod as Period;
use App\Models\MonthlyBill as Bill;
use App\Models\Customer;

use Carbon\Carbon;
use DB;

class CustomerSummaryService{

    public function getMonthSummary(Customer $customer, Bill $bill)
    {
        // Set default amounts
        $opening_balance = 0;
        $closing_balance = 0;
        $total_invoiced  = 0;
        $total_paid      = 0;

        $period = $bill->period()->first();
        if (!$period) {
            return compact('opening_balance', 'total_invoiced', 'total_paid', 'closing_balance');
        }

        $month = $period->getMonthNumber();
        $year = $period['year'];

        // Current month starts on this date
        $current_period = Carbon::create($year, $month, 1);
        // Work out number of days this month
        $days_in_month = $current_period->daysInMonth;
        // Set the start and end dates of the month
        $month_start = "$year-$month-1";
        $month_end = "$year-$month-$days_in_month";

        // Check if there are any items
        $item_count = $customer->statementItems()
            ->whereBetween(DB::raw('DATE(date)'), [$month_start, $month_end])
            ->count();

        if ($item_count) {
            // Closing Balance being the first item(last entry) when ordered in descending sequence.
            $last_entry = $customer->statementItems()
                ->whereBetween(DB::raw('DATE(date)'), [$month_start, $month_end])
                ->orderBy('date', 'DESC')
                ->first();

            $closing_balance = $last_entry->balance ?? 0;

            // Get all statement items and filter them within this month
            $total_invoiced = $customer->statementItems()
                ->whereBetween(DB::raw('DATE(date)'), [$month_start, $month_end])
                ->sum('credit');

            // Total amount received from customer this period
            $total_paid = $customer->statementItems()
                ->whereBetween(DB::raw('DATE(date)'), [$month_start, $month_end])
                ->sum('debit');

            // Debit Sum
            $debit_sum = $total_paid;

            // Credit Sum
            $credit_sum = $total_invoiced;

            // Work out the opening balance for current period
            $opening_balance = $closing_balance - $credit_sum + $debit_sum;
        } else {
            /*------------------------------------------------------------------------
            #   1. If No records for the current financial period found
            #   2. Check if there are previous financial periods
            #   3. If this customer had records in the most recent one
            #   4. Pick the closing balance of that
            #   5. Use that closing balance as the opening balance this current period.
            #   0. Skip all the above and use the customer's current balance as opening balance.
            --------------------------------------------------------------------------*/
            $current_period_id = $period->id;
            $previous_period_id = $current_period_id - 1;
            $previous_period = Period::find($previous_period_id);
            $previous_item_count = 0; // Initialize to avoid undefined variable issues

            if ($previous_period) {
                // Previous period exists
                $previous_period_month = $previous_period->getMonthNumber();
                $previous_period_year = $previous_period['year'];

                // Previous month started on this date
                $previous_month = Carbon::create($previous_period_year, $previous_period_month, 1);

                // Work out number of days this month
                $days_in_last_month = $previous_month->daysInMonth;

                // Set the start and end dates of the month
                $last_month_start = "$previous_period_year-$previous_period_month-1";
                $last_month_end = "$previous_period_year-$previous_period_month-$days_in_last_month";

                // Check if there are any items
                $previous_item_count = $customer->statementItems()
                    ->whereBetween(DB::raw('DATE(date)'), [$last_month_start, $last_month_end])
                    ->count();
            }

            if ($previous_period && $previous_item_count > 0) {
                // The last month has items for this customer
                // Pick the closing balance
                // This month's opening balance being the last month's closing balance i.e., (last entry) when ordered in descending sequence.
                $last_months_final_entry = $customer->statementItems()
                    ->whereBetween(DB::raw('DATE(date)'), [$last_month_start, $last_month_end])
                    ->orderBy('date', 'DESC')
                    ->first();

                $opening_balance = $last_months_final_entry->balance ?? 0;
            } else {
                // No records in last month too.
                // Set balance to current customer balance.
                $opening_balance = $customer->getLastBalance() ?? 0;
            }

            // Work out closing balance since you now have an opening balance.
            // Since there's no transactions, then it's the same as the opening balance.
            $closing_balance = $opening_balance;
        }

        // Work out total due before deductions
        $sub_total = $opening_balance + $total_invoiced;

        $data = compact('opening_balance', 'total_invoiced', 'sub_total', 'total_paid', 'closing_balance');

        return $data;
    }

    public function updateReportItem(ReportItem $report_item)
    {
        $bill = Bill::whereFinancialPeriodId($report_item->report['financial_period_id'])->first();
        $customer = $report_item->customer;

        $data = $this->getMonthSummary($customer, $bill);

        $report_item->update([
            'slug'              =>  $customer['name'],
            'opening_balance'   =>  $data['opening_balance'],
            'invoiced_amount'   =>  $data['total_invoiced'],
            'paid_amount'       =>  $data['total_paid'],
            'closing_balance'   =>  $data['closing_balance'],
        ]);
    }



    public function getMonthSummaryOld(Customer $customer, Bill $bill)
    {
        //set default amounts
        $opening_balance = 0;
        $closing_balance = 0;
        $total_invoiced  = 0;
        $total_paid      = 0;

        $period = $bill->period()->first();
        $month = $period->getMonthNumber();
        $year = $period['year'];

        //current month starts on this date
        $current_period = Carbon::create($year, $month, 1);
        //Work out number of days this month
        $days_in_month = $current_period->daysInMonth;
        //Set the start and end dates of the month
        $month_start = $year.'-'.$month.'-1';
        $month_end = $year.'-'.$month.'-'.$days_in_month;

        //Check if there are any items
         $item_count = $customer->statementItems()
        ->whereBetween(DB::raw('DATE(date)'), [$month_start, $month_end])
        ->count();

        if($item_count){
            //Closing Balance being the first item(last entry) when ordered in descending sequence.
            $last_entry = $customer->statementItems()
            ->whereBetween(DB::raw('DATE(date)'), [$month_start, $month_end])
            ->orderBy('date','DESC')
            ->first();

            $closing_balance = $last_entry->balance;

            //Get all statement items and filer them within this month
            $total_invoiced = $customer->statementItems()
            ->whereBetween(DB::raw('DATE(date)'), [$month_start, $month_end])
            ->sum('credit');

            //Total amount received from customer this period
            $total_paid = $customer->statementItems()
            ->whereBetween(DB::raw('DATE(date)'), [$month_start, $month_end])
            ->sum('debit');

            //Debit Sum
            $debit_sum = $customer->statementItems()
            ->whereBetween(DB::raw('DATE(date)'), [$month_start, $month_end])
            ->sum('debit');

            //Credit Sum
            $credit_sum = $customer->statementItems()
            ->whereBetween(DB::raw('DATE(date)'), [$month_start, $month_end])
            ->sum('credit');

            //Work out the opening balance for current period
            $opening_balance = $closing_balance - $credit_sum + $debit_sum;

        }else{
            /*------------------------------------------------------------------------
            #   1. If No records for the current financial period found
            #   2. Check if there are previous financial periods
            #   3. If this customer had a records in the most recent one
            #   4. Pick the closing balance of that
            #   5. Use that closing balance as the opening balance this current period.
            #   0. Skip all the above and use the customer's current balance as opening balance.
            --------------------------------------------------------------------------*/
            $current_period_id  = $period->id;
            $previous_period_id = $current_period_id - 1;
            $previous_period = Period::find($previous_period_id);

            if($previous_period){

                //Previous period exists
                $previous_period_month = $previous_period->getMonthNumber();
                $previous_period_year = $previous_period['year'];

                //previous month started on this date
                $previous_month = Carbon::create($previous_period_year, $previous_period_month, 1);

                //Work out number of days this month
                $days_in_last_month = $previous_month->daysInMonth;

                //Set the start and end dates of the month
                $last_month_start = $previous_period_year.'-'.$previous_period_month.'-1';
                $last_month_end = $previous_period_year.'-'.$previous_period_month.'-'.$days_in_last_month;

                //Check if there are any items
                $previous_item_count = $customer->statementItems()
                ->whereBetween(DB::raw('DATE(date)'), [$last_month_start, $last_month_end])
                ->count();
            }

            if($previous_period && $previous_item_count){
                //The last month has items for this customer
                //Pick the closing balance
                //This months opening balance being the last months closing balance i.e., (last entry) when ordered in descending sequence.
                $last_months_final_entry = $customer->statementItems()
                ->whereBetween(DB::raw('DATE(date)'), [$last_month_start, $last_month_end])
                ->orderBy('date','DESC')
                ->first();

                $opening_balance = $last_months_final_entry->balance;
            }else{
                //No records in last month too.
                //Set balance to current customer balance.
                $opening_balance = $customer->getLastBalance();
            }

            //Ensure not null
            $opening_balance = $opening_balance ?? 0;

            //Work out closing balance since you now have an opening balance.
            //Since there's no transactions, then its the same as the opening balance.
            $closing_balance = $opening_balance;
        }

        //Work out total due before deductions
        $sub_total = $opening_balance + $total_invoiced;

        $data = [
            'opening_balance'   =>  $opening_balance,
            'total_invoiced'    =>  $total_invoiced,
            'sub_total'         =>  $sub_total,
            'total_paid'        =>  $total_paid,
            'closing_balance'   =>  $closing_balance,
        ];

        return $data;

    }

}
