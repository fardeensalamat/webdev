@extends('user.layouts.userMaster')
@push('css')
@endpush
@section('content')
    <section class="content">
        <br>
        <div class="row">
            <div class="col-sm-12">
                @include('alerts.alerts')
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="{{ route('user.userEdit') }}">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-edit"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Tenant Edit</span>
                                    <span class="info-box-number">
                                        Link
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="{{ route('user.userPasswordChange') }}">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-key"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Password Change</span>
                                    <span class="info-box-number">
                                       Link
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="{{ route('user.userPinChange') }}">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-map-pin"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> Pin Change</span>
                                    <span class="info-box-number">
                                      Link
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </section>
@endsection


@push('js')



@endpush
