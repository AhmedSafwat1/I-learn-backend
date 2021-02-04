<?php

Route::group(['prefix' => 'subjects'], function () {

  	Route::get('/' ,'SubjectController@index')
  	->name('dashboard.subjects.index')
    ->middleware(['permission:show_subjects']);

  	Route::get('datatable'	,'SubjectController@datatable')
  	->name('dashboard.subjects.datatable')
  	->middleware(['permission:show_subjects']);

  	Route::get('create'		,'SubjectController@create')
  	->name('dashboard.subjects.create')
    ->middleware(['permission:add_subjects']);

  	Route::post('/'			,'SubjectController@store')
  	->name('dashboard.subjects.store')
    ->middleware(['permission:add_subjects']);

  	Route::get('{id}/edit'	,'SubjectController@edit')
  	->name('dashboard.subjects.edit')
    ->middleware(['permission:edit_subjects']);

  	Route::put('{id}'		,'SubjectController@update')
  	->name('dashboard.subjects.update')
    ->middleware(['permission:edit_subjects']);

  	Route::delete('{id}'	,'SubjectController@destroy')
  	->name('dashboard.subjects.destroy')
    ->middleware(['permission:delete_subjects']);

  	Route::get('deletes'	,'SubjectController@deletes')
  	->name('dashboard.subjects.deletes')
    ->middleware(['permission:delete_subjects']);

  	Route::get('{id}','SubjectController@show')
  	->name('dashboard.subjects.show')
    ->middleware(['permission:show_subjects']);

});
