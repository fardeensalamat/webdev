<div class="col-sm-12">
    <div class="card card-widget">
        <div class="card-body" style="min-height: 400px;">
          
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>ID</th>
                        {{-- <th>Action</th> --}}
                        <th>Date</th>
                        <th>Mobile</th>
                        <th>Balance</th>
                        <th>PF Balance</th>
                        <th>Deposit</th>
                        <th>Withdraw</th>
                    </tr>
                    </thead>
                    @if(isset($reports))
                        
                        @php
                            $i = 1;
                            $balance = 0;
                            $pfBalance = 0;
                            $deposite = 0;
                            $withdraw = 0;
                        @endphp
                            @foreach ($reports as $tenant)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$tenant->id}}</td>
                                {{-- <td>

                

                                    <div class="btn-group btn-group-xs">
                        
                        
                        <a class="btn btn-primary btn-xs" href="{{ route('admin.userEdit', $tenant) }}">Edit</a>
                      
                        <div class="btn-group " role="group">
                          <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            
                          </button>
                          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="{{ route('admin.userStatusUpdate', [$tenant,'type'=> 'active']) }}">Make {{ $tenant->active ? 'Inactive' : 'Active' }}</a>
                            <a class="dropdown-item" href="{{ route('admin.userStatusUpdate', [$tenant,'type'=> 'wallet']) }}"> {{ $tenant->wallet_lock ? 'Unlock' : 'Lock' }} Wallet</a>
                            <a class="dropdown-item" href="{{ route('admin.userHistoryInfo', [$tenant,'type'=> 'subscribers']) }}">All Subscribers ({{ $tenant->subscriptions->count() }})</a>
                            <a class="dropdown-item" href="{{ route('admin.userHistoryInfo', [$tenant,'type'=> 'all_tr']) }}">All Tr History</a>
                            <a class="dropdown-item" href="{{ route('admin.userHistoryInfo', [$tenant,'type'=> 'deposit']) }}">All Deposit History</a>
                            <a class="dropdown-item" href="{{ route('admin.userHistoryInfo', [$tenant,'type'=> 'withdraw']) }}">All Withdraw History</a>
                            <a class="dropdown-item" href="{{ route('admin.userHistoryInfo', [$tenant,'type'=> 'honorarium']) }}">All Honoraria History</a>
                       
                          </div>
                        </div>
                         
                      
                      
                      </div>
                                      
                      
                                    </td> --}}
                                <td>{{$tenant->created_at}}</td>
                                <td>{{$tenant->mobile}}</td>
                                <td>BDT {{$tenant->totalBalance()}}</td>
                                <td>BDT {{$tenant->sfBalanceTotal()}}</td>
                                <td>BDT {{$tenant->totalDeposit()}}</td>
                                <td>BDT {{$tenant->totalWithdraw()}}</td>
                            </tr>
                            @php
                                $balance = $balance +$tenant->totalBalance();
                                $pfBalance = $pfBalance + $tenant->sfBalanceTotal();
                                $deposite = $deposite + $tenant->totalDeposit();
                                $withdraw =  $withdraw + $tenant->totalWithdraw();
                            @endphp
                            @endforeach   
                            <tr>
                                <td></td>                     
                                <td></td>                     
                                <td></td>                     
                                <td>Total</td>  
                                <td>BDT {{$balance}}</td>   
                                <td>BDT {{$pfBalance}}</td>
                                <td>BDT {{$deposite}}</td>  
                                <td>BDT {{$withdraw}}</td>                
                            </tr>

                    @endif
                    
                </table>
            </div>
        </div>
</div>