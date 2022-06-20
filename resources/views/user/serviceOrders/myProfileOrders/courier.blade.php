@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
<section class="content">

<div class="row">
  <div class="col-sm-12">

    @include('alerts.alerts')

    <div class="card card-widget">
      <div class="card-header">
        <h3 class="card-title">
          All Available Courier
        </h3>
      </div>
     <div class="card-body ">

      <div class="card card-widget">
        <div class="card-body" style="background-color: #ccc;">
                
                  <div class="row">
                      @foreach($data as $data)
                          <div class="col-sm-6">
                              <div class="card card-default" style="margin-bottom: 5px;">
                                      <div class="card-body">
                  
                                             
                  
                                          <div class="media border ">
                                              <div class="w3-display-container">
                                          <img src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $data->vc()]) }}" alt="John Doe" class="mr-1   rounded" style="width:100px;">
                                          
                                          
                                          
                                          </div>
                                          <div class="media-body"   style=" word-wrap: break-word;word-break: break-all;">
                                              <p>
                                                  Name: {{$data->name}} <br>
                                                  Description: {{$data->comment}} <br><br>
                              
                                                  <a href="{{$data->link}}" target="_blank"><button class="btn btn-primary btn-sm">Link</button></a>
                                              </p>
                                          </div>
                                          </div>
                                          
                                        
                
                                    
                                        
                                    </div>
                                </div>
                        </div>
                    @endforeach
                </div>
              
                
            
          
                
            
        </div>
      </div>

       

     </div>
   </div>




  </div>
</div>


</section>



@endsection


@push('js')


@endpush
