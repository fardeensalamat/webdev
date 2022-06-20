<div class="col-sm-12">
    <div class="card card-widget">
        <div class="card-body" style="min-height: 400px;">
          
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped table-sm ">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Mobile</th>
                        <th>Workstation</th>
                        <th>Total Workers</th>    
                        <th>Total Job Post Price</th>
                        <th>Total Job Post Cost</th>                    
                        {{-- <th>Details</th> --}}
                    </tr>
                    </thead>
                    @if(isset($reports))
                        @php
                            $i = 1;
                            $jobPostPrice = 0;
                            $total_work_cost = 0;
                            
                        @endphp
                        @foreach ($reports as $report)

                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$report->id}}</td>
                            <td>{{$report->user ? $report->user->name : '-'}}</td>
                            <td>{{$report->created_at}}</td>
                            <td>{{$report->user ? $report->user->mobile : '-'}}</td>
                            <td>{{$report->workstation ? $report->workstation->title : '-'}}</td>
                            <td>{{$report->total_worker}}</td>
                            <td>{{$report->job_post_price}}</td>
                            <td>{{$report->total_job_work_cost}}</td>
                            {{-- <td>{{$report->details}}</td> --}}

                        </tr>
                        @php
                            $jobPostPrice =$jobPostPrice + $report->job_post_price;
                            $total_work_cost = $total_work_cost + $report->total_job_work_cost;
                        @endphp
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td>BDT {{$jobPostPrice}}</td>
                            <td>BDT {{$total_work_cost}}</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>