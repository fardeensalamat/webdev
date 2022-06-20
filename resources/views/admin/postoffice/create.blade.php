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
                <h3>Add Post Office</h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-5 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.storepostoffice') }}" method="POST" id='my-form'>
                                @csrf
                                <div class="form-group">
                                    <label for="type">Name</label>
                                    <input  type="text" value="" class="form-control" name="name" required>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="type">Bangla Name</label>
                                    <input  type="text" value="" class="form-control" name="bn_name" required>
                                    @error('bn_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="type">Code</label>
                                    <input  type="text" value="" class="form-control" name="code" required>
                                    @error('code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="type">Thana/Upazila</label>
                                    <select name="thana_id" id="thana_id" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($thanas as $thana)
                                            <option value="{{$thana->id}}">{{$thana->name}}</option>
                                        @endforeach
                                    </select>
                                   
                                    @error('thana_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                               
                                <div class="form-group">
                                    <input class="btn btn-info" type="submit" value="Save">
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
