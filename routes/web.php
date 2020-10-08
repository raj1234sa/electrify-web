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

Route::post('/upload-csv', 'App\Http\Controllers\ImportController@uploadFile');

Route::post('/get-services-list-ajax', 'App\Http\Controllers\ServiceController@ajaxlist');
Route::get('/service-list', 'App\Http\Controllers\ServiceController@index');
Route::get('/add-service', 'App\Http\Controllers\ServiceController@create');
Route::post('/save-service', 'App\Http\Controllers\ServiceController@insert');
Route::get('/add-service/{id}', 'App\Http\Controllers\ServiceController@edit');
Route::post('/service-status-change', 'App\Http\Controllers\ServiceController@changeStatus');
Route::get('/delete-service/{id}', 'App\Http\Controllers\ServiceController@delete');
Route::post('/services-export', 'App\Http\Controllers\ServiceController@export');
Route::get('/import-service', 'App\Http\Controllers\ServiceController@importView');
Route::get('/service-importave','App\Http\Controllers\ServiceController@importSave');

Route::post('/get-customers-list-ajax', 'App\Http\Controllers\CustomersController@ajaxlist');
Route::get('/customer-list', 'App\Http\Controllers\CustomersController@index');
Route::get('/add-customer', 'App\Http\Controllers\CustomersController@create');
Route::post('/save-customer', 'App\Http\Controllers\CustomersController@insert');
Route::get('/add-customer/{id}', 'App\Http\Controllers\CustomersController@edit');
Route::post('/customer-status-change', 'App\Http\Controllers\CustomersController@changeStatus');
Route::get('/delete-customer/{id}', 'App\Http\Controllers\CustomersController@delete');
Route::post('/customers-export', 'App\Http\Controllers\CustomersController@export');
