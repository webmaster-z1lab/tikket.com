<?php

Route::get('/', function () {
    Meta::set('title', 'A sua plataforma de eventos, inscrições e ingressos');

    return view('home.index');
})->name('home');

Route::get('login', function () {
    Meta::set('title', 'Entrar na conta Tikket');

    return view('coming-soon');
})->name('login');

Route::get('registro', function () {
    Meta::set('title', 'Criar uma conta Tikket');

    return view('coming-soon');
})->name('register');

Route::get('quem-somos', function () {
    Meta::set('title', 'Sobre o Tikket');

    return view('coming-soon');
})->name('about');

Route::get('facilidades', function () {
    Meta::set('title', 'A forma mais simples de vender ingressos online');

    return view('coming-soon');
})->name('features');

Route::get('termos-de-uso', function () {
    Meta::set('title', 'Termos de uso');

    return view('coming-soon');
})->name('terms');

Route::get('privacidade-e-cookies', function () {
    Meta::set('title', 'Privacidade e cookies');

    return view('coming-soon');
})->name('privacy');

Route::get('contato', function () {
    Meta::set('title', 'Contato e suporte');

    return view('about.contact');
})->name('contact');

Route::get('criar-evento', function () {
    Meta::set('title', 'Criar evento');

    return view('coming-soon');
})->name('new-event');

Route::get('eventos/{type?}', function () {
    Meta::set('title', 'Eventos');

    return view('coming-soon');
})->name('events');
