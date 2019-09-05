@extends('layouts.default')

@section('content')
    @include('home.components.hero')

    @if(!empty($featured))
        @include('home.components.featured')

    @else
        <div class="container space-2"></div>
    @endif

    @include('home.components.categories')
    @include('home.components.features')
    @include('home.components.cta')
@endsection
