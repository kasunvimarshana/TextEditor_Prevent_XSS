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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::group([], function(){
    Route::get('home', array('uses' => 'HomeController@create'))->name('home');
    Route::get('post_a', array('uses' => 'PostControllerA@create'))->name('post_a_create');
    Route::post('post_a', array('uses' => 'PostControllerA@store'))->name('post_a_store');
    
    Route::get('post_b', array('uses' => 'PostControllerB@create'))->name('post_b_create');
    Route::post('post_b', array('uses' => 'PostControllerB@store'))->name('post_b_store');
});

Route::get('/', function () {
    //return redirect()->route('home');
    return redirect()->route('post_a_create');
});