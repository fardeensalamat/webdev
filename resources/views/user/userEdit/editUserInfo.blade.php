@extends('user.layouts.userMaster')
@push('css')
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
                        
                      {{ __('tenant.tenant_information_update') }} 
      
                      </span> 
                  </h3>
                    </div>
                    <div class="card-body" style="min-height: 200px;">
      
      
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-md-8">
                  <div class="card">
                      <div class="card-header">{{ __('tenant.update_tenant') }}  ({{ $user->mobile }})</div>
      
                      <div class="card-body">
                          <form method="POST" action="{{ route('user.userUpdate') }}" enctype="multipart/form-data">
                              @csrf
                              <div class="form-group row">
                                <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('tenant.mobile') }} </label>
    
                                <div class="col-md-6">
                                    <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror"  value="{{ old('mobile') ?: $user->mobile }}" readonly autocomplete="mobile" >
    
                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                              <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('tenant.upload_image') }} </label>
    
                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" >
    
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @if ($user->img_name)
                                        <img src=" {{ route('imagecache', ['template' => 'pfism', 'filename' => $user->img_name]) }} " alt="" srcset="">
                                    @endif
                                </div>
                            </div>
      
                              <div class="form-group row">
                                  <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('tenant.full_name') }} </label>
      
                                  <div class="col-md-6">
                                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?: $user->name }}" required autocomplete="name" autofocus>
      
                                      @error('name')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div>
      
                              <div class="form-group row">
                                  <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('tenant.email_address') }} </label>
      
                                  <div class="col-md-6">
                                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?: $user->email }}"  autocomplete="email">
      
                                      @error('email')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div>


                            <div class="form-group row">
                                <label for="sc_fb_group_link" class="col-md-4 col-form-label text-md-right">{{ __('tenant.facebook_group_link') }} </label>
    
                                <div class="col-md-6">
                                    <a class="btn btn-info btn-xs" href="{{ $websiteParameter->fb_page_link ?? '' }}">{{ __('tenant.join_in_facebook') }} </a>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sc_fb_group_link_image" class="col-md-4 col-form-label text-md-right">{{ __('tenant.joined_fb') }}  </label>
    
                                <div class="col-md-6">
                                    <input type="checkbox" name="sc_fb_group_link_image" id="sc_fb_group_link_image"  {{ $user->sc_fb_group_link_image?'checked':'' }}>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sc_youtube_channel_link" class="col-md-4 col-form-label text-md-right">{{ __('tenant.youtube_channel_link') }} </label>
    
                                <div class="col-md-6">
                                    <a class="btn btn-danger btn-xs" href="{{ $websiteParameter->youtube_url ?? '' }}"> {{ __('tenant.subscribe_in_youtube') }}</a>
                                </div>
                            </div>
      
      
                            <div class="form-group row">
                                <label for="sc_youtube_channel_link_image" class="col-md-4 col-form-label text-md-right">{{ __('tenant.subscribed_youtube') }} </label>
    
                                <div class="col-md-6">
                                    <input type="checkbox" name="sc_youtube_channel_link_image" id="sc_youtube_channel_link_image"  {{ $user->sc_youtube_channel_link_image?'checked':'' }}>
                                </div>
                            </div>

                              <div class="form-group row mb-0">
                                  <div class="col-md-6 offset-md-4">
                                      <button type="submit" class="btn btn-primary">
                                      {{ __('tenant.update') }}
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
    
    </section>
@endsection


@push('js')

 



@endpush

