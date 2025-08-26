<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

//File & Storage Management
use Illuminate\Http\UploadedFile;
use App\Http\Requests\StoreDocumentRequest;

use App\Models\AuditTrail as Audit;
use App\Models\Letter;
use App\Models\User as User;
use Illuminate\Support\Str;


class PrintController extends Controller
{

    public $letterhead, $stamp, $logo;

    public function __construct()
    {
        // Encode the image to base64
        $signaturePath = public_path('assets/images/signature/main.png');
        $signatureData = base64_encode(file_get_contents($signaturePath));
        $this->signature = 'data:image/png;base64,' . $signatureData;

        $letterheadPath = public_path('assets/images/letterhead/top.jpg');
        $letterheadData = base64_encode(file_get_contents($letterheadPath));
        $this->letterhead = 'data:image/png;base64,' . $letterheadData;

        $footerPath = public_path('assets/images/letterhead/bottom.png');
        $footerData = base64_encode(file_get_contents($footerPath));
        $this->footer = 'data:image/png;base64,' . $footerData;
    }


    public function makeQRCodeData(Letter $letter)
    {
        $route = route('letter.verify', ['letter' => $letter->serial_number]);

        return \QrCode::format('png')
            ->size(300)
            ->margin(1)
            ->errorCorrection('M')
            ->generate($route);
    }

    public function downloadLetter(Letter $letter)
    {

        $qrBinaryData = $this->makeQRCodeData($letter);
        $qr_code = 'data:image/png;base64,' . base64_encode($qrBinaryData);

        $pdf = PDF::loadView('livewire.letters.printout.index', [
            'letter'        => $letter,
            'letterhead'    => $this->letterhead,
            'footer'        => $this->footer,
            'signature'     => $this->signature,
            'qr_code'       => $qr_code
        ]);

        $file_name = ucwords($letter->serial_number) . '.pdf';
        // return $pdf->download($file_name);
        // return $pdf->stream($file_name);
        return response($pdf->output(), 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="letter.pdf"');

        return view('livewire.letters.printout.index',[
            'letter'        => $letter,
            'letterhead'    => $this->letterhead,
            'footer'        => $this->footer,
            'signature'     => $this->signature,
            'qr_code'       => $qr_code
        ]);

    }

    public function verifyLetter($serial_number)
    {

        $letter = Letter::where('serial_number','=',$serial_number)->first();

        if($letter){
            $qrBinaryData = $this->makeQRCodeData($letter);
            $qr_code = 'data:image/png;base64,' . base64_encode($qrBinaryData);

            $pdf = PDF::loadView('livewire.letters.printout.index', [
                'letter'        => $letter,
                'letterhead'    => $this->letterhead,
                'footer'        => $this->footer,
                'signature'     => $this->signature,
                'qr_code'       => $qr_code
            ]);

            $file_name = ucwords($letter->serial_number) . '.pdf';
            return $pdf->stream($file_name);

        }else{
            return redirect()->away('https://www.google.com');
        }

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
