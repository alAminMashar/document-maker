<?php

namespace app\Http\Livewire\Letters\Traits;

use App\Models\User;
use Auth;

trait DataTrait{

    public $current_user_id, $users;

    public function mountData()
    {
        $this->current_user_id = Auth::user()->id;
        $this->users = User::where('active', '=', 1)
        ->orderBy('name', 'ASC')
        ->get();
    }

}
