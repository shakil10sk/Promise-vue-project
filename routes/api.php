<?php


use \Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'Auth\LoginController@login');

Route::middleware('auth.jwt')->group(function () {

    Route::resource('department','DepartmentController');
    Route::get('department/delete/{id}','DepartmentController@delete');

    Route::resource('location','LocationController');
    Route::get('location/delete/{id}','LocationController@delete');

    //branch sections
    Route::resource('branch','BranchController');
    Route::get('branch/delete/{id}','BranchController@delete');

    //branch sections
    Route::resource('municipility','MunicipilityController');
    Route::get('municipility/delete/{id}','MunicipilityController@delete');

    // employee quata
    Route::resource('employee/quota','EmployeeQuotaController');
    Route::get('employee/quota/delete/{id}','EmployeeQuotaController@delete');

    // bank Branch
    Route::resource('bank_branch/','BankBranchController');
    Route::get('bank_branch/delete/{id}','BankBranchController@delete');

});




