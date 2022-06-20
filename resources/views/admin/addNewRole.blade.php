@extends('admin.layouts.adminMaster')
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

                                Add New Role

                            </span>
                        </h3>
                    </div>
                    <div class="card-body" style="min-height: 200px;">


                        <div class="container">
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header w3-blue">Enter Existing User</div>

                                        <div class="card-body">
                                            <form method="post" action="{{ route('admin.roleAddNewPost') }}">
                                                @csrf
                                                <div class="input-group mb-3">
                                                    <select id="user" name="user"
                                                        class="form-control user-select select2-container step2-select select2"
                                                        data-placeholder="Mobile"
                                                        data-ajax-url="{{ route('admin.selectNewRole') }}"
                                                        data-ajax-cache="true" data-ajax-dataType="json"
                                                        data-ajax-delay="200" style="">

                                                    </select>
                                                    <div class="input-group-append">

                                                        {{-- <button class="btn btn-primary" type="button"><i class="fa fa-save"></i></button> --}}

                                                        <a title="Add New User" target="_blank"
                                                            href="{{ route('admin.newUserCreate') }}"
                                                            class="btn btn-default"><i class="fa fa-user-plus"></i></a>

                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <label for="" class=" col-form-label text-md-right">Role Name</label>
                                                    <div class="ml-2">
                                                        <input id="rolename" type="text" class="form-control "
                                                            name="rolename" required="" autocomplete="rolename"
                                                            list="role_value_list">
                                                        <datalist id="role_value_list">
                                                            <option value="Support Team">

                                                            </option>
                                                            <option value="Editor">
                                                            </option>
                                                            <option value="Moderator">
                                                            </option>
                                                            <option value="Contributor">
                                                            </option>
                                                        </datalist>

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
                                        <div class="card-header w3-blue">Select Items (for modify/edit by this role)</div>
                                        <div class="card-body">
                                            <div class="form-group ">

                                                <div class="col-sm-12">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="page" type="checkbox">
                                                            Menu &amp; Page
                                                        </label>

                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="webparameters" type="checkbox">
                                                          Web Parameter
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="subscriber" type="checkbox">
                                                            Subscriber
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="subscription" type="checkbox">
                                                            Subscription order
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="balance" type="checkbox">
                                                            Balance order
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="workstation" type="checkbox">
                                                            Workstation
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="jobs_work" type="checkbox">
                                                            All Posted Latest jobs
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="all_pending_jobs" type="checkbox">
                                                            All Pending jobs
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="all_posted_jobs" type="checkbox">
                                                            All Posted jobs
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="all_admin_modified_jobs"
                                                                type="checkbox">
                                                            All Admin Modified jobs
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="all_admin_custom_jobs"
                                                                type="checkbox">
                                                            All Admin Custom jobs
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="subscriber_honorarium"
                                                                type="checkbox">
                                                            Subscriber Honorarium
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="obsb_setting" type="checkbox">
                                                            OBSB Setting
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="tenant" type="checkbox">
                                                            Tenant
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="report" type="checkbox">
                                                            Report
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="opinions" type="checkbox">
                                                            Opinions
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="service_profile" type="checkbox">
                                                            Service Profile
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="service_profile_orders"
                                                                type="checkbox">
                                                            Service Profile Orders
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="service_products" type="checkbox">
                                                            Service Products
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="course_items"
                                                                type="checkbox">
                                                            Course Item
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="course_orders" type="checkbox">
                                                           Course Orders
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="withdraw" type="checkbox">
                                                            Withdraw List
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="needs" type="checkbox">
                                                            Needs
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="blog" type="checkbox">
                                                            Blogs
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="suggessionAll" type="checkbox">
                                                             Suggestion & Complain
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="employee" type="checkbox">
                                                            Employee
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="freelancer" type="checkbox">
                                                         Freelancer
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="variations" type="checkbox">
                                                            Variations
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="setupmanagement" type="checkbox">
                                                            Setup Management
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="smssend" type="checkbox">
                                                            SMS Send
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="notificationsend" type="checkbox">
                                                            Notification Send
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="categorylist" type="checkbox">
                                                          Category List
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="socialgroup" type="checkbox">
                                                         Social Group
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="addwebsitelink" type="checkbox">
                                                         Add Website Link
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="toppriority" type="checkbox">
                                                         Top Priority
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="valuedcustomer" type="checkbox">
                                                         Valued Customer/Partners
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
