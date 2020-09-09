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
Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'AdminController@index')->name('dashboard');
    Route::resource('companies', 'CompaniesController', ['except' => ['show'] ]);

    Route::post('employees/search', 'EmployeesController@search')->name('employees.search');
    Route::resource('employees', 'EmployeesController', ['except' => ['show'] ]);



    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});

Route::get('/home', 'HomeController@index')->name('home');
