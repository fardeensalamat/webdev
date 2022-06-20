@if($product->user)
<img width="30" src="{{ asset($product->user->pp()) }}" alt="User ">
&nbsp; {{ $lead->user->mobileOrEmail() }} ({{ $product->user->name }})

@if($product->source)
<br>
{{ $product->source->name }} 
({{ $product->source->type }}) 
{{-- ({{ $lead->source->market->name }}) --}}
@endif
@else
<a class="user-create-modal-lg" href="">
  <img width="30" src="{{ asset('img/ppm.jpg') }}" alt="User ">

  {{ __('Set product Owner') }}
      
    </a>
@endif