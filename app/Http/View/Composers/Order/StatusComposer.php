<?php
/**
 * Created by Olimar Ferraz
 * webmaster@z1lab.com.br
 * Date: 08/04/2019
 * Time: 15:18
 */

namespace App\Http\View\Composers\Order;

use App\Traits\OrderComposeTrait;
use Illuminate\View\View;

class StatusComposer
{
    use OrderComposeTrait;

    /**
     * @param  \Illuminate\View\View  $view
     */
    public function compose(View $view)
    {
        $view->with('status', $this->orderStatus());
    }

}
