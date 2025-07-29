<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Employee;
use App\Models\Task;
use App\Models\TenderItem;
use App\Models\Department;
use App\Models\OperationReport as Report;
use App\Models\CustomerContract as Contract;
use App\Models\PaymentInstallment as Payment;
use App\Models\DocumentType as Type;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\StoreDocumentRequest;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;
use File;

class DocumentsController extends Controller
{

    private function checkDocumentType($id, $title)
    {
        $type = Type::find($id);

        if(!$type){
            $type = Type::create([
                'id'    =>  $id,
                'name'  =>  $title,
                'description'   =>  $title,
            ]);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTaskDocument(StoreDocumentRequest $request)
    {
        //Ensure this document type Id exists
        $this->checkDocumentType(110, 'Task Reports');

        $task = Task::findOrFail($request->documentable_id);
        $description = $task->name;
        $org = 1;
        $slug = $description.'-'.date('Y M d H:m:s');
        $slug = Str::slug(strtolower($slug),'-');

        if($request->hasFile('document') && $request->file('document')->isValid())
        {

            $file = $request->file('document');
            $type = $file->getClientMimeType();
            $size = $file->getSize();
            $save_to = 'documents/timesheets';

            $path = public_path($save_to);
            //Save to Filesystem
            $file_name = $slug.'.'. $request->document->extension();

            // Upload the file
            $file->storePubliclyAs($save_to, $file_name);

            //Storage Path
            $file_path = $save_to.'/'.$file_name;

            Document::upload(
                $slug,
                $request->documentable_id,
                $request->documentable_type,
                110,
                $org,
                $type,
                $size,
                $file_path,
                $description,
            );

        }

        return redirect()->back()
        ->withSuccess(__('Document added successfully.'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTenderDocument(StoreDocumentRequest $request)
    {

        $tender_item = TenderItem::findOrFail($request->documentable_id);
        $doc_type = Type::where('name','like','%tender%')->first();
        $description = $tender_item->tender['reference'];
        $org = 1;
        $slug = $description.'-'.date('Y M d H:m:s');
        $slug = Str::slug(strtolower($slug),'-');

        if($request->hasFile('document') && $request->file('document')->isValid())
        {

            $file = $request->file('document');
            $type = $file->getClientMimeType();
            $size = $file->getSize();
            $save_to = 'documents/tenders';

            $path = public_path($save_to);
            //Save to Filesystem
            $file_name = $slug.'.'. $request->document->extension();

            // Upload the file
            $file->storePubliclyAs($save_to, $file_name);

            //Storage Path
            $file_path = $save_to.'/'.$file_name;

            Document::upload(
                $slug,
                $request->documentable_id,
                $request->documentable_type,
                $doc_type->id,
                $org,
                $type,
                $size,
                $file_path,
                $description,
            );

        }

        return redirect()->back()
        ->withSuccess(__('Document added successfully.'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeContractDocument(StoreDocumentRequest $request)
    {

        $contract = Contract::findOrFail($request->documentable_id);
        $doc_type = Type::where('name','like','%contract%')->first();
        $description = $request->description;
        $org = 1;
        $slug = $contract->name.'-'.$description.'-'.date('Y M d H:m:s');
        $slug = Str::slug(strtolower($slug),'-');

        if($request->hasFile('document') && $request->file('document')->isValid())
        {

            $file = $request->file('document');
            $type = $file->getClientMimeType();
            $size = $file->getSize();
            $save_to = 'documents/contracts';

            $path = public_path($save_to);
            //Save to Filesystem
            $file_name = $slug.'.'. $request->document->extension();

            // Upload the file
            $file->storePubliclyAs($save_to, $file_name);

            //Storage Path
            $file_path = $save_to.'/'.$file_name;

            Document::upload(
                $slug,
                $request->documentable_id,
                $request->documentable_type,
                $doc_type->id,
                $org,
                $type,
                $size,
                $file_path,
                $description,
            );

        }

        return redirect()->back()
        ->withSuccess(__('Document added successfully.'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDepartmentDocument(StoreDocumentRequest $request)
    {

        $department = Department::findOrFail($request->documentable_id);
        $doc_type = Type::where('name','like','%manual%')->first();
        $description = $request->description;
        $org = 0;
        $slug = $department->name.'-'.$description.'-'.date('Y M d H:m:s');
        $slug = Str::slug(strtolower($slug),'-');

        if($request->hasFile('document') && $request->file('document')->isValid())
        {

            $file = $request->file('document');
            $type = $file->getClientMimeType();
            $size = $file->getSize();
            $save_to = 'documents/department';

            $path = public_path($save_to);
            //Save to Filesystem
            $file_name = $slug.'.'. $request->document->extension();

            // Upload the file
            $file->storePubliclyAs($save_to, $file_name);

            //Storage Path
            $file_path = $save_to.'/'.$file_name;

            Document::upload(
                $slug,
                $request->documentable_id,
                $request->documentable_type,
                $doc_type->id,
                $org,
                $type,
                $size,
                $file_path,
                $description,
            );

        }

        return redirect()->back()
        ->withSuccess(__('Document added successfully.'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEmployeeDocument(StoreDocumentRequest $request)
    {

        $employee = Employee::findOrFail($request->documentable_id);
        $doc_type = Type::findOrFail($request->document_type_id);
        $org = $request->original_received == true? 1:0;
        $slug = $employee->name().'-'.$doc_type->name.'-'.date('Y M d H:m:s');
        $slug = Str::slug(strtolower($slug),'-');

        if($request->hasFile('document') && $request->file('document')->isValid())
        {

            $file = $request->file('document');
            $type = $file->getClientMimeType();
            $size = $file->getSize();
            $save_to = 'documents/employee';

            $path = public_path($save_to);
            //Save to Filesystem
            $file_name = $slug.'.'. $request->document->extension();

            // Upload the file
            $file->storePubliclyAs($save_to, $file_name);

            //Storage Path
            $file_path = $save_to.'/'.$file_name;

            Document::upload(
                $slug,
                $request->documentable_id,
                $request->documentable_type,
                $request->document_type_id,
                $org,
                $type,
                $size,
                $file_path,
            );

        }

        return redirect()->back()
        ->withSuccess(__('Document added successfully.'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOccurrenceDocument(StoreDocumentRequest $request)
    {

        $doc_type = Type::where('name','like','%occurrence%')->first();
        $slug = 'Occurrence-'.$request->documentable_id.'-'.$doc_type->name.'-'.date('Y M d H:m:s');
        $slug = Str::slug(strtolower($slug),'-');
        $org = 0;

        if($request->hasFile('document') && $request->file('document')->isValid())
        {

            $fileName = $slug.'.'. $request->document->extension();
            $file = $request->file('document');
            $type = $file->getClientMimeType();
            $size = $file->getSize();

            //Upload the file
            $save_to = 'documents/occurrence-reports';

            $path = public_path($save_to);
            //Save to Filesystem
            $file_name = $slug.'.'. $request->document->extension();

            // Upload the file
            $file->storePubliclyAs($save_to, $file_name);

            //Storage Path
            $file_path = $save_to.'/'.$file_name;

            Document::upload(
                $slug,
                $request->documentable_id,
                $request->documentable_type,
                $doc_type->id,
                $org,
                $type,
                $size,
                $file_path,
            );

        }

        return redirect()->back()
        ->withSuccess(__('Document added successfully.'));

    }

    public function storePaymentDocument(StoreDocumentRequest $request)
    {
        $doc_type = Type::where('name','like','%'.$request->document_type.'%')->first();
        $payment = Payment::findOrFail($request->documentable_id);
        $slug = $payment->reference.' Payment-'.'-'.$doc_type->name.'-'.date('Y M d H:m:s');
        $slug = Str::slug(strtolower($slug),'-');
        $org = 0;

        if($request->hasFile('document') && $request->file('document')->isValid())
        {

            $file = $request->file('document');
            $type = $file->getClientMimeType();
            $size = $file->getSize();

            //Upload the file
            $save_to = 'documents/payments';

            $path = public_path($save_to);
            //Save to Filesystem
            $file_name = $slug.'.'. $request->document->extension();

            // Upload the file
            $file->storePubliclyAs($save_to, $file_name);

            //Storage Path
            $file_path = $save_to.'/'.$file_name;

            Document::upload(
                $slug,
                $request->documentable_id,
                $request->documentable_type,
                $doc_type->id,
                $org,
                $type,
                $size,
                $file_path,
            );
        }

        return redirect()->back()
        ->withSuccess(__('Document added successfully.'));

    }

    public function downloadDocument($doc)
    {
        $doc = Document::findOrFail($doc);
        // return Storage::url($doc->file_name);
        return Storage::download($doc->file_name);
    }


    public function deleteDocument($doc)
    {

        $doc = Document::findOrFail($doc);

        $filepath = $doc->file_name;

        if(File::exists($filepath)){
            File::delete($filepath);
        }

        $doc->delete();

        return redirect()->back();

    }

}
