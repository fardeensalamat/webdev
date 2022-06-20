// $(function(){
//     $(document).on("click", ".btn-user-setting", function(e){
//     e.preventDefault();

//     var that = $( this );
//     var url = that.attr("href");
 
    
//     $.ajax({
//       url: url,
//       type: 'GET',
//       cache: false,
//       dataType: 'json',
//       success: function(response)
//       {
//         $(".user-setting-container").empty().append(response);

//           $('.simple-select2').select2({
//               theme: 'bootstrap4',
//               placeholder: "Select an option",
//               containerCssClass: ':all:',
//               allowClear: true
//           });
//       },
//       error: function(){}
//     });
//   });
// });


// $(function(){
//   $(document).on('click','.success-js-alert-close', function(e){
//     e.preventDefault();
//     $(".success-js-alert").fadeOut();
//   });
// });

$(function(){
  $(document).on('submit','.form-user-setting',function(s){

      s.preventDefault();
      var form = $(this),
      url = form.attr('action'),
      type = form.attr('method'),
      alldata = new FormData( this );

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
          $(".success-js-alert").show();

          if (response['output'].length != 0) 
          {
            $('.output-edu-work').empty().append(response.output);
          }
        }
        else
        {
          $.each( response.errors, function( key, value ) {
            $("[name~='"+key+"']").after( "<span class='help-block text-red'><strong>"+value+"</strong></span>" );
          });

          if (response.sessionMessage) 
          {
            swal({
            text: response.sessionMessage,
            title: "Error!",
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
});

// $(document).ready(function(){
//     $(document).on('click', '.btn-add-user', function(e){
//       e.preventDefault();

//       var that = $( this ),
//       url = that.attr('href');
//         $.ajax({
//         url: url,
//         // data: {'_token': $('input[name=_token]').val()},
//         type: 'Get',
//         cache: false,
//         dataType: 'json',
//         success: function(response)
//         {
//           $('[data-toggle="tooltip"], .tooltip').tooltip("hide");

//           if(!response.success)
//               {
//                   alert('false');
//               }
//           else
//               {
//                   that.closest(".btn-area").empty().append(response.page);

//               }
//         },
//         error: function(){}
//       }); //ajax
//     });
//   });

$(document).ready(function(){
    $(document).on('change', '.change-with-other', function(e){
      // e.preventDefault();
      // alert('ok');      
      var that = $(this);
      var val = that.val();
      if((val == 'Other') || (val == 'Others'))
      {
        that.closest('.other-area').find('.other-value-field').slideDown();
      }
      else
      {
        that.closest('.other-area').find('.other-value-field').slideUp();
      }
    });   
  });

$(document).ready(function(){
    $(document).on('click', '.delete-edu-work', function(e){
      e.preventDefault();
      var that = $( this ),
      url = that.attr('data-url');
        $.ajax({
        url: url,
        data: {'_token': $('input[name=_token]').val()},
        type: 'POST',
        cache: false,
        dataType: 'json',
        success: function(response)
        {
          if(!response.success)
              {
                  alert('false');
              }
          else
              {
                  $(".output-edu-work").empty().append(response.output);
              }
        },
        error: function(){}
      }); //ajax
    });
  });
