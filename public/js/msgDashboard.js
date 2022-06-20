$(document).ready(function(){ 

  $(".message-list").slimScroll({
    height: '300px',
    size: '3px',
    color: 'gray',
    start:'bottom'
  });

  $(".my-chats").slimScroll({
    height: '280px',
    size: '3px',
    color: 'gray',
  });



  // var dropzonePost = $("#dropzone-msg").dropzone({ 
  //     url: $("#dropzone-msg").attr('data-url'),
  //     paramName: "file",
  //     maxFilesize: 50, // MB
  //     dictDefaultMessage: 'Drop Your Message Files (Image, pdf, Audio:wav,mp3, Video:mp4,webm,ogg) Here.',
  //     dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
  //     clickable: true,
  //     acceptedFiles: 'image/gif,image/jpeg,image/png,video/mp4,video/webm,video/ogg,application/pdf,audio/mpeg,audio/ogg,audio/wav,audio/mp3',
  //     headers: {
  //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //       },
  //   });

});

$(function(){
  $(document).on('click','.chatSingle',function(e){
    e.preventDefault();
    var that = $(this),
    url = that.attr('href'),
    list = that.closest('.products-list');
    list.find('.item').removeClass('list-selected');
    $.ajax({
      url: url,
      type: 'GET',
      dataType: ' json',
      cache: false
    })
    .done(function(data) {
      $('.msgForm').empty().append(data.formOldMsg);
      $(".message-list").slimScroll({
        height: '300px',
        size: '3px',
        color: 'gray',
        start:'bottom'
      });
      // $(".input_box").elastic();
      that.closest('li').addClass('list-selected');
      $(".input_box").val('').css('height', '65px');

    //   var dropzonePost = $("#dropzone-msg").dropzone({ 
    //   url: $("#dropzone-msg").attr('data-url'),
    //   paramName: "file",
    //   maxFilesize: 50, // MB
    //   dictDefaultMessage: 'Drop Your Message Files (Image, pdf, Audio:wav,mp3, Video:mp4,webm,ogg) Here.',
    //   dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
    //   clickable: true,
    //   acceptedFiles: 'image/gif,image/jpeg,image/png,video/mp4,video/webm,video/ogg,application/pdf,audio/mpeg,audio/ogg,audio/wav,audio/mp3',
    //   headers: {
    //   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    // });
    
      setTimeout("$('.input_box').focus().css('background-color', 'white');", 500);


      var pageChatM = 1;
      $('.message-list').scroll(function(e){
        // if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight - 20) {
          if($(this).scrollTop() == 0) {

          var LP = $(".dataLastPage").attr("data-lastpage"),
              url = $(".dataLastPage").attr("data-url");
          if( pageChatM < LP )
          {
            pageChatM=pageChatM+1;
            getCB(url, pageChatM);

            $(this).animate({
              scrollTop: 15
            }, 'slow');

          }else
          {
            // $('.previousShopComments').prepend("<p>No More Data.</p>");

          }

        }
      });

      function getCB(url, pageChatM)
      {
          $.ajax({
              url : url + '?page=' + pageChatM,
              dataType: 'json',
              beforeSend: function()
              {
                  $(".loadingMessages").show();
              },
              complete: function()
              {
                  $(".loadingMessages").hide();
              },
          }).done(function (data) {
              $('.message-list').find('.previousChatMessage').prepend(data);
              // location.hash = page;
          }).fail(function () {
              $(".loadingMessages").html("<p>No More Data.</p>");
          });
      }



    })
    .fail(function() {
      alert("error");
    });    
  });
});

$(function(){
  var pageMC = 1;
  $(".my-chats").scroll(function(){
    if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight - 20) {
      var LP = $(".chatsLastPage").attr("data-lastpage"),
          url = $(".chatsLastPage").attr("data-url");
          // alert(url);
      if( pageMC < LP )
      {
        pageMC=pageMC+1;
        chatUsers(url, pageMC);
      }else
      {
        return false;
      }
    }
  });

  function chatUsers(url, pageMC)
  {
      $.ajax({
          url : url + '?page=' + pageMC,
          dataType: 'json',
          beforeSend: function()
          {
              $(".loadingChats").show();
          },
          complete: function()
          {
              $(".loadingChats").hide();
          },
      }).done(function (data) {
          $('.chatsAuto').append(data);
          // location.hash = page;
      }).fail(function () {
          $(".loadingChats").html("<p>No More Data.</p>");
      });
  }



});

$(function(){
  var pageChatBus = 1;
      $('.message-list').scroll(function(e){
        // if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight - 20) {
          if($(this).scrollTop() == 0) {

          var LP = $(".dataLastPage").attr("data-lastpage"),
              url = $(".dataLastPage").attr("data-url");
          if( pageChatBus < LP )
          {
            pageChatBus=pageChatBus+1;
            getCB(url, pageChatBus);

            $(this).animate({
              scrollTop: 15
            }, 'slow');

          }else
          {
            // $('.previousShopComments').prepend("<p>No More Data.</p>");

          }

        }
      });

      function getCB(url, pageChatBus)
      {
          $.ajax({
              url : url + '?page=' + pageChatBus,
              dataType: 'json',
              beforeSend: function()
              {
                  $(".loadingMessages").show();
              },
              complete: function()
              {
                  $(".loadingMessages").hide();
              },
          }).done(function (data) {
              $('.message-list').find('.previousChatMessage').prepend(data);
              // location.hash = page;
          }).fail(function () {
              $(".loadingMessages").html("<p>No More Data.</p>");
          });
      }

});

  $(function (){
      
      // $(".input_box").elastic();
      var newMsgUrl = $(".newChatMessage").attr('data-url');

      $(".input_box").val('').css('height', '65px');


       //post body final...
  $(document).on('click',"#btn_msg_post_final", function(e){

  e.preventDefault();
  var that =  $( this ),
      form = that.closest("form"),
      urls = form.attr( "action" ),
      method = form.attr("method"),
      alldata = form.serialize();
  // alert(urls);
  $.ajax({
    url: urls,
    type: method,
    cache: false,
    dataType: 'json',
    data: alldata,
    beforeSend: function()
    {
      $(".input_box").val('').css('height', '65px');
        // $(".loadingNewPost").show();
        // $(".overlay-post").show();
    },
    complete: function()
    {
        // $(".loadingNewPost").hide();
        // $(".overlay-post").hide();
    },
  }).done(function(data){


    $(".input_box").val('').css('height', '65px');

    // $("#dropzone-msg").html('Drop Your Message Files (Image, pdf, Audio:wav,mp3, Video:mp4,webm,ogg) Here.');

    setTimeout("$('.input_box').focus().css('background-color', 'white');", 500);
    // $("#newPost").show();
    $('.newChatMessage').append(data.newMsgSingle);
      
      $(".message-list").animate({
          scrollTop:  $(".message-list")[0].scrollHeight
     }, 1000);



  }).fail(function(){});
});

  $(document).on('click',"#btn_msg_new_final", function(e){

  e.preventDefault();
  var that =  $( this ),
      form = that.closest("form"),
      urls = form.attr( "action" ),
      method = form.attr("method"),
      alldata = form.serialize();
  // alert(urls);
  $.ajax({
    url: urls,
    type: method,
    cache: false,
    dataType: 'json',
    data: alldata,
  }).done(function(data){



    $('.msgForm').empty().append(data.formOldMsg);
    $('.chatsAuto').empty().append(data.newChatto);
      $(".message-list").slimScroll({
        height: '300px',
        size: '3px',
        color: 'gray',
        start:'bottom'
      });

      $(".my-chats").slimScroll({
        height: '300px',
        size: '3px',
        color: 'gray',
      });

      // $(".input_box").elastic();
      that.closest('li').addClass('list-selected');
      $(".input_box").val('').css('height', '65px');
      
    //   var dropzonePost = $("#dropzone-msg").dropzone({ 
    //   url: $("#dropzone-msg").attr('data-url'),
    //   paramName: "file",
    //   maxFilesize: 50, // MB
    //   dictDefaultMessage: 'Drop Your Message Files (Image, pdf, Audio:wav,mp3, Video:mp4,webm,ogg) Here.',
    //   dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
    //   clickable: true,
    //   acceptedFiles: 'image/gif,image/jpeg,image/png,video/mp4,video/webm,video/ogg,application/pdf,audio/mpeg,audio/ogg,audio/wav,audio/mp3',
    //   headers: {
    //   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    // });
      setTimeout("$('.input_box').focus().css('background-color', 'white');", 500);


      var pageChatM = 1;
      $('.message-list').scroll(function(e){
        // if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight - 20) {
          if($(this).scrollTop() == 0) {

          var LP = $(".dataLastPage").attr("data-lastpage"),
              url = $(".dataLastPage").attr("data-url");
          if( pageChatM < LP )
          {
            pageChatM=pageChatM+1;
            getCB(url, pageChatM);

            $(this).animate({
              scrollTop: 15
            }, 'slow');

          }else
          {
            // $('.previousShopComments').prepend("<p>No More Data.</p>");

          }

        }
      });

      function getCB(url, pageChatM)
      {
          $.ajax({
              url : url + '?page=' + pageChatM,
              dataType: 'json',
              beforeSend: function()
              {
                  $(".loadingMessages").show();
              },
              complete: function()
              {
                  $(".loadingMessages").hide();
              },
          }).done(function (data) {
              $('.message-list').find('.previousChatMessage').prepend(data);
              // location.hash = page;
          }).fail(function () {
              $(".loadingMessages").html("<p>No More Data.</p>");
          });
      }




  }).fail(function(){});
});


  // (function latest() {    
  //   $.ajax({
  //     url: $(".wall-right-suggested").attr('data-url'),
  //     type: 'GET',
  //     dataType: 'json',
  //     cache:false,
  //   })
  //   .done(function(data) {
  //     $(".wall-right-suggested").empty().append(data);
  //   })
  //   .fail(function() {
  //     console.log("error");
  //   })
  //   .then(function() {           
  //      setTimeout(latest, 20000);  
  //   });
  // })();



  // (function pullData() {
  //   $.ajax({
  //     url: newMsgUrl,
  //     type: 'GET',
  //     dataType: 'json',
  //     cache:false,
  //   })
  //   .done(function(data) {
  //     $(".newChatMessage").append(data);
  //     $(".message-list").animate({
  //         scrollTop:  $(".message-list")[0].scrollHeight
  //         }, 1000);
  //     window.setTimeout(pullData, 2000); 
  //   }).fail(function() {
  //     console.log("error");
  //   }).then(function() {
      
  //   });
  
  // })();


  // pullData();

  // function pullData()
  // {
  //     getNewMsg();
  //     window.setTimeout(pullData, 3000);
  // }

  // function getNewMsg()
  // {

  //     $.ajax({
  //     url: newMsgUrl,
  //     type: 'GET',
  //     dataType: 'json',
  //     cache:false,
  //   })
  //   .done(function(data) {
  //     $(".newChatMessage").append(data.newMsges);
  //     $(".message-list").animate({
  //         scrollTop:  $(".message-list")[0].scrollHeight
  //         }, 1000);
  //   }).fail(function() {
  //     console.log("error");
  //   });
  // }
});