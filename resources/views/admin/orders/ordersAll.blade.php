@extends('admin.layouts.adminMaster')

@push('css')
@endpush

@section('content')
  <section class="content">

<style>
  tr.nowrap td {
       white-space:nowrap;
   }

   tr.nowrap th {
       white-space:nowrap;
   }
</style>

  	<br>


  	<div class="row">
      
      <div class="col-sm-12">
        @include('alerts.alerts')

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              All @if ($type != 'all')
              {{ucfirst($type)}}
              @endif Orders 
            </h3>
            <div class="card-tools">
              <form action="">
                  
                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" data-url="{{ route('admin.searchAjax', ['type'=>'order', 'status'=> isset($status) ? $status : null]) }}" class="form-control ajax-data-search" placeholder="Search Order">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-primary w3-border">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
                </form>
              </div>
          </div>

          <div class="card-body">



@include('admin.orders.ajax.paymentOrdersAll')

</div>
</div>
</div>
</div>


  
  </section>
@endsection


@push('js')

@endpush

