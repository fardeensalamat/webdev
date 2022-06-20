<a class="toggle-btn-for-lead-info-add btn btn-link" href=""> <i class="fa fa-edit"></i>   {{__('Update lead information')}}</a>  

@if($product->name and $product->price)
	({{ __('Updated') }})
@endif

     <div class="add-new-lead-info float-left w-100" style="display: none;">

      <br>
 
    {{-- <form method="POST" class="lead-info-update-form" action="{{ route('agent.leadInfoUpdate',['agent'=>$agent,'lead'=>$lead]) }}"> --}}
      <form method="POST" class="lead-info-update-form" action="">
    @csrf

    <div class="form-group mb-1 row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}*</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control input-for-new-user form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?: $product->name }}" placeholder="{{ __('Product Name with size') }}" required autocomplete="name" autofocus >
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="product_condition" class="col-md-4 col-form-label text-md-right">{{ __('Porduct Condition') }}*</label>

        <div class="col-md-6">

          <select name="product_condition" class="form-control form-control-sm" id="product_condition" required>
          	@if($product->product_condition)
          	<option value="{{ $product->product_condition }}">{{ $product->product_condition }}</option>
          	@endif
            @foreach(config('parameter.product_conditions') as $condition)
            @if($product->product_condition != $condition)
            <option value="{{ $condition }}">{{ $condition }}</option>
            @endif
            @endforeach
          </select>
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="mobile_optional" class="col-md-4 col-form-label text-md-right">{{ __('Mobile (Optional)') }}</label>

        <div class="col-md-6">
            <input id="mobile_optional" type="text" class="form-control input-for-new-user form-control-sm @error('mobile_optional') is-invalid @enderror" name="mobile_optional" value="{{ old('mobile_optional') ?: $product->mobile_optional }}" placeholder="{{ __('Mobile Optional') }}"  autocomplete="mobile_optional" >
        </div>
    </div>


    <div class="form-group mb-1 row">
        <label for="general_category" class="col-md-4 col-form-label text-md-right">{{ __('product Category') }}*</label>

        <div class="col-md-6">

          <select name="general_category" class="form-control form-control-sm" id="general_category" required>
          	@if($product->general_cat_id)
          	<option value="{{ $product->general_cat_id }}">{{ $product->generalCat->name }}</option>
          	@else
            <option value="">{{ __('Select Category') }}</option>
          	@endif
            @foreach($generalCats as $cat)

            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>
    </div>

    <div style="display: none;" class="general-subcats-all" data-value="{{ $generalSubcats }}"> </div>

    <div class="form-group mb-1 row">
        <label for="general_subcategory" class="col-md-4 col-form-label text-md-right">{{ __('Product Subcategory') }}*</label>

        <div class="col-md-6">

          <select name="general_subcategory" class="form-control form-control-sm" id="general_subcategory" required>

          	@if($product->general_subcat_id)
          	<option value="{{ $product->general_subcat_id }}">{{ $product->generalSubcat->name }}</option>
          	@else
            <option value="">{{ __('Product Subcategory') }}</option>
          	@endif
             
            
            
          </select>
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="mfg_date" class="col-md-4 col-form-label text-md-right">{{ __('Manufacture Date') }}</label>
        <div class="col-md-6">
          <input type="date" name="mfg_date" value="{{ $product->mfg_date }}" class="form-control form-control-sm">
        </div>
    </div> 

    <div class="form-group mb-1 row">
        <label for="exp_date" class="col-md-4 col-form-label text-md-right">{{ __('Expired Date') }}</label>
        <div class="col-md-6">
          <input type="date" value="{{ $product->exp_date }}" name="exp_date"  class="form-control form-control-sm" >
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Unit Price (BDT)') }}*</label>
        <div class="col-md-6">
          <input type="number" name="price" min="1" step="1" placeholder="{{ __('Price in BDT') }}"  value="{{ $product->price }}" class="form-control form-control-sm" required>
        </div>
    </div>

     

    <div class="form-group mb-1 row">
        <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>
        <div class="col-md-6">
          <input type="number" name="quantity" min="1" step="1" placeholder="{{ __('Quantity') }}" value="{{ $product->quantity }}" class="form-control form-control-sm" >
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="min_order_quantity" class="col-md-4 col-form-label text-md-right">{{ __('MOQ') }}*</label>
        <div class="col-md-6">
          <input type="number" name="min_order_quantity" min="1" step="1" placeholder="{{ __('Minimum Order Quantity') }}" value="{{ $product->min_order_quantity }}" class="form-control form-control-sm" required >
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="max_order_quantity" class="col-md-4 col-form-label text-md-right">{{ __('Max Order Qty') }}</label>
        <div class="col-md-6">
          <input type="number" name="max_order_quantity" min="1" step="1" placeholder="{{ __('Maximum Order Quantity') }}" value="{{ $product->max_order_quantity }}"  class="form-control form-control-sm"  >
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="unit_weight" class="col-md-4 col-form-label text-md-right">{{ __('Unit Weight') }}*</label>
        <div class="col-md-6 d-flex">
          <input type="number" name="unit_weight" min="0" step="any" placeholder="{{ __('Weight per unit') }}"  class="form-control form-control-sm w-50" value="{{ $product->unit_weight }}" required >

          <select name="unit" id="unit" class="form-control form-control-sm w-50">
          @foreach(config('parameter.unit') as $unit)
            <option value="{{ $unit }}">{{ $unit }}</option>
          @endforeach            
          </select>

        </div>
    </div>  

    <div class="form-group mb-1 row mb-1">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Update Information') }}
            </button>
        </div>
    </div>
</form>


</div>


<br>
<br>

 <a class="toggle-btn-for-lead-description-add btn btn-link" href=""> <i class="fa fa-edit"></i>   {{__('Update lead description')}}</a>

 @if ($product->description)
 	({{ ('Updated') }})
 @endif



     <div class="add-new-lead-description float-left w-100" style="display: none;">

  <br>

      {{-- <form method="post" class="lead-info-update-form" action="{{ route('agent.leadDescriptionUpdate',['agent'=>$agent,'lead'=>$lead]) }}"> --}}
        <form method="post" class="lead-info-update-form" action="">
      	@csrf
      	
    <div class="form-group">
      <label for="description">{{ __('Description') }}:</label>
      <textarea class="form-control summernote" rows="10" id="description" name="description">{!! $product->description !!}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">{{ __('Update Description') }}</button>
  </form>


     </div>