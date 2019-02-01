@extends('layouts.default')

@section('content')
    <div id="vue-cart"></div>
@endsection

@push('scripts')
    <script src="https://stc.sandbox.pagseguro.uol.com.br//pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script src="{{ mix('js/cart/main.js') }}"></script>
@endpush
