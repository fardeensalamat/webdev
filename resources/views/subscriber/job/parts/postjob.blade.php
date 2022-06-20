<section class="content">
    <br>
    <div class="row">
        <div class="col-sm-12">
            @include('alerts.alerts')
            <div class="card card-primary">
                <div class="card-header">
                    Post A Job
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">

                                <div class="card">
                                    <div class="card-header">{{ __('Create New Job') }} ({{ $subscription->work_station_id }})</div>
                                    
                                    
                                    <div class="card-body">
                                        @if ($websiteParameter->job_post_instraction)
                                    <div class="card card-default collapsed-card ">
                                        <div class="card-header">
                                          <h3 class="card-title">Job Post Guideline</h3>
                          
                                          <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus w3-text-blue"></i>
                                            </button>
                                          </div>
                                          <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div id="video" class="card-body w-100" style="display: none;">
                                            {!! $websiteParameter->job_post_instraction !!}
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    @endif
                                        <form method="post" action="{{route('subscriber.subscriptionNewPostJob',[ 'subscription'=> $subscription->id,'worksation' => $subscription->work_station_id])}}" enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group row">
                                                
                                                <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Job category') }}</label>
                    
                                                <div class="col-md-6">
                                                    
                                                    <select name="category" class="form-control" id="category" onchange="yesnoCheck(this);">
                                                        <option value="">Select Category</option>

                                                        @foreach ($categories as $category)
                                                            <option value="{{$category->id}}">{{$category->title}}</option>
                                                        @endforeach
                                                    </select>
                    
                                                    @error('category')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <script>
                                                 function yesnoCheck(that) {
                                                if (that.value == "20") {
                                                            //alert("check");
                                                        document.getElementById("ifYes").style.display = "block";
                                                    } else {
                                                        document.getElementById("ifYes").style.display = "none";
                                                    }
                                            }

                                            </script>
                                         
                                           

                                            <div class="form-group row">
                                                <label for="subcategory" class="col-md-4 col-form-label text-md-right">{{ __('Job subcategory') }}</label>
                    
                                                <div class="col-md-6">
                                                    
                                                    <select name="subcategory" class="form-control" id="subcategory">
                                                        <option value="" id="p">Select Subcategory</option>

                                                        
                                                    </select>
                    
                                                    @error('subcategory')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-6">
                                                    {{-- <input id="instraction" type="text" class="form-control @error('instraction') is-invalid @enderror" name="instraction" readonly> --}}
                                                    <p class="w3-border edit p-2 w3-round" id="instraction" style="display : none; white-space: pre-line;"></p>
                                                </div>
                                            </div>
                    
                    
                                            {{-- <div class="form-group row">
                                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Job Title') }}</label>
                    
                                                <div class="col-md-6">
                                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Title(exmp: Hello)"  required autocomplete="title" autofocus>
                    
                                                    @error('title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div> --}}
                    
                                            
                                            <div class="form-group row">
                                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                    
                                                <div class="col-md-6">
                                                    <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description"  required autocomplete="description" placeholder="Description(exmp: Video editing job)" ></textarea>
                    
                                                    @error('description')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="Link" class="col-md-4 col-form-label text-md-right">{{ __('Link (if available)') }}</label>
                    
                                                <div class="col-md-6">
                                                    <input id="link" type="text" class="form-control @error('Link') is-invalid @enderror" name="link" placeholder="Link(exmp: https://www.youtube.com/)"  autocomplete="Link" autofocus>
                    
                                                    @error('Link')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="img" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                    
                                                <div class="col-md-6">
                                                    <input id="image" type="file" required class="form-control @error('image') is-invalid @enderror" name="image"  autocomplete="image" >
                    
                                                    @error('image')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="form-group row">
                                                <label for="total_worker" class="col-md-4 col-form-label text-md-right">Total Worker's Need</label>
                    
                                                <div class="col-md-6">
                                                    <input id="total_worker" type="number"  class="form-control @error('total_worker') is-invalid @enderror" name="total_worker" placeholder="Minimum One worker required" required autocomplete="total_worker" autofocus>
                    
                                                    @error('total_worker')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>


                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="total_worker" class="col-md-4 col-form-label text-md-right">Cost Per Worker</label>
                    
                                                <div class="col-md-6">
                                                    <input id="cost_per_worker" type="text" class="form-control @error('cost_per_worker') is-invalid @enderror" name="cost_per_worker" placeholder="Cost Per Worker" readonly autocomplete="cost_per_worker" autofocus>
                    
                                                    @error('cost_per_worker')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                
                                            </div>

                                            <div class="form-group row">
                                                <label for="total_worker" class="col-md-4 col-form-label text-md-right">Duration To Complete</label>
                    
                                                <div class="col-md-6">
                                                    <input  id="estimate_day" type="date" class="form-control @error('estimate_day') is-invalid @enderror" name="estimate_day" placeholder="Minimum One worker required" required autocomplete="estimate_day" autofocus>
                    
                                                    @error('estimate_day')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="total_worker" class="col-md-4 col-form-label text-md-right">Estimated Cost</label>
                    
                                                <div class="col-md-6">
                                                    <input id="total_cost" type="text" class="form-control @error('estimate_cost') is-invalid @enderror" name="estimate_cost"  autocomplete="estimate_cost" autofocus readonly value="BDT 10">
                    
                                                    @error('estimate_cost')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div id="ifYes" style="display: none;">
                                               
                                          
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                    </div>
                                                    <style>
                                                        #flexRadioDefault2{
                                                        border:2px solid white;
                                                        box-shadow:0 0 0 1px #932;
                                                        appearance:none;
                                                        border-radius:50%;
                                                        width:14px;
                                                        height:14px;
                                                        background-color:#fff;
                                                        transition:all ease-in 0.2s;

                                                        }
                                                        #flexRadioDefault2:checked{
                                                        background-color:#932;
                                                        }
                                                </style>
                                                    <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id='flexRadioDefault2' type="checkbox" name="ad_balance" value="ad_balance"> 
                                                        <label class="form-check-label">Pay With Ad Topup Balance.</label>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary submit-job">
                                                        {{ __('Update') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>




