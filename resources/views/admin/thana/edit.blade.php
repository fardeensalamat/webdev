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
                <h3>Edits Thana</h3>
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
                                    <label for="type">Bangla Name</label>
                                    <input  type="text" value="{{$data->bn_name}}" class="form-control" name="bn_name" required>
                                    @error('bn_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="type">District</label>
                                    <select name="district_id" id="district_id" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($districts as $district)
                                            <option value="{{$district->id}}"  @if($district->id==$data->district_id) selected @endif>{{$district->name}}</option>
                                        @endforeach
                                    </select>
                                   
                                    @error('district_id')
                                        <span class="text-danger">{{ $message }}</span>
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
