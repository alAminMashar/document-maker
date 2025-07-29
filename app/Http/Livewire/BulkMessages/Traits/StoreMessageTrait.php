<?php

namespace App\Http\Livewire\BulkMessages\Traits;

use App\Models\Message;
use Carbon\Carbon;
use Auth;

trait StoreMessageTrait{

    public  $slug, $title, $body, $send_data, $published, $sent_by;

    public $updateMessage = false, $addMessage = false;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteMessageListner'=>'deleteMessage'
    ];

     /**
     * List of add/edit form rules
     */
    protected $rules = [
        'slug'                 =>  'unique:messages',
        'title'                =>  'required',
        'body'                 =>  'required',
        'send_date'            =>  'required',
        'published'            =>  'required',
        'sent_by'              =>  'required',
    ];

    /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields(){
        $this->slug                 = '';
        $this->title                = '';
        $this->body                 = '';
        $this->send_date            = '';
        $this->published            = false;
        $this->sent_by              = Auth::user()->id;
    }

    public function storeMessage()
    {

        $validated = $this->validate($this->rules);

        try {

            Message::create($validated);

            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"The message was successfully created!"
            ]);

            $this->resetFields();
            $this->addMessage = false;

        } catch (\Exception $ex) {
            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Something went wrong! We could not add the message."
            ]);
        }
    }

     /**
     * show existing Message data in edit Message form
     * @param mixed $id
     * @return void
     */
    public function editMessage(Message $message){
        try {
                $this->slug                 = $message->slug;
                $this->title                = $message->title;
                $this->body                 = $message->body;
                $this->send_date            = $message->send_date;
                $this->published            = $message->published;
                $this->sent_by              = $message->sent_by;
                $this->messageId            = $message->id;
                $this->updateMessage        = true;
                $this->addMessage           = false;

        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Oops! Something went wrong!"
            ]);
        }

    }


    /**
     * update the Message data
     * @return void
     */
    public function updateMessage()
    {

        $validated = $this->validate([
            'name'            =>    'required|unique:messages,slug,'.$this->messageId,
            'title'           =>    'required',
            'body'            =>    'required',
            'send_date'       =>    'required',
            'published'       =>    'numeric',
            'sent_by'         =>    'required',
        ]);

        try {

            Message::whereId($this->messageId)->update($validated);

            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'success',
                'message'   =>  'Message Updated Successfully!'
            ]);

            $this->resetFields();
            $this->updateMessage = false;

        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'error',
                'message'   =>  $ex.'Something went wrong!'
            ]);
        }
    }

}
