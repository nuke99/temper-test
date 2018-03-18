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
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard/weekly-cohorts','DashboardController@weeklyCohorts')->middleware('jwt');


Route::get('/auth/refresh', function(Request $request) {
    return $request;
})->middleware('jwt.refresh');
Route::get('/auth/user', 'AdminController@user')->middleware('jwt.refresh');
Route::post('/auth/login','AdminController@login');

