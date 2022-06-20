@extends('admin.layouts.adminMaster')

@section('content')
    <br>
    <section class="content">
        @include('alerts.alerts')
        <div class="card bg-info">
            <div class="card-body">
                <h3>Edit Slider</h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.updateslider',$data->id) }}" method="POST" id='my-form' enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Title</label>
                                            <input  type="text" value="{{$data->title}}" class="form-control" name="title" required>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Link Title</label>
                                            <input  type="text" value="{{$data->linktitle}}" class="form-control" name="linktitle" required>
                                            @error('linktitle')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Link</label><br>
                                            <textarea name="link" type="text" value="{{$data->link}}" class="form-control" id="" cols="45" rows="3"></textarea>
                                            
                                            @error('link')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                       

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Description</label><br>
                                            <textarea name="description" type="text" class="form-control" id="" cols="45" rows="3"> {{$data->description}}</textarea>
                                            
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                       

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">Slider Image (1200*420px)</label>
                                            <input type="file" name="image" id="image" class="form-control">
                                        </div>
                                        @if ($data->image)
                                            <br>
                                            <a data-toggle="lightbox" href="{{ route('imagecache', ['template' => 'ppxlg', 'filename' => $data->si()]) }}">  
                                            <img class="img-fluid" src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $data->si()]) }}" alt="">
                                            </a>
                                      
                                        @endif
                                        
                                    </div>
                                </div>


                               
                                <br>
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
