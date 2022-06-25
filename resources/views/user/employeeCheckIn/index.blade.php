@extends('user.layouts.userMaster')

@section('content')


        <br>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-title"> All Check Ins of <b>{{Auth::user()->name}}</b></div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" style="white-space: nowrap">
                        <thead>
                            <tr>
                                <th>Shop Check In</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Note</th>
                                <th>Date</th>
                                <th>Action</th>
                               
                            
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
                            <td><a onclick="return confirm('Are you sure?. you want to delete this Product?');" href="{{route('user.deleteCheckIn',$data->id)}}" class="btn btn-danger btn-xs">Delete</a></td>
                          
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
