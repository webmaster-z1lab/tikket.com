@extends('layouts.auth')

@section('content')
    @if($confirmed)
        <div class="mb-6">
            <h1 class="h2 font-weight-normal">Email verificado com sucesso!</h1>
            <p class="text-dark">Obrigado por validar o seu e-mail no nosso sistema e garantir a segurança e qualidade de informações da sua conta.</p>
        </div>
    @endif

    <a class="btn btn-primary transition-3d-hover" href="{{ route('home') }}">Ir para a Home</a>
@endsection
