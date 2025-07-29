<?php

namespace App\Http\Livewire\Common\Traits;

trait TabMemoryTrait{

    public $current_tab = '';

    public function switchTab($new_tab)
    {
        try {

            $this->current_tab = $new_tab;

            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'success',
                'message'   =>  "Current Tab set to $new_tab"
            ]);
        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'error',
                'message'   =>  'Something went wrong! Could not change tab'
            ]);
        }
    }

}
