@extends('user.layouts.userMaster')

@section('content')
    <br>
    <section class="content">
        @include('alerts.alerts')
        <div class="card bg-info">
            <div class="card-body">
                <h3>{{__('employeeReport.add_report')}}</h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('user.storeemployeereport') }}" method="POST" id='my-form' enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">{{__('employeeReport.type')}}</label>
                            
                                              <select id="inputState" class="form-control" name="type">
                                                     <option>Official</option>
                                                     <option>Marketing</option>                            
                                              </select>
                                         
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Date</label>
                                            <input  type="date" class="form-control" name="date">
                                        
                                        </div>
                                    </div>
                              
                                </div>
                      
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">{{__('employeeReport.note')}}</label><br>
                                            <textarea name="note" type="text" class="form-control" id="" cols="45" rows="3"></textarea>
                                            
                                         
                                        </div>
                                       

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">{{__('employeeReport.specialnote')}}</label><br>
                                            <textarea name="special_note" type="text" class="form-control" id="" cols="45" rows="3"></textarea>
                                        
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">(1200*420px)</label>
                                            <input type="file" name="image" id="image" class="form-control">
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="location">Location</label>
                                            <input type="text" name="location" id="location" class="form-control">
                                        </div>
                                        
                                    </div>
                                </div>


                               
                              
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-info" type="button" value="Save">Save</button>
                                        </div>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <button class="test" onclick="getLocation()">Try It</button>

            <p id="demo"></p> --}}
            <script>
               $(document).ready(function(){
                   $('body').on('click','.test',function(){
                    getLocation()
                    const x = document.getElementById("demo");
                    function getLocation() {
                   
                      if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showPosition);
                      } else { 
                        x.innerHTML = "Geolocation is not supported by this browser.";
                      }
                    }
                    function showPosition(position) {
                        x.innerHTML = "Latitude: " + position.coords.latitude + 
                        "<br>Longitude: " + position.coords.longitude;
                        }
                   })
           
                
               
                
               
                   

               })

               
                
                </script>
          
        </div>
    </section>
@endsection
@push('js')



@endpush
