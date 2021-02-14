<?php

Route::group(['prefix' => 'lessons', "middleware"=>['auth:api']], function () {
   
   
    Route::group([ 'prefix' => 'student','middleware' => [ "user.type:student"]], function () {
         Route::post("/","LessonController@store");
         Route::post("/{id}","LessonController@update");
         
         
    });

   
    Route::group(['middleware' => [ "user.type:teacher"]], function () {
      
    });

  

    Route::get("/running","LessonController@running");
    Route::get("/previous","LessonController@previous");
    Route::get("/in-comming","LessonController@incomming");
    

    Route::get("{id}","LessonController@show");
    

    

});


