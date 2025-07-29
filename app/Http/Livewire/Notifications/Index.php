<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Notifications\DatabaseNotification as Notification;
use Carbon\Carbon;
use Auth, DB;

class Index extends Component
{
    /*-----------------------------------------------

        Search Stuff and Pagination

     *----------------------------------------------*/

    use WithPagination;
    // use Livewire\WithPagination; Read this to top

    public $search = '';

    public function updateSearch(){
        $this->resetPage();
    }

    protected $paginationTheme = 'bootstrap';

     /*-----------------------------------------------

        End of Search Stuff and Pagination

     *----------------------------------------------*/

    public $type, $data, $user;

    public $unread_notifications, $read_notifications, $all_notifications;

    public $status = 1;

    public $openNotification = false;



    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteNotificationListner' =>  'deleteNotification',
        'readOneListner'            =>  'readOne',
        'readAllListner'            =>  'readAll',
        'clearAllListener'          =>  'clearAll',
    ];

     /**
     * List of Read/edit form rules
     */
    protected $rules = [
        'search'           => 'min:0'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->user = Auth::user();

        $this->unread_notifications = $this->user->unreadNotifications()->count();

        $this->read_notifications = $this->user->readNotifications()->count();

        $this->all_notifications = $this->user->notifications()->count();
    }

    public function render()
    {

        if($this->status == 1){
            $notifications = $this->user->unreadNotifications()
            ->where('data','like','%'.$this->search.'%')
            ->paginate(config('app.paginate'));
        }elseif($this->status == 2){
            $notifications = $this->user->readNotifications()
            ->where('data','like','%'.$this->search.'%')
            ->paginate(config('app.paginate'));
        }else{
            $notifications = $this->user->notifications()
            ->where('data','like','%'.$this->search.'%')
            ->paginate(config('app.paginate'));
        }

        return view('livewire.notifications.index',['notifications'=>$notifications])
        ->extends('layouts.app')
        ->section('content');

    }

    public function statusFilter($status){
        $this->status = $status;
    }


    public function showNotification($notification)
    {
        try {

            $this->type = $notification['type'];
            $this->data = $notification['data'];

            $this->openNotification = true;
            // $this->readNotification($notification);

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   => 'Oops! Could not open notification'
            ]);

        }

    }

    public function readOne($notification){

        try{

           $notification = $this->user->notifications()
        ->where('id','=',$notification)->first();
           $notification->markAsRead();

           $this->dispatchBrowserEvent('alert',[
                  "type"      => "success",
                  "message"   => "Marked as read!"
            ]);

       }catch(\Exception $ex){
           $this->dispatchBrowserEvent('alert',[
                  "type"      =>  "error",
                  "message"   => "Oops! Could not open notification"
            ]);
       }
    }

    public function unreadOne($notification){

        try{

           $notification = $this->user->notifications()
            ->where('id','=',$notification)->first();
           $notification->markAsUnread();

           $this->dispatchBrowserEvent('alert',[
                  "type"      => "success",
                  "message"   => "Marked as unread!"
            ]);

       }catch(\Exception $ex){
           $this->dispatchBrowserEvent('alert',[
                  "type"      =>  "error",
                  "message"   => "Oops! Could not open notification"
            ]);
       }
    }

    /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields(){
        $this->search      = '';
        $this->notification_type = '';
        $this->notification_data = '';
    }

    /**
     * Cancel Read/Edit form and redirect to notification listing page
     * @return void
     */
    public function cancelNotification()
    {
        $this->openNotification = false;
        $this->resetFields();
    }

    public function readAll()
    {
        try{

         $this->user->unreadNotifications()->update(['read_at' => now()]);

           $this->dispatchBrowserEvent('alert',[
                  "type"      => "success",
                  "message"   => "Marked all as read!"
            ]);

       }catch(\Exception $ex){
           $this->dispatchBrowserEvent('alert',[
                  "type"      =>  "error",
                  "message"   => "Oops! Something went wrong."
            ]);
       }

    }

    public function clearAll()
    {
        $this->user->notifications()->delete();
    }


}
