@extends('layouts.default')


@section('content')
    <div class="space-top-2 space-top-sm-3"></div>
    @include('user.components.breadcrumb-section', ['page' => 'Detalhes do ingresso'])

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

        <h1 class="h2 text-truncate">Ingresso #<span class="text-uppercase">{{ $ticket->id }}</span></h1>

        <hr>

        @if($ticket->status === $status->valid)
            <div class="row d-print-none mb-4">
                <div class="col-12">
                    <button type="button" class="btn btn-primary btn-lg" onclick="window.print();return false;">
                        <i class="fas fa-print mr-1"></i>Imprimir
                    </button>
                </div>
            </div>
        @endif

        <div class="card card-frame-highlighted">
            <div class="card-body">
                <h3 class="card-title">Código:
                    @if($ticket->status === $status->valid)
                        <span class="font-weight-bold">{{ $ticket->code }}</span>
                    @else
                        <span class="text-danger"><del>{{ $ticket->code }}</del> {{ __($ticket->status) }}</span>
                    @endif

                </h3>

                @if($ticket->status === $status->valid)
                    <div class="row my-4">
                        <div class="col-md-6 mb-4">
                            <img class="img-responsive img-fluid" src="data:image/png;base64,{{ DNS1D::getBarcodePNG($ticket->code, "C39E+", 2, 70) }}" alt="Ingresso código {{ $ticket->code }}">
                        </div>

                        <div class="col-md-6 text-right">
                            <img class="img-responsive img-fluid" src="data:image/png;base64,{{ DNS2D::getBarcodePNG($ticket->code, "QRCODE", 5, 5) }}" alt="Ingresso código {{ $ticket->code }}">
                        </div>
                    </div>
                @endif

                <div class="alert alert-primary"  role="alert">
                    <h4 class="alert-heading text-uppercase">Não publique fotos com os códigos do seu ingresso!</h4>
                    <p class="alert-text">Para garantir a segurança da sua entrada, não divulgue fotos que contenham dados sensíveis como códigos de barras e documentos pessoais.</p>

                    <hr>

                    <p class="alert-text mb-0 font-weight-bold">É indispensável a apresentação desse INGRESSO em formato impresso ou digital junto com o DOCUMENTO cadastrado na portaria do evento.</p>
                </div>

                <hr class="d-none d-print-block">

                <ul class="list-unstyled">
                    <li>
                        <span class="text-secondary">Titular:</span>
                        <span class="font-weight-medium text-uppercase">{{ $ticket->participant->name }}</span>
                    </li>

                    <li>
                        <span class="text-secondary">Documento:</span>
                        <span class="font-weight-medium text-uppercase">{{ $ticket->participant->document }}</span>
                    </li>

                    <li>
                        <span class="text-secondary">Email:</span>
                        <span class="font-weight-medium text-uppercase">{{ $ticket->participant->email }}</span>
                    </li>

                    <li>
                        <span class="text-secondary">Situação do ingresso:</span>
                        <span class="font-weight-medium">{{ __($ticket->status) }}</span>
                    </li>
                </ul>

                <hr class="my-4">

                <h5 class="text-dark font-size-1 text-uppercase">Dados do Evento:</h5>

                <ul class="list-unstyled mb-0">
                    <li>
                        <span class="text-secondary">Nome:</span>
                        <span class="font-weight-medium text-uppercase"><a class="text-primary"
                                                                           href="{{ route('event', $ticket->event->url) }}">{{ $ticket->event->name }}</a></span>
                    </li>

                    <li>
                        <span class="text-secondary">Endereço:</span>
                        <address>{{ $ticket->event->address }} </address>
                    </li>

                    <li>
                        <span class="text-secondary">Data e hora:</span>
                        <span>{{ $ticket->event->starts_at->format('d/m/Y H:i') }}</span>
                    </li>
                </ul>

                <hr class="my-4">

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-dark font-size-1 text-uppercase">Dados do pedido:</h5>

                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <span class="text-secondary">Código:</span>
                                <span class="font-weight-medium text-uppercase"><a href="{{ route('orders.show', $ticket->order_id) }}">{{ $ticket->order_id }}</a></span>
                            </li>

                            <li class="mb-2">
                                <span class="text-secondary">Data e hora:</span>
                                <span class="font-weight-medium">{{ $ticket->created_at->format('d/m/Y H:i:s') }}</span>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <h5 class="text-dark font-size-1 text-uppercase">Detalhes da transação:</h5>

                        <ul class="list-unstyled mb-0">
                            <li>
                                <span class="text-secondary">Primeiro titular:</span>
                                <span class="font-weight-medium">
                                    @if($ticket->first_owner) Sim @else Não @endif
                                </span>
                            </li>

                            <li>
                                <span class="text-secondary">Página gerada em:</span>
                                <span class="font-weight-medium">{{ now()->format('d/m/Y H:i:s') }}</span>
                            </li>

                            <li>
                                <span class="text-secondary">Validade (final do evento):</span>
                                <span class="font-weight-medium">{{ $ticket->event->finishes_at->format('d/m/Y H:s') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-primary d-print-none mt-4"  role="alert">
            <h4 class="alert-heading">Instruções para impressão</h4>
            <p class="alert-text">Utilize uma versão atual do Google Chrome ou Mozilla Firefox.</p>
            <p class="alert-text">Imprima o seu ingresso em papel A4 utilizando a qualidade de impressão normal.</p>

            <hr>

            <p class="alert-text mb-0 font-weight-bold">É indispensável a apresentação desse INGRESSO em formato impresso ou digital junto com o DOCUMENTO cadastrado na portaria do evento.</p>
        </div>

        @if($ticket->status === $status->valid)
            <div class="row d-print-none mt-4">
                <div class="col-12">
                    <button type="button" class="btn btn-primary btn-lg" onclick="window.print();return false;">
                        <i class="fas fa-print mr-1"></i>Imprimir
                    </button>
                </div>
            </div>
        @endif
    </div>
@endsection
