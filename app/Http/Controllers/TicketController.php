<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        \Meta::set('title', 'Meus ingressos');

        return View('user.ticket.index');
    }

    /**
     * @param  string  $ticket
     *
     * @return \Illuminate\View\View
     */
    public function show(string $ticket): View
    {
        \Meta::set('title', 'Ingresso #' . $ticket);

        return View('user.ticket.show')->with('id', $ticket);
    }
}
