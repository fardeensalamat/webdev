<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              {{ __('Lead') }}
              <small>{{ __('Single') }}</small>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{ __('Lead') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Single') }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content"> 

 
<!-- Info cardes -->
      <div class="row">
      <div class="col-md-12">

       @include('alerts.alerts')

      	<div class="card card-widget">

          <div class="card-header ">
            <h3 class="card-title">
             ID:{{ $lead->id }} {{ $lead->name }}
            </h3>
          </div>

          <div class="card-body bg-light">

            <div class="row">
              <div class="col-sm-6">





<div class="card mb-1">

  <div class="card-body">

    <div class="fb-profile">

      <div class="row">
        <div class="col-sm-6">

          <div class="profile-image">

            @include('admin.leads.ajax.leadFeatureImg')

          </div>

          <div class="crop-profilepic-container">
            <img style="display: none;" class="img-fluid w-100 mb-3" id="crop-profilepic" src="">
          </div>



        </div>

        <div class="col-sm-6">





          <a href="{{route('admin.leadFeatureImageDelete', $lead)}}" style="{{ $lead->feature_img ? '' : 'display:none;'}}" class="btn-profilepic-delete" title="Feature Image Delete">


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






          <form id="form_profilepic_upload" method="post" enctype="multipart/form-data" action="">

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

          <a class="w3-btn p-1 w3-round w3-border w3-border-blue extra-img-modal" href="">Update extra image</a>

        </div>
      </div>

    </div>

  </div>

</div>

 
 

<div class="lead-extra-image-container">
  @include('admin.leads.ajax.leadExtraImages')
</div>






<div class="card card-widget mb-1 collapsed-card">
    <div class="card-header">
      <div class="user-block">
         
        @if($lead->user)
        <img class="" src="{{ asset($lead->user->pp()) }}" alt="User Profile Picture">
        <span class="username"><a href="#">{{ $lead->user->name }}</a></span>
        <span class="description">{{ $lead->user->mobileOrEmail() }} (Lead Owner)
           
        </span>
        @endif
      </div>
      <!-- /.user-block -->
      <div class="card-tools">
         
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
        </button>
         
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">

      @if($lead->user->sources)
         @foreach($lead->user->sources as $source)
         <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input source-selected" name="source" value="{{ $source->id }}" {{ $lead->source_id == $source->id ? 'checked' : '' }}>{{ $source->name }} ({{ $source->type }}) ({{ $source->market->name }})
            </label>
          </div>

          <div class="source-change-url-get" data-url="" style="display: none;"></div>
            @endforeach

      @endif
             
    </div>
  </div>
















<form method="POST" class="" action="">


<div class="card card-widget mb-1">
              <div class="card-header">
                <div class="user-block">
                   
                  <span class="username"><a href="#">{{ __('Lead Attributes') }}</a></span>
                  <span class="description">
                    
                  </span>
               
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                   
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                   
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">






    @csrf

    <div class="form-group mb-1 row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Lead Name') }}*</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control input-for-new-user form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?: $lead->name }}" placeholder="{{ __('Lead Name with size') }}" required autocomplete="name" autofocus >
        </div>
    </div>


    <div class="form-group mb-1 row">
        <label for="name_bn" class="col-md-4 col-form-label text-md-right">{{ __('Bangla Lead Name') }}*</label>

        <div class="col-md-6">
            <input id="name_bn" type="text" class="form-control input-for-new-user form-control-sm @error('name_bn') is-invalid @enderror" name="name_bn" value="{{ old('name_bn') ?: $lead->name_bn }}" placeholder="{{ __('Bangla Lead Name with size') }}" required autocomplete="name_bn" >
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="product_condition" class="col-md-4 col-form-label text-md-right">{{ __('Lead Condition') }}*</label>

        <div class="col-md-6">

          <select name="product_condition" class="form-control form-control-sm" id="product_condition" required>
            @if($lead->product_condition)
            <option value="{{ $lead->product_condition }}">{{ $lead->product_condition }}</option>
            @endif
            @foreach(config('parameter.product_conditions') as $condition)
            @if($lead->product_condition != $condition)
            <option value="{{ $condition }}">{{ $condition }}</option>
            @endif
            @endforeach
          </select>
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="mobile_optional" class="col-md-4 col-form-label text-md-right">{{ __('Mobile (Optional)') }}</label>

        <div class="col-md-6">
            <input id="mobile_optional" type="text" class="form-control input-for-new-user form-control-sm @error('mobile_optional') is-invalid @enderror" name="mobile_optional" value="{{ old('mobile_optional') ?: $lead->mobile_optional }}" placeholder="{{ __('Mobile Optional') }}"  autocomplete="mobile_optional" >
        </div>
    </div>


    <div class="form-group mb-1 row">
        <label for="source_category" class="col-md-4 col-form-label text-md-right">{{ __('Source Category') }}*</label>

        <div class="col-md-6">

          <select name="source_category" class="form-control form-control-sm" id="source_category" required>
            @if($lead->source_cat_id)
            <option value="{{ $lead->source_cat_id }}">{{ $lead->generalCat->name }}</option>
            @else
            <option value="">{{ __('Select Source Category') }}</option>
            @endif
            @foreach($sourceCats as $cat)

            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>
    </div>

    <div style="display: none;" class="source-subcats-all" data-value="{{ $sourceSubcats }}"> </div>

    <div class="form-group mb-1 row">
        <label for="source_subcategory" class="col-md-4 col-form-label text-md-right">{{ __('Source Subcat') }}*</label>

        <div class="col-md-6">

          <select name="source_subcategory" class="form-control form-control-sm" id="source_subcategory" required>

            @if($lead->source_subcat_id)
            <option value="{{ $lead->source_subcat_id }}">{{ $lead->generalSubcat->name }}</option>
            @else
            <option value="">{{ __('Source Subcategory') }}</option>
            @endif
          </select>
        </div>
    </div>


    <div class="form-group mb-1 row">
        <label for="general_category" class="col-md-4 col-form-label text-md-right">{{ __('General Category') }}*</label>

        <div class="col-md-6">

          <select name="general_category" class="form-control form-control-sm" id="general_category" required>
            @if($lead->general_cat_id)
            <option value="{{ $lead->general_cat_id }}">{{ $lead->generalCat->name }}</option>
            @else
            <option value="">{{ __('Select General Category') }}</option>
            @endif
            @foreach($generalCats as $cat)

            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>
    </div>

    <div style="display: none;" class="general-subcats-all" data-value="{{ $generalSubcats }}"> </div>

    <div class="form-group mb-1 row">
        <label for="general_subcategory" class="col-md-4 col-form-label text-md-right">{{ __('General Subcat') }}*</label>

        <div class="col-md-6">

          <select name="general_subcategory" class="form-control form-control-sm" id="general_subcategory" required>

            @if($lead->general_subcat_id)
            <option value="{{ $lead->general_subcat_id }}">{{ $lead->generalSubcat->name }}</option>
            @else
            <option value="">{{ __('General Subcategory') }}</option>
            @endif
             
            
            
          </select>
        </div>
    </div>


<div class="form-group mb-1 row">
        <label for="sale_category" class="col-md-4 col-form-label text-md-right">{{ __('Sale Category') }}*</label>

        <div class="col-md-6">

          <select name="sale_category" class="form-control form-control-sm" id="sale_category" required>
            @if($lead->sale_cat_id)
            <option value="{{ $lead->sale_cat_id }}">{{ $lead->generalCat->name }}</option>
            @else
            <option value="">{{ __('Select Sale Category') }}</option>
            @endif
            @foreach($saleCats as $cat)

            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>
    </div>

    <div style="display: none;" class="sale-subcats-all" data-value="{{ $saleSubcats }}"> </div>

    <div class="form-group mb-1 row">
        <label for="sale_subcategory" class="col-md-4 col-form-label text-md-right">{{ __('Sale Subcat') }}*</label>

        <div class="col-md-6">

          <select name="sale_subcategory" class="form-control form-control-sm" id="sale_subcategory" required>

            @if($lead->sale_subcat_id)
            <option value="{{ $lead->sale_subcat_id }}">{{ $lead->saleSubcat->name }}</option>
            @else
            <option value="">{{ __('Sale Subcategory') }}</option>
            @endif
             
            
            
          </select>
        </div>
    </div>


    <div class="form-group mb-1 row">
        <label for="mfg_date" class="col-md-4 col-form-label text-md-right">{{ __('Manufacture Date') }}</label>
        <div class="col-md-6">
          <input type="date" name="mfg_date" value="{{ $lead->mfg_date }}" class="form-control form-control-sm">
        </div>
    </div> 

    <div class="form-group mb-1 row">
        <label for="exp_date" class="col-md-4 col-form-label text-md-right">{{ __('Expired Date') }}</label>
        <div class="col-md-6">
          <input type="date" value="{{ $lead->exp_date }}" name="exp_date"  class="form-control form-control-sm" >
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="publish_date" class="col-md-4 col-form-label text-md-right">{{ __('Publish Date') }}*</label>
        <div class="col-md-6">
          <input type="date" value="{{ $lead->publish_date }}" name="publish_date"  class="form-control form-control-sm" required >
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="close_date" class="col-md-4 col-form-label text-md-right">{{ __('Lead Close Date') }}*</label>
        <div class="col-md-6">
          <input type="date" value="{{ $lead->close_date }}" name="close_date"  class="form-control form-control-sm" required >
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Unit Price (BDT)') }}*</label>
        <div class="col-md-6">
          <input type="number" name="price" min="1" step="1" placeholder="{{ __('Price in BDT') }}"  value="{{ $lead->price }}" class="form-control form-control-sm price" required>
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="pp" class="col-md-4 col-form-label text-md-right">{{ __('PP') }}*</label>
        <div class="col-md-6">
          <input type="number" name="pp" min="1" step="1" placeholder="{{ __('PP') }}"  value="{{ $lead->pp }}" class="form-control pp form-control-sm" required>
        </div>
    </div>


    <div class="form-group mb-1 row">
        <label for="price_with_pp" class="col-md-4 col-form-label text-md-right">{{ __('Price with PP') }}</label>
        <div class="col-md-6">
          <input type="text" name="price_with_pp" min="1" step="1" placeholder="{{ __('price_with_pp') }}"  value="{{ $lead->price_with_pp }}" class="form-control  form-control-sm price_with_pp" readonly>
        </div>
    </div>

     

    <div class="form-group mb-1 row">
        <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>
        <div class="col-md-6">
          <input type="number" name="quantity" min="1" step="1" placeholder="{{ __('Quantity') }}" value="{{ $lead->quantity }}" class="form-control form-control-sm" >
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="min_order_quantity" class="col-md-4 col-form-label text-md-right">{{ __('MOQ') }}*</label>
        <div class="col-md-6">
          <input type="number" name="min_order_quantity" min="1" step="1" placeholder="{{ __('Minimum Order Quantity') }}" value="{{ $lead->min_order_quantity }}" class="form-control form-control-sm" required >
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="max_order_quantity" class="col-md-4 col-form-label text-md-right">{{ __('Max Order Qty') }}</label>
        <div class="col-md-6">
          <input type="number" name="max_order_quantity" min="1" step="1" placeholder="{{ __('Maximum Order Quantity') }}" value="{{ $lead->max_order_quantity }}"  class="form-control form-control-sm"  >
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="unit_weight" class="col-md-4 col-form-label text-md-right">{{ __('Unit Weight') }}*</label>
        <div class="col-md-6 d-flex">
          <input type="number" name="unit_weight" min="0" step="any" placeholder="{{ __('Weight per unit') }}"  class="form-control form-control-sm w-50" value="{{ $lead->unit_weight }}" required >

          <select name="unit" id="unit" class="form-control form-control-sm w-50">
          @foreach(config('parameter.unit') as $unit)
            <option value="{{ $unit }}">{{ $unit }}</option>
          @endforeach            
          </select>

        </div>
    </div>  

    {{-- <div class="form-group mb-1 row mb-1">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Update Information') }}
            </button>
        </div>
    </div> --}}
                 
              </div>  
            </div>

 


<div class="card card-widget">
  <div class="card-body">
    
    <div class="form-group">
      <label for="description">{{ __('Description') }}:</label>
      <textarea class="form-control summernote" rows="10" id="description" required name="description">{!! $lead->description !!}</textarea>
    </div>

  </div>
</div>


<div class="card card-widget">
  <div class="card-body">
    
    <div class="form-group">
      <label for="description_bn">{{ __('Description Bangla') }}:</label>
      <textarea class="form-control summernote" rows="10" id="description_bn" name="description_bn">{!! $lead->description_bn !!}</textarea >
    </div>

  </div>
</div>


<div class="card card-widget">
  <div class="card-body">
    
    <div class="form-group form-check">
     <label class="form-check-label">
      <input class="form-check-input" type="checkbox" name="publish_status" value="published" checked> Publish Now
    </label>
    </div>

  </div>
</div>


<div class="card card-widget">
  <div class="card-body">
    
    <div class="form-group mb-1 row mb-1">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Update Information') }}
            </button>
        </div>
    </div>

  </div>
</div>


</form>



          















                 
              </div>
              <div class="col-sm-6">
                
                <div class="card card-widget mb-1">
              <div class="card-header">
                <div class="user-block">
                  @if($lead->source)
                  <img class="" src="{{ asset($lead->source->logo()) }}" alt="Shop Logo">
                  <span class="username"><a href="#">{{ $lead->source->name }}</a></span>
                  <span class="description">{{ $lead->source->type }}
                    @if($lead->source->market)
                      , {{ $lead->source->market->name }},
                      {{ $lead->upazila->name }},
                      {{ $lead->district->name }}
                    @endif
                  </span>
                  @endif
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                   
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                   
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <img class="img-fluid img-rounded" src="{{ asset($lead->fi()) }}" alt="Product Photo">

                 
              </div>
               
               
            </div>


            <div class="card card-widget mb-1 collapsed-card">
              <div class="card-header">
                <div class="user-block">
                   
                  @if($lead->user)
                  <img class="" src="{{ asset($lead->user->pp()) }}" alt="User Profile Picture">
                  <span class="username"><a href="#">{{ $lead->user->name }}</a></span>
                  <span class="description">{{ $lead->user->mobileOrEmail() }} (Lead Owner)
                     
                  </span>
                  @endif
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                   
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                   
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                @if($lead->user->sources)

                <dl>
                   
                   @foreach($lead->user->sources as $source)
                      <dt>

                        <img width="30" src="{{ asset($source->logo()) }}" alt="Shop Logo">

                         {{ $source->name }} 

                      </dt>
                      <dd>({{ $source->type }}), {{ $source->market->name }}, {{ $source->upazila->name }}, {{ $source->district->name }}</dd>

                      @endforeach
            

                </dl>

                @endif
                 
       
                 
              </div>
               
               
            </div>









            <div class="card card-widget mb-1 collapsed-card">
              <div class="card-header">
                <div class="user-block">
                   
                  @if($lead->agent)
                  <img class="" src="{{ asset($lead->agent->user->pp()) }}" alt="User Profile Picture">
                  <span class="username"><a href="#">{{ $lead->agent->title }}</a></span>
                  <span class="description">{{ $lead->agent->user->name }}, {{ $lead->agent->user->mobileOrEmail() }} (Agent)
                     
                  </span>
                  @endif
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                   
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                   
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                @if($lead->agent->markets)

                <dl>
                   
                   @foreach($lead->agent->markets as $market)
                      <dt>

                         

                         {{ $market->name }} ({{ $market->agent->user->mobileOrEmail() }})

                      </dt>
                      <dd> Sources: {{ $market->sources->count() }}, Leads: {{ $market->leads->count() }}</dd>

                      @endforeach
            

                </dl>

                @endif
                 
       
                 
              </div>
               
               
            </div>





            <div class="card card-widget mb-1">
              <div class="card-header">
                <div class="user-block">
                   
                  <span class="username"><a href="#">{{ __('Lead Attributes') }}</a></span>
                  <span class="description">
                    
                  </span>
               
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                   
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                   
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <dl>
                  <dt>Name  of lead</dt>
                  <dd>{{ $lead->name }}</dd>

                  <dt>Bangla Name  of lead</dt>
                  <dd>{{ $lead->name_bn }}</dd>

                  <dt>Condition</dt>
                  <dd>{{ $lead->product_condition }}</dd>

                   @if($lead->source_cat_id)
                  <dt>Source Category</dt>
                  <dd>{{ $lead->sourceCat->name }}</dd>
                  @endif
                    @if ($lead->source_subcat_id)
                  <dt>Source Subcategory</dt>
                  <dd>{{ $lead->sourceSubcat->name }}</dd>
                    @endif
                    @if ($lead->general_cat_id)
                  <dt>General Category</dt>
                  <dd>{{ $lead->generalCat->name }}</dd>
                    @endif

                    @if ($lead->general_subcat_id)
                  <dt>General Subcategory</dt>
                  <dd>{{ $lead->generalSubcat->name }}</dd>
                    @endif

                  @if ($lead->sale_cat_id)                    
                  <dt>Sale Category</dt>
                  <dd>{{ $lead->saleCat->name }}</dd>
                  @endif
                    @if ($lead->sale_subcat_id)
                  <dt>Sale Subcategory</dt>
                  <dd>{{ $lead->saleSubcat->name }}</dd>
                    @endif
                    
                  <dt>Mobile</dt>
                  <dd>{{ $lead->mobile }}</dd>
                  <dt>Mobile (Optional)</dt>
                  <dd>{{ $lead->mobile_optional }}</dd>

                  <dt>Manufacturing Date</dt>
                  <dd>{{ $lead->mfg_date }}</dd>
                  <dt>Expired Date</dt>
                  <dd>{{ $lead->exp_date }}</dd>

                  <dt>Lead Publish Date</dt>
                  <dd>{{ $lead->publish_date }}</dd>
                  <dt>Lead Cloase Date</dt>
                  <dd>{{ $lead->close_date }}</dd>

                  <dt>Total Quantity</dt>
                  <dd>{{ $lead->quantity }}</dd>

                  <dt>Minimum Order Qty</dt>
                  <dd>{{ $lead->min_order_quantity }} </dd>

                  <dt>Maximum Order Qty</dt>
                  <dd>{{ $lead->max_order_quantity }}</dd>

                  <dt>Unit Price</dt>
                  <dd>{{ env('CURRENCY_CODE') }} {{ $lead->price }} </dd>

                   
                  <dt>PP</dt>
                  <dd>{{ $lead->pp }}</dd>
 
                  <dt>Final Price</dt>
                  <dd>{{ $lead->final_price }}</dd>
                  <dt>Unit Weight</dt>
                  <dd>{{ $lead->unit_weight }} {{ $lead->unit }}</dd>
 
                   
                   


                </dl>
          
                 
              </div>
               
               
            </div>


            <div class="card card-widget mb-1 collapsed-card">
              <div class="card-header">
                <div class="user-block">
                   
                  <span class=" "><a href="#">{{ __('Lead Description') }}</a></span>
                  <span class=" ">
                    
                  </span>
               
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                   
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                   
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                @if($lead->description)

                 {!! $lead->description !!}

                @endif
                 
              </div>              
               
            </div>

            @if($lead->description_bn)
            <div class="card card-widget mb-1 collapsed-card">
              <div class="card-header">
                <div class="user-block">
                   
                  <span class=" "><a href="#">{{ __('Bangla Lead Description') }}</a></span>
                  <span class=" ">
                    
                  </span>
               
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                   
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                   
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
 

                 {!! $lead->description_bn !!}
 
                 
              </div>              
               
            </div>

            @endif











              </div>
            </div>
            
          </div>

          <div class="card-footer bg-white">
            
          </div>

        </div>             
      	
      </div>        
      </div>
      <!-- /.row -->

 
      

    </section>
