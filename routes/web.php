<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::get('/', 'App\Http\Controllers\DashboardController@index');
Route::post('/loginAuth', 'App\Http\Controllers\DashboardController@loginAuth');
Route::get('/logout', 'App\Http\Controllers\DashboardController@logout');
Route::get('/dashboard', 'App\Http\Controllers\DashboardController@dashboard');

Route::post('/get-services-list-ajax', 'App\Http\Controllers\ServiceController@ajaxlist');

Route::get('/service-list', 'App\Http\Controllers\ServiceController@index');
Route::get('/add-service', 'App\Http\Controllers\ServiceController@create');
Route::post('/save-service', 'App\Http\Controllers\ServiceController@insert');
Route::get('/add-service/{id}', 'App\Http\Controllers\ServiceController@edit');
Route::post('/service-status-change', 'App\Http\Controllers\ServiceController@changeStatus');
Route::get('/delete-service/{id}', 'App\Http\Controllers\ServiceController@delete');
Route::get('/services-export', 'App\Http\Controllers\ServiceController@export');