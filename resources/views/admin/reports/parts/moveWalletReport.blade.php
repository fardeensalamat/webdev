<div class="col-sm-12">
    <div class="card card-widget">
        <div class="card-body" style="min-height: 400px;">
          
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped table-sm ">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Tenant ID</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Mobile</th>
                        <th>Moved Balance</th>                        
                        <th>Details</th>
                    </tr>
                    </thead>
                    @if(isset($reports))
                        @php
                            $i = 1;
                            $balance = 0;
                            
                        @endphp
                        @foreach ($reports as $report)

                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$report->user ? $report->user->id : '-'}}</td>
                            <td>{{$report->user ? $report->user->name : '-'}}</td>
                            <td>{{$report->created_at}}</td>
                            <td>{{$report->user ? $report->user->mobile : '-'}}</td>
                            <td>{{$report->moved_balance}}</td>
                            <td>{{$report->details}}</td>

                        </tr>
                        @php
                            $balance = $balance + $report->moved_balance;
                            
                        @endphp
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td>{{$balance}}</td>
                            <td></td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>