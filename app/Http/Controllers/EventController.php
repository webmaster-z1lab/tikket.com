<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        \Meta::set('title', 'Eventos');

        return View('event.index');
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
        $image = $event->relationships->image->attributes;

        return View('event.show')
            ->with('id', $event->id)
            ->with('image', $image)
            ->with('address', $address)
            ->with('producer', $producer)
            ->with('event', $event->attributes);
    }


}
