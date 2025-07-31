<?php

namespace app\Http\Livewire\Letters\Traits;

trait FormSetupTrait{

    public $letterID, $serial_number, $signature_option_id, $title, $content = '', $published = false, $published_at, $published_by, $created_by;

    public $updateLetter = false, $addLetter = false;

    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'serial_number'         =>  'required|unique:letters,serial_number',
        'title'                 =>  'required|unique:letters,title',
        'content'               =>  'required|min:10',
        'signature_option_id'   =>  'required',
        'published'             =>  'required|boolean',
        'published_at'          =>  'nullable|date',
        'published_by'          =>  'nullable|exists:users,id',
        'created_by'            =>  'nullable|exists:users,id',
    ];

    public function resetFields()
    {
        $this->letterID             = '';
        $this->serial_number        = '';
        $this->title                = '';
        $this->content              = '';
        $this->published            = false;
        $this->signature_option_id  = '';
        $this->published_at         = '';
        $this->published_by         = $this->current_user['id'];
        $this->created_by           = $this->current_user['id'];
    }

    /**
     * Open Add Letter form
     * @return void
     */
    public function addLetter()
    {
        $this->dispatchBrowserEvent('showEditor'); // triggers JS init
        $this->emit('openModal');
        $this->cancelLetter();
        $this->addLetter = true;
    }

    /**
     * Cancel Add/Edit form and redirect to Letter listing page
     * @return void
     */
    public function cancelLetter()
    {
        $this->dispatchBrowserEvent('hideEditor'); // triggers JS init
        $this->addLetter = false;
        $this->updateLetter = false;
        $this->resetFields();
    }

}
