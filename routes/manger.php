<?php

Route::middleware('Manger')->group(function () {

    /** Department Routes */
    Route::prefix('Department')->group(function () {
        Route::get('/all', 'DepartmentController@all');
        Route::get('/single', 'DepartmentController@single');
        Route::post('/create', 'DepartmentController@create');
        Route::post('/update', 'DepartmentController@update');
        Route::post('/delete', 'DepartmentController@delete');
    });

    /** Employee Routes */
    Route::prefix('Employee')->group(function () {
        Route::get('/all', 'EmployeeController@all');
        Route::get('/single', 'EmployeeController@single');
        Route::post('/create', 'EmployeeController@create');
        Route::post('/update', 'EmployeeController@update');
        Route::post('/delete', 'EmployeeController@delete');
    });

    /** Task Routes */
    Route::prefix('Task')->group(function () {
        Route::post('/create', 'TaskController@create');
        Route::post('/delete', 'TaskController@delete');
        Route::post('/update', 'TaskController@update');
    });

});
