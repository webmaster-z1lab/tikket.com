<div class="card card-frame card-frame-highlighted mb-4">
    <div class="card-body p-5">
        <div class="d-sm-flex">
            <a href="{{ route('tickets.show', $ticket->id) }}" class="u-lg-avatar mb-3 mb-sm-0 mr-3">
                <img class="img-fluid img-thumbnail" src="{{ $ticket->event->thumbnail }}" alt="Image Description">
            </a>

            <div class="mr-3">
                <div class="mb-3">
                    <h3 class="h5 mb-1"><a class="text-primary text-capitalize" href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->event->name }}</a></h3>
                    <div class="font-size-1 mb-2">
                        <span class="mr-4"><i class="fas fa-ticket-alt mr-1"></i> {{ $ticket->name }} - Lote {{ $ticket->lot }}</span>
                        <span><i class="fas fa-calendar-alt mr-1"></i> {{ $ticket->event->starts_at->format('d/m/Y') }}</span>
                    </div>

                    <p class="font-size-1"><i class="fas fa-map-marker-alt mr-1"></i> {{ $ticket->event->address }}</p>
                </div>

                <div class="d-sm-flex align-items-sm-center">
                    <div class="u-ver-divider u-ver-divider--none-sm pr-4 mb-3 mb-sm-0 mr-4">
                        <h4 class="small font-weight-normal text-secondary mb-0">Situação</h4>
                        <span class="fas fa-circle text-success small"></span>
                        <span class="text-dark">{{ __($ticket->status) }}</span>
                    </div>

                    @if($ticket->status === $status->valid)
                        <div class="mr-4">
                            <a href="{{ route('tickets.show', $ticket->id) }}">
                                <span class="fas fa-print text-primary"></span>
                                <span class="text-primary">Imprimir</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
