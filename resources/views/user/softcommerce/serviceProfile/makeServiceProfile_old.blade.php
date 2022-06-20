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
                        <h3 class="card-title"><i class="fa fa-briefcase text-primary"></i> 
                            <span
                                class="badge badge-light">

                                Add New Service/Business Profile

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

                                            {{-- form start from here --}}
                                            <form method="post" id="myform" action="{{ route('user.storeServiceProfileFromUser') }}"
                                                enctype="multipart/form-data">
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
                                                        <a id="newUser" title="Add New User" target="_blank" href="#"
                                                            class="btn btn-default"><i class="fa fa-user-plus"></i></a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <select name="workstation" id="workstation"
                                                                class="form-control"
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
                                                                data-url="{{ route('admin.fetchAjaxData') }}" >
                                                                <option value="">Select Category</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 my-2">
                                                        <label for="location-input">Google Location</label>
                                                        <input type="text" name="location" placeholder="Enter your location" class="form-control pac-target-input"  id="location-input" placeholder="Google Location" autocomplete="off" required>
                                                        @error('location-input')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <input type="hidden" name="lat" class="form-control"  id="lat" >
                                                        <input type="hidden" name="lng" class="form-control" id="lng">
                                                    </div>
                                                    {{-- <input type="text" name="location" class="form-control pac-target-input" id="location-input" placeholder="Google Location" autocomplete="off"> --}}
                                                    {{-- <div class="col-md-12">
                                                        <div class="form-group mb-3">
                                                            <input type="radio" name="balance_debit" id="balance_debit" value="my_balance">
                                                            <label for="balance_debit">Service/Business price Diducted form my account </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-3">
                                                            <input type="radio" name="balance_debit" id="balance_debit2" value="user_balance">
                                                            <label for="balance_debit2">Service/Business price Diducted form my account </label>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                                <div class="another">

                                                </div>
                                                <style>
                                                     #flexRadioDefault2{
                                                        border:2px solid white;
                                                        box-shadow:0 0 0 1px #932;
                                                        appearance:none;
                                                        border-radius:50%;
                                                        width:14px;
                                                        height:14px;
                                                        background-color:#fff;
                                                        transition:all ease-in 0.2s;

                                                        }
                                                        #flexRadioDefault2:checked{
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
                                                <div class="col-md-12 my-2">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                        <input class="form-check-input" id='flexRadioDefault2' type="checkbox" name="paynow" value="paynow" > 
                                                        <label class="form-check-label">Pay now if you want to publish.</label>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-12 ">
                                                        <button type="submit" onclick="return confirm('Do you want to continue? Service charge will be deducted from your account for creating service/Shop profile.')" class="btn btn-primary btn-block"> Submit </button>
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
                                            <form method="POST" action="{{ route('user.makeUserCreateForServiceProfile') }}" id="tenant-form" name="tenant-form">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="name"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="name" name="name" type="text" placeholder="Enter your full name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus required>

                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    
                                                </div>

                                                <div class="form-group row">
                                                    <label for="email"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Workstation') }}</label>

                                                    <div class="col-md-6">
                                                        <select name="workstation" id="workstation" class="form-control" required>
                                                                <option value="">Select Workstation</option>
                                                                @foreach ($workstation as $wt)
                                                                    <option value="{{ $wt->id }}">
                                                                        {{ $wt->title }}</option>
                                                                @endforeach
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="mobile"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="mobile" type="text" placeholder="Enter a valid mobile number" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" autocomplete="mobile" autofocus required>

                                                        @error('mobile')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    
                                                </div>
                                               
                                                <div class="form-group row">
                                                    <label for="password"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Password') }}
                                                    </label>

                                                    <div class="col-md-6">

                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="Enter a secure password" required>

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    
                                                </div>

                                                <div class="form-group row">
                                                    <label for="password-confirm"
                                                        class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}
                                                    </label>

                                                    <div class="col-md-6">
                                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="Retype your password" required>
                                                    </div>

                                                </div>


                                                <div class="form-group row">
                                                    <div class="col-md-6 offset-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="active" id="active" checked required>

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

        {{-- <div class="col-md-6 mt-2">
            <label for="location-input">Google Location</label>
            <input type="text" name="location" class="form-control pac-target-input" id="location-input" placeholder="Google Location" autocomplete="off">
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input type="hidden" name="lat" class="form-control"  id="lat" >
            <input type="hidden" name="lng" class="form-control" id="lng">
        </div> --}}

    </section>
@endsection
@push('js')
    <script src="{{ asset('js/location.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcjU4Z83IrRvF3DdDYqsBW66_2eUC8krU&libraries=places&callback=initAutocomplete"
        async defer></script>
    <!-- Select2 -->
    <script src="{{ asset('cp/plugins/select2/js/select2.full.min.js') }}"></script>
    
    <!-- jQuery library asrana-->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>

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
                        document.getElementById('location-selected-text').value = place.formatted_address;


                    }

                }
            });
        });
    </script>

{{-- onload jquery asrana--}}
<script>
     $(document).ready(function(){
    $('#password').on('input', function(){
        checkpass();
    });
     $('#password').on('input', function(){
        checkcpass();
    });
   

    //password show and hide function
    function password_show_hide(){
        console.log('ok');
        var x = document.getElementById("password");
        var show_eye = document.getElementById("show_eye");
        var hide_eye = document.getElementById("hide_eye");
        hide_eye.classList.remove("d-none");
        if( x.type === "password"){
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        }else{
            x.type = "password";
            show_eye.style.display = "block"
            hide_eye.style.display = "none"
        }
    }

    function cpassword_show_hide(){
        console.log('ok');
        var x = document.getElementById("cpassword");
        var show_eye = document.getElementById("cshow_eye");
        var hide_eye = document.getElementById("chide_eye");
        hide_eye.classList.remove("d-none");
        if( x.type === "password"){
            x.type = "text";
            cshow_eye.style.display = "none";
            chide_eye.style.display = "block";
        }else{
            x.type = "password";
            cshow_eye.style.display = "block"
            chide_eye.style.display = "none"
        }
    }
</script>

{{-- form validation with jquery cdn library asrana--}}
<script>
    $(document).ready(function() {

  $("#myform").validate({

      rules:{
          location:{
              required:true
          },
          name:{
              required:true
          },
          img:{
              required:true
          },
          cover_image:{
              required:true
          },
          address:{
              required:true
          }
      },
      
      messages:{
          location:"Please input your location",

          name: "Must input at least 4 character Business / Service Name",

          img:"Please upload a profile photo",

          cover_image:"Please upload a cover photo",

          address:"Please input a valid location"

        },
  });
});
</script>
{{-- tenant new user form --}}
<script>
    $(document).ready(function() {

  $("#tenant-form").validate({
      rules:{
          name:{
              required: true
          },
          workstation:{
              required: true
          },
          mobile:{
              required: true
          },
          password:{
              required: true
          },
          password_confirmation:{
              required: true
          }
      },

      messages:{

          name:"Must input at least 4 character fullname",

          workstation:"Please select a workstation",

          mobile:"Please enter a valid phone number",

          password:"Please enter a secure password",

          password_confirmation:"Please retype your password"

        },
  });
});
</script>


@endpush
