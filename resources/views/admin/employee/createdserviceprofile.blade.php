@extends('admin.layouts.adminMaster')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @include('alerts.alerts')
                <div class="card card-primary">
                    <div class="card-header">
                      <b>{{$user->name}}</b> Created Service Profile List
                    </div>
                    <div class="card-body">
                        <div class="row">
                           <div class="col-sm-12">
                               <form class="form-inline" method="get" action="{{ route('admin.EmployeeHistoryInfo', [$user,'type'=> 'all_create_profile_date']) }}">
                                <div class="form-group form-group-sm">
                                    <label for="date">Date</label>
                                    <select name="date" id="date" class="form-control ml-1 mr-1" >
                                        <option value="">Select One</option>
                                        <option value="today" @if($date =='today') selected @endif>Today</option>
                                        <option value="yesterday" @if($date =='yesterday') selected @endif>Yesterday</option>
                                        <option value="7" @if($date =='7') selected @endif>Last 7 Days</option>
                                        <option value="30" @if($date =='30') selected @endif>Last 30 Days</option>
                                        <option value="this_month" @if($date =='this_month') selected @endif>This Month</option>
                                        <option value="last_month" @if($date =='last_month') selected @endif>Last Month</option>
                                    </select>
                                  </div>
                                  <div class="form-group form-group-sm">
                                    <label for="paystatus">Pay Status</label>
                                    <select name="paystatus" id="paystatus" class="form-control ml-1 mr-1" >
                                        <option value="1"@if($paystatus =='1') selected @endif>Paid</option>
                                        <option value="0" @if($paystatus =='0') selected @endif >Unpaid</option>
                                        <option value="2" @if($paystatus =='2') selected @endif >Trial</option>
                                    </select>
                                  </div>
                                 <div class="form-group form-group-sm">
                                   <label for="date_from">From:</label>
                                   <input type="date" name="date_from" class="form-control ml-1 mr-1" id="date_from">
                                 </div>
                                 <div class="form-group form-group-sm">
                                   <label for="date_to">To:</label>
                                   <input type="date" name="date_to" class="form-control ml-1 mr-2" id="date_to">
                                 </div>
                                 <button type="submit" class="btn btn-primary btn-sm ml-2">Submit</button>
                                 <button class="btn btn-sm btn-danger " onclick="exportTableToCSV('@if($user){{$user->name}} @endif Data.csv')">Export To CSV</button>
                               </form>
                   
                   
                             </div>
                       </div>
                       <br>
                       <div class="row">
                           <div class="col-md-4">@if($start)Start Date: {{date_format($start,"d/m/Y")}} @endif</div>
                           <div class="col-md-4">@if($end) End Date: {{date_format($end,"d/m/Y")}} @endif</div>
                           <div class="col-md-4">@if($total) Total: {{$total}} @endif</div>
                       </div>
                       <br>
                        <div class="table-responsive">
                            <table class="table table-stripped table-border table-sm">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        {{-- <th>Action</th> --}}
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>SS</th>
                                        <th>Cat</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Pay Status</th>
                                        <th>Date</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>

                                <?php $i = (($profiles->currentPage() - 1) * $profiles->perPage() + 1); ?>
                                    @foreach ($profiles as $profile)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            {{-- <td>
                                                <div class="btn-group btn-group-sm">

                                                    @if ($profile->status == "0")

                                                    <a href="{{ route('admin.profileStatusChange',['profile'=>$profile,'status'=>'approve']) }}" class="btn btn-xs
                                                    btn-success" onclick="return confirm('Do you want to approve this profile?')">Approve</a>
                                                    <a href="{{ route('admin.profileStatusChange',['profile'=>$profile,'status'=>'deny']) }}" class="btn btn-xs
                                                    btn-danger" onclick="return confirm('Do you want to deny this profile?')">Decline</a>
                                                    @elseif ($profile->status == '1')

                                                    <button class="btn btn-xs
                                                    btn-warning">Approved</button>
                                                    @elseif($profile->status == 'deny')
                                                    <button class="btn btn-xs
                                                    w3-deep-orange">Reject</button>
                                                    @endif
                                                    
                                                    <a href="{{ route('admin.serviceProfileDetails',['profile'=>$profile->id]) }}" class="btn btn-info btn-xm">Details</a>

                                                    @if(Auth::user()->roleItems()->count() < 1)
                                                    <a href="{{ route('admin.serviceProfileDelete',['profile'=>$profile->id]) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-xs">Delete</a>
                                                    @endif
                                                     <a class="btn btn-xs btn-success " href="{{ route('admin.serviceProfileEdit',['profile'=>$profile->id]) }}">Edit</a>

                                                    
                                                </div>
                                            </td> --}}
                                            <td>{{ ucfirst($profile->name) }}</td>
                                            <td>{{ ucfirst($profile->user->email ?? '') }}</td>
                                            <td>{{ ucfirst($profile->user->mobile ?? '') }}</td>
                                            <td>{{ ucfirst($profile->workstation->title ?? '') }}</td>
                                            <td>{{ ucfirst($profile->category->name ?? '') }}</td>
                                            <td>{{ ucfirst($profile->profile_type ?? '') }}</td>
                                            <td>
                                                {{ $profile->status == 1 ? 'Active' : 'Pending' }}
                                            </td>
                                            <td>
                                                {{ $profile->paystatus == 1 ? 'Paid' : 'Unpaid' }}
                                            </td>
                                            <td>{{date_format($profile->created_at,"d/m/Y")}}</td>
                                            
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        {{ $profiles->render() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
<script>
  function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}
function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("table tr");
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");
        
        for (var j = 0; j < cols.length; j++) 
        row.push("\""+cols[j].innerText+"\"");
        
        csv.push(row.join(","));        
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}
</script>
@endpush
