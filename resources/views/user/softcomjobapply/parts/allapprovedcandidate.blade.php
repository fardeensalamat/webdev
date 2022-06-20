  <!-- Main content -->
    <section class="content">

        <div class="row">
          <div class="col-sm-12">
  
            @include('alerts.alerts')

            <div class="card card-widget">
              <div class="card-header">
                <h3 class="card-title">
                  All Applicant
                </h3>
              </div>
             <div class="card-body ">
  
              <div class="card card-widget">
                <div class="card-body" style="background-color: #ccc;">
                        @if($datas->count())
                        @foreach($datas->chunk(2) as $datas2)
                          <div class="row">
                              @foreach($datas2 as $data)
                                  <div class="col-sm-6">
                                      <div class="card card-default" style="margin-bottom: 5px;">
                                              <div class="card-body">
                          
                          
                          
                                                  <div class="media border ">
                                                      <div class="w3-display-container">
                                                  <img src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $data->pi()]) }}" alt="John Doe" class="mr-1   rounded" style="width:100px;">
                                                  
                                                  
                                                  
                                                  </div>
                                                  <div class="media-body"   style=" word-wrap: break-word;word-break: break-all;">
                                                      <p>
                                                          Name: {{$data->name}} <br>
                                                          NID: {{$data->nid}} <br>
                                                          Category: {{$data->applicantcategory->name}} <br>
                                                          Description:<small> {{$data->description}}  </small> <br>
                                      
                                                          <a href="{{route('user.AssignApplicantforServiceprofile',$data->id)}}"><button class="btn btn-primary btn-sm">Assign</button></a>
                                                      </p>
                                                  </div>
                                                  </div>
                                                  
                                                
                        
                                            
                                                
                                            </div>
                                        </div>
                                </div>
                            @endforeach
                        </div>
                        @endforeach
                        
                        <div class="pull-right">
                            {{$datas->render()}}
                        </div>
                        
                        @endif 
                        
                    
                </div>
              </div>
  
               
  
             </div>
           </div>
  
  
  
  
          </div>
        </div>
        
  
      </section>
      <!-- /.content -->
  
  