<?php

namespace App\Http\Controllers;

class OrderController extends Controller
{
    public function index()
    {
        \Meta::set('title', 'Meus pedidos');

        return View('user.order.index');
    }

    public function show(string $order)
    {
        \Meta::set('title', "Pedido #$order");

        return View('user.order.show')->with('id', $order);
    }
}
