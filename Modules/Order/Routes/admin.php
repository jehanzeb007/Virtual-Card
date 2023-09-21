<?php

Route::get('orders', [
    'as' => 'admin.orders.index',
    'uses' => 'OrderController@index',
    'middleware' => 'can:admin.orders.index',
]);

Route::get('orders/{id}', [
    'as' => 'admin.orders.show',
    'uses' => 'OrderController@show',
    'middleware' => 'can:admin.orders.show',
]);

Route::put('orders/{order}/status', [
    'as' => 'admin.orders.status.update',
    'uses' => 'OrderStatusController@update',
    'middleware' => 'can:admin.orders.edit',
]);

Route::post('orders/{order}/email', [
    'as' => 'admin.orders.email.store',
    'uses' => 'OrderEmailController@store',
    'middleware' => 'can:admin.orders.show',
]);

Route::get('orders/{order}/print', [
    'as' => 'admin.orders.print.show',
    'uses' => 'OrderPrintController@show',
    'middleware' => 'can:admin.orders.show',
]);
Route::put('orders/log/update', [
    'as' => 'admin.orders.status.updatelog',
    'uses' => 'OrderStatusController@updatelog',
    'middleware' => 'can:admin.orders.edit',
]);

Route::get('cards', [
    'as' => 'admin.cards.index',
    'uses' => 'CardController@index',
    'middleware' => 'can:admin.cards.index',
]);
Route::post('card-generate', [
    'as' => 'admin.cards.generate',
    'uses' => 'CardController@generateCards',
    'middleware' => 'can:admin.cards.index',
]);
Route::post('card-export', [
    'as' => 'admin.cards.export',
    'uses' => 'CardController@exportCards',
    'middleware' => 'can:admin.cards.index',
]);

Route::post('/cards', 'CardController@urlAssigned')->name('urlAssigned');
