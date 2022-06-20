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
                        <h3 class="card-title"><i class="fa fa-briefcase text-primary"></i> <span
                                class="badge badge-light">
                                {{ __('tenant.tenant_pin_change_step_1') }} 
                            </span>
                        </h3>
                    </div>
                    <div class="card-body" style="min-height: 200px;">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card card-primary">
                                        <div class="card-header">{{ __('tenant.tenant_pin_change_step_1') }} 
                                            ({{ $user->mobile }})</div>
                                        <div class="card-body" id="pinSet">
                                            {{-- <div class="text-danger text-center">{{ __('tenant.msg') }} </div> --}}
                                            <form method="POST" action="{{ route('user.userPassCheck') }}"
                                                enctype="multipart/form-data" id="passForm">
                                                @csrf
                                                <input type="hidden" name="type" value="checkPass">
                                                <div class="form-group row">
                                                    <label for="password"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('tenant.current_password') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="password" type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            name="password" placeholder="{{ __('tenant.current_password_place') }}">

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="send"
                                                                id="send" value="1">

                                                            <label class="form-check-label" for="send">
                                                            {{ __('tenant.send') }} 
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6 offset-md-4">
                                                        <button type="submit" class="btn btn-primary">
                                                        {{ __('tenant.submit') }}
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
