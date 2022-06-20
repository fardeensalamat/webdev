@extends('user.layouts.userMaster')

@section('content')

<br>
<section class="content">
    @include('alerts.alerts')
    <div class="card bg-info">
        <div class="card-body">
            <h3>Employer Registration Form</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 m-auto">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('vacancyannounce.jobannouncerprimaryinfostore') }}" method="POST" id='my-form'>
                            @csrf
                            <div class="row">
                                <h5>Account Information</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="type">User Name</label>
                                        <input  type="text" value="" class="form-control" name="user_name" placeholder="Ex: Oli Ullah" required>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                               

                            </div>
                            <div class="row">
                                <h5>Company Details Information</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Company Name</label>
                                        <input  type="text" value="" class="form-control" name="company_name" placeholder="Type Company Name" required>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">কোম্পানির নাম (বাংলায়)</label>
                                        <input  type="text" value="" class="form-control" name="company_bnname" placeholder="কোম্পানির নাম বাংলায় লিখুন" required>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                               

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="skill">Are you new Entrepreneur?</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" onchange="show()" type="radio" name="is_entrepreneur" id="inlineRadio1" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" onchange="show1()" name="is_entrepreneur" id="inlineRadio2" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">No</label>
                                          </div>
                                    </div>
                                    <div id="yes" style="display: none;">
                                        <p>If your company age is maximum 1 year, total employee size is 6 and your business falls into any of the categories like Restaurant, Showroom, Pharmacy, Saloon, Agro Farm, Workshop then enjoy our Uddokta Scheme for the next one year. (*Condition applied)</p>

                                    </div>
                                    <div id="no" style="display: none;">
                                       

                                    </div>
                                    <script type="text/javascript">
                                            function show(str){
                                                document.getElementById('yes').style.display = 'block';
                                                document.getElementById('no').style.display = 'none';
                                            }
                                            function show1(str){
                                                document.getElementById('yes').style.display = 'none';
                                                document.getElementById('no').style.display = 'block';
                                            }
                                    </script>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Year of Establishment *</label>
                                        <input  type="text" value="" class="form-control" name="year_of_est" placeholder="Type Company Establishment Ex:2003" required>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_size">Company Size *</label>
                                       <select name="company_size" id="company_size" class="form-control">
                                           <option value="Male">Select Company Size</option>
                                           <option value="1-15">1-15 Employees</option>
                                           <option value="16-30">16-30 Employees</option>
                                           <option value="31-50">31-50 Employees</option>
                                           <option value="51-120">51-120 Employees</option>
                                           <option value="121-300">121-300 Employees</option>

                                          
                                          
                                       </select>
                                        @error('company_size')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                               

                            </div>
                            <div class="row">
                                <h5>Company Address*</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country">Country *</label>
                                       <select name="country" id="country" class="form-control">
                                           <option >Select Country</option>
                                           <option value="Bangladesh">Bangladesh</option>
                                       </select>
                                        @error('country')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="distric">Distric *</label>
                                       <select name="distric" id="distric" class="form-control">
                                           <option >Select Distric</option>
                                           <option value="Bangladesh">Dhaka</option>
                                       </select>
                                        @error('distric')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="thana">Thana *</label>
                                       <select name="thana" id="thana" class="form-control">
                                           <option >Select Thana</option>
                                           <option value="Bangladesh">Dhaka</option>
                                       </select>
                                        @error('thana')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                               

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Write Company Address *</label><br>
                                        <textarea name="address" id="address" class="form-control" cols="40" rows="5" placeholder="Write Company Address"></textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bn_address">কোম্পানির ঠিকানা</label><br>
                                        <textarea name="bn_address" id="bn_address" class="form-control" cols="40" rows="5" placeholder="কোম্পানির ঠিকানা "></textarea>
                                        @error('bn_address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                               

                            </div>
                            <div class="row">
                                <h5>Industry Type*</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="industry_type">Industry Category *</label>
                                       <select name="industry_type" id="industry_type" class="form-control">
                                           <option >Select Category</option>
                                           <option value="Bangladesh">Bangladesh</option>
                                       </select>
                                        @error('industry_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="industry_category">Industry Sub-Category *</label>
                                       <select name="industry_category" id="industry_category" class="form-control">
                                           <option >Select Sub-Category</option>
                                           <option value="Bangladesh">Dhaka</option>
                                       </select>
                                        @error('industry_category')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                              
                               

                            </div>
                            <div class="row">
                                <h5>Business Description</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="business_description" id="" class="form-control" cols="80" rows="5" placeholder="Write Business Description"></textarea>
                                        @error('business_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                              
                               

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Business/ Trade License No</label>
                                        <input  type="text" value="" class="form-control" name="license_no" placeholder="Type Business/ Trade License No" required>
                                        @error('license_no')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">RL No (Only for Recruiting Agency)</label>
                                        <input  type="Number" value="" class="form-control" name="rl_no" placeholder="Type RL No (Only for Recruiting Agency)" required>
                                        @error('rl_no')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                               

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Website Url</label>
                                        <input  type="text" value="" class="form-control" name="web_url" placeholder="Write Website Url" required>
                                        @error('web_url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                               
                            </div>
                            <div class="row">
                                <h5>Contact</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_user">Contact Person's Name*</label>
                                        <input  type="text" value="" class="form-control" name="contact_person_name" placeholder="Contact Person's Name*" required>
                                        @error('contact_person_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_person_designation">Contact Person's Designation*</label>
                                        <input  type="text" value="" class="form-control" name="contact_person_designation" placeholder="Contact Person's Designation*" required>
                                        @error('contact_person_designation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_person_email">Contact Person's Email*</label>
                                        <input  type="text" value="" class="form-control" name="contact_person_email" placeholder="Contact Person's Email*" required>
                                        @error('contact_person_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_person_mobile">Contact Person's Mobile</label>
                                        <input  type="text" value="" class="form-control" name="contact_person_mobile" placeholder="Contact Person's Mobile" required>
                                        @error('contact_person_mobile')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                           
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="is_agree" name="is_agree">
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