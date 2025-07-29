<?php

namespace App\Http\Livewire\User;

use Hash;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User as Users;
// use App\Models\Role as Roles;
use Spatie\Permission\Models\Role as Roles;
use App\Models\Department as Departments;
use App\Models\CustomerContract as Contract;

use Spatie\Permission\Models\Role;
use Auth;

class Show extends Component
{
     /*-----------------------------------------------

        Search Stuff and Pagination

     *----------------------------------------------*/

    use WithPagination;
    // use Livewire\WithPagination; add this to top

    public $search = '';

    public function updateSearch(){
        $this->resetPage();
    }

    protected $paginationTheme = 'bootstrap';

     /*-----------------------------------------------

        End of Search Stuff and Pagination

     *----------------------------------------------*/


    public $roles, $userId, $addUser = false, $updateProfile = false, $updateUser = false, $updatePassword = false, $importUsers = false;

    public $name, $email, $phone, $selected_roles = [], $password, $password_confirm, $document, $active = true;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteUserListner'=>'deleteUser'
    ];

    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'name'                  => 'required|min:6',
        'phone'                 => 'required|unique:users|min:10|max:12',
        'email'                 => 'required|unique:users|email',
        'selected_roles'        => 'required',
        'password'              => 'required|min:6',
        'password_confirm'      => 'required|min:6|same:password',
        'active'                => 'boolean',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields(){
        $this->name                 = '';
        $this->phone                = '';
        $this->email                = '';
        $this->selected_roles       = [];
        $this->password             = '';
        $this->password_confirm     = '';
        $this->document             = '';
        $this->active               = true;
    }

    public function mount()
    {
        $this->roles = Roles::where('name','<>','Super Admin')
        ->orderBy('name','ASC')
        ->get();
    }

    /**
     * render the user data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {

        if(Auth::user()->can('users.store')){
            $users = Users::where('name','like','%'.$this->search.'%')
            ->orWhere('phone','like','%'.$this->search.'%')
            ->orWhere('email','like','%'.$this->search.'%')
            ->orderBy('active','DESC')
            ->orderBy('name','ASC')
            ->paginate(config('app.paginate'));
        }else{
            $users = null;
        }

        return view('livewire.user.show',['users'=>$users])
        ->extends('layouts.app')
        ->section('content');

    }

    /**
     * Open Add user form
     * @return void
     */
    public function addUser()
    {
        $this->resetFields();
        $this->addUser = true;
        $this->updateUser = false;
    }


    /**
      * store the user inputted User data in the Users table
      * @return void
      */
    public function storeUser()
    {

        $this->validate();

        try {

           $user =  Users::create([
                'name'                  => $this->name,
                'email'                 => $this->email,
                'phone'                 => $this->phone,
                'password'              => $this->password,
                'active'                => $this->active,
            ]);

            //assigning role to the created user
            $role = Role::findOrFail($this->selected_roles);
            $user->assignRole($role);

             $this->dispatchBrowserEvent('alert',[
                'type'      => 'success',
                'message'   =>  'User Created Successfully!'
            ]);

            $this->resetFields();
            $this->addUser = false;

        } catch (\Exception $ex) {
             $this->dispatchBrowserEvent('alert',[
                'type'      => 'error',
                'message'   =>  'Something went wrong! We could not add the user.'
            ]);
        }
    }

    /**
     * show existing User data in edit User form
     * @param mixed $id
     * @return void
     */
    public function editUser($id){
        try {

            $user = Users::findOrFail($id);
            if( !$user) {
                 $this->dispatchBrowserEvent('alert',[
                'type'      => 'error',
                'message'   =>  'User not found'
            ]);
            } else {

                // $this->selected_roles   = $user->selected_roles;
                foreach ($user->roles as $role) {
                    $this->selected_roles[] = $role->id;
                }

                $this->name                 = $user->name;
                $this->email                = $user->email;
                $this->phone                = $user->phone;
                $this->active               = $user->active;
                $this->userId               = $user->id;
                $this->updateUser           = true;
                $this->addUser              = false;
            }
        } catch (\Exception $ex) {
             $this->dispatchBrowserEvent('alert',[
                'type'      => 'error',
                'message'   =>  'Something went wrong!'
            ]);
        }

    }

    /**
     * update the User data
     * @return void
     */
    public function updateUser()
    {

        $this->validate([
            'name'                  => 'required|min:6',
            'phone'                 => 'required|min:10|max:12|unique:users,phone,'.$this->userId,
            'email'                 => 'required|email|unique:users,email,'.$this->userId,
            'active'                => 'boolean',
        ]);

        try {

            Users::whereId($this->userId)->update([
                'name'                  =>  $this->name,
                'email'                 =>  $this->email,
                'phone'                 =>  $this->phone,
                'active'                =>  $this->active,
            ]);

            if($this->selected_roles != null)
            {
                $user = Users::findOrFail($this->userId);

                //assigning role to the created user
                if($user){
                    $user->syncRoles($this->selected_roles);
                }

            }

             $this->dispatchBrowserEvent('alert',[
                'type'      => 'success',
                'message'   =>  'User Updated Successfully!'
            ]);

            $this->resetFields();

            $this->updateUser = false;

        } catch (\Exception $ex) {
             $this->dispatchBrowserEvent('alert',[
                'type'      => 'error',
                'message'   =>  'Something went wrong!'
            ]);
        }

    }

    /**
     * Open Add Import Users Form
     * @return void
     */
    public function importUsers()
    {
        $this->resetFields();
        $this->importUsers = true;
    }

    /**
     * Cancel Add/Edit form and redirect to user listing page
     * @return void
     */
    public function cancelUser(){
        $this->addUser = false;
        $this->updateUser = false;
        $this->importUsers = false;
        $this->resetFields();
    }


}
