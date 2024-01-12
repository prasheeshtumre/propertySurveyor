<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function added()
    {
        return view('added');
    }
    
    public function createRole(){
        $role = Role::create(['name' => 'writer']);
        $permission = Permission::create(['name' => 'edit articles']);
    }
    
    public function addRole(){
        // return User::with('roles')->get();
        // $role = Role::create(['name' => 'surveyor']);
        $roles = Role::where('guard_name', 'web')->get();

        foreach ($roles as $role) {
            echo $role->name . '<br>';
        }
        $user = User::find(1);
        $role = Role::where('name', 'surveyor')->first();
        
        $user->assignRole($role);
        
         if( $user->hasRole('surveyor')){
            echo 'is surveyor';
        }
        else{
            echo "not surveyor";
        }
        // $user->assignRole([$role1, $role2, $role3]);
    //   $user = User::find(1);
    //   $role = Role::where('name', 'admin')->first();
    //   $user->assignRole($role);
    }

    public function auth_status(){
        if(Auth::check())
            return response()->json(['status' => true, 'baseUrl' => url('/')], 200);
        else
            return response()->json(['status'=> false, 'baseUrl' => url('/')], 408);
    }

}
