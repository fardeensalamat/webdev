
@extends('admin.layouts.adminMaster')



@section('content')
    <section class="content">
        <div class="row">
            
           
            <div class="col-md-12">
                @include('alerts.alerts')
                <div class="card card-primary">
                    <div class="card-header">
                        Top Priority List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped table-border table-sm">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Comment</th>
                                        <th>Link</th>
                                        <th>Service Profile</th>
                                        <th>From</th>
                                        <th>TO</th>
                                        <th>Added by</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>

                             
                                
                            @foreach ($priorityList as $key=>$data)
                            
                            <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $data->name}}</td>                       
                            <td><img  src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $data->tp()]) }}" width="100" height="100" alt="Image not available" ></td>
                            <td>{{ $data->comment}}</td>
                            <td><a href="{{ $data->link}}">{{ $data->link}}</a></td>
                            <td>{{ $data->service_profile}}</td>  
                            <td>{{ $data->from}}</td>  
                            <td>{{ $data->to}}</td>                       
                            <td>{{ $data->added_by->name ?? ''}}</td>
                            <td>
                                <div class="btn-group btn-group-xs">
                                    <a class="btn btn-success btn-xs" href="{{route('admin.editTopPriority',$data->id)}}">Edit</a>
                                    <a class="btn btn-danger btn-xs" href="{{route('admin.deleteTopPriority',$data->id)}}">Delete</a>
                                </div>
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




