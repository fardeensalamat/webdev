<div class="table-responsive ajax-data-container">
          
        {{ $usersAll->render() }}

          <table class="table table-hover table-bordered table-striped table-sm {{ $usersAll->count() < 3 ? 'mb-5 mt-5' : '' }}">

            <thead>
              <tr class="nowrap">
                <th>SL</th>
                <th>Action</th>
                <th>ID</th>
 
                <th>Name</th>
                {{-- <th>Email</th> --}}
                <th>Mobile</th>
                {{-- <th>Status</th> --}}
                <th>Balance</th>
 
                <th>Introducer</th>
                <th>Joining Date</th>
              </tr>
            </thead>

            <tbody> 

              <?php $i = 1; ?>

              <?php $i = (($usersAll->currentPage() - 1) * $usersAll->perPage() + 1); ?>

            @foreach($usersAll as $user)        


            <tr class="nowrap">

            	<td>{{ $i }}</td>
              <td>

                
              <div class="btn-group btn-group-xs">
  
  {{-- <a class="btn  btn-xs w3-blue mx-1" href="{{ route('admin.message', $user) }}"> <i class="fas fa-comments"></i> </a> --}}
  <a class="btn btn-primary btn-xs" href="{{ route('admin.userEdit', $user) }}">Edit</a>

  <div class="btn-group " role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      @if (Auth::user()->roleItems()->count() < 1)
      <a class="dropdown-item" href="{{ route('admin.LoginAsUser', ['user'=>$user]) }}">Login As Tenant</a>
      <a class="dropdown-item" href="{{ route('admin.userSalesHistoryInfo', [$user]) }}">Sales History</a>
@endif
      <a class="dropdown-item" href="{{ route('admin.userStatusUpdate', [$user,'type'=> 'active']) }}">Make {{ $user->active ? 'Inactive' : 'Active' }}</a>
      <a class="dropdown-item" href="{{ route('admin.userStatusUpdate', [$user,'type'=> 'wallet']) }}"> {{ $user->wallet_lock ? 'Unlock' : 'Lock' }} Wallet</a>
      <a class="dropdown-item" href="{{ route('admin.userHistoryInfo', [$user,'type'=> 'subscribers']) }}">All Subscribers</a>
      <a class="dropdown-item" href="{{ route('admin.userHistoryInfo', [$user,'type'=> 'all_tr']) }}">All Tr History</a>
      <a class="dropdown-item" href="{{ route('admin.userHistoryInfo', [$user,'type'=> 'deposit']) }}">All Deposit History</a>
      <a class="dropdown-item" href="{{ route('admin.userHistoryInfo', [$user,'type'=> 'withdraw']) }}">All Withdraw History</a>
      <a class="dropdown-item" href="{{ route('admin.userHistoryInfo', [$user,'type'=> 'honorarium']) }}">All Honoraria History</a>


 
    </div>
  </div>
   


</div>
                

              </td>
              <td>
                @if($user->active)
                <span class="badge badge-success">{{ $user->id }}</span>
                @else
                <span class="badge badge-danger">{{ $user->id }}</span>
                @endif

                 
                  @if($user->wallet_lock)
                  (<span class="badge badge-danger">Lock</span>)
                @endif
                </td>
            	<td>{{ $user->name }}</td>
            	{{-- <td>{{ $user->email }}</td> --}}
            	<td>{{ $user->mobile }}</td>
              {{-- <td>
                @if($user->active)
                <span class="badge badge-success">Active</span>
                @else
                <span class="badge badge-danger">Inactive</span>
                @endif

                @if($user->wallet_lock)

                <span class="badge badge-danger">(Lock)</span>                
                @endif
              </td> --}}
      
              <td>

                @if($user->totalBalance() > 0)
                  <span class="badge badge-success">{{ $user->totalBalance() }}</span>
                  @else
                  {{ $user->totalBalance() }}
                  @endif
                  </td>
      
                <td>
                  
                  @if($intRef = $user->introducerRefferer())
                  
                    <a class="btn btn-xs w3-round w3-border" href="{{route('admin.usersAll',['user' => $intRef->user_id])}}">T-{{$intRef->user_id}}</a>

                    <a href="{{route('admin.userHistoryInfo',['user'=>$intRef->user_id,'type'=>'subscribers'])}}"  class="btn btn-xs w3-round w3-border" >
                      {{$intRef->id}}
                    </a>
                    
                  @else
                      -
                  @endif
                </td>

            	
              <td>{{$user->created_at}}</td>
              
            </tr>

            <?php $i++; ?>

            @endforeach 
            </tbody>

          </table>

          {{ $usersAll->render() }}

        </div>
