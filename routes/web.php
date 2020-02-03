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

Route::get('/', function () {
    if(Auth::check())
        return redirect('home');
    else
        return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
	
	Route::get('/home', 'HomeController@index')->name('home');
	
	Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

	Route::post('/dashboard', 'HomeController@dashboard')->name('dashboard');
	
    Route::resource('/requests', 'RequestController');
	
	Route::get('/requests/{id}/editfp', 'RequestController@editFp');
	
	Route::put('/requests/{id}/updatefp', 'RequestController@updateFp');
	
    Route::post('/requests/{id}/message', 'RequestController@sendMessage');

    Route::get('/password/edit', 'UserController@editPassword')->name('edit-password');
    
    Route::put('/password/update/', 'UserController@updatePassword')->name('update-password');

    Route::get('/download/{file}', function($file){

        return Storage::download('files/'.$file);

    });
	
	Route::middleware('admin')->group(function () {	

		Route::resource('/users', 'UserController');
		
		Route::resource('/projects', 'ProjectController');
		
		Route::resource('/institutions', 'InstitutionController');

	}); 
 
});
