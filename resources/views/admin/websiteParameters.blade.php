@extends('admin.layouts.adminMaster')

@push('css')
<link rel="stylesheet" href="{{asset('cp/plugins/summernote/summernote-bs4.css')}}">
@endpush

@section('content')
  <div class="container">
    @include('admin.modules.websiteParameter')
  </div>
@endsection



@push('js')
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('cp/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<script src="{{asset('cp/plugins/summernote/summernote-bs4.min.js')}}"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>

@endpush


