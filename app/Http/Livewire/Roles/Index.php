<?php

namespace App\Http\Livewire\Roles;

use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

use Livewire\Component;
class Index extends Component
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

    public $roleId, $permissions;
    public $name, $selected_permission = [], $rolePermissions;
    public $updateRole = false, $addRole = false;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteRoleListner'=>'deleteRole'
    ];

     /**
     * List of add/edit form rules
     */
    protected $rules = [
        'name'          =>  'required|unique:roles'
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
        $this->name           = '';
        $this->selected_permission  =   [];
    }

    public function mount()
    {
        $this->permissions = Permission::orderBy('name','ASC')->get();
    }

    public function render()
    {

        $roles = Role::where('name','like','%'.$this->search.'%')
        ->where('name','<>','Super Admin')
        ->orderBy('name','ASC')
        ->paginate(config('app.paginate'));

        return view('livewire.roles.index',['roles'=>$roles])
        ->extends('layouts.app')
        ->section('content');

    }

    /**
     * Open Add Role form
     * @return void
     */
    public function addRole()
    {
        $this->resetFields();
        $this->addRole = true;
        $this->updateRole = false;
    }

    /**
      * store the Role inputted Role data in the roles table
      * @return void
      */
    public function storeRole()
    {
        $validated = $this->validate();

        try {

            $role = Role::create([
                  'name'  => $this->name,
            ]);

            $role->syncPermissions($this->selected_permission);

            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'success',
                'message'   =>  'Role Created Successfully!'
            ]);

            $this->resetFields();
            $this->addRole = false;

            return redirect()
            ->route('role.show',['role'=>$role]);

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'error',
                'message'   =>  'Something went wrong! We could not add the role.'
            ]);

        }
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
                //Existing Permissions
                $this->selected_permission = DB::table("role_has_permissions")
                ->where("role_has_permissions.role_id",$id)
                ->pluck('role_has_permissions.permission_id',
                'role_has_permissions.permission_id')
                ->all();

                $this->name                 = $role->name;
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
     * update the Role data
     * @return void
     */
    public function updateRole()
    {

        $validated = $this->validate([
            'name'  =>  'required|unique:roles,name,'.$this->roleId,
        ]);

        try {

            Role::whereId($this->roleId)->update([
                  'name'  => $this->name,
            ]);

            $role = Role::findOrFail($this->roleId);
            $role->syncPermissions($this->selected_permission);

            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'success',
                'message'   =>  'Role Updated Successfully!'
            ]);

            $this->updateRole = false;
            $this->resetFields();

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'error',
                'message'   =>  'Something went wrong!'
            ]);

        }
    }


    /**
     * Cancel Add/Edit form and redirect to Role listing page
     * @return void
     */
    public function cancelRole()
    {
        $this->addRole = false;
        $this->updateRole = false;
        $this->resetFields();
    }


     /**
     * delete specific Role data from the roles table
     * @param mixed $id
     * @return void
     */
    public function deleteRole($id)
    {
        try{

            Role::find($id)->delete();

            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'success',
                'message'   =>  "Role Item Deleted Successfully!"
            ]);

        }catch(\Exception $e){

            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'error',
                'message'   =>  "Something went wrong!"
            ]);

        }
    }
}
