<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserhomeController extends Controller
{
    public function login()
    {
        return view('userhome.login');
    }
}
