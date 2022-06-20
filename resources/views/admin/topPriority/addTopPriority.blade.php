@extends('admin.layouts.adminMaster')

@section('content')
    <br>
    <section class="content">
        @include('alerts.alerts')
        <div class="card bg-info">
            <div class="card-body">
                <h3>Add Top Priority</h3>
            </div>
        </div>
              <!-- Success message -->
      @if(Session::has('msg'))

<p class="alert alert-success"> {{ Session::get('msg') }} </p> 

@endif
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.storeTopPriority') }}" method="POST" id='my-form' enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Name</label>
                                            <input  type="text" value="" class="form-control" name="name" required>
                                            @error('name')
                                                   <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Link</label>
                                            <input  type="text" value="" class="form-control" name="link" required>
                                        </div>
                                    </div>
                                </div>
                                
                                
                               
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">Comment</label><br>
                                            <textarea name="comment" type="text" class="form-control" id="" cols="45" rows="3"></textarea>
                                        </div>
                                       

                                    </div>
                               
                                </div>
                         
                                <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>     
                                </div>

                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputState">Select Service Profile</label>
                                    <select id="inputState" class="form-control" name="service_profile">
                                    @foreach ($service_station as $key=>$data)                                        
                                         <option value="{{ $data->id}}"> {{ $data->name}} </option>
                                    @endforeach 
                                    </select>
                                   
                                                        
                                    </div>

                                </div>
                                
                                
                                
                             </div>

                       
                              <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                        <label class="form-label">From:</label>
                                            <input class="form-control" type="date" name="from">
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label class="form-label">To:</label>
                                            <input class="form-control" type="date" name="to">
                                        </div>
                                    </div>
                                </div>
                               
                              
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="btn btn-info" type="submit" value="Submit">
                                        </div>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

          
        </div>
    </section>
@endsection
@push('js')


@endpush



