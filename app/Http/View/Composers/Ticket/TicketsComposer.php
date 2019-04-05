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

        $view->with('tickets', $this->instantiate($tickets));
        $view->with('status', $this->ticketStatus());
    }

    /**
     * @param $tickets
     *
     * @return \Illuminate\Support\Collection
     */
    private function instantiate($tickets)
    {
        $collection = collect();

        foreach ($tickets as $ticket) {
            $ticket = \Cache::remember("ticket-{$ticket->id}", 2, function () use ($ticket) {
                return $this->makeTicket($ticket);
            });

            $collection->push($ticket);
        }

        return $collection;
    }
}
