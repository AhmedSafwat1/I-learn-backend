<?php

Route::group(['prefix' => 'contacts'], function () {

  	Route::get('/' ,'ContactController@index')
  	->name('dashboard.contact.index')
    ->middleware(['permission:show_contact']);

  	Route::get('datatable'	,'ContactController@datatable')
  	->name('dashboard.contact.datatable')
  	->middleware(['permission:show_contact']);

  

  	Route::delete('{id}'	,'ContactController@destroy')
  	->name('dashboard.contact.destroy')
    ->middleware(['permission:delete_contact']);

  	Route::get('deletes'	,'ContactController@deletes')
  	->name('dashboard.contact.deletes')
    ->middleware(['permission:delete_contact']);

  
	
	

});
