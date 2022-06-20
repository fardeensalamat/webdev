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

                                Add New Service Profile

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
                                            <form method="post" action="{{ route('admin.storeServiceProfileFromAdmin') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="input-group mb-3">
                                                    <select id="user" name="user" required
                                                        class="form-control user-select select2-container step2-select select2"
                                                        data-placeholder="Mobile"
                                                        data-ajax-url="{{ route('admin.selectNewRole') }}"
                                                        data-ajax-cache="true" data-ajax-dataType="json"
                                                        data-ajax-delay="200" style="">

                                                    </select>
                                                    <div class="input-group-append">
                                                        <a id="newUser" title="Add New User" target="_blank" href="#"
                                                            class="btn btn-default"><i class="fa fa-user-plus"></i></a>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <select name="workstation" id="workstation"
                                                                class="form-control select2"
                                                                data-url={{ route('user.searchCategoryAjax') }}>
                                                                <option value="">Select Workstation</option>
                                                                @foreach ($workstation as $wt)
                                                                    <option value="{{ $wt->id }}">
                                                                        {{ $wt->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <select name="category" id="category" class="form-control"
                                                                data-url="{{ route('admin.fetchAjaxData') }}">
                                                                <option value="">Select Workstation</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 my-2">
                                                        <label for="location-input">Google Location</label>
                                                        <input type="text" name="location"
                                                            class="form-control pac-target-input" required=""
                                                            id="location-input" placeholder="Google Location"
                                                            autocomplete="off">
                                                        <input type="hidden" name="lat" class="form-control" id="lat">
                                                        <input type="hidden" name="lng" class="form-control" id="lng">
                                                    </div>
                                                    @if (Auth::user()->hasPermission('addwebsitelink'))

                                                        <div class="col-md-12 my-2">
                                                            <label for="website_link">Website Link</label>
                                                            <input type="text" name="website_link" id="website_link" class="form-control" placeholder="https://www.sc-bd.com/mypanel/dashboard/my/services">
                                                        </div>
                                                    @endif
                                                </div>

                                              
                                                <div class="another">

                                                </div>
                                                <style>
                                                    #inlineRadio1{
                                                       border:2px solid white;
                                                       box-shadow:0 0 0 1px #932;
                                                       appearance:none;
                                                       border-radius:50%;
                                                       width:14px;
                                                       height:14px;
                                                       background-color:#fff;
                                                       transition:all ease-in 0.2s;

                                                       }
                                                       #inlineRadio1:checked{
                                                       background-color:#932;
                                                       }

                                                       #inlineRadio2{
                                                       border:2px solid white;
                                                       box-shadow:0 0 0 1px #932;
                                                       appearance:none;
                                                       border-radius:50%;
                                                       width:14px;
                                                       height:14px;
                                                       background-color:#fff;
                                                       transition:all ease-in 0.2s;

                                                       }
                                                       #inlineRadio2:checked{
                                                       background-color:#932;
                                                       }
                                                       /* new ajax form css start here asrana*/
                                                       
                                                       label.error {
                                                               color: red;
                                                               font-size: 0.7rem;
                                                               display: block;
                                                               margin-top: 5px;
                                                           }

                                                       input.error {
                                                               border: 1px dashed red;
                                                               font-weight: 300;
                                                               color: red;
                                                           }
                                                       
                                                       /* new ajax form css End here asrana*/
                                               </style>
                                               {{-- <div class="col-md-12 my-2">
                                                   <div class="form-group">
                                                       <div class="form-check">
                                                       <input class="form-check-input" id='flexRadioDefault2' type="checkbox" name="paynow" value="paynow" > 
                                                       <label class="form-check-label">Pay now if you want to publish.</label>
                                                       </div>
                                                       
                                                   </div>
                                               </div> --}}
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <div class="form-check form-check-inline">
                                                               <input class="form-check-input" onchange="show()" type="radio" name="paynow" value="paynow" id="inlineRadio1" >
                                                               <label class="form-check-label" for="inlineRadio1">{{__('userserviceprofile.pay_now')}}</label>
                                                             </div>
                                                             <div class="form-check form-check-inline">
                                                               <input class="form-check-input" type="radio" onchange="show1()" name="paynow" id="inlineRadio2" value="trial">
                                                               <label class="form-check-label" for="inlineRadio2">{{__('userserviceprofile.trial')}}</label>
                                                             </div>
                                                       </div>
                                                       <div id="yes" style="display: none;">
                                                           <p>Pay now if you want to publish.Paid accounts have lots of benefits.</p>
                   
                                                       </div>
                                                       <div id="no" style="display: none;">
                                                           <p>Trial account have 45days free.Then you have to pay for this account.</p>
                                                          
                                                       </div>
                                                       <script type="text/javascript">
                                                               function show(str){
                                                                   document.getElementById('yes').style.display = 'block';
                                                                   document.getElementById('no').style.display = 'none';
                                                               }
                                                               function show1(str){
                                                                   document.getElementById('yes').style.display = 'none';
                                                                   document.getElementById('no').style.display = 'block';
                                                               }
                                                       </script>
                   
                                                   </div>
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-12 ">
                                                        <button type="submit" class="btn btn-primary btn-block">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" id="hideShow" style="display: none;">
                                    <div class="card">
                                        <div class="card-header">{{ __('Create New Tenant') }}</div>

                                        <div class="card-body">
                                            <form method="POST"
                                                action="{{ route('admin.newUserCreateForServiceProfile') }}">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="name"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="name" type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            name="name" value="{{ old('name') }}" required
                                                            autocomplete="name" autofocus>

                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="email"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="email" type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" value="{{ old('email') }}" required
                                                            autocomplete="email">

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="mobile"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="mobile" type="text"
                                                            class="form-control @error('mobile') is-invalid @enderror"
                                                            name="mobile" value="{{ old('mobile') }}" required
                                                            autocomplete="mobile" autofocus>

                                                        @error('mobile')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="password"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="password" type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            name="password" required autocomplete="new-password">

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="password-confirm"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="password-confirm" type="password" class="form-control"
                                                            name="password_confirmation" required
                                                            autocomplete="new-password">
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <div class="col-md-6 offset-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="active"
                                                                id="active" checked>

                                                            <label class="form-check-label" for="active">
                                                                {{ __('Active') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6 offset-md-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Create') }}
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
    <script src="{{ asset('js/location.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcjU4Z83IrRvF3DdDYqsBW66_2eUC8krU&libraries=places&callback=initAutocomplete"
        async defer></script>
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
                            obj.id = obj.id || obj.id;
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
        $('#newUser').click(function(e) {
            e.preventDefault();

            $("#hideShow").toggle();
        });
    </script>
    <script>
        $('select#workstation').on('change', function() {
            var st = $(this).val();
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: st,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {

                    $('#category').empty();
                    $.each(data.categories, function(index, categories) {
                        $('select#category').append('<option value="' +
                            categories.id + '">' + categories.name.en +
                            '</option>');
                        // console.log(categories.id);
                    })
                }
            });
        });

        $('select#category').on('change', function() {
            var st = $(this).val();
            var url = $(this).attr('data-url');
            var user = $('select#user').val();
            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: st,
                    user: user,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    console.log(data)
                    $('.another').empty();
                    $('.another').append(data.html);


                    var autocomplete;

                    function initAutocomplete() {
                        // Create the autocomplete object, restricting the search to geographical
                        // location types.
                        autocomplete = new google.maps.places.Autocomplete(
                            /** @type {!HTMLInputElement} */
                            (document.getElementById('location-input')), {
                                types: ['geocode']
                            });

                        // When the user selects an address from the dropdown, populate the address
                        // fields in the form.
                        autocomplete.addListener('place_changed', fillInAddress);
                    }

                    function fillInAddress() {
                        // Get the place details from the autocomplete object.
                        var place = autocomplete.getPlace();

                        document.getElementById('lat').value = place.geometry.location.lat();
                        document.getElementById('lng').value = place.geometry.location.lng();
                        document.getElementById('location-selected-text').value = place
                            .formatted_address;


                    }

                }
            });
        });
    </script>

@endpush