@extends('admin.layouts.adminMaster')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-4 col-6">
                <div class="card">
                    <div class="card-body bg-info text-center">
                        <h1>({{ count($profiles->where('profile_type','business')) }})</h1>
                        Total Business Profiles
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="card">
                    <div class="card-body bg-info text-center">
                        <h1>({{ count($profiles->where('profile_type','personal')) }})</h1>
                        Total Personal Profiles
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                @include('alerts.alerts')
                <div class="card card-primary">
                    <div class="card-header">
                        All Service Profile List
                        <div class="card-tools">
                            <form action="">

                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text"
                                        data-url="{{ route('admin.searchAjax', ['type' => 'serviceprofile', 'status' => isset($status) ? $status : null]) }}"
                                        class="form-control ajax-data-search" placeholder="Search Service Profile">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary w3-border">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('admin.profile.serviceProfilelistajax')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
