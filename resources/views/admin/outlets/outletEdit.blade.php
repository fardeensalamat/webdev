@extends('admin.layouts.adminMaster')

@push('css')
   
@endpush

@section('content')
    @include('admin.outlets.parts.outletEdit')
@endsection


@push('js')
<script type="text/javascript">
    $(function(){

    $(document).on('submit','.form-data-submit',function(s){

      s.preventDefault();
      var form = $(this),
      // box = $(this).closest(".box"),
      url = form.attr('action'),
      type = form.attr('method'),
      alldata = new FormData( this );
      // alert(alldata);
      $(".help-block").remove();
      $.ajax({
        url: url,
        type: type,
        // dataType: 'json',
        data: alldata,
        // mimeType:"multipart/form-data",
        contentType: false,
        cache: false,
        processData:false,
        // beforeSend: function()
        // {
        // },
        // complete: function()
        // {
        // },
      }).done(function(response){
    
      
      if(response.success == true)
        {
          // $('.all-data-area').prepend(response.page);
          // $(".d-d").text(response.d);
          // $(".success-js-alert").show();
          $(".data-ajax-container").empty().append(response.page);

          if(response.success){
            swal({
            text: response.sessionError,
            title: "Great!",
            timer: 8000,
            type: "success",
            showConfirmButton: true,
            confirmButtonText: "Close",
            confirmButtonColor: "#000033"
            });
          }
        }
        else
        {
          $.each( response.errors, function( key, value ) {
            $("[name~='"+key+"']").after( "<span class='help-block text-red'><strong>"+value+"</strong></span>" );
          });
          if(response.sessionError){
            swal({
            text: response.sessionError,
            title: "Opps!",
            timer: 8000,
            type: "error",
            showConfirmButton: true,
            confirmButtonText: "Close",
            confirmButtonColor: "#ff0000"
            });
          }
        }
      }).fail(function(){
        alert('error');
      });
    });

    /////////////////////////

      $(document).on("change",'.load_thana', function (e){
           var that=$(this);
          var ldiv =  $(".load_division option:selected").text();
          var ldist = $(".load_district option:selected").text();
          var lthana = $(".load_thana option:selected").text();
          var llocation = $(".load_location").val();
          var lvalue = llocation + ', ' + lthana + ', ' + ldist + ', ' + ldiv;
          $('.loading_point_preview').text(lvalue);
          // alert(lvalue);
        });
        //////////////////////////////////
        $(document).on("input propertychange",'.load_location', function (e){
           var that=$(this);
          var ldiv =  $(".load_division option:selected").text();
          var ldist = $(".load_district option:selected").text();
          var lthana = $(".load_thana option:selected").text();
          var llocation = that.val();
          var lvalue = llocation + ', ' + lthana + ', ' + ldist + ', ' + ldiv;
          $('.loading_point_preview').text(lvalue);
          // alert(lvalue);
          // alert(that.val());
        });
        $(document).ready(function() {
  
        var dists =  <?php echo json_encode($districts); ?>;
        var thanas =  <?php echo json_encode($thanas); ?>
  
        $(document).on("change", ".div-select", function(e){
          // e.preventDefault();
  
          var that = $( this );
          var q = that.val();
  
          that.closest('.form-group').find(".thana-select").empty().append($('<option>',{
                  value: '',
                  text: 'Thana'
                }));
  
          that.closest('.form-group').find(".dist-select").empty().append($('<option>',{
            value: '',
            text: 'District'
          }));
  
          $.each(dists, function (i, item) {
            if(item.division_id == q)
            {
              that.closest('.form-group').find(".dist-select").append("<option value='"+ item.id +"'>"+ item.name +"</option>");              
            }              
          });
  
          $.each(thanas, function (i, item) {
            if(item.division_id == q)
            {
              that.closest('.form-group').find(".thana-select").append("<option value='"+ item.id +"'>"+ item.name +"</option>");             
            }              
          }); 
    
    });
  
  
  
  $(document).on("change", ".dist-select", function(e){
    // e.preventDefault();
  
    var that = $( this );
    var q = that.val();
  
    that.closest('.form-group').find(".thana-select").empty().append($('<option>',{
            value: '',
            text: 'Thana'
          }));
  
    $.each(thanas, function (i, item) {
      if(item.district_id == q)
      {
        that.closest('.form-group').find(".thana-select").append("<option value='"+ item.id +"'>"+ item.name +"</option>");             
      }              
    }); 
    
  });
  
  
  });
    });
  </script>
@endpush