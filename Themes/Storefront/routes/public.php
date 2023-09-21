<?php

Route::get('products/{slug}/quick-view', 'ProductQuickViewController@show')->name('products.quick_view.show');
Route::post('products/upload-design', 'ProductQuickViewController@uploadCustomDesign')->name('product.upload-custom-design');