<article class="bg-light">
    <div class="container space-2 space-md-3">
        <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-9">
            <h1 class="text-primary"><strong>{{ $event->name }}</strong></h1>
            <h6><a href="#map"><i class="fas fa-map-marker-alt mr-1"></i>{{ $address->formatted }}</a></h6>
            <p class="text-dark">{{ $event->starts_at }} - {{ $event->finishes_at }}</p>
        </div>

        <div class="row">
            <div class="col-md-8">
                <h3 class="text-primary"><i class="fas fa-list mr-1"></i>Descrição</h3>
                <hr>
                {!! $event->body !!}
            </div>

            <aside class="col-md-4">
                <div id="map" class="mb-4">
                    <h3 class="text-primary"><i class="fas fa-map-marker-alt mr-1"></i>Local</h3>
                    <hr>

                    <h4 class="h6 text-uppercase">{{ $address->name }}</h4>

                    <div id="GMapTerrain" class="js-g-map embed-responsive embed-responsive-1by1"
                         data-lat="{{ $address->coordinate->location->lat }}"
                         data-lng="{{ $address->coordinate->location->lng }}"
                         data-zoom="15"
                         data-title="{{ $address->name }}"
                         data-pin="true"
                         data-pin-icon="{{ getenv('AWS_CDN_ENDPOINT') }}/template/front/2.0.1/img/map-markers/map-marker6.png"
                         >
                    </div>
                </div>

                <h3 class="text-primary"><i class="fas fa-rocket mr-1"></i>Organizador</h3>
                <hr>
                <h4 class="h6 text-uppercase">{{ $producer->name }}</h4>
                <p>{{ $producer->description }}</p>
            </aside>
        </div>
    </div>
</article>

@push('scripts')
    <script>
        function initMap() {
            $.HSCore.components.HSGMap.init('.js-g-map')
        }
    </script>
    <script src="{{ getenv('AWS_CDN_ENDPOINT') }}/template/front/2.0.2/vendor/gmaps/gmaps.min.js"></script>
    <script src="//maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&callback=initMap" async defer></script>
@endpush
