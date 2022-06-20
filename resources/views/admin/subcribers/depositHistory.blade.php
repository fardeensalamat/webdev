@extends('admin.layouts.adminMaster')

@push('css')

@endpush

@section('content')
  <section class="content">
  	<br>
    <div class="card card-primary">
      <div class="card-header with-border">
          <h3 class="card-title">
              Deposit History of Subscriber ({{$subscriber->subscription_code}})
          </h3>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          

          <table class="table table-hover table-sm">


            <thead>
              <tr>
                <th>SL</th>
                <th>Transaction Date</th>
                <th>Work Station</th>
                <th>Previous Balance</th>
                <th>New Balance</th>
                <th>Type</th>
                <th width="30">Details</th>
              </tr>
            </thead>

            <tbody> 

              <?php $i = 1; ?>

              <?php $i = (($transactionHistory->currentPage() - 1) * $transactionHistory->perPage() + 1); ?>

              @foreach($transactionHistory as $th)        


              <tr>

                <td>{{ $i }}</td>
                <th>{{$th->created_at->format('d-m-Y')}}</th>
                <td>{{$th->workStation ? $th->workStation->title : '-'}}</td>
                
                <td>{{$th->previous_balance}}</td>
                  
                <td>{{$th->new_balance}}</td>
                  
                <td>{{$th->type}}</td>
                <td>{{$th->details}}</td>

                
              </tr>

              <?php $i++; ?>

              @endforeach 
            </tbody>

          </table>

          {{ $transactionHistory->render() }}

        </div>
      </div>
    </div>
  </section>
@endsection