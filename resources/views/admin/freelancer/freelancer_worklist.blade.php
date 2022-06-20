@extends('admin.layouts.adminMaster')

@push('css')
@endpush

@section('content')
<section class="content">
    <br>
    <div class="row">

<style>
  tr.nowrap td {
       white-space:nowrap;
   }

   tr.nowrap th {
       white-space:nowrap;
   }
</style>

      
        <div class="col-sm-12">
          @include('alerts.alerts')
  
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        All Freelancer Work List
                    </h3>
                    @php
                        $type="freelancerworklist"
                    @endphp
                </div>
    
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form class="form-inline" method="get" action="{{ route('admin.freelancerworklistfilter')}}">
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
                                 <label for="employee">Freelancer</label>
                                 <select name="employee" id="employee" class="form-control ml-1 mr-1" >
                                     @foreach($users as $user)
                                      <option value="{{$user->id}}" @if($employee)@if($user->id==$employee->id) Selected @endif @endif>{{$user->name}}</option>
                                     @endforeach
                                 </select>
                               </div>
                             {{-- <div class="form-group form-group-sm">
                                 <label for="paystatus"> Status</label>
                                 <select name="paystatus" id="paystatus" class="form-control ml-1 mr-1" >
                                     <option value="1">Approved</option>
                                     <option value="0">Pending</option>
                                 </select>
                               </div> --}}
                              <div class="form-group form-group-sm">
                                <label for="date_from">From:</label>
                                <input type="date" name="date_from" class="form-control ml-1 mr-1" id="date_from" >
                              </div>
                              <div class="form-group form-group-sm">
                                <label for="date_to">To:</label>
                                <input type="date" name="date_to" class="form-control ml-1 mr-2" id="date_to">
                              </div>
                              <br><br>
                              <button type="submit" class="btn btn-primary btn-sm ml-2">Submit</button>
                                 <button class="btn btn-sm btn-danger " onclick="exportTableToCSV('@if($employee){{$employee->name}} @endif Data.csv')">Export To CSV</button>

                            </form>
                
                
                          </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2">
                         <div class="dropdown">
                             <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Date
                             <span class="caret"></span></button>
                             <ul class="dropdown-menu">
                               <li><a class="ml-3" href="{{route('admin.serviceprofileGetByDate', ['date'=>'today','type'=>$type])}}">Today</a></li>
                               <li><a class="ml-3" href="{{route('admin.serviceprofileGetByDate', ['date'=>'yesterday','type'=>$type])}}">Yesterday</a></li>
                               <li><a class="ml-3" href="{{route('admin.serviceprofileGetByDate', ['date'=>7,'type'=>$type])}}">Last 7 Days</a></li>
                               <li><a class="ml-3" href="{{route('admin.serviceprofileGetByDate', ['date'=>30,'type'=>$type])}}">Last 30 Days</a></li>
                               <li><a class="ml-3" href="{{route('admin.serviceprofileGetByDate', ['date'=>'this_month', 'type'=>$type])}}">This Month</a></li>
                               <li><a class="ml-3" href="{{route('admin.serviceprofileGetByDate', ['date'=>'last_month','type'=>$type])}}">Last Month</a></li>
                             </ul>
                           </div>
                            
                        </div>
                        <div class="col-md-2">@if($employee)Name: {{$employee->name}} @endif</div>
                        <div class="col-md-2">@if($start)Start Date:{{$start}} @endif</div>
                        <div class="col-md-2">@if($end) End Date: {{$end}} @endif</div>
                        <div class="col-md-2">@if($total) Total: {{$total}} @endif</div>
                    </div>
                    <br>
                    @include('admin.freelancer.ajax.freelancer_worklist')
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