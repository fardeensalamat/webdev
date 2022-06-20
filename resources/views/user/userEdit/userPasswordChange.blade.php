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

                        {{ __('tenant.tenant_password_change') }} 

                            </span>
                        </h3>
                    </div>
                    <div class="card-body" style="min-height: 200px;">


                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card card-primary">
                                        <div class="card-header">  {{ __('tenant.password_change_of_tenant') }}  ({{ $user->mobile }})</div>

                                        <div class="card-body">
                                            <form method="POST" action="{{ route('user.userPasswordUpdate') }}"
                                                enctype="multipart/form-data">
                                                @csrf


                                                <div class="form-group row">
                                                    <label for="current_password"
                                                        class="col-md-4 col-form-label text-md-right">  {{ __('tenant.current_password') }} </label>

                                                    <div class="col-md-6">
                                                        <input id="current_password" type="password"
                                                            class="form-control @error('current_password') is-invalid @enderror"
                                                            name="current_password" placeholder="  {{ __('tenant.current_password_place') }} ">

                                                        @error('current_password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="form-group row">
                                                    <label for="password" class="col-md-4 col-form-label text-md-right"> {{ __('tenant.password') }} </label>
                        
                                                    <div class="col-md-6">
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"   placeholder="{{ __('tenant.password_place') }} ">
                        
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                        
                                                <div class="form-group row">
                                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right"> {{ __('tenant.confirm_password') }} </label>
                        
                                                    <div class="col-md-6">
                                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder=" {{ __('tenant.confirm_password_place') }} ">
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
