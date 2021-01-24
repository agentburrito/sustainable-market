<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\WelcomeController@index')->name('welcome');


Auth::routes();

Route::resource('category', 'App\Http\Controllers\CategoryController');
Route::resource('listing', 'App\Http\Controllers\ListingController')->middleware('auth');

Route::group(['namespace' => 'App\Http\Controllers\User', 'as' => 'user.', 'middleware' => ['auth']], function () {

    // User Profile 
    Route::group(['as' => 'profile.'], function () {
       
       Route::get('user/profile', 'UserProfileController@index')->name('index');
       Route::post('user/profile', 'UserProfileController@update')->name('update');
 
       // Update Password Routes 
       Route::get('user/profile/password', 'UserPasswordController@index')->name('password.index');
       Route::post('user/profile/password', 'UserPasswordController@update')->name('password.update');
    });
      
 }); 

