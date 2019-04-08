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

            <ul class="nav nav-classic nav-borderless px-0 mb-4" id="pills-tab" role="tablist">
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

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab">
                    @each('user.components.ticket-card', $tickets, 'ticket', 'user.components.empty.active-tickets')
                </div>

                <div class="tab-pane fade bg-white" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">
                    @each('user.components.ticket-card', $others, 'ticket', 'user.components.empty.other-tickets')
                </div>
            </div>
        </div>
    </div>
@endsection
