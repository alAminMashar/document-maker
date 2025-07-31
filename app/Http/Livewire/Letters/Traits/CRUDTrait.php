<?php

namespace App\Http\Livewire\Letters\Traits;
use App\Models\Letter;
use App\Jobs\SystemUpdates;
use Auth;

trait CRUDTrait{

    /**
      * store the Letter inputted Letter data in the Letters table
      * @return void
      */
    public function storeLetter()
    {
        $validated = $this->validate($this->rules);

        try {

            Letter::create($validated);

            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"The Letter was successfully created!"
            ]);

            $this->resetFields();
            $this->addLetter = false;

        } catch (\Exception $ex) {
            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"$ex Something went wrong! We could not add the Letter."
            ]);
        }
    }

    /**
     * show existing Letter data in edit Letter form
     * @param mixed $id
     * @return void
     */
    public function editLetter(Letter $letter){
        try {
            $this->letterID             = $letter->id;
            $this->serial_number        = $letter->serial_number;
            $this->title                = $letter->title;
            $this->content              = $letter->content;
            $this->published            = $letter->published;
            $this->signature_option_id  = $letter->signature_option_id;
            $this->published_at         = $letter->published_at;
            $this->published_by         = $letter->published_by;
            $this->created_by           = $letter->created_by;
            $this->updateLetter         = true;
            $this->addLetter            = false;

        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Oops! Something went wrong!"
            ]);
        }

    }


    /**
     * update the Letter data
     * @return void
     */
    public function updateLetter(Letter $letter)
    {

        $validated = $this->validate([
            'serial_number'         =>  'required|unique:letters,serial_number,'.$letter->id,
            'title'                 =>  'required|unique:letters,title,'.$letter->id,
            'content'               =>  'required|min:10',
            'signature_option_id'   =>  'required',
            'published'             =>  'required|boolean',
            'published_at'          =>  'nullable|date',
            'published_by'          =>  'nullable|exists:users,id',
            'created_by'            =>  'nullable|exists:users,id',
        ]);

        try {


            $letter->update($validated);

            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'success',
                'message'   =>  'Letter Updated Successfully!'
            ]);

            $this->resetFields();
            $this->updateLetter = false;

        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'error',
                'message'   =>  'Something went wrong!'
            ]);
        }
    }


    public function addDocument()
    {
        $this->resetFields();
        $this->cancelLetter();
        $this->addDocument = true;
    }

     /**
     * delete specific Letter data from the Letters table
     * @param mixed $id
     * @return void
     */
    public function deleteLetter(Letter $letter)
    {

        if($letter->isDeletable()){
            try{

                if($response){
                    $letter->delete();
                }

                $this->dispatchBrowserEvent('alert',[
                    'type'=>'success',
                    'message'=>"Letter Deleted Successfully!"
                ]);

            }catch(\Exception $e){
                $this->dispatchBrowserEvent('alert',[
                    'type'=>'error',
                    'message'=>"Something went wrong!"
                ]);
            }

        }else{
            $this->dispatchBrowserEvent('alert',[
                    'type'=>'error',
                    'message'=>"This Letter has related records and isn't deletable"
            ]);
        }
    }


}
