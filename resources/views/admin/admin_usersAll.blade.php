<table class="table table-striped table-bordered table-hover" >
    <thead>
        <tr>
            <th width="10%">ID</th>
            <th>Action</th>
            <th>Name</th>
            <th width="15%">Mobile</th>
            <th width="15%">Status</th>
            <th>Balance</th>
            <th>PF Balance</th>
            <th>Deposite</th>
            <th>Withdraw</th>
            <th>JoinDate</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>
            <strong>ID:</strong> {{$user->id}}
            </td>
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
            <td>
            {{$user->name}}
            </td>
            <td> {{$user->mobile}}</td>
            <td>{{ $user->active ? 'Active' : 'Inactive' }}</td>
            
            <td>{{ $user->balance }}</td>
              <td>{{ $user->sfBalanceTotal() }}</td>
              <td>{{ $user->totalDeposit() }}</td>
              <td>{{ $user->totalWithdraw() }}</td>

            	
              <td>{{$user->created_at->format('d-m-Y')}}</td>
            
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th width="10%">ID</th>
            <th>Action</th>
            <th>Name</th>
            <th width="15%">Mobile</th>
            <th width="15%">Status</th>
            <th>Balance</th>
            <th>PF Balance</th>
            <th>Deposite</th>
            <th>Withdraw</th>
            <th>JoinDate</th>
        </tr>
    </tfoot>
</table>

<div class="ajax-pagination-area">    
{{ $users->appends([
    'q' => isset($q) ? $q : null
    ])->render() }}    
</div>