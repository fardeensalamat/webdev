@extends('user.layouts.userMaster')

@push('css')

<link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

@endpush

@section('content')
    <section class="content">

        <?php $user = Auth::user();?>
        <br>
        <div class="container-fluid">
      
            @include('alerts.alerts')


            <div class="row">

                <div class="col-md-12">


                     <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLongTitle">Enter Information <small>({{ $cat->workstation->title }} >> {{ $cat->name }})</small></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form  action="{{route('user.newsubscription',$cat->id)}}" method="post" class="new-profile-create-user-part-form- profile-create-form">
                                  @csrf
                                <div class="modal-body">
                                  
                                  <div class="row">
                                    <div class="col-12">
                                      <label for="" class="h4">Choose Payment Method</label> <br>
                                      <label for="nagad"><input type="radio" name="payment_type" value="nagad" id="nagad">Nagad</label>
                                      <label for="other"><input type="radio" name="payment_type" value="other" id="other">Other</label>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="" class="col-form-label">Subscription Fee</label>
                                        <input type="text"  class="form-control" name="amount" placeholder="Enter Amount" value="100" readonly id="">
                                      </div>



                                      <div class="form-group">
                                        <label for="" class="col-form-label">Refferal ID (PF)</label>
                                        <input type="text"  class="form-control" name="reffer"  value="{{ isset($refferCode) ? $refferCode : "" }}" placeholder="Enter refferal ID (PF)" id="">
                                      </div>

                                      {{-- <input type="hidden" value="{{$cat->id}}" name="cat"> --}}


                                      <div class="form-group">
                                        <label for="" class="col-form-label">Subscribe for</label>
                                        <select class="form-control" name="for_user" id="typeOfGlass"> 
                                          @if ($subscription)
                                          <option value="new" selected>For New Tenant</option>
                                          @else
                                          <option value="own">For Me</option>
                                          <option value="new" selected>For New Tenant</option>
                                          @endif


                                        </select>
                                      </div>

                                      <div class="hideme">
                                        <div class="form-group">
                                          <label for="" class="col-form-label">Name</label>
                                          <input type="text" name="username" class="form-control" placeholder="Tenant Name">
                                        </div>
  
                                        <div class="form-group">
                                          <label for="" class="col-form-label">Mobile</label>
                                          <input type="text" id="input-mobile" name="mobile" class="form-control" placeholder="Mobile">
                                        </div>
                                        
  
                                        <div class="form-group">
                                          <label for="" class="col-form-label">Password</label>
                                          <input type="password" name="password" class="form-control" placeholder="password">
                                        </div>
                                      </div>

                                      

                                      


                                      @if(Auth::user()->balance > 99)

                                      @else

                                      <div class="form-group">
                                        <label for="" class="col-form-label">Transection</label>
                                        <input type="text" class="form-control" name="transection" placeholder="Transection ID" id="">
                                      </div>
                                      <div class="form-group">
                                        <label for="" class="col-form-label">Sender No</label>
                                        <input type="text" class="form-control" name="sender" placeholder="Sender No" id="">
                                      </div>

                                      @endif

                                      
                                      <button type="submit" class="btn btn-primary ">Submit</button>

                                    </div>

                                    
                                    <div class="col-md-6">


                                      <div class="card card-primary">
                                        <div class="card-body w3-indigo">


                                          @if(Auth::user()->balance > 99)

                                          <p>Your Current Balance: BDT {{ Auth::user()->balance }}</p>

                                          <p> New Subscription Fee: BDT 100 </p>
                                          <p> New Balance Will Be: BDT <span class="badge badge-light w3-large">{{ Auth::user()->balance - 100 }}</span>   </p>

                                          @else

                                          <div class="form-group">
                                            <h5 class="text-center p-3">bKash / Nagad / Upay / Rocket</h5>
                                            <hr>
                                              {{-- <p>Our Bkash Merchant : 01821952907</p>
                                              
                                              <p>
                                                Go to bKash Menu by dialing *247#
                                                <br>
                                                Choose 'Payment' option
                                                <br>
                                                Enter our Merchant wallet number : 01821952907.
                                                <br>
                                                Enter BDT 100
                                                <br>

                                                Enter a reference : joining
                                                <br>
                                                Enter the counter number : 1.
                                                <br>
                                                Now enter your PIN to confirm: xxxx.
                                                <br>
                                                Done and wait untill approve!
                                              </p> --}}
                                              <p>{!!$websiteParameter->payment_no!!}</p>
                                          </div>

                                          @endif


                                          
                                        </div>
                                      </div>
                                      
                                    
                                    </div>  
                                  </div>             
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </form>
                              </div>


                              <br> 

                </div>
            </div>
  

 

        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')

    <script>
        function subscribeId(actionUrl) {
            $("#subscribeForm").attr("action", actionUrl);
        }
        $(document).ready(function() {
            $('select').change(function() {
                if ($(this).val() === "new")
                {
                  $('.hideme').show();
                  $('.profile-create-form').addClass('new-profile-create-user-part-form');
                }
                    
                else
                    {
                      $('.hideme').hide();
                    $('.profile-create-form').removeClass('new-profile-create-user-part-form');
                    }
            }).change();
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
         initialCountry: "auto",
         geoIpLookup: getIp,
         utilsScript:
         "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
  
         preferredCountries: ["bd","in","my" ],
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
      console.log(phoneInput.getSelectedCountryData());
      $(".country_name").val(phoneInput.getSelectedCountryData().name);
      $(".mobile_country").val(phoneInput.getSelectedCountryData().iso2);
      $(".calling_code").val(phoneInput.getSelectedCountryData().dialCode);
    });
  
    
   
   
  
   </script>

<script>
  $(function(){

        $(document).on('click', '.setting-cont-open-btn', function(e){
  e.preventDefault();

  // $(".setting-container").hide();
  $( this ).closest('.w3-container').find('.setting-container').toggle();
});


        /////////////////


$(document).on('submit', '.new-profile-create-user-part-form', function(e){
  // e.preventDefault();
 
  var that = $( this );

  $(".help-block").remove();

    if(phoneInput.isValidNumber())
      {
        $("#input-mobile").val(phoneInput.getNumber());
        
      }
      else
      {
        e.preventDefault();
        alert('Not Valid number.');
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
          text: 'Mobile number is wrong! Try again please.',
          confirmButtonText: 'Try Again'
        })

      }
  


});




  });
</script>

@endpush
