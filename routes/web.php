<?php

Route::get('', 'HomeController@index')->name('home')->middleware('cors');
Route::get('quem-somos', 'HomeController@about')->name('about');
Route::get('facilidades', 'HomeController@features')->name('features');
Route::get('termos-de-uso', 'HomeController@terms')->name('terms');
Route::get('privacidade-e-cookies', 'HomeController@privacy')->name('privacy');
Route::get('contato', 'HomeController@contact')->name('contact');
Route::get('eventos', 'EventController@index')->name('events');
Route::get('evento/{url}', 'EventController@show')->name('event');
Route::get('cart/{vue?}', 'HomeController@cart')->name('cart')->where('vue', '.*')->middleware('auth');

Route::view('usuario/{vue?}', 'user.index')->name('user')->where('vue', '.*')->middleware('auth');

Route::middleware('auth')
    ->prefix('meus-ingressos')
    ->group(function () {
        Route::get('/', 'TicketController@index')->name('tickets');
        Route::get('{ticket}', 'TicketController@show')->name('tickets.show');
    });

Route::middleware('auth')
    ->prefix('meus-pedidos')
    ->group(function () {
        Route::get('/', 'OrderController@index')->name('orders');
        Route::get('{event}', 'OrderController@show')->name('orders.show');
    });


