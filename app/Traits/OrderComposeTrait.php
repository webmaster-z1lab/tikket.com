<?php
/**
 * Created by Olimar Ferraz
 * webmaster@z1lab.com.br
 * Date: 08/04/2019
 * Time: 10:57
 */

namespace App\Traits;


use Carbon\Carbon;

trait OrderComposeTrait
{
    public function makeOrder($order)
    {
        $aux = (object) [];

        $aux->id = $order->id;
        $aux->code = $order->attributes->code;
        $aux->status = $order->attributes->status;
        $aux->price = $order->attributes->amount;
        $aux->discount = $order->attributes->discount;
        $aux->channel = $order->attributes->channel;
        $aux->created_at = Carbon::createFromFormat('d/m/Y H:i', $order->attributes->created_at);
        $aux->updated_at = Carbon::make($order->attributes->updated_at);

        $aux->event = (object) [];

        $aux->event->id = $order->attributes->event->id;
        $aux->event->name = $order->attributes->event->name;
        $aux->event->url = $order->attributes->event->url;

        if (NULL !== $order->attributes->ip) $aux->ip = $order->attributes->ip;
        if (NULL !== $order->attributes->type) $aux->type = $order->attributes->type;
        if (NULL !== $order->attributes->tickets) $aux->bag = $order->attributes->tickets;
        if (NULL !== $order->attributes->customer) $aux->customer = $order->attributes->customer;
        if (isset($order->relationships->coupon)) $aux->coupon = $order->relationships->coupon;
        if (isset($order->relationships->actual_tickets)) $aux->tickets = $order->relationships->actual_tickets;

        if ($aux->type === 'credit_card' && NULL !== $order->attributes->card) {
            $aux->card = $order->attributes->card;
            $aux->card->amount = $aux->card->parcel * $aux->card->installments;
            $aux->card->taxes = $aux->card->amount - $aux->price;
        }

        if ($aux->type === 'boleto' && NULL !== $order->attributes->boleto) {
            $aux->boleto = $order->attributes->boleto;
            $aux->boleto->expired = now()->startOfDay()->greaterThan(Carbon::createFromFormat('d/m/Y', $aux->boleto->due_at));
        }

        $aux->pdf417 = $this->getPdf417Data($aux);

        return $aux;
    }

    /**
     * @return object
     */
    public function orderStatus()
    {
        $status = (object) [];

        $status->waiting = 'waiting';
        $status->paid = 'paid';
        $status->canceled = 'canceled';
        $status->reversed = 'reversed';

        return $status;
    }

    /**
     * @return object
     */
    public function orderChannel()
    {
        $channel = (object) [];

        $channel->online = 'online';
        $channel->pdv = 'pdv';
        $channel->admin = 'admin';

        return $channel;
    }

    /**
     * @param $order
     *
     * @return string
     */
    private function getPdf417Data($order)
    {
        $string = "CODE: ".$order->code.PHP_EOL;
        $string .= "COMPRADOR: ".$order->customer->name.PHP_EOL;
        $string .= "DOCUMENTO: ".$order->customer->document.PHP_EOL;
        $string .= "DESCONTOS: ".\Akaunting\Money\Money::BRL($order->discount).PHP_EOL;
        $string .= "TOTAL: ".\Akaunting\Money\Money::BRL($order->price).PHP_EOL;
        $string .= "CANAL: ".$order->channel.PHP_EOL;
        $string .= "EMISSÃO: ".$order->created_at->format('d/m/Y H\hi').PHP_EOL;
        $string .= "EVENTO: ".$order->event->name.PHP_EOL;
        $string .= "TIPO: ".$order->type.PHP_EOL;
        $string .= "STATUS: ".__('status.order.'.$order->status).PHP_EOL;
        $string .= "REF: ".$order->id.PHP_EOL;
        $string .= "REF EVENTO: ".$order->event->id.PHP_EOL;

        return $string;
    }
}
