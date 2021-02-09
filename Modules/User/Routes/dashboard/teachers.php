<?php

Route::group(['prefix' => 'teachers'], function () {

  	Route::get('/' ,'TeacherController@index')
  	->name('dashboard.teachers.index')
    ->middleware(['permission:show_teachers']);

  	Route::get('datatable'	,'TeacherController@datatable')
  	->name('dashboard.teachers.datatable')
  	->middleware(['permission:show_teachers']);

  	Route::get('create'		,'TeacherController@create')
  	->name('dashboard.teachers.create')
    ->middleware(['permission:add_teachers']);

  	Route::post('/'			,'TeacherController@store')
  	->name('dashboard.teachers.store')
    ->middleware(['permission:add_teachers']);

  	Route::get('{id}/edit'	,'TeacherController@edit')
  	->name('dashboard.teachers.edit')
    ->middleware(['permission:edit_teachers']);

  	Route::put('{id}'		,'TeacherController@update')
  	->name('dashboard.teachers.update')
    ->middleware(['permission:edit_teachers']);

  	Route::delete('{id}'	,'TeacherController@destroy')
  	->name('dashboard.teachers.destroy')
    ->middleware(['permission:delete_teachers']);

  	Route::get('deletes'	,'TeacherController@deletes')
  	->name('dashboard.teachers.deletes')
    ->middleware(['permission:delete_teachers']);

  	Route::get('{id}','TeacherController@show')
  	->name('dashboard.teachers.show')
    ->middleware(['permission:show_teachers']);

});
