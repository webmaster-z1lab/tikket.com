<?php
/**
 * Created by Olimar Ferraz
 * webmaster@z1lab.com.br
 * Date: 25/02/2019
 * Time: 16:57
 */

namespace App\Http\View\Composers\Event;


use Akaunting\Money\Money;
use App\Services\ApiService;
use Carbon\Carbon;
use Illuminate\View\View;

class CartComposer
{
    protected $status;

    public function __construct()
    {
        $this->status = (object)[];

        $this->status->open = 'open';
        $this->status->soon = 'soon';
        $this->status->unavailable = 'unavailable';
        $this->status->sold_out = 'sold_out';
    }

    /**
     * @param \Illuminate\View\View $view
     */
    public function compose(View $view)
    {
        $entrances = (new ApiService('events', 'GET'))->findRelationship($view->getData()['id'], 'entrances')->collect();

        $entrances = $this->instantiate($entrances);

        $view->with('status', $this->status);
        $view->with('entrances', $entrances);
    }

    /**
     * @param \stdClass $entrances
     *
     * @return \Illuminate\Support\Collection
     */
    private function instantiate($entrances)
    {
        $collection = collect();

        foreach ($entrances as $entrance) {
            $aux = (object)[];

            $aux->id = $entrance->id;
            $aux->name = $entrance->attributes->name;
            $aux->min_buy = $entrance->attributes->min_buy;
            $aux->max_buy = $entrance->attributes->max_buy;
            $aux->description = $entrance->attributes->description;
            $aux->is_free = $entrance->attributes->is_free;

            $aux->fee = Money::BRL($entrance->attributes->lot->fee)->format();
            $aux->price = Money::BRL($entrance->attributes->lot->price)->format();
            $aux->value = Money::BRL($entrance->attributes->lot->value)->format();

            $aux->starts_at = Carbon::make($entrance->attributes->lot->starts_at);
            $aux->finishes_at = Carbon::make($entrance->attributes->lot->finishes_at);

            $aux->lot = isset($entrance->attributes->lot) ? $entrance->attributes->lot : NULL;
            $aux->status = $this->checkStatus($aux);

            $collection->push($aux);
        }

        return $collection;
    }

    /**
     * @param \stdClass $entrance
     *
     * @return string
     */
    private function checkStatus($entrance)
    {
        if (NULL === $entrance->lot) return $this->status->unavailable;
        if ($entrance->starts_at > now()) return $this->status->soon;
        if (now()->between($entrance->starts_at, $entrance->finishes_at)) return $this->status->open;

        return $this->status->sold_out;
    }
}
