@if($category->subcategories()->first())
<table class="table table-condensed table-subcat">
  <thead>
    <tr>

      <th>SL</th>
  <th>Subcategory Title</th>
  <th>Description</th>
  <th>Job post Price</th>
  <th>Job Work Price</th>
  <th>Screenshot  </th>
  <th>admin approve</th>
  <th>Work Link</th>
  <th>Instraction</th>
  <th>Action</th>

    </tr>
  </thead>
  
  <tbody>
    
@foreach($category->subcategories as $subcat)

  @include('admin.categories.ajax.subcatTr')

@endforeach
  </tbody>
</table>
@endif