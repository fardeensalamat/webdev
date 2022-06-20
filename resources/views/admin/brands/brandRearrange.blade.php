@extends('admin.layouts.adminMaster')
@section('title')
@endsection

@push('css')
{{-- <link rel="stylesheet" href="{{asset('cp/dist/css/adminlte.min.css')}}"> --}}
 <!-- iCheck -->
 {{-- <link rel="stylesheet" href="{{asset('cp/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}"> --}}
@endpush
@section('content')
@include('alerts.alerts')



  <br>
  <section class="content">    
    <div class="card card-primary">
      <div class="card-header with-border">
          <h3 class="card-title">
              Rearrange Brands 
          </h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div id="sortablePanel" class="col-md-12 connectedSortable" data-url="{{route('admin.brandSort')}}">


            @foreach ($brands as $key => $brand)
      
            <div id="{{$brand->id}}" class="card card-primary">
                <div class="card-header">                
                    <h6> SL:{{$key +1 }} &nbsp; Id:{{$brand->id}}  Title:{{$brand->title}}</h6>
                </div>
            </div>
    
        @endforeach
            
    </div>
        </div>
        
      </div>
    </div>
      
  </section>






    
</div>
@endsection
@push('js')
 
<!-- jQuery UI 1.11.4 -->

{{-- <script src="{{asset('cp/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script> --}}
 <script>

     $(document).ready(function(){

        // Make the dashboard widgets sortable Using jquery UI
  $('.connectedSortable').sortable({
    placeholder         : 'sort-highlight',
    connectWith         : '.connectedSortable',
    handle              : '.card-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex              : 999999
  });
  $('.connectedSortable .card-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move');

        $.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


        $( "#sortablePanel" ).sortable({
      connectWith: ".connectedSortable",
      distance: 5,
    delay: 300,
    opacity: 0.6,
    cursor: 'move',
        update : function () {
          var order = $('#sortablePanel').sortable('toArray'),
            url = $("#sortablePanel").attr('data-url');
            $.ajax({
            url: url,
            type: 'Post',
            cache: false,
            dataType: 'json',
            data: {sorted_data:order},
            success: function(response)
            {
              if(response.success == true)
              {

              }
              else
              {
                alert('fail');
              }
            },
            error: function(){}
          }); //ajax


      }
    }).disableSelection();




     });
      
 </script>
@endpush