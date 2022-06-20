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
             {{ ucwords($type) }} History of Subscriber ({{$subscriber->subscription_code}})
          </h3>
      </div>
      <div class="card-body">

        <div class="table-responsive">
          

                        <table class="table table-hover table-striped table-sm">
              
              
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

                                        <td>{{ $bt->purpose }}</td>
                                          
                                         

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
         
      </div>
    </div>
  </section>
@endsection