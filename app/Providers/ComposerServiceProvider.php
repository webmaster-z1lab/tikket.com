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
        View::composer('user.order.index', 'App\Http\View\Composers\Order\OrdersComposer');
        View::composer('user.order.show', 'App\Http\View\Composers\Order\OrderComposer');
        View::composer('user.components.status.order', 'App\Http\View\Composers\Order\StatusComposer');
        View::composer([
            'user.components.status.ticket',
            'user.components.ticket-card',
        ], 'App\Http\View\Composers\Ticket\StatusComposer');
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
