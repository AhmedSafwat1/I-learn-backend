<?php

Route::group(['prefix' => 'homeworks', "middleware"=>['auth:api']], function () {
   
   
    Route::group([ 'prefix' => 'student','middleware' => [ "user.type:student"]], function () {
         Route::post("/","HomeWorkController@store");
         Route::post("/{id}","HomeWorkController@update");
         Route::get("/solutions","HomeWorkController@getSolutions");
         
    });

    Route::group(['prefix' => "attachs/{id}"], function () {
        Route::get("download", "HomeWorkController@download" );
        Route::delete("/", "HomeWorkController@deleteAttach" );
    });

    Route::group(['middleware' => [ "user.type:teacher"]], function () {
        Route::post("{id}/solution","HomeWorkController@solution");
    });

  

    Route::get("/","HomeWorkController@index");
    

    Route::get("{id}","HomeWorkController@show");
    

    

});


