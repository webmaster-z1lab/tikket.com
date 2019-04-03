@extends('layouts.default')

@section('content')
    <div id="vue-cart"></div>
@endsection

@push('scripts')
    @if(getenv('APP_ENV') === 'production')
        <script src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    @else
        <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    @endif

    <script src="{{ mix('js/cart/main.js') }}"></script>
@endpush
