<!-- <html>
@foreach($customerList as $key=>$data)
 <td>{{ $data->name}}</td><td>{{ $data->link}}</td><td>{{ $data->comment}}</td>
 @endforeach
</html> -->
@extends('admin.layouts.adminMaster')



@section('content')
    <section class="content">
        <div class="row">
            
           
            <div class="col-md-12">
                @include('alerts.alerts')
                <div class="card card-primary">
                    <div class="card-header">
                       Valued Customer/Our Partners/Model Shop List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped table-border table-sm">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Comment</th>
                                        <th>Link</th>
                                        <th>Added By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>

                             
                                
                            @foreach ($customerList as $key=>$data)
                            
                            <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $data->name}}</td>  
                            <td>
                                @if($data->type==1)
                                 Valued Customer
                                @elseif($data->type==2)
                                 Our Partner
                                @elseif($data->type==4)
                                Courier
                                @else 
                                 Model Shop
                                @endif
                                
                            </td>                     
                            <td><img  src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $data->vc()]) }}" width="100" height="100" alt="Image not available" ></td>
                            <td>{{ $data->comment}}</td>
                            <td><a href="{{ $data->link}}">{{ $data->link}}</a></td>                     
                            <td>{{ $data->added_by->name ?? ''}}</td>
                            <td>
                                <div class="btn-group btn-group-xs">
                                    <a class="btn btn-success btn-xs" href="{{route('admin.editvaluedCustomer',$data->id)}}">Edit</a>
                                    <a class="btn btn-danger btn-xs" href="{{route('admin.deleteValuedCustomer',$data->id)}}">Delete</a>
                                </div>

                            </td>
                            </td>
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
@endsection




