@extends('admin.layouts.adminMaster')

@push('css')

@endpush

@section('content')
  <section class="content">

    <br>

     <div class="row">
      
      <div class="col-sm-12">


@include('alerts.alerts')





            <div class="card card-widget">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-briefcase text-primary"></i> <span class="badge badge-light">
                  
               All Transaction History of Tanent: ID:({{ $user->id }}),  {{ $user->name }} ({{ $user->mobile }})

                </span> 
            </h3>
              </div>
              <div class="card-body" style="min-height: 200px;">

<div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    All Transaction
                </div>
                <div class="card-body">
                    @if ($transactions->count() >0)
                    <div class="table-responsive">
                      
                    <table class="table table-bordered">
                        <tr>
                            <th>Date</th>
                            <th>Balance</th>

                            {{-- <th>Method</th> --}}
                            {{-- <th>Previous Balance</th> --}}
                            {{-- <th>New Balance</th> --}}
                            <th>Details</th>
                            <th>Status</th>
                        </tr>

                        @foreach($transactions as $tr)
                        <tr>
                            <td>{{ $tr->created_at }}</td>
                            <td>
                                {{ $tr->moved_balance }}
                            </td>
                            {{-- <td>
                                {{ $tr->type }}
                            </td> --}}
                            {{-- <td>
                                {{ $tr->previous_balance }}
                            </td> --}}

                            

                            {{-- <td>
                                {{ $tr->new_balance }}
                            </td> --}}
                            <td>{{$tr->details}}</td>
                            <td>
                                <span class="badge badge-success">Success</span>
                            </td>
                        </tr>

                        @endforeach
                    </table> 
                    </div>

                    {{ $transactions->render() }}
                    @else
                    <p class="text-center">No Transaction Yet</p>
                    @endif
                    
                </div>
            </div>
        </div>
                
              </div>
            </div>
          </div>
        </div>



          </div>
      </div>
  </div>
</div>


  
  </section>
@endsection


@push('js')

@endpush

