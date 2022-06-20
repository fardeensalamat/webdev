@extends('user.layouts.userMaster')

@section('content')

<br>
<section class="content">
    @include('alerts.alerts')
    <div class="card bg-info">
        <div class="card-body">
            <h3>Add Profile Informations</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 m-auto">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('dropcv.storejobseekerprimaryinfo') }}" method="POST" id='my-form'>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Name</label>
                                        <input  type="text" value="" class="form-control" name="name" placeholder="Ex: Oli Ullah" required>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                       <select name="gender" id="gender" class="form-control">
                                           <option value="Male">Male</option>
                                           <option value="Female">Female</option>
                                           <option value="Others">Others</option>
                                          
                                       </select>
                                        @error('gender')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                               

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="skill">Select your skill from following list</label>
                                       <select name="skill" id="skill" class="form-control">
                                           <option value="1">Engineers</option>
                                          
                                       </select>
                                        @error('skill')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input  type="text" value="" class="form-control" name="email" placeholder="Email Address" required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number</label>
                                        <input  type="text" value="" class="form-control" name="mobile" placeholder="Your Phone Number" required>
                                        @error('mobile')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                               

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_user">Select User ID</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_user" value='0'  id="is_user1">
                                            <label class="form-check-label" for="is_user1">
                                             <i class="fas fa-envelope-open"></i>  <b>Email</b>  
                                            </label>
                                          </div>
                                          <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_user" value='1' id="is_user2" >
                                            <label class="form-check-label" for="is_user2">
                                             <i class="fas fa-mobile-alt"></i> <b>Mobile</b> 
                                            </label>
                                          </div>
                                        @error('is_user')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <script>
                                function myFunction() {
                                  var checkBox = document.getElementById("is_user1");
                                  var text = document.getElementById("text");
                                  if (checkBox.checked == true){
                                    text.style.display = "block";
                                  } else {
                                     text.style.display = "none";
                                  }
                                }
                                </script>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="agree" name="agree">
                                            <label class="form-check-label" for="defaultCheck1">
                                                I agree to the sc-bd.com Terms of use. <a href="">Terms & Conditions</a> 
                                            </label>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                  
                                    <div class="form-group">
                                        <input class="btn btn-info" type="submit" value="Create Account">
                                    </div>
                                </div>

                            </div>
                            
                           

            
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>

      
    </div>
</section>

@endsection