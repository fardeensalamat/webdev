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
    <div class="card card-primary">
      <div class="card-header with-border">
          <h3 class="card-title">
             {{ ucwords(str_replace('_', ' ', $type)) }} History of Tanent: <a class="btn btn-xs w3-round w3-border" href="{{ route('admin.usersAll', ['user' => $user->id]) }}">{{ $user->id}}</a>,  {{ $user->name }} ({{ $user->mobile }})
          </h3>
      </div>
      <div class="card-body">

       @include('admin.users.ajax.admin_userTrHistory')
         
      </div>
    </div>
  </section>
@endsection