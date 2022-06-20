@extends('user.layouts.userMaster')

@push('css')

<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('cp/plugins/select2/css/select2.min.css') }}">

  <style>
  	.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 22px;
}
  </style>

@endpush

@section('content')

 
@include('user.withdraw.parts.commissionWithdrawPart')
 

@endsection

@push('js')

<!-- Select2 -->
<script src="{{ asset('cp/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

    

    $(document).on('click','.radio-agent', function(e){
	    // $( ".manual-show" ).slideUp( "fast", function() {} );

	    $( ".recharge-input-list" ).slideUp( "fast", function() {} );
      $( ".bkash-input-list" ).slideUp( "fast", function() {} );
      $( ".from-cash-list" ).slideUp( "fast", function() {} );
      
	    $( ".from-agent-list" ).slideDown( "slow", function() {} );
	  });

    $(document).on('click','.radio-recharge', function(e){
	    $( ".from-agent-list" ).slideUp( "fast", function() {} );
      $( ".bkash-input-list" ).slideUp( "fast", function() {} );
      $( ".from-cash-list" ).slideUp( "fast", function() {} );

	    $( ".recharge-input-list" ).slideDown( "slow", function() {} );

	  });

    $(document).on('click','.radio-bkash', function(e){
	    $( ".from-agent-list" ).slideUp( "fast", function() {} );
       $( ".recharge-input-list" ).slideUp( "fast", function() {} );
       $( ".from-cash-list" ).slideUp( "fast", function() {} );

    $( ".bkash-input-list" ).slideDown( "slow", function() {} );
   

       
	  });

    $(document).on('click','.radio-cash', function(e){
	    $( ".from-agent-list" ).slideUp( "fast", function() {} );
       $( ".recharge-input-list" ).slideUp( "fast", function() {} );
        $( ".bkash-input-list" ).slideUp( "fast", function() {} );
        $( ".from-cash-list" ).slideDown( "slow", function() {} );

       
	  });


	  $(document).on('keyup', '#cashout_amount, #recharge_amount, #bkash_amount', function(){ 

	  	var cashout_amount = Number($( this ).val()),
	  	current_amount = Number($("#current-balance").val()),
	  	new_amount = Number(current_amount - cashout_amount);
	  	if(new_amount <= 0)
	  	{
	  		new_amount = 0;
	  	}
	  	$(".new-balance").text(parseFloat( new_amount).toFixed(2));


	  });


	  $(document).on('click', '.new-pin-link', function(s){

	  	s.preventDefault();
	  	var that = $( this ),
	  	url = that.attr('href');

	  	$.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
          })
            .done(function(response) {


 
              if(response.success)
              {
              	// that.closest('.form-group').addClass('has-feedback has-success');
              	// that.next(".form-control-feedback").show().addClass('glyphicon-ok');
              	// $(".feedback-display").text(response.feedback);
              	$(".new-pin-success-msg").text(response.feedback);

              }

              

            })
            .fail(function() {});
			// }, 800);


	  });



var delay = (function(){
				var timer = 0;
				return function(callback, ms){
					clearTimeout (timer);
					timer = setTimeout(callback, ms);
				};
				})();


	$(document).on('keyup', '.pin-check', function(e){

      e.preventDefault();
      var that = $(this),
          url = that.attr('data-url');
          // alert(that.val());

          

            delay(function(){  
			
          $.ajax({
            url: url + '?pin=' + that.val(),
            type: 'GET',
            dataType: 'json',
            beforeSend: function()
            {
                // $(".placement-loading").show();

                that.closest('.form-group').removeClass('has-feedback has-error has-success');
          that.next(".form-control-feedback").hide().removeClass('glyphicon-remove glyphicon-ok');


            },
            complete: function()
            {
                // $(".placement-loading").hide();
            },
          })
            .done(function(response) {


 
              if(response.success)
              {
              	that.closest('.form-group').addClass('has-feedback has-success');
              	that.next(".form-control-feedback").show().addClass('glyphicon-ok');
              	$(".feedback-display").text(response.feedback);

              }else{
              	that.closest('.form-group').addClass('has-feedback has-error');
              	that.next(".form-control-feedback").show().addClass('glyphicon-remove');
              	$(".feedback-display").text(response.feedback);
              	// $(".feedback-display").text(response.feedback + ' | ' + response.errors.pin);

              }

              

            })
            .fail(function() {});
			}, 800);
    });


});
</script>

@endpush