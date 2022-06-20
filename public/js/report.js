$(document).ready(function () {
$(document).on('click', '.select-date', function(e){
      e.preventDefault();
      var that = $(this),
          url = that.attr('href'),
          url = url + '?user_type=' + $('input[name=user_type]:checked').val();
          // alert(url);
          // alert(url + '?user_type=' + $('input[name=user_type]:checked').val());
          $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            beforeSend: function()
            {
                $(".overlay").show();
            },
            complete: function()
            {
                $(".overlay").hide();
            },
          })
            .done(function(response) {
              // $("#modalLargeFeed").empty().append(response);

              // that.closest(".box").remove();
              
              $(".sales-account-part").empty().append(response);

            })
            .fail(function() {
              alert("error");
          });
    });

      //////////////////////////////////////////

$(document).on('submit', '.select-date-interval', function(e){
      e.preventDefault();
      var that = $(this),
          url = that.attr('action'),
          url = url + '?user_type=' + $('input[name=user_type]:checked').val(),
          alldata = $(this).serialize();
          // alert(alldata);
          $.ajax({
            url: url,
            type: 'GET',
            // dataType: 'json',
            data: alldata,
            beforeSend: function()
            {
                $(".overlay").show();
            },
            complete: function()
            {
                $(".overlay").hide();
            },
          })
            .done(function(response) {
               

              $(".sales-account-part").empty().append(response);
              

            })
            .fail(function() {
              alert("error");
          });
    });

///////////////////////////////////////////

  $(document).on('change', '.select_cat_for_report', function(e){
      e.preventDefault();
      var that = $(this),
          url = that.attr('data-url');
          // alert(that.val());
          $.ajax({
            url: url + '?cat=' + that.val(),
            type: 'GET',
            dataType: 'json',
            beforeSend: function()
            {
                $(".overlay").show();
            },
            complete: function()
            {
                $(".overlay").hide();
            },
          })
            .done(function(response) {
 
              $(".sales-account-part").empty().append(response);

            })
            .fail(function() {
              alert("error");
          });
    });

  //////////////////////////////////
  

  $(document).on('change', '.select_subcat_for_report', function(e){
      e.preventDefault();
      var that = $(this),
          url = that.attr('data-url');
          // alert(that.val());
          $.ajax({
            url: url + '?subcat=' + that.val(),
            type: 'GET',
            dataType: 'json',
            beforeSend: function()
            {
                $(".overlay").show();
            },
            complete: function()
            {
                $(".overlay").hide();
            },
          })
            .done(function(response) {
 
              $(".sales-account-part").empty().append(response);

            })
            .fail(function() {
              alert("error");
          });
    });
  
/////////////////////////////////////////////////

$(document).on('click', '.product-stock-report .pagination a', function(e){
      e.preventDefault();
      var that = $(this),
      url = that.attr('href');
    $.ajax({
      url: url,
      type: 'GET',
      dataType: 'json',
      beforeSend: function()
      {
          $(".overlay").show();
      },
      complete: function()
      {
          $(".overlay").hide();
      },
    })
      .done(function(response) {

        $(".sales-account-part").empty().append(response);

      })
      .fail(function() {
        alert("error");
    });
  });


});
