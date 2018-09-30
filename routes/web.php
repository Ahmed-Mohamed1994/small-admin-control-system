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

Route::get('/','mainController@loginPage')->name('login');
Route::get('/logout','mainController@logout')->name('logout');
Route::post('/login','mainController@login')->name('postLogin');

Route::get('/dashboard','mainController@dashboard')->name('dashboard');
// user
Route::group(['prefix' => 'users'],function (){
    Route::get('/','UserController@index')->name('users');
    Route::get('create','UserController@create')->name('createUser');
    Route::post('store','UserController@store')->name('storeUser');
    Route::group(['prefix' => '{user}'], function () {
        Route::get('','UserController@show')->name('showUser');
        Route::get('/suspend','UserController@suspend')->name('suspendUser');
        Route::get('/edit', 'UserController@edit')->name('editUser');
        Route::post('/update', 'UserController@update')->name('updateUser');
        Route::get('/delete', 'UserController@destroy')->name('deleteUser');
        Route::get('/admin/suspend', 'UserController@admin_suspend')->name('adminSuspendUser');
        Route::get('/restore', 'UserController@restore')->name('restoreUser');
        Route::get('/forceDelete', 'UserController@forceDelete')->name('forceDeleteUser');
    });
});
// members
Route::group(['prefix' => 'members'],function (){
    Route::get('/','UserController@allMembers')->name('members');
    Route::get('create','UserController@create_member')->name('createMember');
    Route::post('store','UserController@store_member')->name('storeMember');
    Route::get('activate/{token}','UserController@activateMember')->name('activateMember');
    Route::get('/logs','UserController@logs_member')->name('memberLogs');
    Route::get('/logs/{log}/update','UserController@update_old_log')->name('updateLog');
    Route::get('/logs/{log}/delete','UserController@delete_old_log')->name('deleteLog');
    Route::group(['prefix' => '{user}'],function (){
       Route::get('','UserController@show_member')->name('showMember');
       Route::get('/edit','UserController@edit_member')->name('editMember');
       Route::post('/update','UserController@update_member')->name('updateMember');
       Route::get('/delete','UserController@delete_member')->name('deleteMember');
    });
});
//page
Route::group(['prefix' => 'pages'],function (){
    Route::get('/','PagesController@index')->name('pages');
    Route::get('create','PagesController@create')->name('createPage');
    Route::post('store','PagesController@store')->name('storePage');
    Route::group(['prefix' => '{page}'], function () {
        Route::get('','PagesController@show')->name('showPage');
        Route::get('/edit', 'PagesController@edit')->name('editPage');
        Route::post('/update', 'PagesController@update')->name('updatePage');
        Route::get('/delete', 'PagesController@destroy')->name('deletePage');
    });
});
//group
Route::group(['prefix' => 'groups'],function (){
    Route::get('/','GroupsController@index')->name('groups');
    Route::get('create','GroupsController@create')->name('createGroup');
    Route::post('store','GroupsController@store')->name('storeGroup');
    Route::group(['prefix' => '{group}'], function () {
        Route::get('','GroupsController@show')->name('showGroup');
        Route::get('/edit', 'GroupsController@edit')->name('editGroup');
        Route::post('/update', 'GroupsController@update')->name('updateGroup');
        Route::get('/delete', 'GroupsController@destroy')->name('deleteGroup');
        Route::get('/assign', 'GroupsController@assign')->name('assignGroup');
        Route::post('/assign/store', 'GroupsController@storeAssign')->name('storeAssignGroup');
    });
});