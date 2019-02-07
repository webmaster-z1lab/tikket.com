<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * @param string $type
     *
     * @return \Illuminate\View\View
     */
    public function index(string $type = ''): View
    {
        \Meta::set('title', 'Eventos');

        return View('event.index');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        \Meta::set('title', 'Criar evento');

        return View('coming-soon');
    }

    /**
     * @param string $url
     *
     * @return \Illuminate\View\View
     */
    public function show(string $url): View
    {
        $event = (new ApiService('events', 'GET'))->find($url)->collect();

        \Meta::set('title', $event->attributes->name);
        \Meta::set('description', $event->attributes->description);

        $address = $event->attributes->address;
        $producer = $event->relationships->producer->attributes;

        unset($event->attributes->address);
        unset($event->attributes->producer);

        return View('event.show')
            ->with('id', $event->id)
            ->with('address', $address)
            ->with('producer', $producer)
            ->with('entrances', $event->relationships->entrances)
            ->with('event', $event->attributes);
    }


}
