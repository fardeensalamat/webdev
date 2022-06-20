 <div class="table-responsive">
          

                        <table class="table table-bordered table-hover table-striped table-sm">
              
              
                            <thead>
                                <tr class="nowrap">
                                <th>SL</th>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Purpose</th>
                                <th>Prev Bal</th>
                                <th>Moved Bal</th>
                                <th>New Balance</th>
                                <th>Details</th>
                                </tr>
                            </thead>
              
                            <tbody> 
                
                                <?php $i = 1; ?>
                
                                    <?php $i = (($transactions->currentPage() - 1) * $transactions->perPage() + 1); ?>
                
                                    @foreach($transactions as $bt)        
                
                
                                    <tr class="nowrap">
                        
                                        <td>{{ $i }}</td>

                                        <td>{{ $bt->id }}</td>
                                        <td>{{ $bt->created_at }}</td>

                                         
                                        {{-- <td>{{ $bt->created_at->toDateString() }}</td> --}}
                                        
                                        {{-- <td>{{$bt->title}}</td> --}}
                                        {{-- <td>{{$bt->description}}</td> --}}
                                        {{-- <td>{{$bt->btstation ? $bt->btstation->title : ''}}</td>  --}}

                                        <td>
                                            @if($bt->purpose == 'withdraw')
                                            <span class="badge badge-danger">{{ $bt->purpose }}</span>
                                            @elseif($bt->purpose == 'deposit')

                                            <span class="badge badge-success">{{ $bt->purpose }}</span>

                                            @else

                                            <span class="badge badge-warning">{{ $bt->purpose }}</span>

                                            @endif
                                        </td>
                                          
                                         

                                    <td>{{ $bt->previous_balance }}</td>

                                    <td>{{ $bt->moved_balance }}</td>
                                    <td>
                                       {{ $bt->new_balance }}
                                    </td>
                                    <td>
                                         {{ $bt->details }}
                                    </td>
                                                          
                                    </tr>
                
                                    <?php $i++; ?>
                
                                    @endforeach 
                            </tbody>
              
                        </table>
              
                        {{ $transactions->render() }}
              
                      </div>