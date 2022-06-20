@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
<br>

<section class="content">
    <div class="row">
       
        <div class="col-md-12">
            @include('alerts.alerts')
            <div class="card card-info">
                <div class="card-header">
                   Category List
                   <div class="card-tools">
                  

                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Search Category">
                            </div>
                    </div>
                        
                </div>
               
                <div class="card-body">
                    <div class="table-responsive">
                        
                        <table class="table table-sm table-striped table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>WorkStation</th>
                                    <th>Service Chrage</th>
                                    <th>Commission</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>

                                @foreach ($categories as $data)
                                    <tr>
                                       <td>{{$data->name}}</td>
                                       <td>{{$data->workstation->title}}</td>
                                       <td>{{$data->sp_create_charge}}</td>
                                       <td>{{$data->service_product_commission}}</td>
                                        
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }       
      }
    }
</script>

@endsection


