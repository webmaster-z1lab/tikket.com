<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('event.components.cart', 'App\Http\View\Composers\Event\CartComposer');
        View::composer('user.ticket.index', 'App\Http\View\Composers\Ticket\TicketsComposer');
        View::composer('user.ticket.show', 'App\Http\View\Composers\Ticket\TicketComposer');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
