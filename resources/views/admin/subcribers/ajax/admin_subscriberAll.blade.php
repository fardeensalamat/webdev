<div class="table-responsive ajax-data-container">
          
              {{ $subcribers->render() }}

          <table class="table table-hover table-bordered table-striped table-sm {{ $subcribers->count() < 3 ? 'mb-5 mt-5' : '' }}">


            <thead>
              <tr class="nowrap">
                <th>SL</th>
                <th>Action</th>
                <th>ID</th>
                <th>Tenant</th>
                <th>Name</th>
                {{-- <th>Email</th> --}}
                <th>Mobile</th>
                <th>Balance</th>
                {{-- <th>Moved to Wallet</th> --}}
                <th>PF No.</th>

                {{-- <th>Position</th> --}}
                <th>Work Station</th>
                <th>Category</th>
                <th>District</th>
                <th>Referer</th>
                {{-- <th>Employees</th> --}}
                <th>Joining Date</th>
              </tr>
            </thead>

            <tbody> 


              <?php $i = 1; ?>

              <?php $i = (($subcribers->currentPage() - 1) * $subcribers->perPage() + 1); ?>

            @foreach($subcribers as $sc)        


            <tr class="nowrap">

              <td>{{ $i }}</td>

              <td>
                

              <div class="btn-group btn-group-xs w3-hover-shadow">
  
                <a class="btn btn-primary btn-xs" href="{{ route('admin.subcriberEdit', $sc) }}" target="_blank">Edit</a>
                {{-- <a class="btn btn-primary btn-xs" href="{{ route('admin.userCompanies', $user) }}">Company</a> --}}

                <div class="btn-group " role="group">
                  <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      
    </button>
                  <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 25px, 0px);">

                    <a href="{{ route('admin.subscriberHistoryInfo', [$sc,'type'=>'honorarium']) }}"><button type="button" class="dropdown-item btn btn-primary btn-xs">Honorarium </button></a>

                    <a href="{{ route('admin.subscriberHistoryInfo', [$sc,'type'=>'job']) }}"><button type="button" class="dropdown-item btn btn-primary btn-xs">Posted Job</button></a>

                    <a href="{{ route('admin.subscriberHistoryInfo', [$sc,'type'=>'work']) }}"><button type="button" class="dropdown-item btn btn-primary btn-xs">All Works of Job</button></a>

                    <a href="{{ route('admin.subscriberHistoryInfo', [$sc,'type'=>'move_to_wallet']) }}"><button type="button" class="dropdown-item btn btn-primary btn-xs">Balance Move History</button></a>


                    @if($sc->user)

                    <a href="{{ route('admin.userHistoryInfo', ['user'=>$sc->user_id,'type'=> 'subscribers']) }}"><button type="button" class="dropdown-item btn btn-primary btn-xs">All Subcribers</button></a>

                    <a href="{{ route('admin.userHistoryInfo', ['user'=>$sc->user_id,'type'=> 'all_tr']) }}"><button type="button" class="dropdown-item btn btn-primary btn-xs">All Tr Of Tenant</button></a>

                    <a href="{{ route('admin.userHistoryInfo', ['user'=>$sc->user_id,'type'=> 'deposit']) }}"><button type="button" class="dropdown-item btn btn-primary btn-xs">Deposit of Tenant</button></a>

                    <a href="{{ route('admin.userHistoryInfo', ['user'=>$sc->user_id,'type'=> 'withdraw']) }}"><button type="button" class="dropdown-item btn btn-primary btn-xs">Withdraw of Tenant</button></a>
                    @endif
           
                  </div>
                </div>


              </div>
                

              </td>
              <td>{{ $sc->id }}</td>
              <td>
                @if($sc->user)
                <a class="btn btn-xs {{ $sc->user->active ? '' : 'btn-danger' }}  w3-round w3-border" href="{{ route('admin.usersAll', ['user' => $sc->user]) }}">{{ $sc->user_id}}</a>
                @else
                {{ $sc->user_id }}
                @endif
              </td>
              <td>{{ $sc->user ? $sc->user->name: ''}}</td>
              {{-- <td>{{ $sc->user ? $sc->user->email: '' }}</td> --}}
              <td>{{ $sc->user ? $sc->user->mobile: '' }}</td>
                {{-- <td>{{ $user->position }}</td> --}}
                <td>
                  @if($sc->balance > 0)
                  <span class="badge badge-success">{{ $sc->balance }}</span>
                  @else
                  {{ $sc->balance }}
                  @endif
                  
                </td>

                {{-- <td>
                  @if($sc->movedTotalToWallet() > 0)
                  <span class="badge badge-danger">{{ $sc->movedTotalToWallet() }}</span>
                  @else
                  {{ $sc->movedTotalToWallet() }}
                  @endif
                  
                </td> --}}

              <td>{{ $sc->subscription_code }}</td>
                <td>{{ $sc->workStation ? $sc->workStation->title : '' }}</td>
                <td>{{$sc->category ? $sc->category->name : ''}}</td>
                
                <td>
                  @if ($sc->district)
                  {{ $sc->district->name }} ({{ $sc->district_id }}) 
                  @endif
                  </td>
              <td>{{ $sc->referrer ? $sc->referrer->subscription_code : '' }}</td>
              
              {{-- <td>{{  $sc->referredTeam()->count() }} </td> --}}

              <th>{{$sc->created_at}}</th>
              
              
            </tr>

            <?php $i++; ?>



            @endforeach 
            </tbody>



          </table>

          {{ $subcribers->render() }}

</div>

