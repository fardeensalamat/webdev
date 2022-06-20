<div class="col-sm-12">
    <div class="card card-widget">
        <div class="card-body" style="min-height: 400px;">
          
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped table-sm ">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>ID</th>
                        <th>Tenant</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Mobile</th>
                        <th>PF Number</th>
                        <th>Workstation</th>
                        <th>Category</th>

                        <th>Balance (BDT)</th>                        
                        {{-- <th>Details</th> --}}
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
                            <td>{{$report->id}}</td>
                            <td>{{$report->user ? $report->user->id : '-'}}</td>
                            <td>{{$report->user ? $report->user->name : '-'}}</td>
                            <td>{{$report->created_at}}</td>
                            <td>{{$report->user ? $report->user->mobile : '-'}}</td>
                            <td>{{$report->subscription_code}}</td>
                            <td>{{$report->workStation ? $report->workStation->title : '-'}}</td>
                            <td>{{$report->category ? $report->category->name : '-'}}</td>
                            <td>{{$report->balance}}</td>
                            {{-- <td>{{$report->details}}</td> --}}

                        </tr>
                        @php
                            $balance =$balance + $report->balance;
                            
                        @endphp
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td>BDT {{$balance}}</td>
                            {{-- <td></td> --}}
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>