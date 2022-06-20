@extends('admin.layouts.adminMaster')

@push('css')
<link rel="stylesheet" href="{{asset('cp/plugins/summernote/summernote-bs4.css')}}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />    
@endpush

@section('content')
  @include('admin.jobcategories.parts.addNewCategory')
@endsection


@push('js')
<script src="{{asset('cp/plugins/summernote/summernote-bs4.min.js')}}"></script>

<script>
  function subscribeId(actionUrl) {
    $("#subscribeForm").attr("action", actionUrl);
  };
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>
<script>
  function subcatbeId(actionUrl) {
    $("#subcatForm").attr("action", actionUrl);
  }
</script>

<script>
  $(function(){

    $(document).on('click', '.item-delete', function(e){

      e.preventDefault();

      var confirmation = confirm("are you sure you want to remove the subcategory?");

      if (confirmation) {

          var that = $( this );
          var url = that.attr("href");

          // alert(url);


          $.ajax({
            url: url,
            type: 'GET',
            cache: false,
            dataType: 'json',
            success: function(response)
            {

              // if(response.type == 'answer')
              // {
              //     that.closest('.answer-area').empty().append(response.page);
              // that.closest('.form-outer-area').find('.item-count-area').text(response.item_count);

              // }
              
              if(response.success == true)
              {
                  that.closest('.question-area').empty().append(response.page);
              that.closest('.form-outer-area').find('.item-count-area').text(response.item_count);

              }

            },
            error: function(){}
          });


      }


    });

    $(document).on('submit','.form-add-item',function(s){

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

        form.closest('.form-outer-area').find('.all-data-area').empty().append(response.page);
        form.closest('.form-outer-area').find('.item-count-area').text(response.item_count);
        // $(".d-d").text(response.d);
        // $(".success-js-alert").show();

    }
    else
    {
        $.each( response.errors, function( key, value ) {
          $("[name~='"+key+"']").after( "<span class='help-block text-red'><strong>"+value+"</strong></span>" );
      });

      //   if(response.sessionError){
      //     swal({
      //         text: response.sessionError,
      //         title: "Opps!",
      //         timer: 8000,
      //         type: "error",
      //         showConfirmButton: true,
      //         confirmButtonText: "Close",
      //         confirmButtonColor: "#ff0000"
      //     });
      // }
  }

}).fail(function(){
  alert('error');
});
});
});
</script>
@endpush