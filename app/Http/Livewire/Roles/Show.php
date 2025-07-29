<?php

namespace App\Http\Livewire\Roles;

use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Livewire\Component;

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

    *--------_--------------------------------------*/

    public $updateRole = false;
    public $role, $roleId, $permissions;
    public $name, $selected_permission = [];

    protected $rules = [
        'name'                  =>  'required',
        'selected_permission'   =>  'required',
    ];

     /**
     * remove action listener
     */
    protected $listeners = [
        'removePermissionListner'=>'removePermission'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function mount(Role $role){
        $this->role     =   $role;
        $this->roleId   =   $role->id;
        $this->permissions = Permission::orderBy('name','ASC')->get();
    }

    public function render()
    {

        $this->selected_permission = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$this->roleId)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        $rolePermissions = $this->role->permissions()
        ->where('name','like','%'.$this->search.'%')
        ->orderBy('name','ASC')
        ->paginate(config('app.paginate'));

        return view('livewire.roles.show',
        [
            'rolePermissions'  =>  $rolePermissions
        ])
        ->extends('layouts.app')
        ->section('content');

    }

     /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields(){
        $this->name                 =   '';
        $this->selected_permission  =   [];
    }

    /**
     * show existing Role data in edit Role form
     * @param mixed $id
     * @return void
     */
    public function editRole($id){
        try {

            $role = Role::findOrFail($id);
            if( !$role) {

                $this->dispatchBrowserEvent('alert',[
                    'type'      =>  'error',
                    'message'   =>  'Role item not found'
                ]);

            } else {
                $this->name                 = $role->name;
                // $this->selected_permission  = $role->permissions->pluck('id')->toArray();
                $this->roleId               = $role->id;
                $this->updateRole           = true;
                $this->addRole              = false;
            }

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'error',
                'message'   =>  'Something went wrong!'
            ]);

        }

    }

     /**
     * Update the specified resource in storage.
     *
     */
    public function updateRole()
    {

        $role = $this->role;

        $validated = $this->validate([
            'name'      =>  'required|unique:roles,name,'.$this->roleId,
        ]);

        $this->role->update([
            'name'  =>  $this->name
        ]);

        $pass = $this->role->syncPermissions($this->selected_permission);

        if($pass){
            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'success',
                'message'   =>  'Permissions successfully updated on Role.'
            ]);
        }else{
            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'error',
                'message'   =>  'Something went wrong!'
            ]);
        }


        $this->updateRole = false;
        $this->resetFields();
    }

       /**
     * Cancel Add/Edit form and redirect to Role listing page
     * @return void
     */
    public function cancelRole()
    {
        $this->updateRole = false;
        $this->resetFields();
    }

    public function removePermission($id)
    {

        // dd('here');

        try {

            $perm = Permission::findOrFail($id);
            $perm->removeRole($this->role);

            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'success',
                'message'   =>  'Permission was successfully removed from this role'
            ]);

        } catch (\Throwable $th) {

            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'success',
                'message'   =>  'Opps! Something went wrong'
            ]);

       }

    }

}
