<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\StoreDocumentRequest;
use Illuminate\Support\Str;

use App\Models\Document;
use App\Models\Candidate;
use App\Models\DocumentType as Type;

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
    
    public function storeCandidatePhoto(StoreDocumentRequest $request)
    {
        $this->checkDocumentType(110, 'Candidate Photo');

        $candidate = Candidate::findOrFail($request->documentable_id);
        $description = $candidate->name;
        $org = 1;
        $slug = Str::slug(strtolower($description.'-'.date('Y M d H:i:s')), '-');

        if ($request->hasFile('document') && $request->file('document')->isValid()) {
            $file = $request->file('document');
            $type = $file->getClientMimeType();
            $size = $file->getSize();

            // Path inside public directory
            $save_to = 'documents/candidates/photos';

            // File name
            $file_name = $slug . '.' . $file->extension();

            // Move file into public folder
            $file->move(public_path($save_to), $file_name);

            // Store the relative path for web usage
            $file_path = $save_to . '/' . $file_name;

            Document::upload(
                $slug,
                $request->documentable_id,
                $request->documentable_type,
                110,
                $org,
                $type,
                $size,
                $file_path, // relative path, not absolute
                $description,
            );
        }

        return redirect()->back()->withSuccess(__('Document added successfully.'));
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
