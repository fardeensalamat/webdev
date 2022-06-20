@extends('newsfeed.layouts.newsfeedMaster')
@section('content')

<br>

<div class="content mt-2">
    <div class="row">
        <div class="col-md-8 col-offset-1">
    
 

 
      
              @include('newsfeed.includes.post')
 

 
            
 

        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
                                    
            <p class="card-text">For advertisement please contact with us.</p>
              
          </div>
          </div>
        </div>
    </div>
</div>
@endsection

@push('js')
 
@endpush