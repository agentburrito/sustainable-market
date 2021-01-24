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
Route::post('listing/{listing}/purchase', 'App\Http\Controllers\ListingController@purchase')->middleware('auth')->name('listing.purchase');
Route::get('listing/{listing}/purchase/complete', 'App\Http\Controllers\ListingController@complete')->middleware('auth')->name('listing.purchase.complete');

Route::get('organization/{organization}', 'App\Http\Controllers\OrganizationController@show')->middleware('auth')->name('organization.show');
Route::get('organization/{organization}/edit', 'App\Http\Controllers\OrganizationController@edit')->middleware('auth')->name('organization.edit');
Route::post('organization/{organization}', 'App\Http\Controllers\OrganizationController@update')->middleware('auth')->name('organization.update');

Route::group(['namespace' => 'App\Http\Controllers\User', 'as' => 'user.', 'middleware' => ['auth']], function () {

    // User Profile 
    Route::group(['as' => 'profile.'], function () {
       
        Route::get('user/profile', 'UserProfileController@index')->name('index');
        Route::post('user/profile', 'UserProfileController@update')->name('update');
        Route::get('user/{user}', 'UserProfileController@show')->name('show');

        // Update Password Routes 
        Route::get('user/profile/password', 'UserPasswordController@index')->name('password.index');
        Route::post('user/profile/password', 'UserPasswordController@update')->name('password.update');

        // Update Password Routes 
        Route::get('user/profile/picture', 'UserPictureController@index')->name('picture.index');
        Route::post('user/profile/picture', 'UserPictureController@store')->name('picture.store');
    });
      
 }); 

