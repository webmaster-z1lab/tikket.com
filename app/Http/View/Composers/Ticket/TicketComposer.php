<?php
/**
 * Created by Olimar Ferraz
 * webmaster@z1lab.com.br
 * Date: 05/04/2019
 * Time: 10:39
 */

namespace App\Http\View\Composers\Ticket;

use App\Services\ApiService;
use App\Traits\TicketComposeTrait;
use Illuminate\View\View;

class TicketComposer
{
    use TicketComposeTrait;

    /**
     * @param  \Illuminate\View\View  $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $id = $view->getData()['id'];

        (\Cache::has("ticket-$id"))
            ? $ticket = \Cache::get("ticket-$id")
            : $ticket = $this->makeTicket((new ApiService('tickets', 'GET'))->find($id)->collect());

        $view->with('ticket', $ticket);
        $view->with('status', $this->ticketStatus());
    }
}
