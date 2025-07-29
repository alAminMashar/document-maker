<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use App\Http\Livewire\Auth\Traits\QuoteTrait;

class Login extends Component
{

    use QuoteTrait;

    public $email, $password;

    /**
     * List of add/edit form rules
     */
    protected $rules =
    [
        'email'      => 'required|email',
        'password'   => 'required'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields()
    {
        $this->email      = '';
        $this->password   = '';
    }

    public function mount()
    {
        $this->clearSessionCache();
        $this->loadQuotes();
    }

    public function render()
    {

        if(config('app.suspended')){
            return view('livewire.auth.suspended')
            ->extends('layouts.minimal')
            ->section('content');
        }else{
            return view('livewire.auth.login')
            ->extends('layouts.auth')
            ->section('content');
        }

    }

    public function login(){

        $this->validate();

        try {

            //Login Logic
            $credentials = [
                'email'     => $this->email,
                'password'  => $this->password
            ];

            if (Auth::attempt($credentials)) {

                $this->resetFields();
                redirect()->intended('/');

                $this->dispatchBrowserEvent('alert',[
                    "type"      =>  "success",
                    "message"   =>  "Login was successful. Welcome back!"
                ]);

            }else{

                $this->password = '';
                 $this->dispatchBrowserEvent("alert",[
                    "type"      =>  "error",
                    "message"   =>  "Oops! Credentials dont match"
                ]);

            }


        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent("alert",[
                "type"      =>  "error",
                "message"   =>  "Something went wrong!"
            ]);

        }
    }

}
