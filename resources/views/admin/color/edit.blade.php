@extends('admin.layouts.adminMaster')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
@endpush

@section('content')
    <br>
    <section class="content">
        @include('alerts.alerts')
        <div class="card bg-info">
            <div class="card-body">
                <h3>Edits Colors</h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-5 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.updatecolor',$data->id) }}" method="POST" id='my-form'>
                                @csrf
                                <input  type="hidden" value="{{$data->id}}" class="form-control" name="id" required>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input  type="text" value="{{$data->name}}" class="form-control" name="name" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="sval">Color</label>
                                    <input  type="text" value="{{$data->sval}}" class="form-control" name="sval" required>
                                    @error('sval')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                              
                                <div class="form-group">
                                    <label for="title">Description</label><br>
                                    <textarea name="description" type="text" class="form-control" id="" cols="45" rows="3">{{$data->description}}</textarea>
                                    
                                    @error('description')
                                        <span class="text-danger">{{ $description }}</span>
                                    @enderror
                                </div>
                               
                                <div class="form-group">
                                    <input class="btn btn-info" type="submit" value="Update">
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
