<?php
Route::group(['middleware' => 'cors'], function () {
    Route::get('/pocket', 'PocketsController@index');
    Route::post('/pocket/create', 'PocketsController@createPocket');

    Route::get('/pocket/{pocket_id}', 'SiteContentsController@index');
    Route::post('/pocket/site/create', 'SiteContentsController@createPocketContent');

    Route::post('/pocket/content', 'SiteContentsController@getByHashTags');
    Route::post('/pocket/content/delete', 'SiteContentsController@deleteContentByUrl');
});
