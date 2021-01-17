<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'home@details_form');
Route::post('save-details', 'home@save_details');

Route::get('/admin/login', 'admin\account@login');
Route::post('/admin/login', 'admin\account@login');
Route::get('/admin/logout', 'admin\account@logout');
Route::get('/admin/signup', 'admin\account@signup');
Route::post('/admin/signup', 'admin\account@signup');

Route::get('/admin', function(){
    return redirect('admin/login');
});

Route::group(['middleware' => 'admin_auth'], function () {
    
 Route::get('admin/dashboard', 'admin\dashboard@index');
 Route::post('admin/dashboard', 'admin\dashboard@index');
 Route::get('admin/users', 'admin\dashboard@users');
 Route::post('admin/users', 'admin\dashboard@users');
 Route::get('admin/archieved-users', 'admin\dashboard@archieved_users');
 Route::post('admin/archieved-users', 'admin\dashboard@archieved_users');
 Route::get('admin/edit-user/{ID}', 'admin\dashboard@edit_user');
 Route::post('admin/edit-user/{ID}', 'admin\dashboard@edit_user');
 Route::get('admin/my-profile', 'admin\dashboard@my_profile');
 Route::post('admin/my-profile', 'admin\dashboard@my_profile');
 Route::get('admin/settings', 'admin\dashboard@settings');
 Route::post('admin/settings', 'admin\dashboard@settings');
    
});
