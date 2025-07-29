<?php

namespace App\Http\Livewire\Permissions;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

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

    public $permissionId;

    public $name;

    public $updatePermission = false, $addPermission = false;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deletePermissionListner'=>'deletePermission'
    ];

     /**
     * List of add/edit form rules
     */
    protected $rules = [
        'name'  => 'required|unique:permissions'
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
        $this->name      = '';
    }

    public function render()
    {

        $permissions = Permission::where('name','like','%'.$this->search.'%')
        ->orderBy('name','ASC')
        ->paginate(config('app.paginate'));

        return view('livewire.permissions.index',['permissions'=>$permissions])
        ->extends('layouts.app')
        ->section('content');

    }

    /**
     * Open Add permission form
     * @return void
     */
    public function addPermission()
    {
        $this->resetFields();
        $this->addPermission = true;
        $this->updatePermission = false;
    }

    /**
      * store the permission inputted permission data in the permissions table
      * @return void
      */
    public function storePermission()
    {
        $validated = $this->validate();

        try {

            Permission::create($validated);

            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'success',
                'message'   =>  'Permission Created Successfully!'
            ]);


            $this->resetFields();
            $this->addPermission = false;

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'error',
                'message'   =>  'Something went wrong! We could not add the permission.'
            ]);

        }
    }

    /**
     * show existing permission data in edit permission form
     * @param mixed $id
     * @return void
     */
    public function editPermission($id){
        try {

            $permission = Permission::findOrFail($id);

            if( !$permission) {

                $this->dispatchBrowserEvent('alert',[
                    'type'      =>  'error',
                    'message'   =>  'Permission item not found'
                ]);

            } else {
                $this->name               = $permission->name;
                $this->permissionId          = $permission->id;
                $this->updatePermission      = true;
                $this->addPermission         = false;
            }

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'error',
                'message'   =>  'Something went wrong!'
            ]);

        }

    }

    /**
     * update the permission data
     * @return void
     */
    public function updatePermission()
    {

        $validated = $this->validate([
            'name'  => 'required|unique:permissions,name,'.$this->permissionId,
        ]);

        try {

            Permission::whereId($this->permissionId)->update($validated);

            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'success',
                'message'   =>  'Permission Updated Successfully!'
            ]);

            $this->updatePermission = false;
            $this->resetFields();

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'error',
                'message'   =>  'Something went wrong!'
            ]);

        }
    }


    /**
     * Cancel Add/Edit form and redirect to permission listing page
     * @return void
     */
    public function cancelPermission()
    {
        $this->addPermission = false;
        $this->updatePermission = false;
        $this->resetFields();
    }


     /**
     * delete specific permission data from the permissions table
     * @param mixed $id
     * @return void
     */
    public function deletePermission($id)
    {
        try{

            Permission::find($id)->delete();

            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'success',
                'message'   =>  "Permission Item Deleted Successfully!"
            ]);

        }catch(\Exception $e){

            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'error',
                'message'   =>  "Something went wrong!"
            ]);

        }
    }
}
