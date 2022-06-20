@if($category->subcategories()->first())
<table class="table table-condensed table-subcat">
  <tbody>
    
@foreach($category->subcategories as $subcat)

  @include('admin.categories.ajax.subcatTr')

@endforeach
  </tbody>
</table>
@endif