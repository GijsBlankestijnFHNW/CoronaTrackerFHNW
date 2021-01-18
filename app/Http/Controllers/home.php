// Gijs Blankestijn & Jonathan Opsomer
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class home extends Controller
{
    public function details_form(Request $request)
    {
        return view('details_form.index', []);
    }
    
    public function save_details(Request $request)
    {
        $data=array();
        $data['success']=0;
        $first_name=addslashes($request->input('first_name'));
        $last_name=addslashes($request->input('last_name'));
        $email=addslashes($request->input('email'));
        $phone_number=addslashes($request->input('phone_number'));
        
        $check=DB::select("SELECT id FROM users WHERE email=:email LIMIT 1", ['email'=>$email]);
        if(count($check)==0)
        {
            DB::insert("INSERT INTO users (first_name, last_name, email, phone_number, on_date) VALUES (:first_name, :last_name, :email, :phone_number, NOW())", ['first_name'=>$first_name, 'last_name'=>$last_name, 'email'=>$email, 'phone_number'=>$phone_number]);
            $data['success']=1;
        }
        else $data['error']='This email record is already stored.';
        
        return response()->json($data);
    }
}
