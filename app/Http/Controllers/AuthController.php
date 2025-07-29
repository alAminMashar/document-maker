<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Http\Request;

class AuthController extends Controller
{
     public function signOut() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
