@extends('layouts.default')

@push('stylesheet')
    <style>
        .img-fluid, .img-thumbnail {
            max-width  : 80px;
            max-height : 80px;
        }
    </style>
@endpush

@section('content')
    <div class="space-top-2 space-top-sm-3"></div>
    @include('user.components.breadcrumb-section', ['page' => 'Meus ingressos'])

    <div class="bg-light">
        <div class="container space-2">
            <h1 class="h2">Meus ingressos</h1>
            <hr>

            <div class="card">
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-7">
                            <ul class="nav nav-classic nav-borderless px-0" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-one-tab" data-toggle="pill" href="#pills-one" role="tab" aria-controls="pills-one" aria-selected="true">
                                        Ingressos disponíveis
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="pills-two-tab" data-toggle="pill" href="#pills-two" role="tab" aria-controls="pills-two" aria-selected="false">
                                        Outros ingressos
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab">
                            @if($tickets->isNotEmpty())
                                @foreach($tickets as $ticket)
                                    @include('user.components.ticket-card', ['ticket' => $ticket, 'status' => $status])
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <div class="w-md-80 w-lg-50 text-center mx-md-auto">
                                        <figure class="mb-7">
                                            <img class="w-50" src="{{ getenv('AWS_CDN_ENDPOINT') }}/template/front/2.1.1/svg/illustrations/events.svg" alt="Ingressos ativos">
                                        </figure>

                                        <h4 class="h5 font-weight-normal">Todos os ingressos disponíveis pra você irão aparecer aqui.</h4>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="tab-pane fade" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">
                            <div class="text-center py-4">
                                <div class="w-md-80 w-lg-50 text-center mx-md-auto">
                                    <figure class="mb-7">
                                        <img class="w-50" src="{{ getenv('AWS_CDN_ENDPOINT') }}/template/front/2.1.1/svg/illustrations/events.svg" alt="Ingressos inativos">
                                    </figure>

                                    <h4 class="h5 font-weight-normal">Aqui serão listados os ingressos vencidos e/ou invalidados.</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
