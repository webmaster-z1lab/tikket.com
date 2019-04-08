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
        $aux->status = $order->attributes->status;
        $aux->price = $order->attributes->amount + $order->attributes->fee;
        $aux->discount = $order->attributes->discount;
        $aux->channel = $order->attributes->channel;
        $aux->created_at = Carbon::createFromFormat('d/m/Y H:i', $order->attributes->created_at);
        $aux->updated_at = Carbon::make($order->attributes->updated_at);

        $aux->event = (object) [];

        $aux->event->id = $order->attributes->event->id;
        $aux->event->name = $order->attributes->event->name;
        $aux->event->url = $order->attributes->event->url;

        if (NULL !== $order->attributes->card) $aux->card = $order->attributes->card;
        if (NULL !== $order->attributes->tickets) $aux->tickets = $order->attributes->tickets;

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
}
