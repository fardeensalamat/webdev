<!--
Author: W3layouts
Author URL: http://w3layouts.com
-->

<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Explore your future with us</title>
	<!-- Meta tags -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- //Meta tags -->
	<link rel="stylesheet" href="{{ asset('css/w3.css') }}">
	<link rel="stylesheet" href="{{ asset('cp/dist/css/adminlte.min.css') }}">
	<!-- Select2 -->
	<link rel="stylesheet" href="{{asset('cp/plugins/select2/css/select2.min.css')}}">
	<link rel="stylesheet" href="{{asset('cp/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{asset('lf/css/style.css')}}" type="text/css" media="all" /><!-- Style-CSS -->
	<link href="{{asset('lf/css/font-awesome.css')}}" rel="stylesheet"><!-- font-awesome-icons -->
</head>

<body>
	<section class="w3l-form-36">
		<div class="form-36-mian section-gap">
			{{-- desctop view --}}
			<div class="wrapper d-none d-sm-none d-md-block">
				<div class="row">
					<div class="col-md-5">
						<div class="form-inner-cont" style="max-width: 415px !important;">
							<h3>SoftCode</h3>

							@include('alerts.alerts')
							<form method="POST" action="{{ route('register') }}" class="signin-form">
								@csrf
								
								<div class="form-input">
									<span class="fa fa-user-o" aria-hidden="true"></span> <input type="text" name="name" value="{{old('name')}}"  class="@error('name') is-invalid @enderror" 
										placeholder="Full Name*" autofocus />
								</div>
								@if ($errors->has('name'))
                              		<p style="color: red;margin: 0;">{{ $errors->first('name') }}</p>
                            	@endif
								
								<div class="form-input">
									<span class="fa fa-phone" aria-hidden="true"></span> <input type="text" name="mobile" value="{{old('mobile')}}" class="@error('mobile') is-invalid @enderror"   
										placeholder="Mobile*" autofocus required />
								</div>
								@if ($errors->has('mobile'))
                              		<p style="color: red;margin: 0;">{{ $errors->first('mobile') }}</p>
                            	@endif
								
								<div class="form-input">
									<span class="fa fa-envelope-o" aria-hidden="true"></span> <input type="email" name="email" value="{{old('email')}}" class="@error('email') is-invalid @enderror"  
										placeholder="Email" autofocus />
								</div>
								@if ($errors->has('email'))
                              		<p style="color: red;margin: 0;">{{ $errors->first('email') }}</p>
                            	@endif
								<div class="form-input">
									<span class="fa fa-key" aria-hidden="true"></span> <input type="password" name="password" placeholder="Password" class="@error('password') is-invalid @enderror" 
									required autocomplete="current-password"  />
								</div>
								@if ($errors->has('password'))
                              		<p style="color: red;margin: 0;">{{ $errors->first('password') }}</p>
                            	@endif
		
								<div class="form-input">
									<span class="fa fa-key" aria-hidden="true"></span> <input type="password" id="password_confirmation" name="password_confirmation" class="@error('password_confirmation') is-invalid @enderror"  placeholder="Confirm Password"
									required  />
								</div>
								@if ($errors->has('password_confirmation'))
                              		<p style="color: red;margin: 0;">{{ $errors->first('password_confirmation') }}</p>
                            	@endif
		
								<div class="form-group mt-3">
									
									<select name="district" id="" class="form-control select2 @error('district') is-invalid @enderror">
										<option value="">Select District*</option>
										@foreach ($districts as $district)
										<option value="{{$district->id}}">{{$district->name}}</option>
										@endforeach
										
									</select>
								</div>
								@if ($errors->has('district'))
                              		<p style="color: red;margin: 0;">{{ $errors->first('district') }}</p>
                            	@endif
								<div class="form-input">
									
									<span class="fa fa-code" aria-hidden="true"></span> <input type="text" name="reffer" value="{{old('reffer') ?: $reffer}}" {{$reffer ? "readonly" :''}}  
										placeholder="Referral ID (PF No)" autofocus />
								</div>
								
		
								<div class="form-input">
									
									<span class="fa fa-phone" aria-hidden="true"></span> <input type="text" name="transection" class="@error('transection') is-invalid @enderror" value="{{old('transection')}}"   
										placeholder="Bkash Transaction ID*" autofocus required />
								</div>
								<p class="w3-text-red"><b>Please, Pay bkash to our marchant number and enter Transaction ID here carefully. Uppercase and lowercase enter correctly.</b></p>
								@if ($errors->has('transection'))
                              		<p style="color: red;margin: 0;">{{ $errors->first('transection') }}</p>
                            	@endif
		
								<div class="form-input">
									
									<span class="fa fa-phone" aria-hidden="true"></span> <input type="text" name="sender" class="@error('sender') is-invalid @enderror" value="{{old('sender')}}"   
										placeholder="Sender Bkash No*" autofocus required />
								</div>
								@if ($errors->has('sender'))
                              		<p style="color: red;margin: 0;">{{ $errors->first('sender') }}</p>
                            	@endif

								<input type="hidden" name="ws" value="{{request()->ws}}">
								<p style="color: red;" class="pt-2">* Field is required</p>
								<div class="login-remember d-grid">
									<label class="check-remaind">
										<input type="checkbox" name="remember" checked>
										<span class="checkmark" ></span>
										<p class="remember">By clicking Submit, you agree to the SoftCodeInt.'s Privacy Policy And Terms & Conditions.</p>
									</label>
									
								</div>
								
								<div class="mt-2">
									<button class="btn theme-button btn-block">Submit</button>
								</div>
							</form>
							
							<p class="signup">Have an account? <a href="{{ route('login') }}" class="signuplink">Sign In</a></p>
						</div>
					</div>
					<div class="col-md-7">
						<div class="form-inner-cont mt-3 mt-md-0" style="max-width: 415px !important;">
							<div class="card card-primary">
								<div class="card-body">
									<div class="form-group">
										{{-- <h5 class="text-center p-3">Bkash</h5> --}}
									<h5 class="text-center p-3">bKash / Nagad / Upay / Rocket</h5>

										<hr>
										{{-- <p>Please Send Money To : {{$websiteParameter->payment_no}} (personal) <br>bKash / Nagad / Upay / Rocket</p> --}}
										<p>
											{!!$websiteParameter->payment_no!!}
										  </p>
										{{-- <p>
											Go to bKash Menu by dialing *247#
											<br>
											Choose 'Payment' option
											<br>
											Enter our <b class="w3-text-red">Merchant wallet number</b>  : <b class="w3-text-red">01821952907</b>.
											<br>
											Enter BDT 100
											<br>
				
											Enter a reference : joining
											<br>
											Enter the counter number : 1.
											<br>
											Now enter your PIN to confirm: xxxx.
											<br>
											Done and wait untill approve!
										</p> --}}
									</div>
								</div>
							  </div>
						</div>
					</div>
				</div>
				
				<!-- copyright -->
				<div class="copy-right">
					<p>© {{date('Y')}} All rights reserved | Design by <a href="http://a2sys.co/"
					target="_blank">#a2sys</a></p>
				</div>
				<!-- //copyright -->
			</div>
			
			{{-- mobile view --}}
			<div class="wrapper d-block d-sm-block d-md-none">
				<div class="row">
					
					<div class="col-md-6 mb-3">
						<div class="form-inner-cont" style="max-width: 415px !important;">
							<div class="card card-primary">
								<div class="card-body">
								  <div class="form-group">
									{{-- <h5 class="text-center p-3">Bkash</h5> --}}
									<h5 class="text-center">bKash / Nagad / Upay / Rocket</h5>

									<hr>
									  {{-- <p>Our Bkash Merchant : 01821952907</p> --}}
									  {{-- <p>Please Send Money To : {{$websiteParameter->payment_no}} (personal) <br>bKash / Nagad / Upay / Rocket</p> --}}
									  <p>
										{!!$websiteParameter->payment_no!!}
									  </p>
									  {{-- <p>
										Go to bKash Menu by dialing *247#
										<br>
										Choose 'Payment' option
										<br>
										Enter our Merchant wallet number : 01821952907.
										<br>
										Enter BDT 100
										<br>
			
										Enter a reference : joining
										<br>
										Enter the counter number : 1.
										<br>
										Now enter your PIN to confirm: xxxx.
										<br>
										Done and wait untill approve!
									  </p> --}}
								  </div>
								</div>
							  </div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-inner-cont" style="max-width: 415px !important;">
							<h3>SoftCode</h3>
							<form method="POST" action="{{ route('register') }}" class="signin-form">
								@csrf
		
								<div class="form-input">
									<span class="fa fa-user-o" aria-hidden="true"></span> <input type="text" name="name" value="{{old('name')}}"  class="@error('name') is-invalid @enderror" 
										placeholder="Full Name*" autofocus required />
								</div>
								@error('name')
									<span class="invalid-feedback" style="color: red;" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								<div class="form-input">
									<span class="fa fa-phone" aria-hidden="true"></span> <input type="text" name="mobile" value="{{old('mobile')}}" class="@error('mobile') is-invalid @enderror"   
										placeholder="Mobile*" autofocus required />
								</div>
								@error('mobile')
									<span class="invalid-feedback" style="color: red;" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								<div class="form-input">
									<span class="fa fa-envelope-o" aria-hidden="true"></span> <input type="email" name="email" value="{{old('email')}}" class="@error('email') is-invalid @enderror"  
										placeholder="Email" autofocus />
								</div>
								@error('email')
									<span class="invalid-feedback" style="color: red;" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								<div class="form-input">
									<span class="fa fa-key" aria-hidden="true"></span> <input type="password" name="password" placeholder="Password" class="@error('password') is-invalid @enderror" 
									required autocomplete="current-password"  />
								</div>
								@error('password')
									<span class="invalid-feedback" style="color: red;" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
		
								<div class="form-input">
									<span class="fa fa-key" aria-hidden="true"></span> <input type="password" id="password_confirmation" name="password_confirmation" class="@error('password_confirmation') is-invalid @enderror"  placeholder="Confirm Password"
									required  />
								</div>
								@error('password_confirmation')
									<span class="invalid-feedback" style="color: red;" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
		
								<div class="form-group mt-3">
									
									<select name="district" id="" class="form-control select2 @error('district') is-invalid @enderror">
										<option value="">Select District*</option>
										@foreach ($districts as $district)
										<option value="{{$district->id}}">{{$district->name}}</option>
										@endforeach
										
									</select>
								</div>
								@error('district')
									<span class="invalid-feedback" style="color: red;" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								<div class="form-input">
									
									<span class="fa fa-code" aria-hidden="true"></span> <input type="text" name="reffer" value="{{old('reffer') ?: $reffer}}"   
										placeholder="Referral ID (PF No)" autofocus />
								</div>
								@error('district')
									<span class="invalid-feedback" style="color: red;" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
		
								<div class="form-input">
									
									<span class="fa fa-phone" aria-hidden="true"></span> <input type="text" name="transection" class="@error('transection') is-invalid @enderror" value="{{old('transection')}}"   
										placeholder="Bkash Transaction ID*" autofocus required />
								</div>
								@error('transection')
									<span class="invalid-feedback" style="color: red;" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
		
								<div class="form-input">
									
									<span class="fa fa-phone" aria-hidden="true"></span> <input type="text" name="sender" class="@error('sender') is-invalid @enderror" value="{{old('sender')}}"   
										placeholder="Sender Bkash No*" autofocus required />
								</div>
								@error('sender')
									<span class="invalid-feedback" style="color: red;" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								<input type="hidden" name="ws" value="{{request()->ws}}">
								<p style="color: red;">* Field is required</p>
								<div class="login-remember d-grid">
									<button class="btn theme-button btn-block">Register</button>
								</div>
								{{-- <div class="new-signup">
									<a href="#reload" class="signuplink">Forgot password?</a>
								</div> --}}
							</form>
							
							<p class="signup">Have an account? <a href="{{ route('login') }}" class="signuplink">Sign In</a></p>
						</div>
					</div>
				</div>
				
				<!-- copyright -->
				<div class="copy-right">
					<p>© {{date('Y')}} All rights reserved | Design by <a href="https://a2sys.co/"
					target="_blank">#a2sys</a></p>
				</div>
				<!-- //copyright -->
			</div>

		</div>
	</section>
	<script>
  

		$(function () {
			 $('.select2').select2()
	 
			 //Initialize Select2 Elements
			 $('.select2bs4').select2({
			 theme: 'bootstrap4'
			 });
	 
		 });
	 </script>
</body>

</html>