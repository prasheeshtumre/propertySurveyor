<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;
use DB;
use Carbon\Carbon;

class Login extends Model
{
    protected $table = 'users';

    public function checkLogin($username,$password)
    {
        
       
        DB::enableQueryLog();
        //$result = DB::table('users')->select('user_id','ulbid','user_type')->where($params)->get();
        $result = DB::table('users')
                       ->where('username',$username)
                       ->where('password',$password)
                       ->first();
        //dd(DB::getQueryLog());
        //exit();
        return $result;

     
        
        
    }
}
