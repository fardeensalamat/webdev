@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>

        <style>
            tr.nowrap td {
                white-space: nowrap;
            }

            tr.nowrap th {
                white-space: nowrap;
            }

        </style>


        <div class="row">

            <div class="col-sm-12">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            My Team
                        </h3>
                        <div class="card-tools">
                            <form action="">

                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text"
                                        data-url="{{ route('admin.searchAjax', ['type' => 'employee', 'status' => isset($status) ? $status : null]) }}"
                                        class="form-control ajax-data-search" placeholder="Search Tenant">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary w3-border">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body" >




                        @include('user.employee.ajax.myteam')


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
