<?php

Route::get('', function () {
    Meta::set('title', 'A sua plataforma de eventos, inscrições e ingressos');

    return view('home.index');
})->name('home');

Route::get('login', function () {
    Meta::set('title', 'Acessar sua conta');

    return view('auth.login');
})->name('login');

Route::get('registro', function () {
    Meta::set('title', 'Criar uma conta');

    return view('auth.register');
})->name('register');

Route::get('recuperar-conta', function () {
    Meta::set('title', 'Recuperar sua conta');

    return view('auth.account-recovery');
})->name('account-recovery');

Route::get('quem-somos', function () {
    Meta::set('title', 'Sobre o Tikket');

    return view('about.we-are');
})->name('about');

Route::get('facilidades', function () {
    Meta::set('title', 'A forma mais simples de vender ingressos online');

    return view('coming-soon');
})->name('features');

Route::get('termos-de-uso', function () {
    Meta::set('title', 'Termos de uso');

    return view('about.terms');
})->name('terms');

Route::get('privacidade-e-cookies', function () {
    Meta::set('title', 'Privacidade e cookies');

    return view('about.privacy');
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

    return view('event.index');
})->name('events');

Route::get('evento', function () {
    Meta::set('title', 'Evento');

    return view('event.show');
})->name('event');

Route::post('evento', function (\Illuminate\Http\Request $request) {
   return response()->json($request->all());
})->name('event.test');



Route::view('user/{vue?}', 'user.index')->name('user')->where('vue', '.*')->middleware('auth');

Route::get('cart/{vue?}', function () {
    Meta::set('title', 'Carrinho');

    return view('cart.index');
})->name('cart')->where('vue', '.*');
