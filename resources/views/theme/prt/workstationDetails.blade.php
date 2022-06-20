@extends('theme.prt.layouts.prtMaster')

@section('title')
<title>Explore your future with us</title>
@endsection
@section('meta')
@endsection

@push('css')

@endpush

@section('contents')

<div role="main" class="main">
    <div>
    </div>
    <style>
        .course-caption {
            margin-top: -100px;    
        }  
    
        @media  only screen and (max-width: 600px) {
            .course-caption {
                margin-top: -20px;  
            
            }
            .text-6{
                font-size: 18px !important;
            }
      
        }
    
    </style>
    
    
    
    <div class="content">
        <img class="img-fluid" src="{{asset('img/workstationcover.png')}}" alt="Subject">
    </div>
    
     <div class="container appear-animation animated fadeInLeftShorter appear-animation-visible" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="300" style="animation-delay: 300ms;">
         <div class="course-caption">
            <div class="row">
                <div class="col-sm-12">
                    <div class="w3-card rounded">
                        
                    <div class="card card-default">
                        <div class="card-body">
                              <div class="row">
                                  <div class="col-sm-7">
    
                                    <img src="{{route('imagecache', [ 'template'=>'cplg','filename' => $workstation->imageName() ])}}" class="img-fluid rounded w-100" alt="img">
    
                                    <h1 class="  font-weight-bold text-6">{{$workstation->title}}</h1>
    
                              <p>{{$workstation->description}}</p>
    
    
                                      
                                  </div>
                                  <div class="col-sm-5">
    
    
                                 
                    <div class="w3-border w3-container w3-border-light-gray rounded">
        
        
                        {{-- <h3 class="text-primary">Key Points of {{ucfirst($workstation->title)}}</h3>  --}}
        
        
                         {{-- <p class=""> 
                            <b>Work Station Category: </b> <span class="badge badge-primary"></span> <br>
                            <b>Subject Area:</b> new subject <br>
                            <b>Duration:</b>  months
                            <br> 
                            <b>Mode:</b>  <br>
                            <b>Credit:</b> 1.00
                        
                        </p>                      --}}
        
                    
                        <div class="text-center mb-3">
                            @if(!Auth::check())
                                
                            <a class="btn btn-lg w3-deep-orange btn-block w3-hover-shadow"   data-target="#modal_register"  data-toggle="modal"  href="#">Apply for a virtual co-space</a>
                            @endif
                        </div>
        
                                
                    </div>
    
     
    
                                  </div>
                              </div>
    
                              
                        </div>
                    </div>
                    </div>
                </div>
            </div>
         </div>
     </div>
    
      <div class="divider mb-0">
                    <i class="fas fa-chevron-down"></i>
                  </div>
    
     <section class=" w3-container  with-button-arrow call-to-action-in-footer w3-light-gray py-4">
    
    
                        <div class="container text-center">
    
                          <div class="row">
                            <div class="col-sm-3">
    
                              <div>
                                
                               <p class="">
                                <b>
                             Course Code
    
                               </b> <br>
                            <span class="badge badge-primary"></span></p>
                              </div>
    
                              
                              
                            </div>
                            <div class="col-sm-3">
    
    
                              <div>
                                
                               <p class="">
                                <b>
                             Course Assesments
    
                               </b> <br>
                           </p>
                              </div>
                              
                            </div>
                            <div class="col-sm-3">
    
    
                              <div>
                                
                               <p class="">
                                <b>
                             Accreditation
    
                               </b> <br>
                           </p>
                              </div>
    
    
                              
                            </div>
                            <div class="col-sm-3">
    
    
                              <div>
                                
                               <p class="">
                                <b>
                             Duration
    
                               </b> <br>
                             months
                   </p>
                              </div>
                              
                            </div>
                          </div>
    
    
                             
                        </div>
                    </section>
    
    
    <br> <br> <br>
     
    <div class="container ">    
        <div class="row ">
            <div class="col-md-12 mb-4">
                <div class="row">
                    @foreach ($workstation->categories as $category)
                        <div class="col-md-3 mb-2">
                            <div class="w3-card">
                                <div class="card ">
                                    <div class="card-title m-0">
                                        <p class="text-center m-0"><b>{{$category->name}}</b></p>
                                    </div>
                                </div>                            
                            </div> 
                            @foreach ($category->subcategories as $subcategory)
                            <div class="w3-card ml-3 mt-3 mb-2">
                                <div class="card">
                                    <div class="card-title m-0">
                                        <p class="text-center m-0">{{$subcategory->title}}</p>
                                    </div>
                                </div>
                                
                            </div>
                            @endforeach
                                               
                        </div>
                    @endforeach
                    
                    

                    {{-- test --}}
                    {{-- <div class="col-md-3">
                        <div class="w3-card">
                            <div class="card ">
                                <div class="card-title m-0">
                                    <p class="text-center m-0">Category</p>
                                </div>
                            </div>                            
                        </div> 
                        <div class="w3-card ml-3 mt-3">
                            <div class="card">
                                <div class="card-title m-0">
                                    <p class="text-center m-0">Subcategory</p>
                                </div>
                            </div>
                            
                        </div>  
                        <div class="w3-card mt-3 ml-3 mb-3">
                            <div class="card">
                                <div class="card-title m-0">
                                    <p class="text-center m-0">Subcategory</p>
                                </div>
                            </div>
                        </div>                   
                    </div>
                    <div class="col-md-3">
                        <div class="w3-card">
                            <div class="card ">
                                <div class="card-title m-0">
                                    <p class="text-center m-0">Category</p>
                                </div>
                            </div>                            
                        </div> 
                        <div class="w3-card ml-3 mt-3">
                            <div class="card">
                                <div class="card-title m-0">
                                    <p class="text-center m-0">Subcategory</p>
                                </div>
                            </div>
                            
                        </div>  
                        <div class="w3-card mt-3 ml-3 mb-3">
                            <div class="card">
                                <div class="card-title m-0">
                                    <p class="text-center m-0">Subcategory</p>
                                </div>
                            </div>
                        </div>                   
                    </div>
                    <div class="col-md-3">
                        <div class="w3-card">
                            <div class="card ">
                                <div class="card-title m-0">
                                    <p class="text-center m-0">Category</p>
                                </div>
                            </div>                            
                        </div> 
                        <div class="w3-card ml-3 mt-3">
                            <div class="card">
                                <div class="card-title m-0">
                                    <p class="text-center m-0">Subcategory</p>
                                </div>
                            </div>
                            
                        </div>  
                        <div class="w3-card mt-3 ml-3 mb-3">
                            <div class="card">
                                <div class="card-title m-0">
                                    <p class="text-center m-0">Subcategory</p>
                                </div>
                            </div>
                        </div>                   
                    </div> --}}
                    {{-- ./test --}}
                </div>
            </div>
        </div>
    
    </div>
    
    
    
    <div class="w3-gray w3-container py-3" id="coursepackagearea">
      <div class="container">
        <h3 class="w3-text-white text-center">Packages Containing This </h3>
    
        <br>
    
    
     
    
           
                    <div class="toggle toggle-primary m-0 w3-card" data-plugin-toggle="">
    
                                 
                  </div>
        
    
     
    
     
      </div>
    </div>
    
    
    
    
</div>
@endsection