<?php

Route::get('', 'HomeController@index')->name('home')->middleware('cors');
Route::get('quem-somos', 'HomeController@about')->name('about');
Route::get('facilidades', 'HomeController@features')->name('features');
Route::get('termos-de-uso', 'HomeController@terms')->name('terms');
Route::get('privacidade-e-cookies', 'HomeController@privacy')->name('privacy');
Route::get('contato', 'HomeController@contact')->name('contact');
Route::get('eventos/{type?}', 'EventController@index')->name('events');
Route::get('criar-evento', 'EventController@create')->name('new-event');
Route::get('evento/{url}', 'EventController@show')->name('event');
Route::get('cart/{vue?}', 'HomeController@cart')->name('cart')->where('vue', '.*')->middleware('auth');

Route::view('usuario/{vue?}', 'user.index')->name('user')->where('vue', '.*')->middleware('auth');
