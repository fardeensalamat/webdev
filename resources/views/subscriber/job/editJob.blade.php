@extends('subscriber.layouts.userMaster')
@push('css')
@endpush
@section('content')
    @include('subscriber.job.parts.editJob')    
@endsection
@push('js')
<script type="text/javascript">    
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
                console.log(data);
              
              $("#cost_per_worker").val(data.job_post_price);
            });
            
        });
    
      })
</script> 
@endpush