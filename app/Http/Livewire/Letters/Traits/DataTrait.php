<?php

namespace app\Http\Livewire\Letters\Traits;

use App\Models\User;
use Auth;

trait DataTrait{

    public $current_user, $users;

    public function mountData()
    {

        $this->current_user = Auth::user();

        $this->users = User::where('active', '=', 1)
        ->orderBy('name', 'ASC')
        ->get();

    }

}
