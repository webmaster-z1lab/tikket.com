<div class="container space-lg-3 space-2">
    <div class="card-deck card-sm-gutters-1 d-block d-sm-flex">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center border-bottom">Eventos em destaque</h3>
            </div>

            @foreach($featured as $event)
                <div class="col-12 col-md-6 col-lg-4 mt-4">
                    <a href="{{ route('event', $event->attributes->url) }}" class="card mb-3">
                        <img class="card-img-top" src="{{ $event->attributes->cover }}" alt="{{ $event->attributes->name }}">

                        <div class="card-footer py-0">
                            <div class="my-2">
                                <h4 class="mb-0 h6">{{ $event->attributes->name }}</h4>
                            </div>
                            <hr class="mt-0 mb-2">
                            <div class="row align-items-center mb-2">
                                <div class="col-3 u-ver-divider text-center">
                                    <h5 class="text-primary mb-0">{{ $event->attributes->day }}</h5>
                                    <span class="align-middle text-uppercase">{{ $event->attributes->month }}</span>
                                </div>
                                <div class="col-9 text-left">
                                    <h5 class="small mb-0">{{ $event->attributes->producer }}</h5>
                                    <small class="far fa-clock text-secondary align-middle mr-1"></small>
                                    <span class="small align-middle mr-1" style="font-size: 75%">{{ $event->attributes->hour }}</span>
                                    <small class="fas fa-map-marker-alt text-secondary align-middle mr-1"></small>
                                    <span class="small align-middle" style="font-size: 75%">{{ $event->attributes->address }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

