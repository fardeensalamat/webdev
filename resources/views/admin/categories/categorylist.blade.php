@extends('admin.layouts.adminMaster')

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
                    <div class="row">
                        <div class="col-sm-12">
                            <form class="form-inline" method="get" action="{{ route('admin.servicecategory')}}">
                             <div class="form-group form-group-sm">
                                 <label for="workstation_id">Work Station</label>
                                 <select name="workstation_id" id="workstation_id" class="form-control ml-1 mr-1" >
                                     <option value="">Select One</option>
                                     @foreach($workstations as $workstation)
                                      <option value="{{$workstation->id}}" @if($workstation->id==$workstation_id) Selected @endif>{{$workstation->title}}</option>
                                     @endforeach
                                 </select>
                               </div>
                              <button type="submit" class="btn btn-primary btn-sm ml-2">Submit</button>

                            </form>
                
                
                          </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-stripped table-border table-sm"  id="myTable">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>WorkStation</th>
                                    <th>Service Chrage</th>
                                    <th>Commission</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <form action="{{ route('admin.updatecategorylist') }}" method="POST">
                            @csrf
                            <tbody>
                                <?php $i = 1; ?>

                                @foreach ($categories as $data)
                               
                                   
                                    <tr>
                                       
                                       <td>{{$data->name}}</td>
                                       <td>{{$data->workstation->title}}</td>
                                    
                                       
                                        <input type="hidden" name="id[]" value="{{$data->id}}">
                                        <td><input type="text" name="sp_create_charge[]" value="{{$data->sp_create_charge}}"></td>
                                        <td><input type="text" name="service_product_commission[]" value="{{$data->service_product_commission}}"></td>
                                       
                                    
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <td colspan="3"></td>
                                <td><button class="btn btn-info btn-xs" type="submit">Update</button></td>
                            </tfoot>
                        </form>

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