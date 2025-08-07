<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class viewcontroller extends Controller
{
     public function dashboard()
    {
        return view('pages.dashboard1');
    }
}
