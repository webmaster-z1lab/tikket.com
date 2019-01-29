@extends('layouts.default')

@section('content')
    <div id="vue-user"></div>
@endsection

@push('scripts')
    <script src="{{ mix('js/user/main.js') }}"></script>
@endpush

