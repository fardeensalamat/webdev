@extends('admin.layouts.adminMaster')

@section('content')
    <br>
    <section class="content">
        @include('alerts.alerts')
        <div class="card bg-info">
            <div class="card-body">
                <h3>Add Valued Customer/Our Partners/Model Shop</h3>
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
                            <form action="{{ route('admin.storeValuedCustomer') }}" method="POST" id='my-form' enctype="multipart/form-data">
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
                                        <label for="type">Type</label>
                                            <select id="inputState" class="form-control" name="type">
                                                <option value="1">Valued Customer</option>
                                                <option value="2">Our Partner</option> 
                                                <option value="3">Model Shop</option> 
                                                <option value="4">Courier</option>                            
                                            </select>
                                                                               
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
                                            <label for="type">Link</label>
                                            <input  type="text" value="" class="form-control" name="link" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" name="image" id="image" class="form-control">
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
