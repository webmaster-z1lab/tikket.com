<?php
/**
 * Created by Olimar Ferraz
 * webmaster@z1lab.com.br
 * Date: 05/04/2019
 * Time: 10:50
 */

namespace App\Traits;

use Carbon\Carbon;

trait TicketComposeTrait
{
    /**
     * @param  \stdClass  $ticket
     *
     * @return object
     */
    public function makeTicket($ticket)
    {
        $aux = (object) [];

        $aux->id = $ticket->id;
        $aux->name = $ticket->attributes->name;
        $aux->email = $ticket->attributes->participant->email;
        $aux->lot = $ticket->attributes->lot;
        $aux->order_id = $ticket->attributes->order_id;
        $aux->code = $ticket->attributes->code;
        $aux->status = $ticket->attributes->status;
        $aux->first_owner = $ticket->attributes->first_owner;
        $aux->created_at = Carbon::make($ticket->attributes->created_at);

        $aux->participant = (object) [];
        $aux->participant->name = $ticket->attributes->participant->name;
        $aux->participant->email = $ticket->attributes->participant->email;
        $aux->participant->document = $ticket->attributes->participant->document;

        $aux->event = (object) [];
        $aux->event->name = $ticket->attributes->event->name;
        $aux->event->url = route('event', $ticket->attributes->event->url);
        $aux->event->address = $ticket->attributes->event->address;
        $aux->event->thumbnail = $ticket->attributes->event->image->thumbnail;
        $aux->event->image = $ticket->attributes->event->image->cover;
        $aux->event->starts_at = Carbon::createFromFormat('d/m/Y H:i', $ticket->attributes->event->starts_at);
        $aux->event->finishes_at = Carbon::createFromFormat('d/m/Y H:i', $ticket->attributes->event->finishes_at);

        return $aux;
    }

    /**
     * @return object
     */
    public function ticketStatus()
    {
        $status = (object) [];

        $status->valid = 'valid';
        $status->cancelled = 'cancelled';
        $status->checked_in = 'checked';
        $status->expired = 'expired';

        return $status;
    }
}
