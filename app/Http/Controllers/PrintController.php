<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use Dompdf\Options;
//File & Storage Management
use Illuminate\Http\UploadedFile;
use App\Http\Requests\StoreDocumentRequest;

use App\Models\CompanyAccount
 as Account;
 use App\Models\CustomerContract as Contract;
use App\Models\PaymentOption as Option;
use App\Models\CustomerInvoice as Invoice;
use App\Models\CreditNote as Note;
use App\Models\PayrollPriority as Priority;
use App\Models\FinancialPeriod as Period;
use App\Models\PaySlip as Payslip;
use App\Models\AuditTrail as Audit;
use App\Models\MonthlyBill as Bill;

use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Payroll;
use App\Models\User as User;
use Illuminate\Support\Str;


class PrintController extends Controller
{

    public $letterhead, $stamp, $logo;

    public function __construct()
    {
        // Encode the image to base64
        $letterheadPath = public_path('assets/images/letterhead/top.jpg');
        $letterheadData = base64_encode(file_get_contents($letterheadPath));
        $this->letterhead = 'data:image/png;base64,' . $letterheadData;

        $stampPath = public_path('assets/images/stamps/stamp.png');
        $stampData = base64_encode(file_get_contents($stampPath));
        $this->stamp = 'data:image/png;base64,' . $stampData;
    }


    public function printAssignmentQR(Contract $contract)
    {

        $stations = $contract->patrolStations()->get();

        $pdf = PDF::loadView('livewire.customer-contracts.exportables.qr-bootstraped',['stations'=>$stations]);

        $file_name = ucwords(date('Y M d ').$contract->name.' patrol QR codes').'.pdf';

        return $pdf->download($file_name);

        // return view('livewire.customer-contracts.exportables.qr-bootstraped',['stations'=>$stations]);

    }

    public function printInvoice(Invoice $invoice)
    {
        $account = Account::whereDefault(1)->first();
        $options = Option::all();

        // Encode the image to base64
        $letterheadPath = public_path('assets/images/letterhead/top.jpg');
        $letterheadData = base64_encode(file_get_contents($letterheadPath));
        $letterhead = 'data:image/png;base64,' . $letterheadData;

        $stampPath = public_path('assets/images/stamps/stamp.png');
        $stampData = base64_encode(file_get_contents($stampPath));
        $stamp = 'data:image/png;base64,' . $stampData;

        $pdf = PDF::loadView('livewire.customer-invoice.print-view', [
            'invoice'    => $invoice,
            'account'    => $account,
            'options'    => $options,
            'letterhead' => $this->letterhead,
            'stamp'      => $this->stamp
        ]);

        $file_name = ucwords(str_replace("-", " ", "Invoice -" . $invoice->slug)) . '.pdf';

        return $pdf->download($file_name);
    }



    public function printInvoiceOld(Invoice $invoice)
    {

        $account = Account::whereDefault(1)->first();

        $options = Option::all();

        $pdf = PDF::loadView('livewire.customer-invoice.print-view',['invoice'=>$invoice,'account'=>$account, 'options'=>$options]);

        $file_name = ucwords(str_replace("-"," ","Invoice -".$invoice->slug)).'.pdf';

        return $pdf->download($file_name);

        // return view('livewire.customer-invoice.print-view',['invoice'=>$invoice,'account'=>$account, 'options'=>$options]);

    }


    public function printCreditNote(Note $note)
    {


        // $options = new Options();
        // $options->set('isRemoteEnabled', true);
        // $dompdf = new Dompdf($options);
        $pdf = PDF::loadView('livewire.credit-note.printables.index',['note'=>$note, 'letterhead'=> $this->letterhead,'stamp' => $this->stamp]);
        $file_name = ucwords(str_replace("-"," ","Credit Note -".$note->slug)).'.pdf';
        return $pdf->download($file_name);

        // return view('livewire.credit-note.printables.index',['note'=>$note]);

    }



    public function printCustomerInvoices(Customer $customer, $period = null)
    {

        if($period != null){
            $period = Period::where('slug','like','%'.$period.'%')->first();
        }else{
            $period = Period::where('slug','like','%'.date('Y-M').'%')->first();
        }

        //Current period's bill
        $bill = Bill::whereSlug($period->slug)->first();

        //Fetch payment options
        $options = Option::all();

        //Fetch company account
        $account = Account::whereDefault(1)->first();

        $invoices = $customer->invoices()->whereFinancialPeriodId($period->id)->get();

        $prefix = $customer->customerNumber();

        $invoice_number = $prefix.'-'.$period['year'].'-'.$period->getMonthNumber($period['month']);

        $title = ucwords("Summary Billing For Period ".$period['year'].' '.$period['month']);

        $pdf = PDF::loadView('livewire.customer.print-view',['bill' => $bill,'customer'=>$customer, 'title'=>$title, 'invoices'=>$invoices,'account'=>$account, 'options' => $options, 'invoice_number'=>$invoice_number, 'letterhead'=> $this->letterhead,'stamp' => $this->stamp]);

        $file_name = $invoice_number." ".$title." ".$customer->name.'.pdf';

        return $pdf->download($file_name);

        //  return view('livewire.customer.print-view',['bill' => $bill,'customer'=>$customer, 'title'=>$title, 'invoices'=>$invoices,'account'=>$account, 'options' => $options, 'invoice_number'=>$invoice_number, 'letterhead'=> $this->letterhead,'stamp' => $this->stamp]);

    }



    public function printCustomerStatement(Customer $customer)
    {

        $account = Account::where('default','=',1)->first();

        $options = Option::all();

        $title = 'STATEMENT OF ACCOUNT';

        $statementItems = $customer->statementItems()
        ->orderBy('date','ASC')
        ->get();

        $pdf = PDF::loadView('livewire.customer.print-view',['account'=>$account,'customer'=>$customer,'statementItems'=>$statementItems,'title'=>$title, 'options'=>$options, 'letterhead'=> $this->letterhead,'stamp' => $this->stamp]);

        $file_name = Carbon::now().'-'.$customer->name.' statement of account.pdf';
        return $pdf->download($file_name);

        // return view('livewire.customer.print-view',['account'=>$account,'customer'=>$customer,'statementItems'=>$statementItems, 'letterhead'=> $this->letterhead,'stamp' => $this->stamp]);
    }



    public function printSupplierStatement(Supplier $supplier)
    {

        $title = 'SUPPLIER STATEMENT OF ACCOUNT';

        $statementItems = $supplier->statementItems()
        ->orderBy('date','ASC')
        ->get();


        $pdf = PDF::loadView('livewire.supplier.print-view',['supplier'=>$supplier,'statementItems'=>$statementItems,'title'=>$title, 'letterhead'=> $this->letterhead,'stamp' => $this->stamp]);

        $file_name = Carbon::now().'- '.$supplier->name.' supplier statement of account.pdf';
        return $pdf->download($file_name);

        // return view('livewire.supplier.print-view',['supplier'=>$supplier,'statementItems'=>$statementItems, 'letterhead'=> $this->letterhead,'stamp' => $this->stamp]);
    }

    public function printPayroll(Payroll $payroll, $priority = null)
    {

        if($priority == null){
            $payslips = $payroll->payslips()->orderBy('slug','ASC')->get();
        }else{
            $payslips = $payroll->payslips()->where('payroll_priority_id','=',$priority)->orderBy('slug','ASC')->get();
        }

        $pdf = PDF::loadView('livewire.pay-roll.print-view',['priority'=>$priority,'payroll'=>$payroll,'payslips'=>$payslips])->setPaper('a4', 'landscape');

        $file_name = $payroll->slug.'-payroll.pdf';
        return $pdf->download($file_name);

    }

    public function printFullPayroll(Payroll $payroll)
    {
        $payslips = $payroll->payslips()->orderBy('slug','ASC')
        ->paginate(100);
        // ->get();
        $pdf = PDF::loadView('livewire.payslip.print-view',['payslips'=>$payslips]);
        $file_name = $payroll->slug.'-full-payroll.pdf';
        return $pdf->setPaper('a4', 'potrait')->download($file_name);
        //  return view('livewire.payslip.print-view',['payslips'=>$payslips]);
    }

    public function printPayslip(Payslip $payslip)
    {
        $pdf = PDF::loadView('livewire.payslip.print-view',['payslip'=>$payslip,'letterhead'=> $this->letterhead,'stamp' => $this->stamp]);
        $file_name = $payslip->slug.'-payslip.pdf';
        return $pdf->setPaper('a4', 'portrait')->download($file_name);
        // return view('livewire.payslip.print-view',['payslip'=>$payslip,'letterhead'=> $this->letterhead,'stamp' => $this->stamp]);
    }

    public function printAuditLog(User $user = null)
    {
        if($user != null){
            $logs = $user->logs()->paginate(config('app.paginate'));
            $file_name = $user->name."'s Audit Logs ".date('Y-m-d H:i:s').'.pdf';
        }else{
            $logs = Audit::orderBy('created_at','DESC')->paginate(500);
             $file_name = 'System Audit Logs '.date('Y-m-d H:i:s').'.pdf';
        }

        $pdf = PDF::loadView('livewire.activity-logs.print-view',['logs'=>$logs]);
        return $pdf->download($file_name);
        // return view('livewire.activity-logs.print-view',['logs'=>$logs]);
    }

}
