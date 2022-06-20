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

                                Update Worker Access

                            </span>
                        </h3>
                    </div>
                    <div class="card-body" style="min-height: 200px;">


                        <div class="container">
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header w3-blue">Profile</div>

                                        <div class="card-body">
                                            <form method="post" action="{{ route('user.updateworkeraccess',$data->id) }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$data->id}}">
                                                <div class="input-group mb-3">
                                                    <label for="" class=" col-form-label text-md-right">Profile Name</label>
                                                    <input id="rolename" type="text" class="form-control "
                                                    name="workername" required="" value="{{$data->serviceprofile->name}}" readonly>
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
                                                        <input id="category" type="text" class="form-control"
                                                            required="" value="{{$data->applicantcategory->name ?? ''}}" readonly>
                                                            <input type="hidden" class="form-control"
                                                            name="category" required="" value="{{$data->category}}" readonly>
                                                       
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    
                                                        <div class="checkbox">
                                                            <label>
                                                                <input name="status" value="1" type="checkbox" @if($data->status==1) checked @endif>
                                                                 Active
                                                            </label>
                                                        </div>
    
                                                </div>



                                                <div class="form-group row mb-0">
                                                    <div class="col-md-12 ">
                                                        <button type="submit" class="btn btn-primary btn-block">
                                                            Update
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
                                                            <input name="order_list" value="1" type="checkbox" @if($data->order==1) checked @endif>
                                                            Order List
                                                        </label>

                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="order_change" value="1" type="checkbox" @if($data->order_change==1) checked @endif>
                                                         Order Status Change
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="order_status_details" value="1" type="checkbox" @if($data->order_details==1) checked @endif>
                                                            Order Status Details
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="customer_list" value="1" type="checkbox" @if($data->customer_list==1) checked @endif>
                                                            Customer List
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="add" value="1" type="checkbox" @if($data->add==1) checked @endif>
                                                            Add
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="edit" value="1" type="checkbox" @if($data->edit==1) checked @endif>
                                                           Edit
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="delete" value="1" type="checkbox" @if($data->delete==1) checked @endif>
                                                            Delete
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="list" value="1" type="checkbox" @if($data->list==1) checked @endif>
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
