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

class OrderComposer
{
    use OrderComposeTrait;

    /**
     * @param  \Illuminate\View\View  $view
     */
    public function compose(View $view)
    {
        $id = $view->getData()['id'];

        $order = (\Cache::has("order-$id"))
            ? \Cache::get("order-$id")
            : $this->makeOrder((new ApiService('orders', 'GET'))->find($view->getData()['id'])->collect());

        $view->with('order', $order);
        $view->with('status', $this->orderStatus());
        $view->with('channel', $this->orderChannel());
    }
}
