@extends('newsfeed.layouts.newsfeedMaster')
@section('content')
    <br>
<div class="content mt-2">


 

    <div class="row">
        <div class="col-md-8 col-offset-1">
            <!--- \\\\\\\Post-->
            {{-- {{route('newsfeed.updatePost',$post)}} --}}
            
            @if($mysubscribe)
            <form action="{{route('newsfeed.updateWorkStationPost',['workstation'=>$workstation,'post'=>$post])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Make
                                    a post</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">Files</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                              {{-- <div class="form-group">
                                <label class="sr-only" for="message">Title</label>
                                <input class="form-control" name="title"   placeholder="Title will be here">
                              </div>
                              <div class="form-group">
                                <label class="sr-only" for="message">Excerpt</label>
                                <input class="form-control" name="excerpt"  placeholder="Short Description">
                              </div> --}}
  
                              <div class="form-group">
                                <label for="">Category</label>
                                <select name="category" id="workstation" class="form-control">
                                    <option value="">Select Workstation Category</option>
                                    @foreach ($workstation->categories()->whereIn('id', Auth::user()->myWsCatIds($workstation))->get() as $ms)
                                        <option value="{{$ms->id}}">{{$ms->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @php
                                $value = $mysubscribe->count();
                            @endphp
                              <div class="form-group">
                                  <label class="sr-only" for="message">post</label>
                                  <textarea class="form-control" name="description" id="message" rows="3" {{$value == 0 ? 'readonly' : ''}}  placeholder="What are you thinking?">{{ old('description') }}</textarea>
                              </div>
  
                            </div>
                            <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" name="images[]" class="custom-file-input" id="customFile" multiple>
                                        <label class="custom-file-label" for="customFile">Upload Files</label>
                                    </div>
                                </div>
                                <div class="py-4"></div>
                            </div>
                        </div>
                        <div class="btn-toolbar justify-content-between">
                            <div class="btn-group">
                                <button type="submit"  {{$value == 0 ? 'disabled' : ''}} class="btn btn-primary">share</button>
                            </div>
                            @if ($value == 0)
                                <a href="{{route('user.dashboard')}}"><span class="w3-text-red">Subscribe Now</span></a>
                            @endif
                            {{-- <div class="btn-group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-globe"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="#"><i class="fa fa-globe"></i> Public</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-users"></i> Friends</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Just me</a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
              </form>
            @endif
            
            <!-- Post /////-->

            <!--- \\\\\\\Post-->
 
            @foreach ($allPosts->shuffle() as $post)
              @include('newsfeed.includes.post')
            @endforeach

            {{ $allPosts->render() }}
 
            
            <!-- Post /////-->

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