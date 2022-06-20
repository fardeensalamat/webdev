@extends('theme.prt.layouts.prtMaster')

@section('title')
 {{ $page->page_title }} | {{ env('APP_NAME') }}
@endsection
@section('meta')
@endsection

@push('css')

@endpush

@section('contents')
{{-- @include('alerts.alerts')
<div class="">
    @isset($page)
        @foreach ($page as $item)
            @include('theme.prt.include.pageItem')
        @endforeach
    @endisset
</div> --}}

<section class="content p-0 w3-white container">
  <br>
    @php
    $pageItem =  $page->items->where('active',true);
    @endphp
  @foreach($pageItem as $item)
  
  @if($item->title == 'Register Domain Form part')
  
  <div class="row p-0 m-0">
    {!! $item->content !!}
    </div>
  {{-- <form method="get" action="http://secures.bijoy.net/whmcs/cart.php">
    {!! $item->content !!} 
  </form> --}}
  
  @else
  
  {!! $item->content !!}
  
  @endif
  
  @endforeach   
  </section>
@endsection

@push('js')
@endpush


  