
@if (request()->has('status'))
@php
    $hello = request()->get('status');
    $payment_ref_id = request()->get('payment_ref_id');
    $order_id = request()->get('order_id');
    $merchant = request()->get('merchant');
@endphp
@if ($hello == 'Success')
    <script>
        window.location =
            "{{ route('successpaynow.page', ['order_id' => $order_id, 'payment_ref_id' => $payment_ref_id, 'merchant' => $merchant]) }}";
    </script>
    exit();
@endif
@if ($hello == 'Aborted')
    <script>
        window.location = "{{ route('errornagadpaynow.page', ['order_id' => $order_id]) }}";
    </script>
    exit();
@endif
@endif
@extends('user.layouts.userMaster')
@push('css')
<style>
    .mybalanetotal {
    border: 1px solid #eaeded;
    padding: 10px;
    text-align: center;
    }
    .mybalanetotal p {
    padding: 10px;
    margin: 0;
    background: #eaeded;
    }
    .mybalanetotal h6 {
    font-weight: bold;
    margin: 0;
    padding: 5px;
    }
    .mybalanetotal span {
    font-size: 50px;
    font-weight: bold;
    }
    .myaddbalanetotal {
    border: 1px solid #eaeded;
    padding: 10px;
    text-align: center;
    }
    .myaddbalanetotal p {
    padding: 10px;
    margin: 0;
    background: #eaeded;
    }
</style>
@endpush
@section('content')
<br>
    @include('user.userBalance.parts.userBalance')
@endsection
@push('js')
@endpush

