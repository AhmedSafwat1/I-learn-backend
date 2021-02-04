<?php

Route::group(['prefix' => 'subejcts'], function () {
    Route::get('/', 'SubjectController@index');
});
