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
	<link rel="stylesheet" href="{{asset('lf/css/style.css')}}" type="text/css" media="all" /><!-- Style-CSS -->
	<link href="{{asset('lf/css/font-awesome.css')}}" rel="stylesheet"><!-- font-awesome-icons -->

	<style>

		.showpassword{
			padding: 5px;
			font-family: "lazada-member";
			position: absolute;
			right: 67%;
			top: 237px;
			font-size: 16px;
			line-height: 21px;
			cursor: pointer;
			color: gray;
			background: white;
			z-index: 999;
		}
		
			@media  only screen and (max-width: 769px) {
	
			.hidemobilesidebar{
				display: none;
			}
	
		}
	</style>
</head>

<body>
	<section class="w3l-form-36">
		<div class="form-36-mian section-gap">
			@include('alerts.alerts')
			<div class="wrapper">
				<div class="form-inner-cont">
					<h3>SoftCode</h3>
					<form method="POST" action="{{ route('login') }}" class="signin-form">
                        @csrf
						<div class="form-input">
							<span class="fa fa-phone" aria-hidden="true"></span> <input type="text" class="@error('mobile') is-invalid @enderror" name="mobile" value="{{old('mobile')}}"   
								placeholder="Mobile" autofocus required />
								
						</div>
						@error('mobile')
							<span class="invalid-feedback" style="color: red;" role="alert">
								<strong>{{ $message }}</strong>
							</span>
                        @enderror
						<div class="form-input">
							<span class="fa fa-key" aria-hidden="true"></span> <input type="password" style ="position: relative;" id="password" name="password" placeholder="Password" class="@error('password') is-invalid @enderror" name="password" value="{{old('password')}}"
                            required autocomplete="current-password" />
							<div class="showpassword hidemobilesidebar">
								<span class="remove btn-6d"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
							</div>
						</div>
						
						@error('password')
							<span class="invalid-feedback" style="color: red;" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
						<div class="login-remember d-grid">
							<label class="check-remaind">
								<input type="checkbox" name="remember" checked>
								<span class="checkmark" ></span>
								<p class="remember">Remember me</p>
							</label>
							<button class="btn theme-button">Login</button>
						</div>
						<div class="new-signup">
							<a href="/mobile-forgot-password" class="signuplink">Forgot password?</a>
						</div>
					</form>
					{{-- <div class="social-icons">
						<p class="continue"><span>Or</span></p>
						<div class="social-login">
							<a href="#facebook">
								<div class="facebook">
									<span class="fa fa-facebook" aria-hidden="true"></span>

								</div>
							</a>
							<a href="#google">
								<div class="google">
									<span class="fa fa-google-plus" aria-hidden="true"></span>
								</div>
							</a>
						</div>
					</div> --}}
					<p class="signup">Do you need a workstation? <br> <a href="{{ route('register') }}" class="signuplink">Apply for a virtual co-space</a></p>
				</div>

				<!-- copyright -->
				<div class="copy-right">
					<p>© {{date('Y')}} All rights reserved | Design by <a href="http://a2sys.co/"
							target="_blank">#a2sys</a></p>
				</div>
				<!-- //copyright -->
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(document).ready(function(){
	
			$('.showpassword').click(function(){
					var $this = $('.remove');
					$this.toggleClass('btn-6d');
					if ($this.hasClass('btn-6d')) {
						$('input#password').prop('type','text');
						$(this).find('.remove').empty();
						$(this).find('.remove').append('<i class="fa fa-eye"></i>');
					} else {
						$('input#password').prop('type','password');
						$(this).find('.remove').empty();
						$(this).find('.remove').append('<i class="fa fa-eye-slash"></i>');
					}
			});

		});
	</script>
</body>

</html>