@extends('user.layouts.userMaster')

@push('css')

    <link rel="stylesheet" href="{{ asset('cp/plugins/summernote/summernote-bs4.css') }}">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}

@endpush
@section('content')
    <br>

    <section class="content">
        @include('alerts.alerts')
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        Candidate Apply Form
                     </h3>
                     <div class="card-tools">
                         <a class="btn btn-default text-dark btn-sm" href="{{route('user.SoftcomJobApplyList')}}" >
                             <i class="fa fa-plus"></i>Application List</a>
                     </div>
                 
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('user.SoftcomJobApplyStore') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group my-2">
                                <label for="name">Candidate Name</label>
                                <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control" placeholder="Ex: Oli ullah">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-2">
                                <label for="mobile">Candidate Mobile</label>
                                <input type="text" name="mobile" id="mobile" class="form-control"  value="{{$user->mobile}}" placeholder="Ex:017xxxxxxxxx">
                            </div>
        
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group my-2">
                                <label for="nid">Candidate NID</label>
                                <input type="text" name="nid" id="nid" class="form-control" placeholder="12265645365">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-2">
                                <label for="nid">Category</label>
                                <select name="category" id="category" class="form-control">
                                    <option>Select One</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>                                  
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group my-2">
                                <label for="nid_image">NID Image</label>
                                <input type="file" name="nid_image" id="nid_image" class="form-control">
                              
                            </div>
        

                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-2">
                                <label for="candidate_image">Candidate Image</label>
                                <input type="file" name="candidate_image" id="candidate_image" class="form-control">
                                    <br>
                                    <a data-toggle="lightbox" href=""> </a>
                        
                            </div>

                        </div>
                    </div>

                    
                    <div class="form-group my-2">
                        <label for="qualification">Qualification</label>
                        <textarea name="qualification" id="qualification" cols="30" rows="8" class="form-control"></textarea>
                    </div>

                    <div class="form-group my-2">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="8" class="form-control"></textarea>
                    </div>
                    <div class="form-group my-2">
                        <input type="submit" class="btn btn-info" value="Apply">
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection

@push('js')

{{-- Add moreee --}}

<script src="https://code.jquery.com/jquery-3.1.0.js"></script>

    <script src="{{ asset('cp/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('cp/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <script>
        $(function() {
            // Summernote
            $('#description').summernote()
        })
        $(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.filter-container').filterizr({
                gutterPixels: 3
            });
            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
    </script>
@endpush
