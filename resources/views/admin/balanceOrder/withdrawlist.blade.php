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
              All Withdraw List
            </h3>
          </div>

          <div class="card-body">


            @include('admin.balanceOrder.ajax.withdrawListAll')

</div>
</div>
</div>
</div>


  
  </section>
@endsection


@push('js')

@endpush

