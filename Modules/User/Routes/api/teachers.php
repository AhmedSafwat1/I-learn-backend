<?php

Route::group(['prefix' => 'teachers'], function () {

   Route::get("/","TeacherController@index");
   Route::get("/{id}","TeacherController@show");
    

});




