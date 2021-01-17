<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class account extends Controller
{
    public function logout(Request $request)
    {
        $request->session()->put('admin_id', '');
        $request->session()->forget('admin_id');
        
        return redirect('admin/login');
    }
    
    public function login(Request $request)
    {
        if($request->input('email')!='')
        {
            $data=array();
            $data['success']=0;
            $email=addslashes($request->input('email'));
            $pass=addslashes($request->input('pass'));
            $pass=sha1($pass);
            
            $check=DB::select("SELECT id FROM admin WHERE email=:email AND pass=:pass", ['email'=>$email, 'pass'=>$pass]);
            if(count($check)==1)
            {
                $check=collect($check)->first();
                $request->session()->put('admin_id', $check->id);
                $data['success']=1;
            }
            else $data['error']='Email or password is not valid.';
            
            return response()->json($data);
        }
        return view('admin.login.index', []);
    }
    
    public function signup(Request $request)
    {
        if($request->input('username')!='')
        {
            $data=array();
            $data['success']=0;
            $username=addslashes($request->input('username'));
            $email=addslashes($request->input('email'));
            $pass1=addslashes($request->input('pass1'));
            $pass2=addslashes($request->input('pass2'));
            
            $check=DB::select("SELECT id FROM admin WHERE username=:username LIMIT 1", ['username'=>$username]);
            if(count($check)==0)
            {
                $check=DB::select("SELECT id FROM admin WHERE email=:email LIMIT 1", ['email'=>$email]);
                if(count($check)==0)
                {
                    if($pass1==$pass2)
                    {
                        $pass=sha1($pass1);
                        DB::insert("INSERT INTO admin (username, email, pass, on_date) VALUES (:username, :email, :pass, NOW())", ['username'=>$username, 'email'=>$email, 'pass'=>$pass]);
                        $id=DB::getPdo()->lastInsertId();
                        $request->session()->put('admin_id', $id);
                        $data['success']=1;
                    }
                    else $data['error']='Passwords did not match.';
                }
                else $data['error']='Email already registered.';
            }
            else $data['error']='Username already taken.';
            
            return response()->json($data);
        }
        return view('admin.signup.index', []);
    }
}
