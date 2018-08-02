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
    return view('phoneBook');
});

Route::get('/phoneBook/myhome', function () {
    return redirect('/#/myhome');
});

Route::resource('phoneBook','PhoneBookController');



Route::post('getdata','PhoneBookController@getdata');

Route::post('/upload','usercontroller@imageupload')->name('upload');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::view('/saveimage','showsavedimage');
Route::post('/saveimage','usercontroller@saveimage')->name('saveimage');


//avatar 
Route::get('avatar','avatarcontroller@avatar');
