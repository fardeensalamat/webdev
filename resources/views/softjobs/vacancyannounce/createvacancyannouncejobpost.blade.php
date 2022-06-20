@extends('softjobs.vacancyannounce.layouts.vacancyannounceMaster')

@section('content')

<br>
<section class="content">
    @include('alerts.alerts')
    <div class="card bg-info">
        <div class="card-body">
            <h3>Job Post Form</h3>
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
                                <h5>Primary Job Information</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Service Type</label>
                                       <select name="service_type" id="service_type" class="form-control">
                                           <option value="Basic Listing">Basic Listing</option>
                                           <option value="Stand Out Listing">Stand Out Listing</option>
                                           <option value="Stand Out Premium">Stand Out Premium</option>
                                       </select>
                                        @error('service_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="type">Job Title</label>
                                        <input  type="text" value="" class="form-control" name="job_title" placeholder="Type Company Name" required>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                               

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="type">No. of Vacancies *</label>
                                        <input  type="text" value="" class="form-control" name="no_vacancies" placeholder="Enter Vacancy Number" required>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Functional Category</label>
                                       <select name="service_type" id="service_type" class="form-control">
                                           <option value="Basic Listing">Basic Listing</option>
                                           <option value="Stand Out Listing">Stand Out Listing</option>
                                           <option value="Stand Out Premium">Stand Out Premium</option>
                                       </select>
                                        @error('service_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Special Skilled Category</label>
                                       <select name="service_type" id="service_type" class="form-control">
                                           <option value="Basic Listing">Basic Listing</option>
                                           <option value="Stand Out Listing">Stand Out Listing</option>
                                           <option value="Stand Out Premium">Stand Out Premium</option>
                                       </select>
                                        @error('service_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                               

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Employment Status *</label>
                                       <select name="service_type" id="service_type" class="form-control">
                                           <option value="Full Time">Full Time</option>
                                           <option value="Part Time">Part Time</option>
                                           <option value="Contractual">Contractual</option>
                                           <option value="Internship">Internship</option>
                                           <option value="Freelancer">Freelancer</option>
                                       </select>
                                        @error('service_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Application Deadline *</label>
                                        <input  type="date" value="" class="form-control" name="year_of_est" placeholder="Type Company Establishment Ex:2003" required>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="skill">Resume Receiving Option *</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input"  type="radio" name="is_entrepreneur" id="inlineRadio" value="option">
                                            <label class="form-check-label" for="inlineRadio">Apply Online</label>
                                          </div>
                                          {{-- <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" onchange="show1()" name="is_entrepreneur" id="inlineRadio2" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">No</label>
                                          </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">No. of Vacancies *</label>
                                        <input  type="text" value="" class="form-control" name="no_vacancies" placeholder="Enter Vacancy Number" required>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> 
                                </div>
                                
                               

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="skill">Resume Receiving Option *</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" onchange="show()" type="radio" name="resume_rcv_option" id="inlineRadio1" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">Email</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" onchange="show1()" name="resume_rcv_option" id="inlineRadio2" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">Hard Copy</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" onchange="show2()" name="resume_rcv_option" id="inlineRadio3" value="option2">
                                            <label class="form-check-label" for="inlineRadio3">Work In Interview</label>
                                          </div>
                                    </div>
                                   
                                </div>
                            </div>
                           <div class="row">
                               <div style="display: none;" id="email">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="country">Email</label>
                                            <input  type="text" value="" class="form-control" name="email" placeholder="Enter Vacancy Number" required>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div> 

                                    </div>
                                </div>
                                <div style="display: none;" id="hard_copy_info">
                              
                                    <div class="col-md-12" >
                                            <div class="form-group">
                                                <label for="country">Hard Copy</label>
                                                <textarea name="hard_copy_info" id="hard_copy_info" class="form-control" cols="40" rows="5" placeholder="Write Information For Hard Copy"></textarea>
                                                @error('hard_copy_info')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div> 

                                    </div>
                                </div>
                                <div style="display: none;" id="walk_in_interview_info">
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="country">Walk In Interview</label>
                                                <textarea name="walk_in_interview_info" id="walk_in_interview_info" class="form-control" cols="40" rows="5" placeholder="Write Information For Walk In Interview"></textarea>
                                                @error('walk_in_interview_info')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div> 

                                    </div>
                                </div>

                               <script type="text/javascript">
                                    function show(str){
                                        document.getElementById('email').style.display = 'block';
                                        document.getElementById('hard_copy_info').style.display = 'none';
                                        document.getElementById('walk_in_interview_info').style.display = 'none';
                                    }
                                    function show1(str){
                                        document.getElementById('email').style.display = 'none';
                                        document.getElementById('hard_copy_info').style.display = 'block';
                                        document.getElementById('walk_in_interview_info').style.display = 'none';
                                    }
                                    function show2(str){
                                        document.getElementById('email').style.display = 'none';
                                        document.getElementById('hard_copy_info').style.display = 'none';
                                        document.getElementById('walk_in_interview_info').style.display = 'block';
                                    }
                                </script>
                           </div>
                          
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="special_instruction">Special Instruction for Job Seekers</label>
                                        <textarea name="special_instruction" id="special_instruction" class="form-control" cols="40" rows="5" placeholder="Write Information For Walk In Interview"></textarea>
                                        @error('special_instruction')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                             

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="skill">Photograph (Enclose with resume)</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input"  type="radio" name="photograph" id="photograph1" value="option1">
                                            <label class="form-check-label" for="photograph1">Yes</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="photograph" id="photograph2" value="option2">
                                            <label class="form-check-label" for="photograph2">No</label>
                                          </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="skill">Prefer Video Resume </label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input"  type="radio" name="video_resume" id="video_resume1" value="option1">
                                            <label class="form-check-label" for="video_resume1">Yes</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="video_resume" id="video_resume2" value="option2">
                                            <label class="form-check-label" for="video_resume2">No</label>
                                          </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Job Level*</label>
                                       <select name="job_level" id="job_level" class="form-control">
                                           <option value="Entry">Entry</option>
                                           <option value="Mid">Mid</option>
                                           <option value="Top">Top</option>
                                       </select>
                                        @error('job_level')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="job_content">Job Context</label><br>
                                        <textarea name="job_content" id="job_content" class="form-control" cols="40" rows="5" placeholder="Write Job Context"></textarea>
                                        @error('job_content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="job_responsibilities">Job Responsibilities*</label><br>
                                        <textarea name="job_responsibilities" id="job_responsibilities" class="form-control" cols="40" rows="5" placeholder="Write Job Responsibilities"></textarea>
                                        @error('job_responsibilities')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                               

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="work_at_office">
                                            <label class="form-check-label" for="work_at_office">
                                                Work at office
                                            </label>
                                          </div>
                                        @error('work_at_office')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="work_at_home">
                                            <label class="form-check-label" for="work_at_home">
                                                Work from home
                                            </label>
                                          </div>
                                        @error('work_at_home')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                               

                            </div>
                           
                           
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="job_location">Job Location*</label><br>
                                        <textarea name="job_location" id="" class="form-control" cols="80" rows="5" placeholder="Write Business Description"></textarea>
                                        @error('job_location')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="type">Salary Min</label>
                                        <input  type="number" value="" class="form-control" name="salary_min" placeholder="10000" required>
                                        @error('salary_min')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="type">Salary Max</label>
                                        <input  type="number" value="" class="form-control" name="salary_max" placeholder="15000" required>
                                        @error('salary_max')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                               

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="skill">What do you want to show for salary in Job Detail? *</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input"  type="radio" name="salary_job_detail" id="inlineRadio4" value="option1">
                                            <label class="form-check-label" for="inlineRadio4">Show salary</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"  name="salary_job_detail" id="inlineRadio5" value="option2">
                                            <label class="form-check-label" for="inlineRadio5">Show nothing</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="salary_job_detail" id="inlineRadio6" value="option2">
                                            <label class="form-check-label" for="inlineRadio6">Show 'Negotiable' instead of given salary range</label>
                                          </div>
                                    </div>
                                   
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="additional_salary_info">Additional Salary Info.</label><br>
                                        <textarea name="additional_salary_info" id="" class="form-control" cols="80" rows="5" placeholder="Write Additional Salary Information"></textarea>
                                        @error('additional_salary_info')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="skill">Compensation & other benefits</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" onchange="na()" type="radio" name="others_benefits" id="inlineRadio1" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">NA</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" onchange="selectoption()" name="others_benefits" id="inlineRadio2" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">Select Option</label>
                                        </div>
                                    </div>
                                  
                                    <script type="text/javascript">
                                            function na(str){
                                                document.getElementById('na').style.display = 'block';
                                                document.getElementById('selectoption').style.display = 'none';
                                            }
                                            function selectoption(str){
                                                document.getElementById('na').style.display = 'none';
                                                document.getElementById('selectoption').style.display = 'block';
                                            }
                                    </script>

                                </div>
                            </div>
                            <div id="na" style="display: none;">
                                       

                            </div>
                            <div id="selectoption" style="display: none;">
                               <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input"  type="checkbox" name="ta" id="ta" value="ta">
                                            <label class="form-check-label" for="ta">T/A</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="mobile_bill" id="mobile_bill" value="option2">
                                            <label class="form-check-label" for="mobile_bill">Mobile Bill</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="pension_policy" id="pension_policy" value="option2">
                                            <label class="form-check-label" for="pension_policy">Pension Policy</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="tour_allowance" id="tour_allowance" value="option2">
                                            <label class="form-check-label" for="tour_allowance">Tour Allowance</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="credit_card" id="credit_card" value="option2">
                                            <label class="form-check-label" for="credit_card">Credit Card</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="medical_allowance" id="medical_allowance" value="option2">
                                            <label class="form-check-label" for="medical_allowance">Medical Allowance</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="performance_bonus" id="performance_bonus" value="option2">
                                            <label class="form-check-label" for="performance_bonus">Performance Bonus</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="profit_share" id="profit_share" value="option2">
                                            <label class="form-check-label" for="profit_share">Profit Share</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="provident_fund" id="provident_fund" value="option2">
                                            <label class="form-check-label" for="provident_fund">Provident Fund</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="weekly_2_holidays" id="weekly_2_holidays" value="option2">
                                            <label class="form-check-label" for="weekly_2_holidays">Weekly 2 Holidays</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="insurance" id="insurance" value="option2">
                                            <label class="form-check-label" for="insurance">Insurance</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="gratuity" id="gratuity" value="option2">
                                            <label class="form-check-label" for="gratuity">Gratuity</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="over_time_allowance" id="over_time_allowance" value="option2">
                                            <label class="form-check-label" for="over_time_allowance">Over Time Allowance</label>
                                        </div>
                                    </div>
                               </div>
                               <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="skill">Lunch Facilities</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="lunch_facilities" id="inlineRadio1" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">Partially Subsidize</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="lunch_facilities" id="inlineRadio2" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">Fully Subsidize</label>
                                        </div>
                                    </div>
                            
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="skill">Salary Review</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="salary_review" id="inlineRadio1" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">Half Yearly</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="salary_review" id="inlineRadio2" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">Yearly</label>
                                        </div>
                                        
                                    </div>
                            
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-group">
                                            <label for="">Festival Bonus*</label>
                                        <select name="festival_bonus" id="festival_bonus" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                            @error('festival_bonus')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <div class="form-group">
                                            <label for="other">Other</label>
                                            <textarea name="other" id="" class="form-control" cols="80" rows="5" placeholder="Write Additional Salary Information"></textarea>
                                        
                                        </div>
                                    </div>
                                </div>

                            </div>
                                       

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="additional_salary_info">Educational Qualification</label><br>
                                        <textarea name="educational_qualification)" id="" class="form-control" cols="80" rows="5" placeholder="Write Educational Qualification"></textarea>
                                        @error('educational_qualification')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="additional_salary_info">Preferred Educational Institution</label><br>
                                        <input  type="text" value="" class="form-control" name="preferred_educational_institution" placeholder="Write Preferred Educational Institution">
                                        @error('preferred_educational_institution')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="traning_course">Training/ Trade Course</label>
                                        <input  type="text" value="" class="form-control" name="traning_course" placeholder="Write Training/ Trade Course" required>
                                        @error('traning_course')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="professional_certification">Professional Certification*</label>
                                        <input  type="text" value="" class="form-control" name="professional_certification" placeholder="Write Professional Certification" required>
                                        @error('professional_certification')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <h5>Experience and Business Area</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="skill">Experience</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" onchange="no_experience()" type="radio" name="others_benefits" id="inlineRadio1" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">No Experience Required</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" onchange="experience()" name="others_benefits" id="inlineRadio2" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">Experience Required</label>
                                        </div>
                                    </div>
                                  
                                    <script type="text/javascript">
                                            function no_experience(str){
                                                document.getElementById('no_experience').style.display = 'block';
                                                document.getElementById('experience').style.display = 'none';
                                            }
                                            function experience(str){
                                                document.getElementById('no_experience').style.display = 'none';
                                                document.getElementById('experience').style.display = 'block';
                                            }
                                    </script>

                                </div>
                            </div>
                            <div id="no_experience" style="display: none;">
                                       

                            </div>
                            <div id="experience" style="display: none;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="minimum_year_of_experience">Minimum Year Of Experience</label>
                                            <input  type="number" value="" class="form-control" name="minimum_year_of_experience" placeholder="Minimum Year Of Experience" required>
                                            @error('minimum_year_of_experience')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="maximum_year_of_experience">Maximum Year Of Experience</label>
                                            <input  type="number" value="" class="form-control" name="maximum_year_of_experience" placeholder="Maximum Year Of Experience" required>
                                            @error('maximum_year_of_experience')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
    
                                </div>
                               <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="is_agree" name="is_agree">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Freshers are also encouraged to apply 
                                                </label>
                                            </div>
                                        </div>
                                       
                                    </div>
                               </div>
                               <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label for="area_of_experience">Area Of Experience</label>
                                            <input  type="text" value="" class="form-control" name="area_of_experience" placeholder="Area Of Experiencee" required>
                                            @error('area_of_experience')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="area_of_business">Area of Business</label>
                                            <input  type="text" value="" class="form-control" name="area_of_business" placeholder="Area of Business" required>
                                            @error('area_of_business')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                   

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="skill">Skill</label><br>
                                        <input  type="text" value="" class="form-control" name="skill" placeholder="Write Skill">
                                        @error('skill')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="skill">Additional Requirements</label><br>
                                        <textarea name="additional_requirement" id="" class="form-control" cols="80" rows="5" placeholder="Write Additional Requirements"></textarea>
                                        @error('skill')
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