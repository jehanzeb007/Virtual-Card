<?php

/*Crons Start*/
Route::get('crons/cron-send-orders', 'AccountProfileController@cronSendOrders')->name('cron.sendOrders');
/*Crons End*/

Route::get('u/{username}', 'AccountProfileController@view')->name('account.profile.view');
Route::get('account/vcard/{username}', 'AccountProfileController@generateVcard')->name('account.profile.generateVcard');


Route::get('bar_codes/{file}', 'AccountProfileController@bar_codes_url_fix')->name('account.bar_codes');

Route::middleware('auth')->group(function () {
    Route::get('account', 'AccountDashboardController@index')->name('account.dashboard.index');

    Route::get('account/profile', 'AccountProfileController@edit')->name('account.profile.edit');
    Route::put('account/profile', 'AccountProfileController@update')->name('account.profile.update');

    Route::get('account/profile-password', 'AccountProfileController@updatePassword')->name('account.profile.updatePassword');

    Route::get('account/orders', 'AccountOrderController@index')->name('account.orders.index');
    Route::get('account/orders/{id}', 'AccountOrderController@show')->name('account.orders.show');

    Route::get('account/wishlist', 'AccountWishlistController@index')->name('account.wishlist.index');
    Route::delete('account/wishlist/{productId}', 'AccountWishlistController@destroy')->name('account.wishlist.destroy');

    Route::get('account/reviews', 'AccountReviewController@index')->name('account.reviews.index');
    Route::post('account/profile/update-image','AccountProfileController@uploadUserImage')->name('uploadUserImage');
    Route::post('account/profile/update-company-image','AccountProfileController@uploadCompImage')->name('uploadCompImage');

    Route::post('account/profile/remove-image','AccountProfileController@removeUserImage')->name('removeUserImage');
    Route::post('account/profile/remove-company-image','AccountProfileController@removeCompanyImage')->name('removeCompanyImage');
});
