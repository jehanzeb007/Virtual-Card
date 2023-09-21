<?php

Route::group(['middleware' => 'web', 'prefix' => 'cards', 'namespace' => 'Modules\Cards\Http\Controllers'], function()
{
    Route::get('/', 'CardsController@index');
});
