<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



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

Route::group([
    'middleware' => 'api',
    'namespace'  => 'App\Http\Controllers\Auth',
    'prefix' => 'auth'
    ], function ($router) {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
});

Route::group([
    'middleware' => 'api',
    'namespace'  => 'App\Http\Controllers\Student',
], function ($router) {
    Route::get('dashboard', 'DashboardController@index');
    Route::get('partialGrades', 'PartialGradesController@index');
    Route::get('finalGrade', 'FinalGradeController@index');
    Route::post('planDay', 'PlanController@dayIndex');
    Route::post('planWeek', 'PlanController@weekIndex');
    Route::get('payments', 'PaymentController@index');
    Route::post('paymentDetails', 'PaymentController@show');
    Route::get('messages', 'MessageController@index');
    Route::post('messageDetails', 'MessageController@show');
});



