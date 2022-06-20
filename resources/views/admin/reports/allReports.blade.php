@extends('admin.layouts.adminMaster')
@section('content')
<section class="content">
<br>
<div class="row">
    <div class="col-sm-12">
        <div class="card card-widget">
            <div class="card-body">
              <div class="row">
                  <div class="col-sm-2 mt-1">
                    <div class="dropdown">
                      <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Date
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a class="ml-3" href="{{route('admin.reportsGetByDate', ['date'=>'today','type'=>$type])}}">Today</a></li>
                        <li><a class="ml-3" href="{{route('admin.reportsGetByDate', ['date'=>'yesterday','type'=>$type])}}">Yesterday</a></li>
                        <li><a class="ml-3" href="{{route('admin.reportsGetByDate', ['date'=>7,'type'=>$type])}}">Last 7 Days</a></li>
                        <li><a class="ml-3" href="{{route('admin.reportsGetByDate', ['date'=>30,'type'=>$type])}}">Last 30 Days</a></li>
                        <li><a class="ml-3" href="{{route('admin.reportsGetByDate', ['date'=>'this_month', 'type'=>$type])}}">This Month</a></li>
                        <li><a class="ml-3" href="{{route('admin.reportsGetByDate', ['date'=>'last_month','type'=>$type])}}">Last Month</a></li>
                      </ul>
                    </div>
                  </div>
                  @if ($type == 'Tenant')
                  <div class="col-sm-9">
                    <form class="form-inline" method="get" action="{{route('admin.reportsGetByDateInterval',['type'=>$type])}}">
                      <div class="form-group form-group-sm">
                        <label for="date_from">From:</label>
                        <input type="date" name="date_from" class="form-control ml-1 mr-1" id="date_from">
                      </div>
                      <div class="form-group form-group-sm">
                        <label for="date_to">To:</label>
                        <input type="date" name="date_to" class="form-control ml-1 mr-2" id="date_to">
                      </div>

                      <div class="form-group form-group-sm">
                        <select name="active" id="" class="form-control">
                          <option value="1">Select Status</option>
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </select>
                      </div>
                     
                      <button type="submit" class="btn btn-primary btn-sm ml-2">Submit</button>
                    </form>
        
        
                  </div>
                  @elseif($type == 'PF')
                  <form class="form-inline" method="get" action="{{route('admin.reportsGetByDateInterval',['type'=>$type])}}">
                    <div class="form-group form-group-sm">
                      <label for="date_from">From:</label>
                      <input type="date" name="date_from" class="form-control ml-1 mr-1" id="date_from">
                    </div>
                    <div class="form-group form-group-sm">
                      <label for="date_to">To:</label>
                      <input type="date" name="date_to" class="form-control ml-1 mr-2" id="date_to">
                    </div>

                    <div class="form-group form-group-sm">
                      @if (isset($workstations))
                        <select name="ws" id="workstation" class="form-control">
                          <option value="1" class="form-group">Select Workstation</option>
                          @foreach ($workstations as $ws)
                              <option value="{{$ws->id}}">{{$ws->title}}</option>
                          @endforeach
                        </select>
                      @endif
                    </div>
                   
                    <button type="submit" class="btn btn-primary btn-sm ml-2">Submit</button>
                  </form>
                  @elseif($type == 'Jobs')
                    <form class="form-inline" method="get" action="{{route('admin.reportsGetByDateInterval',['type'=>$type])}}">
                      <div class="form-group form-group-sm">
                        <label for="date_from">From:</label>
                        <input type="date" name="date_from" class="form-control ml-1 mr-1" id="date_from">
                      </div>
                      <div class="form-group form-group-sm">
                        <label for="date_to">To:</label>
                        <input type="date" name="date_to" class="form-control ml-1 mr-2" id="date_to">
                      </div>

                      <div class="form-group form-group-sm">
                        <select name="jobStatus" id="" class="form-control">
                          <option value="completed">Select Status</option>
                          <option value="completed">Completed</option>
                          <option value="">Incomplete</option>
                        </select>
                      </div>
                    
                      <button type="submit" class="btn btn-primary btn-sm ml-2">Submit</button>
                    </form>

                    @elseif($type == 'Works')
                    <form class="form-inline" method="get" action="{{route('admin.reportsGetByDateInterval',['type'=>$type])}}">
                      <div class="form-group form-group-sm">
                        <label for="date_from">From:</label>
                        <input type="date" name="date_from" class="form-control ml-1 mr-1" id="date_from">
                      </div>
                      <div class="form-group form-group-sm">
                        <label for="date_to">To:</label>
                        <input type="date" name="date_to" class="form-control ml-1 mr-2" id="date_to">
                      </div>

                      <div class="form-group form-group-sm">
                        <select name="workStatus" id="" class="form-control">
                          <option value="approved">Select Status</option>
                          <option value="approved">Approved</option>
                          <option value="pending">Pending</option>
                          <option value="claimed">Claimed</option>
                          <option value="rejected">Rejected</option>
                        </select>
                      </div>
                    
                      <button type="submit" class="btn btn-primary btn-sm ml-2">Submit</button>
                    </form>
                    @elseif($type == 'Withdraw')
                    <form class="form-inline" method="get" action="{{route('admin.reportsGetByDateInterval',['type'=>$type])}}">
                      <div class="form-group form-group-sm">
                        <label for="date_from">From:</label>
                        <input type="date" name="date_from" class="form-control ml-1 mr-1" id="date_from">
                      </div>
                      <div class="form-group form-group-sm">
                        <label for="date_to">To:</label>
                        <input type="date" name="date_to" class="form-control ml-1 mr-2" id="date_to">
                      </div>

                      <div class="form-group form-group-sm">
                        <select name="method" id="" class="form-control">
                          <option value="bkash">Select Status</option>
                          <option value="bkash">bKash</option>
                          <option value="rocket">rocket</option>
                          <option value="nagad">nagad</option>
                          <option value="mobile_recharge">Recharge</option>
                        </select>
                      </div>
                    
                      <button type="submit" class="btn btn-primary btn-sm ml-2">Submit</button>
                    </form>
                    @elseif($type == 'Honorarium')
                    <form class="form-inline" method="get" action="{{route('admin.reportsGetByDateInterval',['type'=>$type])}}">
                      <div class="form-group form-group-sm">
                        <label for="date_from">From:</label>
                        <input type="date" name="date_from" class="form-control ml-1 mr-1" id="date_from">
                      </div>
                      <div class="form-group form-group-sm">
                        <label for="date_to">To:</label>
                        <input type="date" name="date_to" class="form-control ml-1 mr-2" id="date_to">
                      </div>
                    
                      <button type="submit" class="btn btn-primary btn-sm ml-2">Submit</button>
                      @elseif($type == 'Deposit')
                    <form class="form-inline" method="get" action="{{route('admin.reportsGetByDateInterval',['type'=>$type])}}">
                      <div class="form-group form-group-sm">
                        <label for="date_from">From:</label>
                        <input type="date" name="date_from" class="form-control ml-1 mr-1" id="date_from">
                      </div>
                      <div class="form-group form-group-sm">
                        <label for="date_to">To:</label>
                        <input type="date" name="date_to" class="form-control ml-1 mr-2" id="date_to">
                      </div>
                    
                      <button type="submit" class="btn btn-primary btn-sm ml-2">Submit</button>
                      @elseif($type == 'MoveWallet')
                    <form class="form-inline" method="get" action="{{route('admin.reportsGetByDateInterval',['type'=>$type])}}">
                      <div class="form-group form-group-sm">
                        <label for="date_from">From:</label>
                        <input type="date" name="date_from" class="form-control ml-1 mr-1" id="date_from">
                      </div>
                      <div class="form-group form-group-sm">
                        <label for="date_to">To:</label>
                        <input type="date" name="date_to" class="form-control ml-1 mr-2" id="date_to">
                      </div>
                    
                      <button type="submit" class="btn btn-primary btn-sm ml-2">Submit</button>
                      @elseif($type == 'Deposit')
                    <form class="form-inline" method="get" action="{{route('admin.reportsGetByDateInterval',['type'=>$type])}}">
                      <div class="form-group form-group-sm">
                        <label for="date_from">From:</label>
                        <input type="date" name="date_from" class="form-control ml-1 mr-1" id="date_from">
                      </div>
                      <div class="form-group form-group-sm">
                        <label for="date_to">To:</label>
                        <input type="date" name="date_to" class="form-control ml-1 mr-2" id="date_to">
                      </div>
                    
                      <button type="submit" class="btn btn-primary btn-sm ml-2">Submit</button>
                @endif
                  
                  
              </div>
              <div class="card-tools mt-2">
                <button class="btn btn-sm btn-primary " onclick="exportTableToCSV('{{$type}}Data.csv')">Export To CSV</button>
              </div>
            </div>
        </div>
    </div>
    
    @if (isset($reports))
      @if($type == 'Tenant')
          @include('admin.reports.parts.tenantReport')
      @elseif($type == 'PF')
          @include('admin.reports.parts.pfReport')
      @elseif( $type == 'Jobs')
          @include('admin.reports.parts.jobsReport')
      @elseif( $type == 'Withdraw')
          @include('admin.reports.parts.withdrawReport')
      @elseif($type == 'MoveWallet')
          @include('admin.reports.parts.moveWalletReport')
      @elseif($type == 'Honorarium')
          @include('admin.reports.parts.honorariumReport')
      @elseif($type=='Deposit')
          @include('admin.reports.parts.depositReport') 
      @elseif($type=='Works')
          @include('admin.reports.parts.worksReport')
      @endif
    @else
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body text-center w3-text-blue">
          <h2><b class="w3-animate-fading">Select Date (or Select Date Interval) and Submit</b></h2>
        </div>
      </div>
    </div>
    @endif
    
    
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