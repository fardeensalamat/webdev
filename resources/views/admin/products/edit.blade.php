@extends('admin.layouts.adminMaster')

@section('title')
Add New Product
@endsection

@push('css')

<!-- cropperjs-->
<link href="{{asset('assets/cropperjs-master/dist/cropper.min.css')}}" rel='stylesheet' type='text/css'>

<link href="{{asset('css/productCreate.css')}}" rel="stylesheet" />

<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('cp/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('cp/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- Bootstrap4 Duallistbox -->
<link href="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css') }}" rel="stylesheet">
{{-- 
<link href="{{asset('cp/css/plugins/summernote/summernote-bs4.css')}}" rel="stylesheet"> --}}
    
<link href="{{ asset('assets/dropzone/dist/css/component-dropzone.min.css') }}" rel="stylesheet">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />  
@endpush

@section('content')

<br>
<!-- Main content -->
<section class="content"> 

  <!-- Info cardes -->
  <div class="row">
    <div class="col-md-12">

     @include('alerts.alerts')

     <div class="elevation-4">

       <div class="card card-primary">
        <div class="card-header with-border">
          <h3 class="card-title"><i class="fa fa-plus-square"></i> {{ __('Create New Product') }}</h3>

        </div>

        <div class="card-body " style="background: #eee;">

         <div class="row">
          <div class="col-sm-6">


            <div class="card mb-0">

              <div class="card-body">

                <div class="fb-profile">

                  <div class="row">
                    <div class="col-sm-6">

                      <div class="profile-image">

                        @include('admin.products.ajax.productFeatureImg')

                      </div>

                      <div class="crop-profilepic-container">
                        <img style="display: none;" class="img-fluid w-100 mb-3" id="crop-profilepic" src="">
                      </div>



                    </div>

                    <div class="col-sm-6">





                      <a href="{{route('admin.productFeatureImageDelete', $product)}}" style="{{ $product->feature_img ? '' : 'display:none;'}}" class="btn-profilepic-delete" title="Feature Image Delete">


                        <span class="fa-stack fa-lg ">
                          <i class="fa fa-square-o fa-stack-2x "></i>
                          <i class="fa fa-trash w3-text-white w3-hover-shadow w3-hover-red w3-round w3-card-4 w3-gray fa-stack-1x "></i>
                        </span>

                      </a>

                      <a id="btn-profilepic" class="btn-profilepic" title="Change Profile Picture">


                        <span class="fa-stack fa-lg ">
                          <i class="fa fa-square-o fa-stack-2x "></i>
                          <i class="fa fa-camera w3-text-white w3-hover-shadow w3-hover-deep-orange w3-round w3-card-4 w3-blue fa-stack-1x "></i>
                        </span>

                      </a>









                      <form id="form_profilepic_upload" method="post" enctype="multipart/form-data" action="{{ route('admin.productFeatureImageChange', ['product'=>$product]) }}">

                        {{csrf_field()}}

                        <input class="form-control" type="file" id="my_profilepic" name="profile_picture" style="display: none;"  />
                        <input class="form-control" style="display: none;" id="off_x" step="any" type="number" name="off_x"  />
                        <input class="form-control" style="display: none;" id="off_y" step="any" type="number" name="off_y"  >
                        <input class="form-control" style="display: none;" id="change_width" step="any" type="number" name="change_width"  >
                        <input class="form-control" style="display: none;" id="change_height" step="any" type="number" name="change_height"  >

                        <button type="reset" class="w3-card-2 btn-profilepic-cancel w3-btn w3-round w3-gray btn-xs"><i class="fa fa-times fa-2x w3-text-white"></i></button>

                        <button type="submit" class="w3-card-2 btn-profilepic-submit w3-btn w3-round w3-green btn-xs"><i class="fa fa-check-square fa-2x w3-text-white"></i></button>

                      </form>

                      <br>

                      Image Size (640 x 640)px or Larger.

                      <br> <br>

                       <a class="w3-btn p-1 w3-round w3-border w3-border-blue extra-img-modal" href="{{ route('admin.productExtraImageChangeModalOpen', ['product'=>$product]) }}">Update extra image</a>

                    </div>
                  </div>

                </div>

              </div>

            </div>


<br>  

<div class="product-extra-image-container">
  @include('admin.products.ajax.productExtraImages')
</div>



{{-- <div class="card">
  <div class="card-body">

    <div class="product-owner-container-tiny float-left">
      @include('admin.products.ajax.userTinyCard')
    </div>
    

    <div data-toggle="tooltip" class="float-right" title="{{ __('Add product owner or create new product owner') }}">
      <a class="user-create-modal-lg btn btn-link" href="{{ route('admin.productOwnerModalOpen',['product'=>$product]) }}">
        <i class="fa fa-user-plus"></i>
      </a>
      <a class="user-create-modal-lg btn btn-link" href="">
        <i class="fa fa-user-plus"></i>
      </a>
    </div>

  </div>
</div> --}}


{{-- category card --}}
<div class="card card-primary">
  <div class="card-header with-border">
      <h3 class="card-title">
          Manage Product Categories 
         
      </h3>
  </div>
  <div class="card-body">
      <div class="row">
          <div class="col-md-12">
              <input id="search-input" class="search-input" />
              <br>
              
              <div id="SimpleJSTree">

              </div>

              
          </div>

          
          {{-- <div class="col-md-3">
              <div class="row">
                  <div class="col-md-12">
                      <img src="{{ route('imagecache', [ 'template'=>'pfimd','filename' => $cat->img_name ]) }}" alt="{{$cat->title}}" width="30px;">
                  </div>
                  <div class="col-md-12">
                      <img src="" alt="">
                  </div>
              </div>
          </div> --}}
      </div>
  </div>
</div>
{{-- ./ category --}}


 

</div>
{{-- col-md right --}}
<div class="col-md-6">
  <div class="card">
    <div class="card-body">
  
      <form action="{{route('admin.productInformationUpdate',$product)}}" class="" method="POST">
        @csrf
        <div class="form-group">
          <label>Product Name*</label>
          @if ($errors->has('name'))
            <p style="color: red;margin: 0;">{{ $errors->first('name') }}</p>
          @endif
          <input type="text" name="name" value="{{ json_decode($product->name)->en }}" class="form-control" placeholder="Enter Product Name">
        </div>
  
        <div class="form-group">
          <label>Product Short Description</label>
          @if ($errors->has('excerpt'))
            <p style="color: red;margin: 0;">{{ $errors->first('excerpt') }}</p>
          @endif
          <input type="text" name="excerpt" value="{{json_decode($product->excerpt)->en}}" class="form-control" placeholder="Enter  Brand Meta Title">
        </div>
  
        <div class="form-group">
          <label>Product Description (Optional)</label>
          @if ($errors->has('description'))
            <p style="color: red;margin: 0;">{{ $errors->first('description') }}</p>
          @endif
          <textarea name="description" rows="3" class="form-control summernote" placeholder="Write Description">{{json_decode($product->description)->en}}</textarea>
        </div>

        {{-- brand select 2 --}}
        <div class="form-group">
          <label>Brands</label>
          <select class="form-control select2" name="brand" style="width: 100%;">
            <option selected="selected">{{$product->brand ? $product->brand->title : 'Select Brand'}}</option>
            @foreach ($brands as $brand)
            <option value="{{$brand->id}}">{{$brand->title}}</option>
            @endforeach           
            
          </select>
        </div>
        {{-- ./brand select 2 --}}
  
        <div class="form-group">
          <label>MRP (sales price)</label>
          @if ($errors->has('regular_price'))
              <p style="color: red;margin: 0;">{{ $errors->first('regular_price') }}</p>
          @endif
          {{-- data-url="{{ route('admin.productParameterUpdate', [$product,'parameter'=>'sale_price']) }}" --}}
          <input type="number" name="regular_price" value="{{old('regular_price') ?:$product->sale_price }}"  placeholder="Enter Regular Sale Price" class="form-control pro-input-update" >
        </div>
  
        <div class="form-group">
          <label>Trade Price</label>
          @if ($errors->has('purchase_price'))
                <p style="color: red;margin: 0;">{{ $errors->first('purchase_price') }}</p>
            @endif
            {{-- data-url="{{ route('admin.productParameterUpdate', [$product,'parameter'=>'purchase_price']) }}" --}}
          <input type="number" name="purchase_price" value="{{old('purchase_price') ?: $product->purchase_price }}"  placeholder="Enter Product Purchase Price" class="form-control pro-input-update">
        </div>

        <div class="form-group">
          <label>PV (Sales point)</label>
          @if ($errors->has('pv'))
                <p style="color: red;margin: 0;">{{ $errors->first('pv') }}</p>
            @endif
            {{-- data-url="{{ route('admin.productParameterUpdate', [$product,'parameter'=>'purchase_price']) }}" --}}
          <input type="number" name="pv" value="{{old('pv') ?: $product->pv }}"  placeholder="Enter PV (sales point)" class="form-control pro-input-update">
        </div>
  

      <div class="form-group">
        <label>Unit Weight (in kg)(For Shipping)</label>
        @if ($errors->has('unit_weight'))
            <p style="color: red;margin: 0;">{{ $errors->first('unit_weight') }}</p>
        @endif
        {{-- data-url="{{ route('admin.productParameterUpdate', ['product'=>$product,'parameter'=>'unit_weight']) }}" --}}
        <input type="number" min="0" step="any" name="unit_weight" value="{{ $product->unit_weight > 0 ? $product->unit_weight : '' }}"   class="form-control pro-input-update" placeholder="e.g: 0.200">
    </div>
    <div class="row">
      <div class="form-group col-md-6">
      <label>Pre-order</label>
      <div class="form-group"><label> <input name="preorder" type="checkbox" {{ $product->preorder ? 'checked' : '' }}> <i></i> Active </label></div>

      
      </div>
      <div class="form-group col-md-6">
        <label>Refundable</label>
      <div class="form-group"><label> <input name="refundable" type="checkbox" {{ $product->refundable ? 'checked' : '' }}> <i></i> Active </label></div>
      </div>
      {{-- <div class="form-group col-md-4">
        <label>Digital (Downloadable)</label>

      <div class="form-group"><label> <input name="digital" type="checkbox" {{ $product->digital ? 'checked' : '' }}> <i></i> Active </label></div>
        
      </div> --}}
    </div>  





    <div class="form-group">
      <label>MGF Date</label>
      @if ($errors->has('mgf_date'))
          <p style="color: red;margin: 0;">{{ $errors->first('mgf_date') }}</p>
      @endif
      <div class="input-group date">
        <input type="date" name="mgf_date" value="{{ old('mgf_date') }}" class="form-control" value="">
      </div>
    </div>
    <div class="form-group">
      <label>Expire Date</label>
      @if ($errors->has('exp_date'))
          <p style="color: red;margin: 0;">{{ $errors->first('exp_date') }}</p>
      @endif
      <div class="input-group date">
        <input type="date" name="exp_date" value="{{ old('exp_date') }}" class="form-control" value="">
      </div>
    </div>
    <div class="form-group">
      <label>Publish Date</label>
      @if ($errors->has('published_date'))
          <p style="color: red;margin: 0;">{{ $errors->first('published_date') }}</p>
      @endif
      <div class="input-group date">
        <input type="date" name="published_date" value="{{ old('published_date') }}" class="form-control" value="">
      </div>
    </div>
    <div class="form-group">
      <label>Close Date</label>
      @if ($errors->has('close_date'))
          <p style="color: red;margin: 0;">{{ $errors->first('close_date') }}</p>
      @endif
      <div class="input-group date">
        <input type="date" name="close_date" value="{{ old('close_date') }}" class="form-control" value="">
      </div>
    </div>

    <div class="form-group ">
      <label>Published</label>
    <div class="form-group"><label> <input name="published" type="checkbox" {{ $product->status=="on" ? 'checked' : '' }}> <i></i> Active </label></div>
    </div>
    
    <div class="form-group">
      <div class="input-group date">
        <button class="btn btn-success">Update</button>
      </div>
    </div>
      </form>
  
    </div>
  </div>
</div>
</div>

</div>

<div class="card-footer w3-white">
 
</div>

</div>

</div>
</div>        
</div>
<!-- /.row -->

</section>


@include('welcome.includes.modals.modalLg')

@endsection


@push('js')

<!-- SUMMERNOTE -->
{{-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.js"></script>
 
<script src="{{asset('cp/js/plugins/summernote/summernote-bs4.js')}}"></script> --}}


<script src="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js') }}"></script>

 <!-- Select2 -->
<script src="{{ asset('cp/plugins/select2/js/select2.full.min.js') }}"></script>

<script src="{{ asset('assets/dropzone/dist/min/dropzone.min.js') }}"></script>

<script src="{{asset('assets/cropperjs-master/dist/cropper.js')}}"></script>

<script src="{{asset('js/productCreate.js')}}"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js">
</script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js">
</script>

<script>
  $(function () {
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

var cats = <?php echo json_encode($categories); ?>;


createJSTree(cats);


function createJSTree(cats) {            
        $('#SimpleJSTree').jstree({
            "core": {
                "check_callback": true,
                'data': cats,
                strings : {
                    'New node': 'New Category'
                }   
                 
            },
            "plugins": ["search","checkbox","sort","changed"],
            "search": {
                "case_sensitive": false,
                "show_only_matches": true
            },
            
        }).on("select_node.jstree", function (e, data) {
                           
                        // var url = $(".jsTreeUrl").attr("data-select-url");

                        // $.get(url, { 'id' : data.node.id })
                        // .done(function (d) {
                        //     $(".data-ajax-container").empty().append(d.page);
                        // })
                        // .fail(function () {
                        //     data.instance.refresh();
                        // });


             }).on("changed.jstree", function (e, data) {
      // console.log("selected:" + data.changed.selected); // newly selected
      console.log("Node: " + data.node.id); // newly selected
      // console.log("Deselected:" + data.changed.deselected); // newly deselected
    });
        
    }
});



$(document).ready(function () {
        $(".search-input").keyup(function () {
            var searchString = $(this).val();
            $('#SimpleJSTree').jstree('search', searchString);
        });
    });
</script>
<script>
$(document).ready(function(){
  // $('[data-toggle="tooltip"]').tooltip();

////////////////////



$('.summernote').summernote({
        placeholder: 'Write Description of the product, video link, website link etc...',
        tabsize: 2,
        height: 200,
        dialogsInBody: true
      });


      //////////////////////////////

var generalSubcats = '';

$(document).on("change", "#general_category", function(e){
    // e.preventDefault();

    var that = $( this );
    var q = that.val();

    $("#general_subcategory").empty().append($('<option>',{
            value: '',
            text: 'Select Subcategory'
          }));

    $.each(JSON.parse(generalSubcats), function (i, item) {

      if(item.category_id == q)
      {
        $("#general_subcategory").append("<option value='"+ item.id +"'>"+ item.name +"</option>");             
      }

    }); 
    
  });

 /////////////////

$(document).on('click','.product-info-modal-lg', function(e){

      e.preventDefault();
      var that =  $( this ),
          url = that.attr( "href" );
          $("#myModalLg").modal({backdrop: false});

      // alert(url);
    $.ajax({
      url: url,
      type: "Get",
      cache: false,
      dataType: 'json',
      beforeSend: function()
      {
          // $(".loadingModalData").show();
          $(".modal-feed").show();
      },
      complete: function()
      {
          // $(".loadingModalData").hide();
          $(".modal-feed").hide();
      },
    }).done(function(data){

      $('#modalLargeFeed').empty().append(data);

      generalSubcats = $(".general-subcats-all").attr('data-value');


      $('.select2').select2({theme: 'bootstrap4'});

       $('.summernote').summernote({
        placeholder: 'Write Description of the product, video link, website link etc...',
        tabsize: 2,
        height: 200,
        dialogsInBody: true
      });

//==+++++++++++++++++++++++++++++++++
//   $('.step2-select').select2({
//     theme: 'bootstrap4',
//     minimumInputLength: 1,
//     ajax: {
//       data: function (params) {
//         return {
//           q: params.term, // search term
//           page: params.page
//         };
//       },
//       processResults: function (data, params) {
//         params.page = params.page || 1;
//         // alert(data[0].s);
//         var data = $.map(data, function (obj) {
//           obj.id = obj.id || obj.id;
//           return obj;
//         });
//         var data = $.map(data, function (obj) {
//           obj.text = obj.mobile || obj.email;
//           return obj;
//         });
//         return {
//           results: data,
//           pagination: {
//             more: (params.page * 30) < data.total_count
//           }
//         };
//       }
//     },
//   }).on("select2:select", function (e) {
//     var selected_element = $(e.currentTarget);
//     var user_id = selected_element.val();

//     var url = $(".user-select").attr('data-user-add');

//     var urls = url + '?user=' + user_id;

//     $.get(urls, function(response)
//     {
//       if(response.success)
//       {
//         $(".product-owner-container-tiny").empty().append(response.userTinyCard);

//         $(".product-owner-sources-container").empty().append(response.userSources);

//         $(".product-owner-new-container").hide();
//         $(".product-owner-sources-container").show();
//       }
     
//     });
// });
//==+++++++++++++++++++++++++++++++++++

 
    }).fail(function(){});
  });



/////////////////

$(document).on('click','.extra-img-modal', function(e){

      e.preventDefault();
      var that =  $( this ),
      url = that.attr( "href" );
      $("#myModalLg").modal({backdrop: false});

      // alert(url);
    $.ajax({
      url: url,
      type: "Get",
      cache: false,
      dataType: 'json',
      beforeSend: function()
      {
          // $(".loadingModalData").show();
          $(".modal-feed").show();
      },
      complete: function()
      {
          // $(".loadingModalData").hide();
          $(".modal-feed").hide();
      },
    }).done(function(data){

      $('#modalLargeFeed').empty().append(data);


      Dropzone.autoDiscover = false;
          var url = $("#dropzone").attr('data-url');
          $("#dropzone").dropzone({
            url: url,
            maxFiles: 4,
            uploadMultiple: true,
            acceptedFiles: 'image/*',
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
            dictDefaultMessage: "Drop files here or<br>click to upload...",
            success: function(file, response){
               $(".product-extra-image-container").empty().append(response.view);
            }

          });
 
 
    }).fail(function(){});
  });

/////////////////////////////////////

$(document).on('click', '.product-extra-img-delete', function(e){

  e.preventDefault();

  var that = $( this );
  var url = that.attr('href');
 

  $.get(url, function(response)
    {
       
     $(".product-extra-image-container").empty().append(response.view);

    });

});


/////////////////////////////////////

$(document).on('click','.user-create-modal-lg', function(e){

      e.preventDefault();
      var that =  $( this ),
          url = that.attr( "href" );
          $("#myModalLg").modal({backdrop: false});

      // alert(url);
    $.ajax({
      url: url,
      type: "Get",
      cache: false,
      dataType: 'json',
      beforeSend: function()
      {
          // $(".loadingModalData").show();
          $(".modal-feed").show();
      },
      complete: function()
      {
          // $(".loadingModalData").hide();
          $(".modal-feed").hide();
      },
    }).done(function(data){

      $('#modalLargeFeed').empty().append(data);


      $('.select2').select2({theme: 'bootstrap4'});

  $('.step2-select').select2({
    theme: 'bootstrap4',
    minimumInputLength: 1,
    ajax: {
      data: function (params) {
        return {
          q: params.term, // search term
          page: params.page
        };
      },
      processResults: function (data, params) {
        params.page = params.page || 1;
        // alert(data[0].s);
        var data = $.map(data, function (obj) {
          obj.id = obj.id || obj.id;
          return obj;
        });
        var data = $.map(data, function (obj) {
          obj.text = obj.mobile || obj.email;
          return obj;
        });
        return {
          results: data,
          pagination: {
            more: (params.page * 30) < data.total_count
          }
        };
      }
    },
  }).on("select2:select", function (e) {
    var selected_element = $(e.currentTarget);
    var user_id = selected_element.val();

    var url = $(".user-select").attr('data-user-add');

    var urls = url + '?user=' + user_id;

    $.get(urls, function(response)
    {
      if(response.success)
      {
        $(".product-owner-container-tiny").empty().append(response.userTinyCard);

        $(".product-owner-sources-container").empty().append(response.userSources);

        $(".product-owner-new-container").hide();
        $(".product-owner-sources-container").show();
      }
     
    });





});

 
// $('.step2-select').on('select2:select', function (evt){

 
         
// });

        


    }).fail(function(){});
  });

///////////////////////
$(document).on('click', '.new-user-create-form-open', function(e){
  e.preventDefault();

    $(".product-owner-new-container").toggle();
    $(".product-owner-sources-container").toggle();
  
});
///////////////////////////
$(document).on('click', '.toggle-btn-for-product-source-add', function(e){
  e.preventDefault();

    $(".add-new-product-source-info").toggle();

  
});

///////////////////////////
$(document).on('click', '.toggle-btn-for-product-info-add', function(e){
  e.preventDefault();

    $(".add-new-product-info").toggle();
     

  
});

///////////////////////////
$(document).on('click', '.toggle-btn-for-product-description-add', function(e){
  e.preventDefault();

    $(".add-new-product-description").toggle();
     

  
});

/////////////////
$(document).on('keyup', '.input-for-new-user',function(){
    $(".help-block").remove();
});
/////////////////

$(document).on('submit', '.new-source-create-form', function(e){

  e.preventDefault();

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
            $(".product-owner-sources-container").empty().append(response.userSources);
            $(".product-owner-container-tiny").empty().append(response.userTinyCard);
            $(".product-owner-sources-container").show();       
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
/////////////////
$(document).on('submit', '.new-user-create-form', function(e){

  e.preventDefault();

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

          // if (response['output'].length != 0) 
          // {
          //   $('.output-edu-work').empty().append(response.output);
          // }

          $(".product-owner-container-tiny").empty().append(response.userTinyCard);

          $(".product-owner-sources-container").empty().append(response.userSources);

            // $('.user-select').select2('data', {id: response.idValue, text: response.textValue});
            $('#select2-user-container').text(response.textValue).attr('title', response.textValue);

          $(".product-owner-new-container").hide();
          $(".product-owner-sources-container").show();

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
////////////////////

$(document).on('submit', '.product-info-update-form',function(e){


  e.preventDefault();

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
          
          $(".product-info-container-tiny").empty().append(response.productAttributes);

          $(".product-inf-form-area").empty().append(response.userSources);

          generalSubcats = $(".general-subcats-all").attr('data-value');


            $('.select2').select2({theme: 'bootstrap4'});

             $('.summernote').summernote({
              placeholder: 'Write Description of the product, video link, website link etc...',
              tabsize: 2,
              height: 200,
              dialogsInBody: true
            });

            swal({
            text: response.sessionMessage,
            title: "Success!",
            timer: 8000,
            type: "success",
            showConfirmButton: true,
            confirmButtonText: "Close",
            confirmButtonColor: "#007bff"
            });

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


/////////////////
$(document).on('click', '.source-selected', function(e){

   var that = $(this);
    var url = $(".source-change-url-get").attr('data-url');
    var urls = url + '?source=' + that.val();

    $.get(urls, function(response){
      $(".product-owner-container-tiny").empty().append(response.userTinyCard);
    });
}); 


});
</script>

 <script src="{{asset('js/custom.js')}}"></script>

@endpush
