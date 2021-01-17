<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use DateTime;

class dashboard extends Controller
{
    public function index(Request $request)
    {
        $chart_data=array();
        $t_date=date('Y-m-d');
        $t_1=date('Y-m-d', strtotime('-1 day', strtotime($t_date)));
        $t_2=date('Y-m-d', strtotime('-2 day', strtotime($t_date)));
        $t_3=date('Y-m-d', strtotime('-3 day', strtotime($t_date)));
        $t_4=date('Y-m-d', strtotime('-4 day', strtotime($t_date)));
        $t_5=date('Y-m-d', strtotime('-5 day', strtotime($t_date)));
        $t_6=date('Y-m-d', strtotime('-6 day', strtotime($t_date)));
        
        $chart_data['day1']=date_format(new DateTime($t_6), 'l');
        $chart_data['day2']=date_format(new DateTime($t_5), 'l');
        $chart_data['day3']=date_format(new DateTime($t_4), 'l');
        $chart_data['day4']=date_format(new DateTime($t_3), 'l');
        $chart_data['day5']=date_format(new DateTime($t_2), 'l');
        $chart_data['day6']=date_format(new DateTime($t_1), 'l');
        $chart_data['day7']=date_format(new DateTime($t_date), 'l');
        
        $t_date_d=DB::select("SELECT id FROM users WHERE (on_date>='$t_date 00:00' AND on_date<='$t_date 23:59')");
        $t_1_d=DB::select("SELECT id FROM users WHERE (on_date>='$t_1 00:00' AND on_date<='$t_1 23:59')");
        $t_2_d=DB::select("SELECT id FROM users WHERE (on_date>='$t_2 00:00' AND on_date<='$t_2 23:59')");
        $t_3_d=DB::select("SELECT id FROM users WHERE (on_date>='$t_3 00:00' AND on_date<='$t_3 23:59')");
        $t_4_d=DB::select("SELECT id FROM users WHERE (on_date>='$t_4 00:00' AND on_date<='$t_4 23:59')");
        $t_5_d=DB::select("SELECT id FROM users WHERE (on_date>='$t_5 00:00' AND on_date<='$t_5 23:59')");
        $t_6_d=DB::select("SELECT id FROM users WHERE (on_date>='$t_6 00:00' AND on_date<='$t_6 23:59')");
        
        $chart_data['day1_d']=count($t_6_d);
        $chart_data['day2_d']=count($t_5_d);
        $chart_data['day3_d']=count($t_4_d);
        $chart_data['day4_d']=count($t_3_d);
        $chart_data['day5_d']=count($t_2_d);
        $chart_data['day6_d']=count($t_1_d);
        $chart_data['day7_d']=count($t_date_d);
        
        $this_week_sales=count($t_6_d).', '.count($t_5_d).', '.count($t_4_d).', '.count($t_3_d).', '.count($t_2_d).', '.count($t_1_d).', '.count($t_date_d);
        
        $recent_users=DB::select("SELECT id, first_name, last_name, on_date FROM users WHERE deleted='0' ORDER BY id DESC LIMIT 5");
        return view('admin.dashboard.index', ['title'=>'Dashboard', 'recent_users'=>$recent_users, 'chart_data'=>$chart_data]);
    }
    
    public function users(Request $request)
    {
        if($request->input('delete_id')!='')
        {
            $id=addslashes($request->input('delete_id'));
            
            DB::update("UPDATE users SET deleted='1' WHERE id=:id", ['id'=>$id]);
            return redirect('admin/users');
        }
        
        $data=DB::select("SELECT * FROM users WHERE deleted='0' ORDER BY id DESC");
        return view('admin.users.index', ['title'=>'Users', 'data'=>$data]);
    }
    
    public function archieved_users(Request $request)
    {
        if($request->input('archieve_id')!='')
        {
            $id=addslashes($request->input('archieve_id'));
            
            DB::update("UPDATE users SET deleted='0' WHERE id=:id", ['id'=>$id]);
            $request->session()->flash('success', 'User un-archieved successfully.');
            return redirect('admin/archieved-users');
        }
        
        if($request->input('delete_id')!='')
        {
            $id=addslashes($request->input('delete_id'));
            
            DB::delete("DELETE FROM users WHERE id=:id", ['id'=>$id]);
            $request->session()->flash('success', 'User deleted successfully.');
            return redirect('admin/archieved-users');
        }
        
        $data=DB::select("SELECT * FROM users WHERE deleted='1' ORDER BY id DESC");
        return view('admin.archieved_users.index', ['title'=>'Archieved Users', 'data'=>$data]);
    }
    
    public function edit_user(Request $request, $user_id)
    {
        $data=DB::select("SELECT * FROM users WHERE id=:id LIMIT 1", ['id'=>$user_id]);
        if(count($data)==0) return redirect('admin/users');
        $data=collect($data)->first();
        
        if($request->input('first_name')!='')
        {
            $first_name=addslashes($request->input('first_name'));
            $last_name=addslashes($request->input('last_name'));
            $email=addslashes($request->input('email'));
            $phone_number=addslashes($request->input('phone_number'));
            
            DB::update("UPDATE users SET first_name=:first_name, last_name=:last_name, email=:email, phone_number=:phone_number WHERE id=:id", ['first_name'=>$first_name, 'last_name'=>$last_name, 'email'=>$email, 'phone_number'=>$phone_number, 'id'=>$user_id]);
            $request->session()->flash('success', 'All changes saved successfully.');
            return redirect('admin/edit-user/'.$user_id);
        }
        
        return view('admin.edit_user.index', ['title'=>'Edit User', 'data'=>$data]);
    }
    
    public function my_profile(Request $request)
    {
        $id=$request->session()->get('admin_id');
        
        if($request->hasFile('profile_image')) {

            // Upload path
            $destinationPath = 'profile_images/';

            // Create directory if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Get file extension
            $extension = $request->file('profile_image')->getClientOriginalExtension();

            // Valid extensions
            $validextensions = array("jpeg","jpg","png");

            // Check extension
            if(in_array(strtolower($extension), $validextensions))
            {
                // Rename file
                $fileName = str_slug(Carbon::now()->toDayDateTimeString()).rand(11111, 99999) .'.' . $extension;

                // Uploading file to given path
                $request->file('profile_image')->move($destinationPath, $fileName);
                $image=$fileName;
                
                DB::update("UPDATE admin SET profile_image='$image' WHERE id=:id", ['id'=>$id]);
            }

        }
        
        if($request->input('username')!='')
        {
            $username=addslashes($request->input('username'));
            $email=addslashes($request->input('email'));
            $first_name=addslashes($request->input('first_name'));
            $last_name=addslashes($request->input('last_name'));
            
            $check=DB::select("SELECT id FROM admin WHERE username=:username AND id!=:id LIMIT 1", ['username'=>$username, 'id'=>$id]);
            if(count($check)==0)
            {
                $check=DB::select("SELECT id FROM admin WHERE email=:email AND id!=:id LIMIT 1", ['email'=>$email, 'id'=>$id]);
                if(count($check)==0)
                {
                    DB::update("UPDATE admin SET username=:username, email=:email, first_name=:first_name, last_name=:last_name WHERE id=:id", ['username'=>$username, 'email'=>$email, 'first_name'=>$first_name, 'last_name'=>$last_name, 'id'=>$id]);
                    $request->session()->flash('success', 'All changes saved successfully.');
                }
                else $request->session()->flash('error', 'Email already registered.');
            }
            else $request->session()->flash('error', 'Username already taken.');
            return redirect('admin/my-profile');
        }
        
        return view('admin.my_profile.index', ['title'=>'My Profile']);
    }
    
    public function settings(Request $request)
    {
        $id=$request->session()->get('admin_id');
        
        if($request->input('pass')!='')
        {
            $pass=addslashes($request->input('pass'));
            $pass1=addslashes($request->input('pass1'));
            $pass2=addslashes($request->input('pass2'));
            
            $check=DB::select("SELECT id FROM admin WHERE pass=:pass AND id=:id LIMIT 1", ['pass'=>sha1($pass), 'id'=>$id]);
            if(count($check)==1)
            {
                if($pass1==$pass2)
                {
                    DB::update("UPDATE admin SET pass=:pass WHERE id=:id", ['pass'=>sha1($pass1), 'id'=>$id]);
                    $request->session()->flash('success', 'Password updated successfully.');
                }
                else $request->session()->flash('error', 'Passwords did not match.');
            }
            else $request->session()->flash('error', 'Current password is not valid.');
            return redirect('admin/settings');
        }
        
        return view('admin.settings.index', ['title'=>'Settings']);
    }
}
