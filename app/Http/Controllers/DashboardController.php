<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class DashboardController extends Controller
{
    public function index()
    {
        if(Session::get('username')){
             return view('dashboard');
        }else{
             return redirect('/');
        }
    }
    public function health_department()
    {
        if(Session::get('username')){
             return view('health_department');
        }else{
            return redirect('/');
        }
    }

    
}
