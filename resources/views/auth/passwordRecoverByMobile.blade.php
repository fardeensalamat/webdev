@extends('theme.prt.layouts.welcomeMasterForPassRecovery')


@push('css')
    <style>

    </style>
@endpush

@section('contents')

    <section class="p-2">

        <br>
        <div class="row">
            <div class="col-md-8 offset-md-2">

                <div class="w3-card">

                    <div class="card card-primary">
                        <div class="card-header w3-deep-orange">
                            <h4 class="card-title  w3-text-white">
                                Password Recovery Option
                            </h4>
                        </div>

                        <div class="card-body">


                            <div class="first-step-number-check">


                                <form method="post" action="{{ route('auth.userCheckByMobile') }}"
                                    class="mobile-check-form-for-pass">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6 offset-md-3">
                                            <div class="w3-card">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="form-group input-group-lg">
                                                            <label for="input-mobile">{{ __('Enter Username') }}
                                                                :</label>
                                                            <input type="text" class="form-control form-control-lg"
                                                                style="width:100%!important;" id="input-name">
                                                        </div>
                                                        <div class="form-group input-group-lg">
                                                            <label for="input-mobile">{{ __('Enter mobile number') }}
                                                                :</label>
                                                            <input type="tel" class="form-control form-control-lg"
                                                                style="width:100%!important;" id="input-mobile">
                                                            <input type="hidden" class="ip" value="{{ request()->ip() }}">
                                                        </div>


                                                        <button type="submit"
                                                            class="btn btn-lg btn-block btn-primary btn-first-next">{{ __('Next') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a class="join-now-btn btn-link" style="display:none;" href="{{ url('/') }}">Join
                                        Now</a>
                                </form>

                            </div>





                            <div class="third-step-signup" style="display:none;">


                                <form class="mobile-signup-form">

                                    <div class="row">
                                        <div class="col-md-6 offset-md-3">
                                            <div class="w3-card">
                                                <div class="card">
                                                    <div class="card-body">
                                                      <div class="form-group input-group-lg">
                                                          <label for="signup-mobile">{{ __('Mobile number') }} :</label>
                                                          <input type="tel" class="form-control form-control-lg" name="signup_mobile"
                                                              style="width:100%!important;" readonly id="signup-mobile">
                                                      </div>
                  
                                                      <div class="form-group input-group-sm">
                  
                                                          <div id="recaptcha-container"></div>
                                                      </div>
                  
                  
                                                      <button type="button" onclick="sendOTP();"
                                                          class="btn btn-lg btn-block btn-success">{{ __('Send OTP') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </div>


                            <div class="forth-step-verify" style="display:none;">


                                <form action="" method="post">
                                    @csrf

                                    <div class="row">
                                      <div class="col-md-6 offset-md-3">
                                          <div class="w3-card">
                                              <div class="card">
                                                  <div class="card-body">
                                                    <div class="form-group input-group-lg">
                                                        <label for="verify-mobile">{{ __('Your Mobile Number') }} :</label>
                                                        <input type="tel" class="form-control form-control-lg" name="register_mobile"
                                                            style="width:100%!important;" readonly id="verify-mobile">
                                                    </div>
                
                                                    <div class="form-group input-group-lg">
                                                        <label for="verification-code">{{ __('Enter Verification Code') }} :</label>
                                                        <input type="tel" class="form-control form-control-lg" name="verification_code"
                                                            placeholder="Check mobile and enter otp code" style="width:100%!important;"
                                                            id="verification-code">
                                                    </div>
                
                
                
                                                    <button type="button" onclick="verify()"
                                                        class="btn btn-lg btn-block btn-dark">{{ __('Verify Mobile Number') }}</button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                </form>

                            </div>



                            <div class="final-step-pass-save" style="display:none;">


                                <form class="mobile-verify-save-pass-form"
                                    action="{{ route('auth.passwordSaveByMobile') }}" method="post">
                                    @csrf

                                    <div class="row">
                                      <div class="col-md-6 offset-md-3">
                                          <div class="w3-card">
                                              <div class="card">
                                                  <div class="card-body">
                                                    <div class="form-group input-group-lg">
                                                        <label for="verified-mobile">{{ __('Your Mobile Number') }} :</label>
                                                        <input type="tel" class="form-control form-control-lg" name="verified_mobile"
                                                            style="width:100%!important;" readonly id="verified-mobile">
                                                    </div>
                  
                  
                  
                                                    <div class="form-group input-group-lg">
                                                        <label for="password">{{ __('Password') }} :</label>
                                                        <input type="password" class="form-control form-control-lg" name="password"
                                                            style="width:100%!important;" placeholder="Enter new password" required
                                                            id="password">
                                                    </div>
                  
                                                    <div class="form-group input-group-lg">
                                                        <label for="password_confirmation">{{ __('Password') }} :</label>
                                                        <input type="password" class="form-control form-control-lg" name="password_confirmation"
                                                            style="width:100%!important;" placeholder="Enter new password again" required
                                                            id="password_confirmation">
                                                    </div>
                  
                  
                  
                                                    <button type="submit"
                                                        class="btn btn-lg btn-block btn-dark">{{ __('Save New Password') }}</button>
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


    <script>
        function getIp(callback) {

            var ip = $(".ip").val();
            // var ip = '72.229.28.185';
            var infoUrl = 'https://ipinfo.io/json?ip=' + ip;

            fetch(infoUrl, {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then((resp) => resp.json())
                .catch(() => {
                    return {
                        country: '',
                    };
                })
                .then((resp) => callback(resp.country));
        }

        const phoneInputField = document.querySelector("#input-mobile");
        const phoneInput = window.intlTelInput(phoneInputField, {
            initialCountry: "bd",
            geoIpLookup: getIp,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",

            preferredCountries: ["bd", "us", "gb"],
            placeholderNumberType: "MOBILE",
            nationalMode: true,
            // separateDialCode:true,
            // autoHideDialCode:true,
            customContainer: "w-100",
            autoPlaceholder: "polite",
            //  customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) 
            // {
            //     return "e.g. " + selectedCountryPlaceholder;
            // },

        });
    </script>

    <script type="text/javascript">
        window.onload = function() {
            render();
        };

        function render() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
            recaptchaVerifier.render();
        }

        function sendOTP() {
            const phoneNumber = $("#signup-mobile").val();
            firebase.auth().signInWithPhoneNumber(phoneNumber, window.recaptchaVerifier).then(function(confirmationResult) {
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


            }).catch(function(error) {

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
            coderesult.confirm(code).then(function(result) {
                // var user = result.user;
                console.log(result.user.phoneNumber);
                // $("#successOtpAuth").text("Auth is successful");
                // $("#successOtpAuth").show();


                $("#verified-mobile").val(result.user.phoneNumber);
                $(".forth-step-verify").slideUp();
                $(".final-step-pass-save").slideDown();


            }).catch(function(error) {

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
                    icon: 'Error',
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



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        // jquery ready start
        $(document).ready(function() {

            $(document).on("submit", ".mobile-check-form-for-pass", function(e) {

                e.preventDefault();
                var that = $(this);
                console.log(phoneInput.getNumber());
                console.log(phoneInput.getSelectedCountryData());
                // console.log(phoneInput.getNumberType());
                // console.log(phoneInput.getValidationError());
                console.log(phoneInput.isValidNumber());
                // console.log(window.intlTelInputGlobals.getCountryData());


                if (phoneInput.isValidNumber()) {
                    $.ajax({
                        url: that.attr("action"),
                        cache: false,
                        type: that.attr('method'),
                        data: {
                            mobile: phoneInput.getNumber()
                        },
                        dataType: 'json',
                        success: function(response) {
                            // console.log(response);
                            // $(".user-table-body").empty().append(response.page);

                            if (response.user > 0) {


                                //recaptch and signup
                                $(".first-step-number-check").slideUp();
                                $("#signup-mobile").val(response.mobile);
                                $(".third-step-signup").slideDown();



                            } else {


                                //password field show
                                // $(".first-step-number-check").slideUp();
                                // $("#login-mobile").val(response.mobile);
                                // $(".second-step-login").slideDown();
                                $(".join-now-btn").slideDown();
                                const Toast = Swal.mixin({
                                    toast: false,
                                    // position: 'top',
                                    showConfirmButton: true,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal
                                            .stopTimer)
                                        toast.addEventListener('mouseleave', Swal
                                            .resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'error',
                                    title: 'Opps!',
                                    text: 'Sorry. Your number did not save in our record',
                                    confirmButtonText: 'OK'
                                })

                            }
                        },
                        error: function() {}
                    });
                } else {

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



            $(document).on('submit', '.mobile-verify-save-pass-form', function(e) {


                e.preventDefault();
                var that = $(this);

                $.ajax({
                    url: that.attr("action"),
                    type: that.attr('method'),
                    data: new FormData(this),
                    // dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {

                        if (response.success) {
                            const Toast = Swal.mixin({
                                toast: false,
                                // position: 'top',
                                showConfirmButton: true,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: 'Great!',
                                text: 'You have successfully saved your new password and logged in.',
                                confirmButtonText: 'OK'
                            })

                            window.location.href = response.url;
                            // return false;
                        } else {
                            const Toast = Swal.mixin({
                                toast: false,
                                // position: 'top',
                                showConfirmButton: true,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            if (response.errors['verified_mobile']) {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Opps!',
                                    text: response.errors['verified_mobile'],
                                    confirmButtonText: 'Try Again'
                                })
                            }

                            if (response.errors['password']) {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Opps!',
                                    text: response.errors['password'],
                                    confirmButtonText: 'Try Again'
                                })
                            }

                            if (response.errors['password_confirmation']) {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Opps!',
                                    text: response.errors['password_confirmation'],
                                    confirmButtonText: 'Try Again'
                                })
                            }


                        }
                    },
                    error: function() {}
                });
            });



        });
        // jquery end
    </script>

@endpush
