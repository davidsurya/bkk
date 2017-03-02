<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(array('before' => 'auth'), function()
{
    Route::get('/admin/down', function() 
    {
        touch(storage_path().'/framework/down');
    });    
});

Route::get('/admin/up', function() {
	@unlink(storage_path().'/framework/down');
});

Route::get('/', 'HomeController@getIndex');
Route::get('/dashboard', 'HomeController@getDashboard');

Route::auth();

Route::group(array('middleware'=>'auth'), function(){	

	Route::group(array('middleware'=>'role:admin'), function(){
		Route::controller('/admin', 'AdminController');
	});

	Route::group(array('middleware'=>'role:alumni'), function(){
		Route::controller('/alumni', 'UserController');
	});
});

Route::get('/register', 'HomeController@getRegister');
Route::post('/register', 'HomeController@postRegister');
Route::get('/subdepartment/{id}', 'HomeController@getSubdepartment');