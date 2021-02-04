<?php

Route::group(['prefix' => 'sections'], function () {

    Route::get('/'      , 'SectionController@sections')->name('api.sections.index');
 

    Route::group(["prefix"=>"{id}"], function(){
        // Route::get('/'   , 'SectionController@section')->name('api.sections.show');
    });

    

});
