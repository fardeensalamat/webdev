@extends('admin.layouts.adminMaster')

@push('css')
<link rel="stylesheet" href="{{ asset('cp/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('cp/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
  <section class="content">

  	<br>

  	 <div class="row">
      
      <div class="col-sm-12">


@include('alerts.alerts')





            <div class="card card-widget">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-briefcase text-primary"></i> <span class="badge badge-light">
                  
                    Work Station Information Update

                </span> 
            </h3>
              </div>
              <div class="card-body" style="min-height: 200px;">


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Work Station') }} ({{ $workstation->title }})</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.workStationUpdate', $workstation) }}" enctype="multipart/form-data">
                        @csrf


                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?: $workstation->title }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?: $workstation->description }}" required autocomplete="description" >{!! $workstation->description !!}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group row">
                            <label for="subscription_code" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('feature_img') ?: $workstation->feature_img }}" autocomplete="image" >

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if ($workstation->feature_img)
                        <div class="form-group row">
                            <label for="subscription_code" class="col-md-4 col-form-label text-md-right">{{ __('Image Preview') }}</label>

                            <div class="col-md-6">
                                <img src="{{asset('storage/workStation/image/'.$workstation->feature_img)}}" width="100" height="50" alt="">
                            </div>
                        </div>
                        @endif
                        
                        <div class="form-group row">
                            <label for="user_page_msg" class="col-md-4 col-form-label text-md-right">{{ __('User Page Message') }}</label>

                            <div class="col-md-6">
                                <textarea id="user_page_msg" type="text" class="form-control @error('user_page_msg') is-invalid @enderror" name="user_page_msg" value="{{ old('user_page_msg') ?: $workstation->user_page_msg }}" autocomplete="user_page_msg" >{!! $workstation->user_page_msg !!}</textarea>

                                @error('user_page_msg')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="active" class="col-md-4 col-form-label text-md-right">{{ __('Active') }}</label>

                            <div class="col-md-6">
                                <input id="active" type="checkbox" class=" mt-2 @error('active') is-invalid @enderror" name="active" {{$workstation->active==1 ? 'checked': ''}}>

                                @error('active')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

                
              </div>
            </div>
          </div>
        </div>



          </div>
      </div>
  </div>
</div>


  
  </section>
@endsection


@push('js')
 <!-- Select2 -->
 <script src="{{ asset('cp/plugins/select2/js/select2.full.min.js') }}"></script>


<script>
  

   $(function () {
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        });

    });
</script>
@endpush

