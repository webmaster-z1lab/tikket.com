@extends('layouts.default')

@section('content')
    <div id="homeSection"></div>
    <div id="vue-home">
        @include('home.components.hero')
        @include('home.components.categories')
        @include('home.components.features')
        @include('home.components.cta')
    </div>
@endsection

@push('scripts')
    {{--<script src="{{ mix('js/home/main.js') }}"></script>--}}
@endpush
