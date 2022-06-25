@extends('admin.layouts.adminMaster')

@section('content')


        <br>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header" style="display: flex; align-items: center;">
                    <div class="card-title"><h3> All Check Ins of Employees</h3></div>
                                <div>
                                            <form class="form-inline" method="get" action="" enctype="multipart/form-data">

                                                    <div class="row" style="margin-left: 1vw;">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                        <input type="search" name="search_name"  placeholder="Search by Employee Name" class="form-control">
                                                                </div>
                                                            </div>

                                                        
                                                                

                                                    </div>
                                                    <div>
                                                        <button type="submit" class="w3-btn w3-blue w3-round w3-border w3-border-white">Search</button>
                                                        <a href=""><button type="submit" class="w3-btn w3-red w3-round w3-border w3-border-white">Reset</button></a>
                                                                                       
                                                    </div>
                                        </form>
                                
                               </div>

                                
                                


                </div>
                <br> 
            </div>
{{-- admin.employeeAllCheckIns --}}
            


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" style="white-space: nowrap">
                        <thead style="background-color:white;">
                            <tr>
                                <th>Shop Check In</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Note</th>
                                <th>Date</th>
                                <th>Employee Name</th>
                    
                               
                            
                            </tr>
                        </thead>
                   
                        <tbody>
                            
                            
                         @foreach($checkins as $data)
                         
                           <tr>
                            <?php                   
                               $date = date('h:i:s a m/d/Y', strtotime($data->created_at));
                            ?>
                           
                            <td>{{$data->name}}</td>
                            <td>{{$data->address}}</td>
                            <td>{{$data->phone}}</td>                           
                            <td>{{$data->note}}</td>
                            <td>{{$date}}</td>
                            <td>{{$data->user_name}}</td>

                           </tr>
                        
                         @endforeach
                        </tbody>
                      
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </section>


@endsection

@push('js')



@endpush
