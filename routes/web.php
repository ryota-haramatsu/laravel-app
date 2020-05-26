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


Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'HomeController@index')->name('home');


    // Folder作成
    Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
    Route::post('/folders/create', 'FolderController@create');

    Route::group(['middleware' => 'can:view,folder'], function(){
        Route::get('/folders/{folder}/tasks', 'TaskController@index')->name('tasks.index');

        // Task作成
        Route::get('/folders/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
        Route::post('/folders/{folder}/tasks/create', 'TaskController@create');

        // Task編集
        Route::get('/folders/{folder}/tasks/{task_id}/edit', 'TaskController@showEditForm')->name('tasks.edit');
        Route::post('/folders/{folder}/tasks/{task_id}/edit', 'TaskController@edit');
    });
});

Auth::routes();


