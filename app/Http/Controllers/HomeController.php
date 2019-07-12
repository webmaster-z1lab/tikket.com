<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        \Meta::set('title', 'A sua plataforma de eventos, inscrições e ingressos');

        return View('home.index');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function about(): View
    {
        \Meta::set('title', 'Sobre o Tikket');

        return view('about.we-are');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function features(): View
    {
        \Meta::set('title', 'A forma mais simples de vender ingressos online');

        return view('coming-soon');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function terms(): View
    {
        \Meta::set('title', 'Termos de uso');

        return view('about.terms');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function privacy(): View
    {
        \Meta::set('title', 'Privacidade e cookies');

        return view('about.privacy');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function contact(): View
    {
        \Meta::set('title', 'Contato e suporte');

        return view('about.contact');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function cart(): View
    {
        \Meta::set('title', 'Carrinho de compras');

        return view('cart.index');
    }
}
