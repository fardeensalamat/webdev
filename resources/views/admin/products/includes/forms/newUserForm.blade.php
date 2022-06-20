<div class="card card-widget">
	<div class="card-body w-100">
		
		<form method="POST" class="new-user-create-form" action="{{ route('admin.leadOwnerUserCreate',['lead'=>$lead]) }}">
    @csrf

    <div class="form-group mb-1 row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control input-for-new-user form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{ __('Full Name') }}" required autocomplete="name" autofocus>

            {{-- @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror --}}
        </div>
    </div>


    <?php $loc = IP2LocationLaravel::get('103.18.180.82'); ?>
                      {{-- <?php $loc = IP2LocationLaravel::get('72.229.28.185'); ?> --}}
                      {{-- <?php $loc = IP2LocationLaravel::get(request()->ip()); ?> --}}

    @if($loc and (strlen($loc['countryCode']) == 2))

    <div class="form-group mb-1 row">
            <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

            <div class="col-md-6">
                <input id="mobile" type="mobile" class="form-control input-for-new-user form-control-sm @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required placeholder="{{ __('01... ... ...') }}" autocomplete="mobile" autofocus>

                {{-- @error('mobile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror --}}
            </div>
        </div>


        <input type="hidden" name="mobile_country" value="{{ $loc['countryCode'] }}">   



    @else

    <div class="form-group mb-1 row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control input-for-new-user form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  placeholder="{{ __('E-Mail Address') }}" required autocomplete="email">

            {{-- @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror --}}
        </div>
    </div>

    @endif

    <div class="form-group mb-1 row mb-1">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Create New User') }}
            </button>
        </div>
    </div>
</form>

	</div>
</div>