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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'AdminController@microsite')->name('microsite');
Route::post('/save', 'AdminController@save')->name('save');
// Route::get('/', 'AdminController@index')->name('index');
Route::get('/login', 'AdminController@login')->name('login');
Route::post('/postlogin', 'AdminController@postlogin')->name('postlogin');
Route::get('/logout', 'AdminController@logout')->name('logout');

Route::group(array('prefix' => 'admin','middleware' => 'admin'), function()
{	
	Route::get('/dashboard', array('as' => 'dashboard', 'uses' => 'AdminController@dashboard'));
	Route::get('/getpersons', array('as' => 'getpersons', 'uses' => 'AdminController@getpersons'));

	Route::get('/doctor/add', array('as' => 'doctoradd', 'uses' => 'AdminController@doctorAdd'));
	Route::post('/doctor/doctorsave', array('as' => 'doctorsave', 'uses' => 'AdminController@doctorSave'));
	Route::get('/doctor/index', array('as' => 'doctorindex', 'uses' => 'AdminController@doctorList'));
	Route::get('/doctor/getdoctors', array('as' => 'getdoctors', 'uses' => 'AdminController@getdoctors'));
	Route::get('/doctor/{id}/edit', array('as' => 'editdoctor', 'uses' => 'AdminController@doctorEdit'));
	Route::post('/doctor/updatedoctor', array('as' => 'updatedoctor', 'uses' => 'AdminController@updatedoctor'));
	Route::get('/doctor/delete/{id}', array('as' => 'deletedoctor', 'uses' => 'AdminController@doctorDelete'));

	Route::get('/patient/add', array('as' => 'patientadd', 'uses' => 'AdminController@patientAdd'));
	Route::post('/patient/patientsave', array('as' => 'patientsave', 'uses' => 'AdminController@patientSave'));
	Route::get('/patient/index', array('as' => 'patientindex', 'uses' => 'AdminController@patientList'));
	Route::get('/patient/checkUniqueID', array('as' => 'checkUniqueID', 'uses' => 'AdminController@checkUniqueID'));
	Route::get('/patient/getpatients', array('as' => 'getpatients', 'uses' => 'AdminController@getpatients'));
	Route::get('/patient/{id}/edit', array('as' => 'editpatient', 'uses' => 'AdminController@patientEdit'));
	Route::post('/patient/updatepatient', array('as' => 'updatepatient', 'uses' => 'AdminController@updatepatient'));
	Route::get('/patient/delete/{id}', array('as' => 'deletepatient', 'uses' => 'AdminController@patientDelete'));
	

	Route::get('/user/add', array('as' => 'useradd', 'uses' => 'AdminController@userAdd'));
	Route::post('/user/usersave', array('as' => 'usersave', 'uses' => 'AdminController@userSave'));
	Route::get('/user/index', array('as' => 'index', 'uses' => 'AdminController@userList'));
	Route::get('/user/getusers', array('as' => 'getusers', 'uses' => 'AdminController@getUsers'));
	Route::get('/user/{id}/edit', array('as' => 'edituser', 'uses' => 'AdminController@userEdit'));
	Route::post('/user/updateuser', array('as' => 'updateuser', 'uses' => 'AdminController@updateuser'));
	Route::get('/user/delete/{id}', array('as' => 'delete', 'uses' => 'AdminController@userDelete'));
    

    
    // Route::get('/doctors', array('as' => 'doctors', 'uses' => 'AdminController@doctors'));
    // Route::get('/getDoctors', array('as' => 'getDoctors', 'uses' => 'AdminController@getDoctors'));
    // Route::get('/doctors/{id}/edit', array('as' => 'doctorsedit', 'uses' => 'AdminController@doctorsedit'));
    // Route::post('/doctors/updatedoctor', array('as' => 'updatedoctor', 'uses' => 'AdminController@updatedoctor'));
    // Route::get('/doctors/delete/{id}', array('as' => 'deletedoctors', 'uses' => 'AdminController@deletedoctors'));

	Route::post('/user/updateuser', array('as' => 'updateuser', 'uses' => 'AdminController@updateuser'));

	Route::get('/options/add', array('as' => 'optionadd', 'uses' => 'AdminController@optionsadd'));
	Route::get('/options', array('as' => 'options', 'uses' => 'AdminController@options'));
	Route::post('/options/save', array('as' => 'saveoptions', 'uses' => 'AdminController@saveoptions'));
	Route::get('/getOptions', array('as' => 'getOptions', 'uses' => 'AdminController@getOptions'));
	Route::get('/options/{id}/edit', array('as' => 'optionsedit', 'uses' => 'AdminController@optionsedit'));
	Route::post('/options/updateoption', array('as' => 'updateoption', 'uses' => 'AdminController@updateoption'));
	Route::get('/options/delete/{id}', array('as' => 'deleteoptions', 'uses' => 'AdminController@deleteoptions'));

	Route::get('/storedashboard', array('as' => 'storedashboard', 'uses' => 'AdminController@storedashboard'));
	Route::get('/dailyvisitdashboard', array('as' => 'dailyvisitdashboard', 'uses' => 'AdminController@dailyvisitdashboard'));
	Route::get('/storedashboard', array('as' => 'storedashboard', 'uses' => 'AdminController@storedashboard'));
});


Route::group(array('prefix' => 'bdo','middleware' => 'bdo'), function()
{
	Route::get('/store', array('as' => 'dashboard', 'uses' => 'AdminController@store'));
	Route::post('/store/updatestore', array('as' => 'updatestore', 'uses' => 'AdminController@updatestore'));
	Route::get('/store/delete/{id}', array('as' => 'deletestore', 'uses' => 'AdminController@deletestore'));

	Route::post('/audit/updateaudit', array('as' => 'updateaudit', 'uses' => 'AdminController@updateaudit'));
	Route::get('/audit/delete/{id}', array('as' => 'deleteaudit', 'uses' => 'AdminController@deleteaudit'));

	Route::get('/getTerritorries', array('as' => 'getTerritorries', 'uses' => 'AdminController@getTerritorries'));
	Route::get('/getTowns', array('as' => 'getTowns', 'uses' => 'AdminController@getTowns'));
	Route::get('/getstorelist', array('as' => 'getstorelist', 'uses' => 'AdminController@getstorelist'));

	Route::get('/audit', array('as' => 'audit', 'uses' => 'AdminController@audit'));
	Route::get('/getAudit', array('as' => 'getAudit', 'uses' => 'AdminController@getAudit'));

	Route::get('/store/{id}/edit', array('as' => 'storeedit', 'uses' => 'AdminController@storeedit'));
	Route::get('/dailyvisit/{id}/edit', array('as' => 'dailyvisitedit', 'uses' => 'AdminController@dailyvisitedit'));

	Route::get('/audit/{id}/edit', array('as' => 'storeedit', 'uses' => 'AdminController@auditedit'));
    
    Route::get('/dailyvisit', array('as' => 'dailyvisit', 'uses' => 'AdminController@dailyvisit'));
    Route::get('/getDailyvisit', array('as' => 'getDailyvisit', 'uses' => 'AdminController@getDailyvisit'));
    Route::post('/dailyvisit/updatedailyvisit', array('as' => 'updatedailyvisit', 'uses' => 'AdminController@updatedailyvisit'));
    Route::get('/dailyvisit/delete/{id}', array('as' => 'dailyvisitdelete', 'uses' => 'AdminController@deletedailyvisit'));


});


Route::group(array('prefix' => 'reportuser','middleware' => 'reportuser'), function()
{
	Route::get('/store', array('as' => 'dashboard', 'uses' => 'AdminController@store'));
	Route::post('/store/updatestore', array('as' => 'updatestore', 'uses' => 'AdminController@updatestore'));
	Route::get('/store/{id}/edit', array('as' => 'storeedit', 'uses' => 'AdminController@storeedit'));
	Route::get('/store/delete/{id}', array('as' => 'deletestore', 'uses' => 'AdminController@deletestore'));
	Route::get('/getstorelist', array('as' => 'getstorelist', 'uses' => 'AdminController@getstorelist'));

	Route::get('/audit', array('as' => 'audit', 'uses' => 'AdminController@audit'));
	Route::get('/getAudit', array('as' => 'getAudit', 'uses' => 'AdminController@getAudit'));
	Route::get('/audit/{id}/edit', array('as' => 'storeedit', 'uses' => 'AdminController@auditedit'));
	Route::post('/audit/updateaudit', array('as' => 'updateaudit', 'uses' => 'AdminController@updateaudit'));
	Route::get('/audit/delete/{id}', array('as' => 'deleteaudit', 'uses' => 'AdminController@deleteaudit'));

	Route::get('/storedashboard', array('as' => 'storedashboard', 'uses' => 'AdminController@storedashboard'));
	Route::get('/dailyvisitdashboard', array('as' => 'dailyvisitdashboard', 'uses' => 'AdminController@dailyvisitdashboard'));
	Route::get('/storedashboard', array('as' => 'storedashboard', 'uses' => 'AdminController@storedashboard'));
});
