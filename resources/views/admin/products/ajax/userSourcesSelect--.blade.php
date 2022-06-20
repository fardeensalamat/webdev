<div class="card card-widget">
    <div class="card-body">


    @foreach($lead->user->sources as $source)
    <div class="custom-control custom-radio ">
 
        <input type="radio" class="custom-control-input" name="optradio" {{ $lead->source_id == $source->id ? 'checked' : '' }} id="customR{{ $source->id }}"> 
      <label class="custom-control-label" for="customR{{ $source->id }}">{{ $source->name }} ({{ $source->type }}) ({{ $source->market->name }})</label>
    </div>
 
    @endforeach

    <br>

     <a class="toggle-btn-for-lead-source-add" href="">	<i class="fa fa-edit"></i>	 {{__('Add lead source information')}}</a>

     <div class="add-new-lead-source-info float-left w-100" style="display: none;">
     	<br>
     	<form method="POST" class="new-source-create-form" action="{{ route('agent.leadSourceCreatePost', ['agent'=> $agent, 'lead'=>$lead]) }}">
    @csrf

    <div class="form-group mb-1 row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name or Title') }}*</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control input-for-new-user form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{ __('Name or Title') }}" required autocomplete="off" autofocus>
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="slogan" class="col-md-4 col-form-label text-md-right">{{ __('Slogan or Subtitle') }}*</label>

        <div class="col-md-6">
            <input id="slogan" type="text" class="form-control input-for-new-user form-control-sm @error('slogan') is-invalid @enderror" name="slogan" value="{{ old('slogan') }}" placeholder="{{ __('Slogan or Subtitle') }}" required autocomplete="off">
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}*</label>

        <div class="col-md-6">
            <input id="description" type="text" class="form-control input-for-new-user form-control-sm @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" placeholder="{{ __('Description') }}" required autocomplete="off" >
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Full Address') }}*</label>

        <div class="col-md-6">
            <input id="address" type="text" class="form-control input-for-new-user form-control-sm @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" placeholder="{{ __('Full Address') }}" required autocomplete="off" >
        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="market" class="col-md-4 col-form-label text-md-right">{{ __('Market or Area') }}*</label>

        <div class="col-md-6">
            
            <select name="market"  value="{{ old('market') }}" placeholder="{{ __('Select Market or Area') }}" required autocomplete="off"  id="market" class="select2 form-control input-for-new-user form-control-sm @error('market') is-invalid @enderror " >
                <option value="">{{ __('Select Market') }}</option>

                @foreach($agent->dealer->markets as $market)
                <option value="{{ $market->id }}">{{ $market->name }}</option>
                @endforeach
                
            </select>


        </div>
    </div>

    <div class="form-group mb-1 row">
        <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Source Type') }}*</label>
        <div class="col-md-6">
            <select name="type"  value="{{ old('type') }}" placeholder="{{ __('Source Type') }}" required autocomplete="off"  id="type" class="select2 form-control input-for-new-user form-control-sm @error('type') is-invalid @enderror " >
                <option value="">{{ __('Select Source Type') }}</option>

                @foreach(config('parameter.source_types') as $type)
                <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- 

    <hr>

    <div class="form-group mb-1 row">
        <label for="_name_bn" class="col-md-4 col-form-label text-md-right">{{ __('Bangla Name') }}</label>

        <div class="col-md-6">
            <input id="_name_bn" type="text" class="form-control input-for-new-user form-control-sm @error('_name_bn') is-invalid @enderror" name="_name_bn" value="{{ old('_name_bn') }}" placeholder="{{ __('Bangla Name') }}" required autocomplete="off" autofocus>
        </div>
    </div> --}}

  {{--   

    <div class="form-group mb-1 row">
        <label for="slogan_bn" class="col-md-4 col-form-label text-md-right">{{ __('Bangla Slogan') }}</label>

        <div class="col-md-6">
            <input id="slogan_bn" type="text" class="form-control input-for-new-user form-control-sm @error('slogan') is-invalid @enderror" name="slogan_bn" value="{{ old('slogan_bn') }}" placeholder="{{ __('Bangla Slogan or Subtitle') }}" required autocomplete="off">
        </div>
    </div>

     --}}

   {{--  

    <div class="form-group mb-1 row">
        <label for="description_bn" class="col-md-4 col-form-label text-md-right">{{ __('Bangla Description') }}</label>

        <div class="col-md-6">
            <input id="description_bn" type="text" class="form-control input-for-new-user form-control-sm @error('description_bn') is-invalid @enderror" name="description_bn" value="{{ old('description_bn') }}" placeholder="{{ __('Bangla Description') }}" required autocomplete="off" >
        </div>
    </div> --}}

  {{--   <div class="form-group mb-1 row">
        <label for="address_bn" class="col-md-4 col-form-label text-md-right">{{ __('Full Address Bangla') }}</label>

        <div class="col-md-6">
            <input id="address_bn" type="text" class="form-control input-for-new-user form-control-sm @error('address_bn') is-invalid @enderror" name="address_bn" value="{{ old('address_bn') }}" placeholder="{{ __('Full Address Bangla') }}" required autocomplete="off" >
        </div>
    </div> --}}

 {{--    <div class="form-group mb-1 row">
        <label for="mobile_optional" class="col-md-4 col-form-label text-md-right">{{ __('Mobile (Optional)') }}</label>

        <div class="col-md-6">
            <input id="mobile_optional" type="text" class="form-control input-for-new-user form-control-sm @error('mobile_optional') is-invalid @enderror" name="mobile_optional" value="{{ old('mobile_optional') }}" placeholder="{{ __('Mobile (Optional)') }}" required autocomplete="off" >
        </div>
    </div>

 --}}
    

    


    
  

    <div class="form-group mb-1 row mb-1">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Create New Source') }}
            </button>
        </div>
    </div>
</form>
     </div>



    </div>
</div>