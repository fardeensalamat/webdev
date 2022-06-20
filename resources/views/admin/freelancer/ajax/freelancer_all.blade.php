<div class="table-responsive ajax-data-container">
          
    {{ $freelancerAll->render() }}

      <table class="table table-hover table-bordered table-striped table-sm {{ $freelancerAll->count() < 3 ? 'mb-5 mt-5' : '' }}">

        <thead>
          <tr class="nowrap">
            <th>SL</th>
            <th>Action</th>
            <th>ID</th>

            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            {{-- <th>Status</th> --}}
            <th>Balance</th>

            <th>Joining Date</th>
          </tr>
        </thead>

        <tbody> 

          <?php $i = 1; ?>

          <?php $i = (($freelancerAll->currentPage() - 1) * $freelancerAll->perPage() + 1); ?>

        @foreach($freelancerAll as $user)        


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
  <a class="dropdown-item" href="{{route('admin.freelanncerWorklist',$user->id)}}">Work List</a>



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
            <td>{{ $user->email }}</td>
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
  
            {{-- <td>
              
              @if($intRef = $user->introducerRefferer())
              
                <a class="btn btn-xs w3-round w3-border" href="{{route('admin.employeeAll',['user' => $intRef->user_id])}}">T-{{$intRef->user_id}}</a>

                <a href="{{route('admin.userHistoryInfo',['user'=>$intRef->user_id,'type'=>'subscribers'])}}"  class="btn btn-xs w3-round w3-border" >
                  {{$intRef->id}}
                </a>
                
              @else
                  -
              @endif
            </td> --}}

            
          <td>{{date_format($user->created_at,"d/m/Y")}}</td>
          
        </tr>

        <?php $i++; ?>

        @endforeach 
        </tbody>

      </table>

      {{ $freelancerAll->render() }}

    </div>
