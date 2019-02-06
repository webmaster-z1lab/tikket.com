@extends('layouts.default')

@section('content')
    <div class="space-top-2 space-top-sm-3"></div>
    <div id="vue-user"></div>
@endsection

@push('scripts')
    <script src="{{ mix('js/user/main.js') }}"></script>
@endpush

