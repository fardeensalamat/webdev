<div class="table-responsive">
          
          {{ $transactionHistory->render() }}
          
          <table class="table table-hover table-bordered table-striped table-sm">


            <thead>
              <tr>
                <th>SL</th>
                
                <th>Work Station</th>
                <th>System Type</th>
                <th>Earning Type</th>
                <th>Benifit (%)</th>
                <th >Amount</th>
                <th>Subscriber</th>
              </tr>
            </thead>

            <tbody> 

              <?php $i = 1; ?>

              <?php $i = (($transactionHistory->currentPage() - 1) * $transactionHistory->perPage() + 1); ?>

              @foreach($transactionHistory as $th)        


              <tr>

                <td>{{ $i }}</td>
                
                <td>{{$th->workstation ? $th->workstation->title : '-'}}</td>

                @if ($th->system_type == "Joining")
                    <td>Rent/Rented</td>
                @else
                    <td>Beneficiary</td> 
                @endif

                @if ($th->earning_type == 'Pair')
                    <td>Incentive</td>
                @elseif($th->earning_type == 'Refferal')
                    <td>Introducer</td>
                @else 
                    <td>{{$th->earning_type}}</td>

                @endif
                  
                <td>{{$th->commission}}</td>
                <td>{{$th->amount}}</td>
                <td>
                    @if($th->subscription)
                    <a class="btn btn-xs w3-round w3-border" href="{{ route('admin.subscribersList', ['subscriber'=>$th->subscriber_id]) }}">{{ $th->subscription->subscription_code}}</a>
                    @else
                    @endif
                     </td>

                
              </tr>

              <?php $i++; ?>

              @endforeach 
            </tbody>

          </table>

          {{ $transactionHistory->render() }}

        </div>