<?php


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
use Illuminate\Http\Request;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');

header('Content-Type: application/json; charset=UTF-8', true);


/** Start Auth Route **/

Route::middleware('auth:api')->group(function () {

    require 'manger.php';

    /** Task Routes */
    Route::prefix('Task')->group(function () {
        Route::get('/all', 'TaskController@all');
        Route::get('/single', 'TaskController@single');
        Route::post('/change_status', 'TaskController@change_status');
    });

});
/** End Auth Route **/

/** Auth_general Routes*/
Route::prefix('Auth')->group(function()
{
    Route::post('/login', 'AuthController@login');
});
