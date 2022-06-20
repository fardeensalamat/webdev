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

                                Edit Role

                            </span>
                        </h3>
                    </div>
                    <div class="card-body" style="min-height: 200px;">


                        <div class="container">
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header w3-blue">Existing User</div>

                                        <div class="card-body">
                                            <form method="post" action="{{ route('admin.roleAddNewPost') }}">
                                                @csrf
                                                <input type="hidden" name='edit' value="1">
                                                <div class="input-group mb-3">
                                                    <input id="user" type="text" class="form-control "
                                                    name="user" required="" autocomplete="user" value="{{$role->user->mobile}}">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <label for="" class=" col-form-label text-md-right">Role Name</label>
                                                    <div class="ml-2">
                                                        <input id="rolename" type="text" class="form-control "
                                                            name="rolename" required="" autocomplete="rolename"
                                                            list="role_value_list" value="{{$role->role_value}}">
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
                                                            <input name="items[]" value="page" type="checkbox" @if($user->hasPermission('page')) checked @endif>
                                                            Menu &amp; Page
                                                        </label>

                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="webparameters" @if($user->hasPermission('webparameters')) checked @endif type="checkbox">
                                                          Web Parameter
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="subscriber" type="checkbox"  @if($user->hasPermission('subscriber')) checked @endif>
                                                            Subscriber
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="subscription" type="checkbox"  @if($user->hasPermission('subscription')) checked @endif>
                                                            Subscription order
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="balance" type="checkbox"  @if($user->hasPermission('balance')) checked @endif>
                                                            Balance order
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="workstation" type="checkbox"  @if($user->hasPermission('workstation')) checked @endif>
                                                            Workstation
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="jobs_work" type="checkbox"  @if($user->hasPermission('jobs_work')) checked @endif>
                                                            All Posted Latest jobs
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="all_pending_jobs" type="checkbox"  @if($user->hasPermission('all_pending_jobs')) checked @endif>
                                                            All Pending jobs
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="all_posted_jobs" type="checkbox"  @if($user->hasPermission('all_posted_jobs')) checked @endif>
                                                            All Posted jobs
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="all_admin_modified_jobs" type="checkbox"  @if($user->hasPermission('all_admin_modified_jobs')) checked @endif>
                                                            All Admin Modified jobs
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="all_admin_custom_jobs"
                                                                type="checkbox"  @if($user->hasPermission('all_admin_custom_jobs')) checked @endif>
                                                            All Admin Custom jobs
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="subscriber_honorarium"
                                                                type="checkbox"  @if($user->hasPermission('subscriber_honorarium')) checked @endif>
                                                            Subscriber Honorarium
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="obsb_setting" type="checkbox"  @if($user->hasPermission('obsb_setting')) checked @endif>
                                                            OBSB Setting
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="tenant" type="checkbox"  @if($user->hasPermission('tenant')) checked @endif>
                                                            Tenant
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="report" type="checkbox"  @if($user->hasPermission('report')) checked @endif>
                                                            Report
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="opinions" type="checkbox"  @if($user->hasPermission('opinions')) checked @endif>
                                                            Opinions
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="service_profile" type="checkbox"  @if($user->hasPermission('service_profile')) checked @endif>
                                                            Service Profile
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="service_profile_orders"
                                                                type="checkbox"  @if($user->hasPermission('service_profile_orders')) checked @endif>
                                                            Service Profile Orders
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="service_products" type="checkbox"  @if($user->hasPermission('service_products')) checked @endif>
                                                            Service Products
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="course_items"
                                                                type="checkbox" @if($user->hasPermission('course_items')) checked @endif>
                                                            Course Item
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="course_orders" type="checkbox" @if($user->hasPermission('course_orders')) checked @endif>
                                                           Course Orders
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="withdraw" type="checkbox"  @if($user->hasPermission('withdraw')) checked @endif>
                                                            Withdraw List
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="needs" type="checkbox"  @if($user->hasPermission('needs')) checked @endif>
                                                            Needs
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="blog" type="checkbox"  @if($user->hasPermission('blog')) checked @endif>
                                                            Blogs
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="suggessionAll" type="checkbox"  @if($user->hasPermission('suggessionAll')) checked @endif>
                                                             Suggestion & Complain
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="employee" type="checkbox"  @if($user->hasPermission('employee')) checked @endif>
                                                            Employee
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="freelancer" type="checkbox"  @if($user->hasPermission('freelancer')) checked @endif>
                                                         Freelancer
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="variations" type="checkbox"  @if($user->hasPermission('variations')) checked @endif>
                                                            Variations
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="setupmanagement" type="checkbox"  @if($user->hasPermission('setupmanagement')) checked @endif>
                                                            Setup Management
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="smssend" type="checkbox"  @if($user->hasPermission('smssend')) checked @endif>
                                                            SMS Send
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="notificationsend" type="checkbox"  @if($user->hasPermission('notificationsend')) checked @endif>
                                                            Notification Send
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="categorylist" type="checkbox"  @if($user->hasPermission('categorylist')) checked @endif>
                                                          Category List
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="socialgroup" type="checkbox"  @if($user->hasPermission('socialgroup')) checked @endif>
                                                         Social Group
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="addwebsitelink" type="checkbox" @if($user->hasPermission('addwebsitelink')) checked @endif>
                                                         Add Website Link
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="toppriority" type="checkbox" @if($user->hasPermission('toppriority')) checked @endif>
                                                         Top Priority
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="items[]" value="valuedcustomer" type="checkbox" @if($user->hasPermission('valuedcustomer')) checked @endif>
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
