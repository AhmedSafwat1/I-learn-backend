<?php

Route::group(['prefix' => 'categories'], function () {

    Route::get('/'  , 'CategoryController@categories');

    Route::get('/{id}/users'  , 'CategoryController@users')->middleware("countryCode");

});
