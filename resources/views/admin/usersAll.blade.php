@extends('admin.layouts.adminMaster')

@push('css')
@endpush

@section('content')
  <section class="content">

  	<br>


  	<div class="row">
      
      <div class="col-sm-12">

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              All Tenants <a class="btn w3-white btn-sm" href="{{ route('admin.newUserCreate') }}"><i class="fa fa-plus"></i> add new tenant</a>
            </h3>
            <div class="card-tools">
              <form action="">
                  
                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" data-url="{{ route('admin.searchAjax', ['type'=>'user', 'status'=> isset($status) ? $status : null]) }}" class="form-control ajax-data-search" placeholder="Search Tenant">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
                </form>
              </div>
          </div>
          <div class="card-body">




<div class="table-responsive ajax-data-container">
          

          <table class="table table-hover table-sm">


            <thead>
              <tr>
                <th>SL</th>
                <th>Action</th>
                <th>Name</th>
                {{-- <th>Email</th> --}}
                <th>Mobile</th>
                <th>Status</th>
                <th>Balance</th>
                <th>PF Balance</th>
                <th>Deposit</th>
                <th>Withdraw</th>
                <th>Joining Date</th>
              </tr>
            </thead>

            <tbody> 

              <?php $i = 1; ?>

              <?php $i = (($usersAll->currentPage() - 1) * $usersAll->perPage() + 1); ?>

            @foreach($usersAll as $user)        


            <tr>

            	<td>{{ $i }}</td>
              <td>

                

              <div class="btn-group btn-group-xs">
  
  {{-- <a class="btn  btn-xs w3-blue mx-1" href="{{ route('admin.message', $user) }}"> <i class="fas fa-comments"></i> </a> --}}
  <a class="btn btn-primary btn-xs" href="{{ route('admin.userEdit', $user) }}">Edit</a>

  <div class="btn-group " role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <a class="dropdown-item" href="{{ route('admin.userTrHistory', $user) }}">Tr History</a>
      {{-- <a class="dropdown-item" href="#">Dropdown link</a> --}}
    </div>
  </div>
   


</div>
                

              </td>
            	<td>{{ $user->name }}</td>
            	{{-- <td>{{ $user->email }}</td> --}}
            	<td>{{ $user->mobile }}</td>
            	<td>{{ $user->active ? 'Active' : 'Inactive' }}</td>
              <td>{{ $user->balance }}</td>
              <td>{{ $user->sfBalanceTotal() }}</td>
              <td>{{ $user->totalDeposit() }}</td>
              <td>{{ $user->totalWithdraw() }}</td>

            	
              <td>{{$user->created_at->format('d-m-Y')}}</td>
              
            </tr>

            <?php $i++; ?>

            @endforeach 
            </tbody>

          </table>

          {{ $usersAll->render() }}

        </div>



</div>
</div>
</div>
</div>


  
  </section>
@endsection


@push('js')

@endpush

