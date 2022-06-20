$(function () {
    var baseUrl = window.location.origin;
     var img = $('.img-changer');
     var int = 1; 
  setInterval(function() {
    if(int===6){int=1}
       
       var background = baseUrl + '/img/b' + int + '.png';
       img.attr('src', background); // change src
       // console.log(int);
       int++;
    }, 2000);
});


$(function(){
    $(document).on("click", ".btn-user-setting", function(e){
    e.preventDefault();

    var that = $( this );
    var url = that.attr("href");
 
    
    $.ajax({
      url: url,
      type: 'GET',
      cache: false,
      dataType: 'json',
      success: function(response)
      {
        $(".user-setting-container").empty().append(response);

          $('.simple-select2').select2({
              theme: 'bootstrap4',
              placeholder: "Select an option",
              containerCssClass: ':all:',
              allowClear: true
          });
      },
      error: function(){}
    });
  });
});

$(function(){
    $(document).on("click", ".user-links .pagination a", function(e){
    e.preventDefault();

    var that = $( this );
    var url = that.attr("href");
 
    
    $.ajax({
      url: url,
      type: 'GET',
      cache: false,
      dataType: 'json',
      success: function(response)
      {
        $(".user-setting-container").empty().append(response);

          $('.simple-select2').select2({
              theme: 'bootstrap4',
              placeholder: "Select an option",
              containerCssClass: ':all:',
              allowClear: true
          });
      },
      error: function(){}
    });
  });
});

$(function(){
    $(document).on("click", ".my-related-user-links .pagination a", function(e){
    e.preventDefault();
    // alert('ok');

    var that = $( this );
    var url = that.attr("href");
 
    
    $.ajax({
          url: url,
          type: 'GET',
          cache: false,
          dataType: 'json',
          beforeSend: function()
          {
              $(".my-loading-overlay").show();
              that.closest('.box').find(".btn-speener").show();
          },
          complete: function()
          {
              $(".my-loading-overlay").hide();
              that.closest('.box').find(".btn-speener").hide();
          },
        })
        .done(function(response) {
          $(".ajax-box-header-remove").remove();
          $(".box-body-container").empty().append(response);

          $('.simple-select2').select2({
              theme: 'bootstrap4',
              placeholder: "Select an option",
              containerCssClass: ':all:',
              allowClear: true
          });

        })
        .fail(function() {
          alert("error");
      });
  });
});




$(function(){
  $(document).on('click','.success-js-alert-close', function(e){
    e.preventDefault();
    $(".success-js-alert").fadeOut();
  });
});



$(document).ready(function(){

    $(document).on('click','.btn-menu-to-container',function(s){

      s.preventDefault();
      var that = $( this ),
      url = that.attr('data-url');

        // alert(url);

        $.ajax({
          url: url,
          type: 'GET',
          cache: false,
          dataType: 'json',
          beforeSend: function()
          {
              $(".my-loading-overlay").show();
              that.closest('.box').find(".btn-speener").show();
          },
          complete: function()
          {
              $(".my-loading-overlay").hide();
              that.closest('.box').find(".btn-speener").hide();
          },
        })
        .done(function(response) {
          $(".ajax-box-header-remove").remove();
          $(".box-body-container").empty().append(response);

           

          $('.simple-select2').select2({
              theme: 'bootstrap4',
              placeholder: "Select an option",
              containerCssClass: ':all:',
              allowClear: true
          });


                   

        })
        .fail(function() {
          alert("error");
      });
    });
});


$(document).ready(function(){

    $(document).on('click','.btn-send-proposal-modal',function(s){

      s.preventDefault();
      var that = $( this ),
      url = that.attr('data-url');
      $("#myModal").modal({backdrop: false});

        // alert(url);

        $.ajax({
          url: url,
          type: 'GET',
          cache: false,
          dataType: 'json',
          beforeSend: function()
          {
              $(".modal-feed-overlay").show();
              // that.closest('.box').find(".btn-speener").show();
          },
          complete: function()
          {
              $(".modal-feed-overlay").hide();
              // that.closest('.box').find(".btn-speener").hide();
          },
        })
        .done(function(response) {

          // $(".box-body-container").empty().append(response);
          $("#modalFeed").empty().append(response);

 

 
          

        })
        .fail(function() {
          alert("error");
      });
    });
});




$(function(){
  $(document).on('submit','.form-send-proposal',function(s){

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
          // $(".success-js-alert").show();



          if(response.sessionMessage)
          {
            $("#myModal").modal("hide");

            swal({
            text: response.sessionMessage,
            title: "Success!",
            timer: 8000,
            type: "success",
            showConfirmButton: true,
            confirmButtonText: "Close",
            confirmButtonColor: "#009933"
            });
          }
        }
        else
        {
          $.each( response.errors, function( key, value ) {
            $("[name~='"+key+"']").after( "<span class='help-block text-red'><strong>"+value+"</strong></span>" );
          });

          if(response.sessionMessage)
          {
            $("#myModal").modal("hide");

            swal({
            text: response.sessionMessage,
            title: "Oops!",
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

$(document).ready(function(){
    $(document).on('click', '.btn-add-user', function(e){
      e.preventDefault();

      var that = $( this ),
      url = that.attr('href');
        $.ajax({
        url: url,
        // data: {'_token': $('input[name=_token]').val()},
        type: 'Get',
        cache: false,
        dataType: 'json',
        success: function(response)
        {
          // $('[data-toggle="tooltip"], .tooltip').tooltip("hide");

          if(!response.success)
          {
              // alert('false');
              if(response.sessionMessage)
              {
                swal({
                text: response.sessionMessage,
                title: "Oops!",
                timer: 8000,
                type: "error",
                showConfirmButton: true,
                confirmButtonText: "Close",
                confirmButtonColor: "#ff0000"
                });
              }
          }
          else
          {
              that.closest(".btn-area").empty().append(response.page);

          }
        },
        error: function(){}
      }); //ajax
    });
  });

$(document).ready(function(){
    $(document).on('click', '.btn-proposal-reply', function(e){
      e.preventDefault();

      var that = $( this ),
      url = that.attr('data-url');
        $.ajax({
        url: url,
        // data: {'_token': $('input[name=_token]').val()},
        type: 'Get',
        cache: false,
        dataType: 'json',
        success: function(response)
        {
          // $('[data-toggle="tooltip"], .tooltip').tooltip("hide");

          if(!response.success)
              {
                  alert('false');
              }
          else
              {
                if (response.page != false) 
                {
                  that.closest(".proposal-card-container").empty().append(response.page);
                }
                else
                {
                  that.closest('.proposal-card-container').slideUp(800);
                }
                  

              }
        },
        error: function(){}
      }); //ajax
    });
  });




  $(document).ready(function(){

    $(document).on('keypress', '.input-search-term', function(e) {
          if(e.which == 13) {
              e.preventDefault();
          }  
      });

  $(document).on("keyup", ".input-search-term", function(e){
      e.preventDefault();
      var that = $( this );
      var q = e.target.value;
      var url = that.attr("data-url");
      var urls = url+'?q='+q;
      // var datalist = $("#products");
      // datalist.empty();
      // alert(urls);
      
      $.ajax({
        url: urls,
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function(response)
        {
          // console.log(response);
          $(".search-term-container").empty().append(response);
        },
        error: function(){}
      });
    });

  });










  $(function(){

  $(document).on('submit','form.cat-subcat-form',function(e){

      e.preventDefault();

      var alldata = $("form.cat-subcat-form").serialize(); // serialize data
      var  form = $("form.cat-subcat-form"),
      url = form.attr('action'),
      type = form.attr('method');


      $.post(url,alldata,function(data) { 
        // $(".loading-icon").hide();
        $(".search-term-container").empty().append(data);
      });



      // posting data and dumping response onto page
      return false;
    });  


  $(document).on('click','.form-check-input-select',function(e){
    if(this.checked) {//Just this.checked will say whether its checked or not
        //Now trigger the form submit event
      // alert('checked');
    } 
    else{ 
    }
      // $(".loading-icon").show();
      $("form.cat-subcat-form").trigger('submit');
      // alert('not checked');
   });
});


  $(function(){
    $(document).on("click", ".my-search-term-user-links .pagination a", function(e){
    e.preventDefault();
    // alert('ok');

    var that = $( this );
    var url = that.attr("href");
 
    
    $.ajax({
          url: url,
          type: 'GET',
          cache: false,
          dataType: 'json',
          beforeSend: function()
          {
              $(".my-loading-overlay").show();
              that.closest('.box').find(".btn-speener").show();
          },
          complete: function()
          {
              $(".my-loading-overlay").hide();
              that.closest('.box').find(".btn-speener").hide();
          },
        })
        .done(function(response) {
          $(".search-term-container").empty().append(response);

          $('.simple-select2').select2({
              theme: 'bootstrap4',
              placeholder: "Select an option",
              containerCssClass: ':all:',
              allowClear: true
          });

        })
        .fail(function() {
          alert("error");
      });
  });
});







// $(function(){
//   $(document).on('submit','.form-user-setting',function(s){

//       s.preventDefault();
//       var form = $(this),
//       url = form.attr('action'),
//       type = form.attr('method'),
//       alldata = new FormData( this );

//       $(".help-block").remove();


//       $.ajax({
//         url: url,
//         type: type,
//         // dataType: 'json',
//         data: alldata,
//         // mimeType:"multipart/form-data",
//         contentType: false,
//         cache: false,
//         processData:false,
//         // beforeSend: function()
//         // {

//         // },
//         // complete: function()
//         // {

//         // },
//       }).done(function(response){

//         if(response.success == true)
//         {
//           $(".success-js-alert").show();
//         }
//         else
//         {
//           $.each( response.errors, function( key, value ) {
//             $("[name~='"+key+"']").after( "<span class='help-block text-red'><strong>"+value+"</strong></span>" );
//           });
//         }

//       }).fail(function(){
//         alert('error');
//       });
//     });
// });

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


// $(document).ready(function(){
//   $(document).on('click', '.box-footer.pagination a', function(e) {
//       e.preventDefault();
//       var url = $(this).attr('href');

          
//   });
// });


// $(function(){
 
//   function automail(){
//       var url = $("body").attr("data-url");
//       $.get(url);
//     }
 

//     setInterval(function() {
//       // This will be executed every 5 seconds
//       automail();
       
//     }, 8000); // 8000 milliseconds

//   });


$(document).ready(function () {

  $(document).on('click','.radio-manual', function(e){
    $( ".manual-show" ).slideDown( "slow", function() {});
  });

  $(document).on('click','.radio-online', function(e){
    $( ".manual-show" ).slideUp( "fast", function() {} );
  });

});