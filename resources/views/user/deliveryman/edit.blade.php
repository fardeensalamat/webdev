@extends('user.layouts.userMaster')

@section('content')
    <br>
    <section class="content">
        @include('alerts.alerts')
        <div class="card bg-info">
            <div class="card-body">
                <h3>Edits Delivery Man</h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('user.updatedeliveryman',$data->id) }}" method="POST" id='my-form' enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Name</label>
                                            <input  type="text" value="{{$data->name}}" class="form-control" name="name" required>
                                            @error('type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">NID</label>
                                            <input  type="text" value="{{$data->nid}}" class="form-control" name="nid" required>
                                            @error('nid')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Phone</label>
                                            <input  type="text" value="{{$data->phone}}" class="form-control" name="phone" required>
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Email</label>
                                            <input  type="text" value="{{$data->email}}" class="form-control" name="email" required>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Address</label><br>
                                            <textarea name="address" type="text" class="form-control" id="" cols="45" rows="3">{{$data->address}}</textarea>
                                            
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                       

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Area</label><br>
                                            <textarea name="area" type="text" class="form-control" id="" cols="45" rows="3">{{$data->area}}</textarea>
                                            
                                            @error('area')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                       

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="profile_image">Profile Image</label>
                                            <input type="file" name="profile_image" id="profile_image" class="form-control">
                                            @if ($data->profile_image)
                                                <br>
                                                <a data-toggle="lightbox" href="{{ route('imagecache', ['template' => 'ppxlg', 'filename' => $data->pi()]) }}">  
                                                  <img class="img-fluid" src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $data->pi()]) }}" alt="">
                                                </a>
                                              
                                            @endif
                    
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nid_image">NID Image</label>
                                            <input type="file" name="nid_image" id="nid_image"  class="form-control">
                                            @if ($data->nid_image)
                                                <br>
                                            <a data-toggle="lightbox" href="{{ route('imagecache', ['template' => 'ppxlg', 'filename' => $data->ni()]) }}">  
                                                <img class="img-fluid" src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $data->ni()]) }}" alt="">
                                            </a>
                                              
                                            @endif
                    
                                        </div>
                                        
                                    </div>
                                </div>
                              
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="btn btn-info" type="submit" value="Save">
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
