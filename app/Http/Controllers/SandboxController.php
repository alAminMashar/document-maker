<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SandboxController extends Controller
{

    public function index()
    {
        $doc_path = 'documents/invoices/2023-June-Lexus AutoMobiles Limited-Customer 2 Guarding Contract.pdf';

        $data = [
            'date'              =>  date('d M Y'),
            'reference'         =>  'INV/2023-MAY/003',
            'inv_name'          =>  'Customer One Sample Invoice',
            'period'            =>  '2023-May',
            'customer_name'     =>  'Customer One',
            'contact_person'    =>  'Jason Statham',
            'email'             =>  'alamin.mashar@gmail.com',
            'attachment'        =>  public_path($doc_path)
        ];

        return view('mail.invoice',['data'  =>  $data]);
    }

}
