@extends('user.layouts.userMaster')

@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('cp/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@section('content')
    <section class="content">

        <br>

        <div class="row">

            <div class="col-sm-12">
                @include('alerts.alerts')


                <div>
                </div>




                <div class="card card-widget">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-briefcase text-primary"></i> <span
                                class="badge badge-light">

                                Add New Worker

                            </span>
                        </h3>
                    </div>
                    <div class="card-body" style="min-height: 200px;">


                        <div class="container">
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header w3-blue">Enter Existing Profile</div>

                                        <div class="card-body">
                                            <form method="post" action="{{ route('user.AssignApplicantforServiceprofileStore') }}">
                                                @csrf
                                                <input type="hidden" name="owner_id" value="{{$user->id}}">
                                                <input type="hidden" name="worker_id" value="{{$data->id}}">
                                                <input type="hidden" name="worker_user_id" value="{{$data->user_id}}">
                                                <div class="input-group mb-3">
                                                    <label for="" class=" col-form-label text-md-right">Profile Name</label>
                                                    <select id="profile_id" name="profile_id"
                                                        class="form-control select2">
                                                        @foreach($profiles as $profile)
                                                            <option value="{{$profile->id}}">{{$profile->name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <label for="" class=" col-form-label text-md-right">Worker Name</label>
                                                    <div class="ml-2">
                                                        <input id="rolename" type="text" class="form-control "
                                                            name="workername" required="" value="{{$data->name}}" readonly>
                                                       
                                                    </div>
                                                </div>
                                               
                                                <div class="input-group mb-3">
                                                    <label for="" class=" col-form-label text-md-right">Worker Category</label>
                                                    <div class="ml-2">
                                                        <input type="text" class="form-control"
                                                            required="" value="{{$data->applicantcategory->name ?? ''}}" readonly>
                                                            <input type="hidden" class="form-control"
                                                            name="category" required="" value="{{$data->category}}" readonly>
                                                       
                                                    </div>
                                                </div>


                                                <div class="form-group row mb-0">
                                                    <div class="col-md-12 ">
                                                        <button type="submit" class="btn btn-primary btn-block">
                                                            Comfirm
                                                        </button>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header w3-blue">Select Worker Role</div>
                                        <div class="card-body">
                                            <div class="form-group ">

                                                <div class="col-sm-12">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="order_list" value="1" type="checkbox">
                                                            Order List
                                                        </label>

                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="order_status_change" value="1" type="checkbox">
                                                         Order Status Change
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="order_status_details" value="1" type="checkbox">
                                                            Order Status Details
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="customer_list" value="1" type="checkbox">
                                                            Customer List
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="add" value="1" type="checkbox">
                                                            Add
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="edit" value="1" type="checkbox">
                                                           Edit
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="delete" value="1" type="checkbox">
                                                            Delete
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="list" value="1" type="checkbox">
                                                            List
                                                        </label>
                                                    </div>
                                                   
                                                </div>
                                                


                                            </div>
                                        </div>
                                    </div>
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


    <!-- Select2 -->
    <script src="{{ asset('cp/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            });

            $('.step2-select').select2({
                theme: 'bootstrap4',
                // minimumInputLength: 1,
                ajax: {
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        // alert(data[0].s);
                        var data = $.map(data, function(obj) {
                            obj.id = obj.mobile || obj.mobile;
                            return obj;
                        });
                        var data = $.map(data, function(obj) {
                            obj.text = obj.mobile;
                            return obj;
                        });
                        return {
                            results: data,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    }
                },
            });


        });
    </script>

@endpush
