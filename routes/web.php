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

Route::get('/', 'ContentsController@index');
Route::get('/pocket/details/{pocket_id}', 'ContentsController@pocketDetalis')->name("pocket_details");
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
