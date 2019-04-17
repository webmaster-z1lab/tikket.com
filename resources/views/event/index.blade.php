@extends('layouts.default')

@section('content')
    <div id="vue-search"></div>
@endsection

@push('scripts')
    <script src="{{ mix('js/search/main.js') }}"></script>
@endpush
