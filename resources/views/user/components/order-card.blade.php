<div class="card card-frame card-frame-highlighted mb-4">
    <div class="card-body p-5">
        <div class="row">
            <div class="col-sm-8 mb-4 mb-sm-0">
                <h3 class="h6">
                    <a class="text-primary text-uppercase" href="{{ route('orders.show', $order->id) }}">REF: {{ $order->code }}</a>
                </h3>

                <div class="font-size-1">
                    <span class="mr-4">
                        <i class="fab fa-cc-{{ $order->card->brand }} mr-1"></i> <span class="text-uppercase">{{ $order->card->brand }}</span> **** {{ $order->card->number }}
                    </span>

                    <span>
                        <i class="fas fa-calendar-alt mr-1"></i> {{ $order->created_at->format('d/m/Y H:i') }}
                    </span>
                </div>

                <div class="font-size-1">
                    <span>
                        <i class="fas fa-ticket-alt mr-1"></i> <a href="{{ route('event', $order->event->url) }}" class="text-truncate">{{ $order->event->name }}</a>
                    </span>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="d-sm-flex align-items-sm-end">
                    <div class="u-ver-divider u-ver-divider--none-sm pr-4 mb-3 mb-sm-0 mr-4">
                        <h4 class="small font-weight-normal text-secondary mb-0">Situação</h4>
                        @include('user.components.status.order')
                    </div>

                    <div class="mr-4">
                        <a class="btn btn-primary btn-sm" href="{{ route('orders.show', $order->id) }}">
                            <i class="far fa-list-alt mr-1"></i>Detalhes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
