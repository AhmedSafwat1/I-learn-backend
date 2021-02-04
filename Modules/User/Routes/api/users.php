<?php

Route::group(['prefix' => 'user','middleware' => 'auth:api'], function () {

    Route::get('profile' ,  'UserController@profile')->name('api.users.profile');
    Route::post('profile' , 'UserController@updateProfile')->name('api.users.profile');

    Route::post('reset-password' ,  'UserController@resetPassword')->name('api.users.resetPassword');

    Route::post("setting", "UserController@updateSetting");

    Route::post("test-fcm", "UserController@testFcm");
    
    Route::get("notifcations", "UserController@notifications");

    

});



Route::group(['prefix' => 'users'], function () {

    Route::get('/' ,  'UserController@getWorkers')->middleware("countryCode");
 
    

});
