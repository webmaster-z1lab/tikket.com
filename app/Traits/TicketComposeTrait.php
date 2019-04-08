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
        $aux->issue = now()->format('d/m/Y H:i:s');

        $aux->status = $ticket->attributes->status;
        $aux->first_owner = $ticket->attributes->first_owner;
        $aux->created_at = Carbon::make($ticket->attributes->created_at);

        $aux->participant = (object) [];
        $aux->participant->name = $ticket->attributes->participant->name;
        $aux->participant->email = $ticket->attributes->participant->email;
        $aux->participant->document = $ticket->attributes->participant->document;

        $aux->event = (object) [];
        $aux->event->id = $ticket->attributes->event->id;
        $aux->event->name = $ticket->attributes->event->name;
        $aux->event->url = route('event', $ticket->attributes->event->url);
        $aux->event->address = $ticket->attributes->event->address;
        $aux->event->thumbnail = $ticket->attributes->event->image->thumbnail;
        $aux->event->image = $ticket->attributes->event->image->cover;
        $aux->event->starts_at = Carbon::createFromFormat('d/m/Y H:i', $ticket->attributes->event->starts_at);
        $aux->event->finishes_at = Carbon::createFromFormat('d/m/Y H:i', $ticket->attributes->event->finishes_at);

        $aux->pdf417 = $this->getPdf417Data($aux);
        $aux->qrcode = $this->getQrCode($aux);

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

    /**
     * @param $ticket
     *
     * @return string
     */
    private function getPdf417Data($ticket)
    {
        $string = "CODE: ".$ticket->code.PHP_EOL;
        $string .= "NOME: ".$ticket->participant->name.PHP_EOL;
        $string .= "DOCUMENTO: ".$ticket->participant->document.PHP_EOL;
        $string .= "DATA: ".$ticket->event->starts_at->format('d/m/Y H\hi').PHP_EOL;
        $string .= "E. INGRESSO: ".$ticket->created_at->format('d/m/Y H\hi').PHP_EOL;
        $string .= "E. DOC: ".$ticket->issue;
        $string .= "EVENTO: ".$ticket->event->name.PHP_EOL;
        $string .= "ENTRADA: ".$ticket->name.PHP_EOL;
        $string .= "LOTE: ".$ticket->lot.PHP_EOL;
        $string .= "STATUS: ".__('status.ticket.'.$ticket->status).PHP_EOL;
        $string .= "REF: ".$ticket->id.PHP_EOL;
        $string .= "REF PEDIDO: ".$ticket->order_id.PHP_EOL;
        $string .= "REF EVENTO: ".$ticket->event->id.PHP_EOL;

        return $string;
    }

    /**
     * @param $ticket
     *
     * @return bool|string
     */
    private function getQrCode($ticket)
    {
        return password_hash($ticket->id, PASSWORD_DEFAULT);
    }
}
