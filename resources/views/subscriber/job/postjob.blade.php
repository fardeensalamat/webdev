@extends('subscriber.layouts.userMaster')
@push('css')
@endpush
@section('content')
    @include('subscriber.job.parts.postjob')    
@endsection

@push('js')
<script type="text/javascript">   

$(document).ready(function(){
  $(document).on("click",'.submit-job', function(e){
    var that = $(this);
    if(that.attr('type') == 'submit')
    {
      $(this).prop('disabled', true);
      that.closest('form').submit();
      that.attr('type', 'button');
    }   

  });
});

$(document).ready(function(){
 $(document).on("change keyup keypress mouseenter",'#total_worker, #cost_per_worker', function(e){
  var rate = parseFloat($('#total_worker').val()) || 1;
    var box = parseFloat($('#cost_per_worker').val()) || 1;

    $('#total_cost').val((rate * box));    
 });

 $("#category").click(function(){
    $("#p").hide();
  });
});

  $(document).ready(function(){
    $( "#category" ).change(function() {
        var catId= $("#category").val();   
        var url= window.location.origin+`/mypanel/category/${catId}/get-subcat`;
        $.getJSON(url, function(data){

          $('#subcategory').empty()
            $('#subcategory').append(`<option value="">Select Subcategory</option>`);
            
            data.forEach(element => {
                $('#subcategory').append(`
                <option value="${element.id}">${element.title}</option>
                `)
            });
        });
    });

    //////////////// subcategory price

    $( "#subcategory" ).change(function() {
      
        var subcatId= $("#subcategory").val();  
        var url= window.location.origin+`/mypanel/subcategory/${subcatId}/get-subcat-price`;
        
        $.getJSON(url, function(data){
          
          $("#cost_per_worker").val(data.job_post_price);
        });
        
    });

    ///////////////// subcategory instraction

    $( "#subcategory" ).change(function() {
      
      var subcatId= $("#subcategory").val();  
      var url= window.location.origin+`/mypanel/subcategory/${subcatId}/get-subcat-instraction`;
      
      $.getJSON(url, function(data){
          $("#instraction").show();
        $("#instraction").html(data.instraction);
      });
      
    });

  })
</script>
<script>
  $(document).ready(function () {
      $('iframe').attr('width', $("#video").width());
      $('iframe').attr('height', 310);
  })  
</script>
<script>
  $(document).ready(function () {
    $(".edit iframe").attr('height', 100);
      $(".edit iframe").attr('width', 200);    
  })
</script>
@endpush