@extends('layouts.default')

@section('content')
    <div id="homeSection"></div>
    @include('home.components.hero')
    @include('home.components.categories')
    @include('home.components.features')
    @include('home.components.cta')
@endsection
