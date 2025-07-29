<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Auth;

class Profile extends Component
{

    public $user, $name, $email, $phone, $password, $password_confirm;

    public $addUser = false, $updateUser = false, $updateProfile = false, $updatePassword = false;

    protected $rules = [
        'name'      =>  'required|min:6',
        'email'     =>  'required',
        'phone'     =>  'required',
    ];

    protected $password_rules = [
        'password'          =>  'required|min:6',
        'password_confirm'  =>  'required|same:password',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        if(Auth::user()->id == $this->user['id']||Auth::user()->can('users.delete')){
            return view('livewire.user.profile')
            ->extends('layouts.app')
            ->section('content');
        }else{
            echo "You are not authorized to view this page";
        }
    }

     /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields(){
        $this->name             = '';
        $this->phone            = '';
        $this->email            = '';
        $this->password         = '';
        $this->password_confirm = '';
    }

    public function updatePassword()
    {
        $this->resetFields();
        $this->updateProfile = false;
        $this->updatePassword = true;
    }

    public function touchPassword()
    {

        $this->validate($this->password_rules);

        try {
            $this->user->update([
                'password' => $this->password,
            ]);

             $this->dispatchBrowserEvent('alert',[
                'type'      => 'success',
                'message'   =>  'Password Updated Successfully!'
            ]);

            $this->resetFields();
            $this->updatePassword = false;

        } catch (\Exception $ex) {
             $this->dispatchBrowserEvent('alert',[
                'type'      => 'error',
                'message'   =>  'Something went wrong!'
            ]);
        }

    }

    public function editUser()
    {
        $this->name     = $this->user->name;
        $this->phone    = $this->user->phone;
        $this->email    = $this->user->email;
        $this->updateProfile = true;
        $this->updatePassword = false;
    }

    public function updateUser()
    {

        $this->validate([
            'name'              => 'required|min:6',
            'phone'             => 'required|min:10|max:12|unique:users,phone,'.$this->user->id,
            'email'             => 'required|email|unique:users,email,'.$this->user->id
        ]);

        try {

            $this->user->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone
            ]);

             $this->dispatchBrowserEvent('alert',[
                'type'      => 'success',
                'message'   =>  'User Updated Successfully!'
            ]);

            $this->resetFields();
            $this->updateProfile = false;

        } catch (\Exception $ex) {
             $this->dispatchBrowserEvent('alert',[
                'type'      => 'error',
                'message'   =>  'Something went wrong!'
            ]);
        }

    }




    /**
     * Cancel Add/Edit form and redirect to user listing page
     * @return void
     */
    public function cancelUser()
    {
        $this->updateProfile = false;
        $this->updatePassword = false;
        $this->resetFields();
    }

}
