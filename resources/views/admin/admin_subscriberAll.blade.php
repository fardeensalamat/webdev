<table class="table table-striped table-bordered table-hover" >
    <thead>
        <tr>
            <th width="10%">ID</th>
            <th>Action</th>
            <th>Tenant</th>
            <th>Name</th>
            <th width="15%">Mobile</th>
            
            <th>Balance</th>
            <th>PF No</th>
            <th>Workstation</th>
            <th>District</th>
            <th>Referer</th>
        </tr>
    </thead>
    <tbody>
        {{$users}}
    @foreach($users as $user)
        <tr>
            <td>
            <strong>ID:</strong> {{$user->id}}
            </td>
            @php 
                $sc = $user->subscriber;
              @endphp
            <td>
       <div class="btn-group btn-group-xs w3-hover-shadow">
  
                <a class="btn btn-primary btn-xs" href="{{ route('admin.subcriberEdit', $sc) }}" target="_blank">Edit</a>
                {{-- <a class="btn btn-primary btn-xs" href="{{ route('admin.userCompanies', $user) }}">Company</a> --}}

                <div class="dropdown">
                  <button type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">
                    
                  </button>
                  <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 25px, 0px);">
                                        


                    <a href="{{ route('admin.dispositHistory', $sc) }}"><button type="button" class="dropdown-item btn btn-primary btn-xs">Deposit History</button></a>

                    <a href="{{ route('admin.honorariumTransfer', $sc) }}"><button type="button" class="dropdown-item btn btn-primary btn-xs">Honorarium Transfer</button></a>

                    <a href="
                    "><button type="button" class="dropdown-item btn btn-primary btn-xs">Cashout History</button></a>
                  </div>
                </div>


              </div>
            
            </td>
            <td>{{ $user->subscriber ? $user->subscriber->user_id : "" }}</td>
            <td>
            {{$user->name}}
            </td>
            <td> {{$user->mobile}}</td>
            
            <td>{{ $user->balance }}</td>
              <td>{{ $user->subscriber ? $user->subscriber->subscription_code : "" }}</td>
              
              @if($sc)
              <td>{{ $sc->workStation ? $sc->workStation->title : ''  }}</td>
              @else
              <td></td>
              @endif
              
            @if($sc)
              <td> @if ($sc->district)
                  {{ $sc->district->name }} ({{ $sc->district_id }}) 
                  @endif</td>
              @else
              <td></td>
              @endif
            	@if($sc)
              <td>{{ $sc->referrer ? $sc->referrer->subscription_code : '' }}</td>
              @else
              <td></td>
              @endif
            
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th width="10%">ID</th>
            <th>Action</th>
            <th>Tenant</th>
            <th>Name</th>
            <th width="15%">Mobile</th>
            
            <th>Balance</th>
            <th>PF No</th>
            <th>Workstation</th>
            <th>District</th>
            <th>Referer</th>
        </tr>
    </tfoot>
</table>

<div class="ajax-pagination-area">    
$users->appends([
    'q' => isset($q) ? $q : null
    ])->render()    
</div>