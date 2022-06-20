@extends('admin.layouts.adminMaster')

@section('title')
<title>Edit Brands</title>
@endsection
@push('css')
@endpush
@section('content')
@include('alerts.alerts')
<br>
<section class="content">
    <div class="card card-primary">
        <div class="card-header">
            Manage Brand Details
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-5">
                
                    <div class="card card-primary ">
                    <div class="card-header">
                        Edit Brand
                        <div class="card-tools">
                            <a class="btn btn-sm btn-default w3-green" href="{{route('admin.addNewBrand')}}">Back</a>
                        </div>
                    </div>
                    <div class="card-body">

                            <form action="{{route('admin.brandUpdate',$brand->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-group">
                                    <label>Brand Name*</label>
                                    @if ($errors->has('title'))
                                    <p style="color: red;margin: 0;">{{ $errors->first('title') }}</p>
                                    @endif
                                    <input type="text" name="title" value="{{$brand->title}}" class="form-control" placeholder="Enter Brand Name">
                                </div>

                                <div class="form-group">
                                    <label>Brand Meta Title (Optinal)</label>
                                    @if ($errors->has('slug'))
                                    <p style="color: red;margin: 0;">{{ $errors->first('slug') }}</p>
                                    @endif
                                    <input type="text" name="meta_title" value="{{$brand->meta_title}}" class="form-control" placeholder="Enter  Brand Meta Title">
                                </div>

                                <div class="form-group">
                                    <label>Brand Description (Optional)</label>
                                    @if ($errors->has('description'))
                                    <p style="color: red;margin: 0;">{{ $errors->first('description') }}</p>
                                    @endif
                                    <textarea name="description" rows="3" class="form-control" placeholder="Write Description">{!!$brand->description!!}</textarea>
                                </div>
                                <div class="form-group">
                                    @if($brand->img_name==null)
                                    No Image
                                    @else
                                    <img src="{{ route('imagecache', [ 'template'=>'cpsm','filename' => $brand->img_name ]) }}" class="img-fluid" style="width: 100px;" alt="{{$brand->title}}">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Brand Image</label>
                                    @if ($errors->has('image'))
                                    <p style="color: red;margin: 0;">{{ $errors->first('image') }}</p>
                                    @endif
                                    <input type="file" name="image" class="form-control" >
                                </div>

                                <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label>Brand Status</label>
                                        <div class="i-checks"><label style="cursor: pointer;"> <input name="active"  type="checkbox" {{$brand->active==true?'checked':''}}> <i></i> Active</label></div>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Brand Fetured</label>
                                        <div class="i-checks"><label style="cursor: pointer;"> <input name="featured"  type="checkbox" {{$brand->featured==true?'checked':''}}> <i></i> Active</label></div>
                                        </div>
                                </div>
                                <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                </form>

                    </div>
                </div>
                </div>

            </div>
        </div>
    </div>
</section>


@endsection
@push('js')
@endpush
