<div class="table-responsive ajax-data-container">
          
    {{ $employeeAll->render() }}

      <table class="table table-hover table-bordered table-striped table-sm {{ $employeeAll->count() < 3 ? 'mb-5 mt-5' : '' }}">

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

          <?php $i = (($employeeAll->currentPage() - 1) * $employeeAll->perPage() + 1); ?>

        @foreach($employeeAll as $user)        


        <tr class="nowrap">

            <td>{{ $i }}</td>
          <td>

            
          <div class="btn-group btn-group-xs">

<a class="btn btn-primary btn-xs" href="{{ route('user.EmployeeHistoryInfo', [$user,'type'=> 'all_create_profile']) }}">Create Profile List</a>

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

            @if($user->employee_balance > 0)
              <span class="badge badge-success">{{ $user->employee_balance }}</span>
              @else
              {{ $user->employee_balance}}
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

      {{ $employeeAll->render() }}

    </div>
