@extends('layouts.default')

@section('content')
    @include('event.components.header')
    @include('event.components.cart')
    @include('event.components.description')
@endsection

@push('defer-scripts')
    <script src="{{ mix('js/shop.js') }}" defer></script>
@endpush
