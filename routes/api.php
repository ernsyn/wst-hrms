<?php

// use Illuminate\Http\Request;

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

Route::post('login', 'Api\UserController@login');

Route::group(['prefix' => 'user', 'middleware' => 'auth:api'], function() {
    Route::get('info', 'Api\UserController@info');
});

Route::group(['prefix' => 'employee', 'middleware' => 'auth:api'], function() {
    Route::get('working-days', 'Api\EmployeeController@getWorkingDays');
});

Route::group(['prefix' => 'attendance', 'middleware' => 'auth:api'], function() {
    Route::get('list', 'Api\AttendanceController@getAttendanceList');
    Route::post('clock-in', 'Api\AttendanceController@postClockIn');
    Route::post('clock-out', 'Api\AttendanceController@postClockOut');
});

Route::group(['prefix' => 'e-leave', 'middleware' => 'auth:api'], function() {
    Route::get('types', 'Api\ELeaveController@getLeaveTypes');
    Route::post('request/check', 'Api\ELeaveController@postCreateLeaveRequest');
    Route::post('request', 'Api\ELeaveController@postCheckLeaveRequest');
});