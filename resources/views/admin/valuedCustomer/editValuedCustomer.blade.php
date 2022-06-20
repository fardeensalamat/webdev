@extends('admin.layouts.adminMaster')

@section('content')
    <br>
    <section class="content">
        @include('alerts.alerts')
        <div class="card bg-info">
            <div class="card-body">
                <h3>Edit Valued Customer/Our Partners/Model Shop</h3>
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
                            <form action="{{ route('admin.storeEditedValuedCustomer',$editData->id) }}" method="POST" id='my-form' enctype="multipart/form-data">
                                @csrf
                             
                                
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Name</label>
                                            <input  type="text" value="{{$editData->name}}" class="form-control" name="name" required>
                                            @error('name')
                                                   <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="type">Type</label>
                                            <select id="inputState" class="form-control" name="type">
                                                <option value="1" @if($editData->type==1) Selected @endif>Valued Customer</option>
                                                <option value="2" @if($editData->type==2) Selected @endif>Our Partner</option> 
                                                <option value="3" @if($editData->type==3) Selected @endif>Model Shop</option> 
                                                <option value="4" @if($editData->type==4) Selected @endif>Courier</option>                            
                                            </select>                                       
                                        </div>
                                    </div>

                                </div>

                                                                  
                               
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">Comment</label><br>
                                            <textarea name="comment" type="text" class="form-control" id="" cols="45" rows="3">{{$editData->comment}}</textarea>
                                        </div>
                                       

                                    </div>
                               
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Link</label>
                                            <input  type="text" value="{{$editData->link}}" class="form-control" name="link" required>
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
