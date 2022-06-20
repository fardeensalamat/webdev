@extends('layouts.app_view')
@section('content')
    <div class="header_main_wrapper">


        <div class="header">
            <div class="nav-bar-wrapper-ok">
                <ul>
                    <li><router-link class="nav-link" to="/"><img src="/vueimage/sc.png" alt=""></router-link></li>
                    <li><a href="/" class="nav-link second-nav" >Home</a></li>
                </ul>
            </div>
        </div>





        <div class="main-content" style="margin-top: -76px;">
            <!-- Header -->

            <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9" id="main_page_main">
                <div class="container" style="margin-top:111px">
                    <div class="header-body text-center mb-7">
                        <div class="row justify-content-center">
                            <div class="col-xl-12 col-lg-12 col-md-12 px-5">
                                <h1 class="text-white">Welcome to Soft Commerce</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="separator separator-bottom separator-skew zindex-100" style="position:absolute; width:100%" id="main_page_bottom">
                    <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                    </svg>
                </div> -->
            </div>

            <!-- Page content -->
            <div class="container mt--8 pb-5" style="margin-top:-90px">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-7">
                        <div class="card bg-secondary border-0 mb-0" style="background:white !important; box-shadow: 0 0 2rem 0 rgb(136 152 170 / 15%);">

                            <div class="card-body px-lg-5 py-lg-5">
                                <div class="text-center text-muted mb-4">

                                    <small>Sign in with your account</small> <!--/ <a target="_blank" href="https://workupjob.com/register"> Create an account</a> -->
                                </div>

                        @if ($value =  request()->cookie('mobile_saved'))
                                    <form role="form" method="post" action="{{ route('auth.registerByMobile') }}"  class="mobile-registration-form">@csrf
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-merge input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                                </div>
                                                <input class="form-control" style="width:100%!important; color:#000b16 !important;" name="mobile_number" readonly value="{{ $value }}"  id="mobile_number" >
                                            </div>
                                            <a  href="{{ route('auth.unsaveMobile') }}" class="float-right  btn-link">Try with another number</a>
                                        </div>

                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-merge input-group-alternative"  style="opacity:0.9">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                                </div>
                                                <input class="form-control" style="width:100%!important; color:#000b16 !important;" name="full_name" placeholder="Your full name"  id="full_name"  type="text" >
                                            </div>
                                        </div>

                                        <div class="form-group"  >
                                            <div class="input-group input-group-merge input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                                </div>
                                                <input class="form-control" name="password" style="width:100%!important; color:#000b16 !important;" placeholder="Enter new password"  id="password">
                                            </div>
                                        </div>

                                        <div class="form-group"  >
                                            <div class="input-group input-group-merge input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                                </div>
                                                <input class="form-control" name="password_confirmation" style="width:100%!important; color:#000b16 !important;" placeholder="Enter new password again"  id="password_confirmation" type="password">
                                            </div>
                                        </div>


                                        <div class="text-center">

                                            <button type="submit" style="padding: 0.5em 1.25rem; color: #fff; border-color: #f8f9fe;background-color: #5e72e4;" name="login_do" class="btn btn-primary my-4 myLoginBtn">Sign in</button>

                                        </div>
                                    </form>

                        @else
                            <div class="first-step-number-check">

                                <form role="form" method="post" action="{{ route('auth.userCheckByMobile') }}" class="mobile-check-form"> @csrf
                                       <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative"  style="opacity:0.9">
                                            <div class="input-group-prepend">
{{--                                                <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>--}}
                                            </div>
                                            <input class="form-control" name="mobile" style="color:#000b16 !important;"  placeholder="01795805817" type="text" id="input-mobile">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit"  style="padding: 0.5em 1.25rem; color: #fff; border-color: #f8f9fe;background-color: #5e72e4;" name="login_do" class="btn btn-primary my-4 myLoginBtn">Next</button>
                                    </div>
                                </form>
                            </div>






                                <div class="second-step-login" style="display:none;">
                                    <form role="form" method="post" action="{{ route('auth.loginByMobile') }}"  class="mobile-login-form"> @csrf
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-merge input-group-alternative"  style="opacity:0.9">
                                                <div class="input-group-prepend">
{{--                                                    <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>--}}
                                                </div>
                                                <input class="form-control" name="login_mobile" style="color:#000b16 !important;"  placeholder="01795805817" type="text" id="login-mobile">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-merge input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                                </div>
                                                <input class="form-control" style="color:#000b16 !important;" placeholder="Password" name="login_password" type="password" id="login-password">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit"  style="padding: 0.5em 1.25rem; color: #fff; border-color: #f8f9fe;background-color: #5e72e4;" name="login_do" class="btn btn-primary my-4 myLoginBtn">Sign in</button>

                                        </div>
                                    </form>
                                </div>



                                <div class="third-step-signup" style="display:none;">

                                    <form  class="mobile-signup-form">
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-merge input-group-alternative"  style="opacity:0.9">
                                                <div class="input-group-prepend">
{{--                                                    <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>--}}
                                                </div>
                                                <input class="form-control" name="signup_mobile" style="width:100%!important; color:#000b16 !important;" readonly type="text" id="signup-mobile" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div id="recaptcha-container"></div>
                                        </div>

                                        <div class="text-center">
                                            <button type="button" onclick="sendOTP();"   style="padding: 0.5em 1.25rem; color: #fff; border-color: #f8f9fe;background-color: #5e72e4;" name="login_do" class="btn btn-primary my-4 myLoginBtn">Send OTP</button>

                                        </div>
                                    </form>
                                </div>



                                <div class="forth-step-verify" style="display:none;">
                                    <form role="form" method="post" action="{{ route('auth.saveNewMobile') }}"   class="mobile-verify-save-form">@csrf
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-merge input-group-alternative"  style="opacity:0.9">
                                                <div class="input-group-prepend">
{{--                                                    <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>--}}
                                                </div>
                                                <input class="form-control"  name="register_mobile" style="width:100%!important; color:#000b16 !important;" readonly  id="verify-mobile" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-merge input-group-alternative">
                                                <div class="input-group-prepend">
{{--                                                    <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>--}}
                                                </div>
                                                <input class="form-control" name="verification_code" placeholder="Check mobile and enter otp code" style="width:100%!important; color:#000b16 !important;"  id="verification-code">

                                                <input class="calling_code"  type="hidden" name="calling_code">
                                                <input class="mobile_country"  type="hidden" name="mobile_country">
                                                <input  class="country_name" type="hidden" name="country_name">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="button"  onclick="verify()" class="btn btn-sm btn-block btn-dark">{{ __('Verify Mobile Number') }}</button>

                                        </div>
                                    </form>
                                </div>

@endif










                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <a href="{{ route('auth.passwordRecoverByMobile') }}" class="text-light" style="color: #ced4da!important;color: #ced4da!important; text-decoration:none;"><small>Forgot password?</small></a>
                            </div>
{{--                            <div class="col-6 text-right">--}}
{{--                                <a href="https://workupjob.com/register" class="text-blue;" style="text-decoration:none;"><small><p style="color:green;    font-size: 1rem;--}}
{{--    font-weight: 300;--}}
{{--    line-height: 1.7;--}}

{{--"> <b>Create new account</b></p></small></a>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>


        </div>






        <footer class="py-6" id="footer-main">
            <div class="container">

                <div class="row align-items-center justify-content-xl-between">
                    <div class="col-xl-6">
                        <div class="copyright text-center text-xl-left text-muted" style="color: #8898aa!important;">
                            © 2022 Soft Commerce Ltd
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                            <li class="nav-item">
                                <a href="#" class="nav-link">About Us</a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">Privacy Policy</a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">Terms &amp; Condition</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Contact Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">FAQ</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('assets/softcommerce.apk') }}" class="nav-link">Download Android App</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Refund Policy</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>





    </div>

@endsection

@push('css')

    <style>
        #main_page_main{
            position: relative;
        }

        #main_page_bottom{
            position: absolute;
            bottom: 0;
        }

        i, input{
            color: #ced4da!important;
        }

        .custom-checkbox .custom-control-input:checked~.custom-control-label::after {
            background:#22ab59;
            border-radius: 2px;
        }

        .myLoginBtn {
            padding: 0.5em 1.25rem;
        }
        .header_main_wrapper {
            width: 100%;
            position: relative;
        }

        .header_main_wrapper .header{
            top: 0;
            width: 100%;
            border: 0;
            background-color: transparent;
            box-shadow: none;
            display:flex;
            overflow: hidden;

        }
        .header_main_wrapper .header .nav-bar-wrapper-ok{
            display: block !important;
            width: 100%;
            overflow: hidden;
            z-index: 200;
        }

        .header_main_wrapper .header .nav-bar-wrapper-ok ul{
            list-style:none;
        }

        .header_main_wrapper .header .nav-bar-wrapper-ok ul li{
            color: white;
            padding: 10px;
            width: 125px;
            float: left;
        }

        .header_main_wrapper .header .nav-bar-wrapper-ok ul li  .nav-link{
            text-decoration: none;
            color: white;
        }

        .header_main_wrapper .header .nav-bar-wrapper-ok ul li img{
            width: 40px;
            height: 40px;
        }

        .second-nav{
            padding-top: 18px;
        }

        .bg-gradient-primary {
            background: linear-gradient(306deg, #d61326 0, #161515 100%) !important;
            height: 429px;
        }


        #footer-main ul li a{
            color: #8898aa!important;
            text-decoration: none;
        }

    </style>





@endpush

@push('js')
    <script>

        function getIp(callback) {

            var ip = $(".ip").val();
            // var ip = '72.229.28.185';
            var infoUrl = 'https://ipinfo.io/json?ip=' + ip;

            fetch(infoUrl, { headers: { 'Accept': 'application/json' }})
                .then((resp) => resp.json())
                .catch(() => {
                    return {
                        country: '',
                    };
                })
                .then((resp) => callback(resp.country));
        }

        const phoneInputField = document.querySelector("#input-mobile");
        // get the country data from the plugin
        // const countryData = window.intlTelInputGlobals.getCountryData();
        // console.log(countryData);
        const phoneInput = window.intlTelInput(phoneInputField, {
            //  initialCountry: "auto",
            initialCountry: "bd",
            geoIpLookup: getIp,
            utilsScript:
                "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",

            preferredCountries: ["bd","us","gb" ],
            placeholderNumberType:"MOBILE",
            nationalMode:true,
            // separateDialCode:true,
            // autoHideDialCode:true,
            customContainer:"w-100",
            autoPlaceholder:"polite",
            //  customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData)
            // {
            //     return "e.g. " + selectedCountryPlaceholder;
            // },
        });

        //country changed event
        phoneInputField.addEventListener("countrychange", function() {
            // do something with iti.getSelectedCountryData()
            // console.log(phoneInput.getSelectedCountryData().iso2);
            // console.log(phoneInput.getSelectedCountryData());
            $(".country_name").val(phoneInput.getSelectedCountryData().name);
            $(".mobile_country").val(phoneInput.getSelectedCountryData().iso2);
            $(".calling_code").val(phoneInput.getSelectedCountryData().dialCode);
        });





    </script>

    <script type="text/javascript">
        window.onload = function () {
            render();
        };

        function render() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
            recaptchaVerifier.render();
        }

        function sendOTP() {
            const phoneNumber = $("#signup-mobile").val();
            firebase.auth().signInWithPhoneNumber(phoneNumber, window.recaptchaVerifier).then(function (confirmationResult) {
                window.confirmationResult = confirmationResult;
                coderesult = confirmationResult;
                // console.log(coderesult);
                // $("#successAuth").text("Message sent");
                // $("#successAuth").show();

                const Toast = Swal.mixin({
                    toast: false,
                    // position: 'top',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    // title: 'Great!',
                    text: 'We have sent a verification code to your mobile. Please, verify now.',
                    // confirmButtonText: 'OK'
                })

                $(".third-step-signup").slideUp();
                $("#verify-mobile").val($("#signup-mobile").val());
                $(".forth-step-verify").slideDown();


            }).catch(function (error) {

                const Toast = Swal.mixin({
                    toast: false,
                    // position: 'top',
                    showConfirmButton: true,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    // title: 'Great!',
                    text: error.message,
                    confirmButtonText: 'Try again later'
                })
                // $("#error").text(error.message);
                // $("#error").show();
            });
        }

        function verify() {
            var code = $("#verification-code").val();
            coderesult.confirm(code).then(function (result) {
                // var user = result.user;

                console.log(result.user);
                console.log(result.user.phoneNumber);
                // $("#successOtpAuth").text("Auth is successful");
                // $("#successOtpAuth").show();

                var form = $(".mobile-verify-save-form");

                // console.log($("#verify-mobile").val());

                $.ajax({
                    url: form.attr('action'),
                    type : form.attr('method'),
                    data : form.serialize(),
                    // dataType: 'json',
                    // contentType: false,
                    cache: false,
                    // processData:false,
                    success: function(response)
                    {
                        if(response.success)
                        {
                            location.reload();

                        }
                        else
                        {

                        }
                    },
                    error: function(){}
                });

                // const Toast = Swal.mixin({
                //     toast: false,
                //     // position: 'top',
                //     showConfirmButton: false,
                //     timer: 3000,
                //     timerProgressBar: true,
                //     didOpen: (toast) => {
                //       toast.addEventListener('mouseenter', Swal.stopTimer)
                //       toast.addEventListener('mouseleave', Swal.resumeTimer)
                //     }
                //   })

                //   Toast.fire({
                //       icon: 'success',
                //       title: 'Great!',
                //       text: 'You have successfully joined.',
                //       // confirmButtonText: 'OK'
                //     })



            }).catch(function (error) {

                const Toast = Swal.mixin({
                    toast: false,
                    // position: 'top',
                    showConfirmButton: true,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    // title: 'Great!',
                    text: error.message,
                    confirmButtonText: 'Try again later'
                })
                // $("#error").text(error.message);
                // $("#error").show();
            });
        }
    </script>

    <script type="text/javascript">
        /// some script


        // jquery ready start
        $(document).ready(function() {

            $(document).on("submit", ".mobile-check-form", function(e){

                e.preventDefault();
                var that = $( this );
                // console.log(phoneInput.getNumber());
                // console.log(phoneInput.getSelectedCountryData());
                // console.log(phoneInput.getNumberType());
                // console.log(phoneInput.getValidationError());
                // console.log(phoneInput.isValidNumber());
                // console.log(window.intlTelInputGlobals.getCountryData());


                if(phoneInput.isValidNumber())
                {
                    $.ajax({
                        url: that.attr("action"),
                        cache: false,
                        type : that.attr('method'),
                        data : { mobile : phoneInput.getNumber()},
                        dataType: 'json',
                        success: function(response)
                        {

                            //alert(response.user);
                            //  console.log(response);
                            //  $(".user-table-body").empty().append(response.page);
                            if(response.usercheck == 2)
                            {
                                const Toast = Swal.mixin({
                                    toast: false,
                                    // position: 'top',
                                    showConfirmButton: true,
                                    timer: 5000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'error',
                                    title: 'Opps!',
                                    text: 'Your mobile number is Inactive!Please Contract Our Office.',
                                    confirmButtonText: 'Try Again'
                                })
                                window.location.href = response.url;



                            }

                            if(response.user > 0)
                            {
                                //password field show
                                $(".first-step-number-check").slideUp();
                                $("#login-mobile").val(response.mobile);
                                $(".second-step-login").slideDown();

                            }else
                            {

                                if(response.bdMobile)
                                {
                                    location.reload();
                                }
                                else
                                {
                                    //recaptch and signup
                                    $(".first-step-number-check").slideUp();
                                    $("#signup-mobile").val(response.mobile);
                                    $(".third-step-signup").slideDown();
                                }


                            }
                        },
                        error: function(){}
                    });
                }
                else
                {

                    const Toast = Swal.mixin({
                        toast: false,
                        // position: 'top',
                        showConfirmButton: true,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: 'Opps!',
                        text: 'Your mobile number is wrong! Try again please.',
                        confirmButtonText: 'Try Again'
                    })


                }

            });



            $(document).on("submit", ".mobile-login-form", function(e){

                e.preventDefault();
                var that = $( this );

                // alert('ok');

                $.ajax({
                    url: that.attr("action"),
                    type : that.attr('method'),
                    data : new FormData( this ),
                    // dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(response)
                    {
                        if(response.success)
                        {
                            const Toast = Swal.mixin({
                                toast: false,
                                // position: 'top',
                                showConfirmButton: true,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: 'Great!',
                                text: 'You have successfully logged in.',
                                confirmButtonText: 'OK'
                            })


                            window.location.href = response.url;
                            // location.reload();
                            // return false;
                        }
                        else
                        {
                            const Toast = Swal.mixin({
                                toast: false,
                                // position: 'top',
                                showConfirmButton: true,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            if(response.errors['login_mobile'])
                            {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Opps!',
                                    text: response.errors['login_mobile'],
                                    confirmButtonText: 'Try Again'
                                })
                            }

                            if(response.errors['login_password'])
                            {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Opps!',
                                    text: response.errors['login_password'],
                                    confirmButtonText: 'Try Again'
                                })
                            }

                            if(response.errors['login'])
                            {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Opps!',
                                    text: response.errors['login'],
                                    confirmButtonText: 'Try Again'
                                })
                            }


                        }
                    },
                    error: function(){}
                });


            });

            /////////////////////////////////

            $(document).on("submit", ".mobile-registration-form", function(e){

                e.preventDefault();
                var that = $( this );

                // alert('ok');

                $.ajax({
                    url: that.attr("action"),
                    type : that.attr('method'),
                    data : new FormData( this ),
                    // dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(response)
                    {
                        if(response.success)
                        {
                            const Toast = Swal.mixin({
                                toast: false,
                                // position: 'top',
                                showConfirmButton: true,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: 'Great!',
                                text: 'You have successfully joined.',
                                confirmButtonText: 'OK'
                            })

                            window.location.href = response.url;
                            // location.reload();
                            // return false;
                        }
                        else
                        {
                            const Toast = Swal.mixin({
                                toast: false,
                                // position: 'top',
                                showConfirmButton: true,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            if(response.errors['full_name'])
                            {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Opps!',
                                    text: response.errors['full_name'],
                                    confirmButtonText: 'Try Again'
                                })

                                // window.location.href = response.url;
                                // location.reload(true);
                            }

                            if(response.errors['password'])
                            {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Opps!',
                                    text: response.errors['password'],
                                    confirmButtonText: 'Try Again'
                                })
                                // window.location.href = response.url;
                                // location.reload(true);
                            }

                            if(response.errors['login'])
                            {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Opps!',
                                    text: response.errors['login'],
                                    confirmButtonText: 'Try Again'
                                })
                                // window.location.href = response.url;
                                // location.reload(true);
                            }


                        }
                    },
                    error: function(){}
                });


            });
            ////////////////////////////////




            @if(request()->cookie('mobile_saved'))
            $("#modal_register").modal('show');
            @endif


            $(document).on("click", ".login-modal-hide, .register-modal-hide", function(e){
                $("#modal_login").modal('hide');
                $("#modal_register").modal('hide');
            });


            $(document).on("click", ".login-modal-hide, .register-modal-hide", function(e){
                $("#modal_login").modal('hide');
                $("#modal_register").modal('hide');
            });

        });
        // jquery end
    </script>
@endpush
