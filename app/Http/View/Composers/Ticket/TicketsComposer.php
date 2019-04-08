<?php
/**
 * Created by Olimar Ferraz
 * webmaster@z1lab.com.br
 * Date: 04/04/2019
 * Time: 19:06
 */

namespace App\Http\View\Composers\Ticket;

use App\Services\ApiService;
use App\Traits\TicketComposeTrait;
use Illuminate\View\View;


class TicketsComposer
{
    use TicketComposeTrait;

    /**
     * @param \Illuminate\View\View $view
     */
    public function compose(View $view)
    {
        $tickets = (new ApiService('tickets', 'GET'))->find()->collect();

        $collection = collect();

        foreach ($tickets as $ticket) {
            $aux = \Cache::remember("ticket-{$ticket->id}", 1, function () use ($ticket) {
                return $this->makeTicket($ticket);
            });

            $collection->push($aux);
        }

        $view->with('tickets', $collection->where('status', $this->ticketStatus()->valid));
        $view->with('others', $collection->whereNotIn('status', $this->ticketStatus()->valid));
        $view->with('status', $this->ticketStatus());
    }
}
