<?php

namespace App\Http\Controllers;

class OrderController extends Controller
{
    public function index()
    {
        return View('user.order.index');
    }

    public function show(string $order)
    {
        return View('user.order.show')->with('id', $order);
    }
}
