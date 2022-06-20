@extends('admin.layouts.adminMaster')
@push('css')

@endpush

@section('content')
    <br>
    <section class="content">
        <div class="card card-solid">
            <div class="card-header bg-info">
                <div class="card-title">Service Item Details ({{ $serviceItem->id }})</div>
            </div>
            @include('alerts.alerts')
            <div class="container-fluid mt-2 mb-3">
                <div class="card-body">
                   <h4>{{ $serviceItem->title }}</h4>
                   <p><b>Details:</b> {!! $serviceItem->description !!}</p>
                   <p><b>Price:</b> {{$serviceItem->price }}</p>
                   <p><b>Total Orders</b> ({{ $serviceItem->totalOrder() }})</p>
                </div>
            </div>
    </section>
@endsection
@push('js')
  
@endpush
