@extends('layouts.default')

@section('content')
    <div class="space-top-2 space-top-sm-3 d-print-none"></div>
    @include('user.components.breadcrumb-section', ['page' => 'Detalhes do pedido'])

    <div class="container space-2">
        <div class="d-none d-print-block">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="text-primary font-weight-bold"><i class="fas fa-ticket-alt mr-1"></i>Tikket</h2>
                    <p>A sua plataforma de eventos!</p>
                </div>

                <div class="col-sm-6 text-right">
                    <ul class="list-unstyled">
                        <li class="mb-1"><i class="fas fa-globe mr-1"></i> https://tikket.com.br</li>
                        <li class="mb-1"><i class="fas fa-envelope mr-1"></i> contato@tikket.com.br</li>
                        <li class="mb-1"><i class="fab fa-whatsapp mr-1"></i> (31) 99715-0447</li>
                    </ul>
                </div>
            </div>
            <hr>
        </div>

        <h1 class="h4 text-truncate">Pedido REF: <span class="text-uppercase">{{ $order->code }}</span></h1>
        <h2 class="h4 text-truncate"><i class="fas fa-rocket mr-1"></i><a href="{{ route('event', $order->event->url) }}" class="text-uppercase">{{ $order->event->name }}</a></h2>
        <hr>

        <div class="card card-frame-highlighted">
            <div class="card-body">
                <div class="row justify-content-md-between mb-7">
                    <div class="col-md-5 col-lg-4">
                        <h3 class="h5">Comprador:</h3>
                        <span class="d-block">{{ $order->costumer->name }}</span>
                        <span class="text-secondary mb-0 d-block">{{ $order->costumer->email }}</span>
                        <span class="text-secondary mb-0 d-block">{{ $order->costumer->document }} <i class="fas fa-info-circle ml-1" data-toggle="tooltip"
                                                                                                      title="Dados ocultados por segurança"></i></span>
                        <span class="text-secondary mb-0 d-block">{{ $order->costumer->phone->formatted }}</span>
                    </div>

                    <div class="col-md-5 col-lg-4 mt-4 mt-sm-0">
                        <h3 class="h5">Forma de pagamento:</h3>
                        @if(NULL !== $order->card)
                            <span class="d-block text-uppercase">@include('user.components.credit-card', ['card' => $order->card]) CC {{ $order->card->brand }}</span>
                            <span class="d-block text-uppercase">**** **** **** {{ $order->card->number }}</span>
                            <span class="text-secondary mb-0 d-block">{{ $order->card->holder->name }}</span>
                            <span class="text-primary font-weight-bold mb-0 d-block">{{ $order->card->installments }}x de {{ money($order->card->parcel, 'BRL') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mr-4 mb-7 pl-4" style="border-left: 3px solid #6000A7">
                    <dl class="row mb-0">
                        <dt class="col-sm-6 font-weight-normal text-secondary">Data do pedido:</dt>
                        <dd class="col-sm-6 font-weight-medium">{{ $order->created_at->format('d/m/Y H\hi') }}</dd>
                    </dl>
                    <dl class="row mb-0">
                        <dt class="col-sm-6 font-weight-normal text-secondary">Última atualização:</dt>
                        <dd class="col-sm-6 font-weight-medium">{{ $order->updated_at->format('d/m/Y H\hi') }}</dd>
                    </dl>
                    <dl class="row mb-0">
                        <dt class="col-sm-6 font-weight-normal text-secondary">Situação:</dt>
                        <dd class="col-sm-6 font-weight-medium">
                            @include('user.components.status.order')
                        </dd>
                    </dl>
                </div>

                <table class="table table-heighlighted font-size-1 mb-9">
                    <thead>
                    <tr class="text-uppercase text-secondary">
                        <th scope="col" class="font-weight-medium">Entrada</th>
                        <th scope="col" class="font-weight-medium">Lote</th>
                        <th scope="col" class="font-weight-medium">Doc. Titular</th>
                        <th scope="col" class="font-weight-medium text-right">Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->bag as $item)
                        <tr>
                            <th scope="row" class="font-weight-normal">{{ $item->entrance }}</th>
                            <td>{{ $item->lot }}</td>
                            <td>{{ $item->document }}</td>
                            <td class="text-right">{{ money($item->price, 'BRL') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr class="text-danger">
                        <td>Descontos</td>
                        @if(isset($order->coupon))
                            <td colspan="2">Cupom: {{ $order->coupon->code }}</td>
                            <td class="text-right">{{ money($order->discount, 'BRL') }}</td>
                        @else
                            <td colspan="3" class="text-right">{{ money($order->discount, 'BRL') }}</td>
                        @endif
                    </tr>
                    <tr>
                        <td>Subtotal</td>
                        <td colspan="3" class="text-right">{{ money($order->price, 'BRL') }}</td>
                    </tr>
                    <tr class="h6 text-primary">
                        <td>Total</td>
                        <td colspan="3" class="text-right">{{ money(($order->card->parcel * $order->card->installments), 'BRL') }}</td>
                    </tr>
                    </tfoot>
                </table>

                <p class="font-size-1">
                    Pedido realizado em {{ $order->created_at->format('d/m/Y H\hi') }} no canal de vendas
                    {{ $order->channel }} utilizando o IP de acesso
                    <a class="link-muted" target="_blank" href="https://whatismyip.com.br/?query={{ $order->ip }}">{{ $order->ip }}</a>.
                </p>

                <img class="img-responsive img-fluid mt-4" src="data:image/png;base64,{{ DNS2D::getBarcodePNG($order->pdf417, "PDF417", 10, 3) }}"
                     alt="Ingresso código {{ $order->code }}">
            </div>
        </div>

        <div class="row d-print-none mt-4">
            <div class="col-12">
                <button type="button" class="btn btn-primary btn-lg" onclick="window.print();return false;">
                    <i class="fas fa-print mr-1"></i>Imprimir
                </button>
            </div>
        </div>

        @if(isset($order->tickets))
            <div class="card card-frame-highlighted mt-4 d-print-none">
                <div class="card-body">
                    <h3 class="card-title">Ingressos</h3>
                    <table class="table table-heighlighted font-size-1 mb-9">
                        <thead>
                        <tr class="text-uppercase text-secondary">
                            <th scope="col" class="font-weight-medium">Código</th>
                            <th scope="col" class="font-weight-medium">Entrada</th>
                            <th scope="col" class="font-weight-medium">Lote</th>
                            <th scope="col" class="font-weight-medium text-right">Doc. Titular</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->tickets as $ticket)
                            <tr>
                                <th scope="row" class="font-weight-normal"><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->attributes->code }}</a></th>
                                <td>{{ $ticket->attributes->name }}</td>
                                <td>{{ $ticket->attributes->lot }}</td>
                                <td class="text-right">{{ $ticket->attributes->participant->document }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('onready')
    $('[data-toggle="tooltip"]').tooltip();
@endpush
