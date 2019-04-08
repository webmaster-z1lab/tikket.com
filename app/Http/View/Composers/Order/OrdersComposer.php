<?php
/**
 * Created by Olimar Ferraz
 * webmaster@z1lab.com.br
 * Date: 05/04/2019
 * Time: 17:58
 */

namespace App\Http\View\Composers\Order;

use App\Services\ApiService;
use App\Traits\OrderComposeTrait;
use Illuminate\View\View;

class OrdersComposer
{
    use OrderComposeTrait;

    /**
     * @param  \Illuminate\View\View  $view
     */
    public function compose(View $view)
    {
        $orders = (new ApiService('orders', 'GET'))->find()->collect();
        //$pastOrders = (new ApiService('orders', 'GET'))->find('', ['query' => 'past=true'])->collect();

        $view->with('orders', $this->instantiate($orders));
        $view->with('status', $this->orderStatus());
        $view->with('channel', $this->orderChannel());
    }

    /**
     * @param $orders
     *
     * @return \Illuminate\Support\Collection
     */
    private function instantiate($orders)
    {
        $collection = collect();

        foreach ($orders as $order) {
            $aux = \Cache::remember("order-{$order->id}", 1, function () use ($order) {
                return $this->makeOrder($order);
            });

            $collection->push($aux);
        }

        return $collection;
    }
}
