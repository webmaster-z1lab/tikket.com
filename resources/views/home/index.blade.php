@extends('layouts.default')

@section('content')
    @include('home.components.hero')

    @if(!empty($featured))
        @include('home.components.featured')
    @endif

    @include('home.components.categories')
    @include('home.components.features')
    @include('home.components.cta')
@endsection
