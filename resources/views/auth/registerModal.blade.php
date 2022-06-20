@push('css')



@endpush

<div id="modal_register" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header w3-deep-orange">
      <h5 class="modal-title w3-text-white">{{ __('Join or Login') }}</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">

@if ($value =  request()->cookie('mobile_saved'))

<form method="post" action="{{ route('auth.registerByMobile') }}" class="mobile-registration-form">
          @csrf

          <div class="row">
            <div class="col-md-6 offset-md-3">
              <div class="w3-card">
                <div class="card">
                  <div class="card-body">

                    <div class="form-group input-group-lg">
                      <label for="mobile_number">{{ __('Your mobile number') }} :</label>
                      <input type="tel" class="form-control form-control-lg" style="width:100%!important;" name="mobile_number" readonly value="{{ $value }}"  id="mobile_number">
                      <a  href="{{ route('auth.unsaveMobile') }}" class="float-right  btn-link">Try with another number</a>
                    </div>
              
              
                    <div class="form-group input-group-lg">
                      <label for="full_name">{{ __('Your full name') }} :</label>
                      <input type="text" class="form-control form-control-lg" style="width:100%!important;" name="full_name" placeholder="Your full name"  id="full_name">
                    </div>
              
                    <div class="form-group input-group-lg">
                      <label for="password">{{ __('Password') }} :</label>
                      <input type="password" class="form-control form-control-lg" name="password" style="width:100%!important;" placeholder="Enter new password"  id="password">
                    </div>
              
              
              
                    <div class="form-group input-group-lg">
                      <label for="password_confirmation">{{ __('Confirm Password') }} :</label>
                      <input type="password" class="form-control form-control-lg" name="password_confirmation" style="width:100%!important;" placeholder="Enter new password again"  id="password_confirmation">
                    </div>
               
                     
                    <button type="submit" class="btn btn-lg btn-block btn-primary btn-first-next">{{ __('Submit') }}</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </form>

    {{-- for google blank id --}}
    <div style="display:none;">
      <input type="tel" class="form-control" id="input-mobile">
    <input type="tel" class="form-control" id="signup-mobile">
    <div id="recaptcha-container"></div>
    </div>


@else


<div class="first-step-number-check">
          

         <form method="post" action="{{ route('auth.userCheckByMobile') }}" class="mobile-check-form">
          @csrf

          <div class="row">
            <div class="col-md-6 offset-md-3">
              <div class="w3-card">
                <div class="card">
                  <div class="card-body">
                    
                    <div class="form-group input-group-lg">
                      <label for="input-mobile">{{ __('Enter mobile number') }} :</label>
                      <input type="tel" class="form-control form-control-lg" style="width:100%!important;"  id="input-mobile">
                      <input type="hidden" class="ip" value="{{ request()->ip() }}">
                    </div>
                     
                     
                    <button type="submit" class="btn btn-lg btn-block btn-primary btn-first-next">{{ __('Next') }}</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
            </form>

        </div>

        <div class="second-step-login" style="display: none;">


          <form method="post" action="{{ route('auth.loginByMobile') }}" class="mobile-login-form">
          @csrf

          <div class="row">
            <div class="col-md-6 offset-md-3">
              <div class="w3-card">
                <div class="card">
                  <div class="card-body">
                    
                    <div class="form-group input-group-lg">
                      <label for="login-mobile">{{ __('Mobile number') }} :</label>
                      <input type="tel" class="form-control form-control-lg" name="login_mobile" style="width:100%!important;" readonly  id="login-mobile">
                    </div>
        
                    <div class="form-group input-group-lg">
                      <label for="login-password">{{ __('Password') }} :</label>
                      <input type="password" class="form-control form-control-lg" name="login_password" style="width:100%!important;" placeholder="Enter your password"  id="login-password">
                    </div>
        
                    <p class="w3-small">Forgot Password?  <a href="{{ route('auth.passwordRecoverByMobile') }}">Click here</a></p>
                     
                     
                    <button type="submit" class="btn btn-lg btn-block btn-success btn-login">{{ __('Next') }}</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
            </form>
          
        </div>

        <div class="third-step-signup" style="display:none;">


          <form  class="mobile-signup-form">

            <div class="row">
              <div class="col-md-6 offset-md-3">
                <div class="w3-card">
                  <div class="card">
                    <div class="card-body">
                      
                      <div class="form-group input-group-lg">
                        <label for="signup-mobile">{{ __('Mobile number') }} :</label>
                        <input type="tel" class="form-control form-control-lg" name="signup_mobile" style="width:100%!important;" readonly  id="signup-mobile">
                      </div>
          
                      <div class="form-group ">
                        
                         <div id="recaptcha-container"></div>
                      </div>
                       
                      <button type="button" onclick="sendOTP();" class="btn btn-lg btn-block btn-success">{{ __('Send OTP') }}</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
             
            </form>
          
        </div>


        <div class="forth-step-verify" style="display:none;">


          <form  class="mobile-verify-save-form" action="{{ route('auth.saveNewMobile') }}" method="post" >
             @csrf
              <div class="form-group input-group-sm">
                <label for="verify-mobile">{{ __('Your Mobile Number') }} :</label>
                <input type="tel" class="form-control" name="register_mobile" style="width:100%!important;" readonly  id="verify-mobile">
              </div>

              <div class="form-group input-group-sm">
                <label for="verification-code">{{ __('Enter Verification Code') }} :</label>
                <input type="text" class="form-control" name="verification_code" placeholder="Check mobile and enter otp code" style="width:100%!important;"  id="verification-code">
              </div>

              <input class="calling_code"  type="hidden" name="calling_code">
              <input class="mobile_country"  type="hidden" name="mobile_country">
              <input  class="country_name" type="hidden" name="country_name">


              <button type="button"  onclick="verify()" class="btn btn-sm btn-block btn-dark">{{ __('Verify Mobile Number') }}</button>
            </form>
          
        </div>

@endif
        
        




        {{-- <p class="text-center mt-4">
            {{ __('Already have an account?') }} <br> <a href="#"  class="btn-link register-modal-hide"  data-target="#modal_login" data-toggle="modal">{{ __('login') }}</a>
        </p> --}}

    </div> 
    </div>
  </div> <!-- modal-bialog .// -->
  </div> <!-- modal.// -->
  {{-- register modal end --}}

@push('js')


 <script type="text/javascript">
/// some script

// jquery ready start
$(document).ready(function() {

 
  /////////////////////////////////////

  //    $(document).on("submit", ".btn-first-next", function(e){
  //   e.preventDefault();
  //   var that = $( this );
  //   var q = e.target.value;
  //   var url = that.attr("data-url");
  //   var urls = url+'?q='+q;
  //   // var datalist = $("#products");
  //   // datalist.empty();
  //   // alert(urls);
    
  //   $.ajax({
  //     url: urls,
  //     type: 'GET',
  //     cache: false,
  //     dataType: 'json',
  //     success: function(response)
  //     {
  //       // console.log(response);
  //       $(".user-table-body").empty().append(response.page);
  //     },
  //     error: function(){}
  //   });
  // });
     ////////////////////////////

});

</script>


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