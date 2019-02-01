<article class="bg-light">
    <div class="container space-2 space-md-3">
        <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-9">
            <h1 class="text-primary">{{ $event->name }}</h1>
            <p class="text-dark">{{ $event->starts_at }} - {{ $event->finishes_at }}</p>
        </div>

        <div class="row">
            <div class="col-sm-8">
                <h3>Descrição</h3>

                {!! $event->body !!}
            </div>
        </div>
    </div>
</article>
