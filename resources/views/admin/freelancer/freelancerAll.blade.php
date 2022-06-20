@extends('admin.layouts.adminMaster')

@push('css')
@endpush

@section('content')
    <section class="content">

        <br>

        <style>
            tr.nowrap td {
                white-space: nowrap;
            }

            tr.nowrap th {
                white-space: nowrap;
            }

        </style>


        <div class="row">

            <div class="col-sm-12">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            All Freelancer 
                        </h3>
                        <div class="card-tools">
                            <form action="">

                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text"
                                        data-url="{{ route('admin.searchAjax', ['type' => 'freelancer', 'status' => isset($status) ? $status : null]) }}"
                                        class="form-control ajax-data-search" placeholder="Search Tenant">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary w3-border">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body" >




                        @include('admin.freelancer.ajax.freelancer_all')


                    </div>
                </div>
            </div>
        </div>



    </section>
@endsection


@push('js')

@endpush
