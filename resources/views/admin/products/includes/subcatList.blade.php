@php
    $subitem = $item
@endphp
@foreach ($subitem->children as $item)
            
<div class="pl-2 checkbox">
    <label>
        <input type="checkbox" name="brands[]" value="">
        {{$item->name}}
    </label>
</div>
@if ($item->children->count())
    @include('admin.products.includes.subcatList')
@endif
@endforeach