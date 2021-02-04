<?php


Route::get('/', function() {
    App::abort(404, 'message');
})->name("frontend.home");
