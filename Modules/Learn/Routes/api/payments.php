<?php

Route::group(['prefix' => 'payment'], function () {
    Route::get('/success', 'PaymentController@success')->name("api.payment.success");
    Route::get('/failed', 'PaymentController@failed')->name("api.payment.failed");
});

