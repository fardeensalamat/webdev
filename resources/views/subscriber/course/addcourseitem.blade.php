@extends('subscriber.layouts.userMaster')

@push('css')

    <link rel="stylesheet" href="{{ asset('cp/plugins/summernote/summernote-bs4.css') }}">

@endpush
@section('content')
    <br>

    <section class="content">
        @include('alerts.alerts')
        <div class="card">
            <div class="card-header">
                <div class="card-title">Add New Course Item</div>
            </div>
            <div class="card-body">
                <form
                    action="{{ route('subscriber.storeCourse', ['profile' => $serviceProfile, 'subscription' => $subscription->subscription_code]) }}"
                    enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Course Title">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="subtitle">Sub-Title</label>
                        <input type="text" name="subtitle" class="form-control" id="subtitle" placeholder="Course Sub-Title">
                        @error('subtitle')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="ins_name">Instructor Name</label>
                        <input type="text" name="ins_name" class="form-control" id="ins_name" placeholder="Course Instructor Name">
                        @error('ins_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> 

                    <div class="form-group">
                        <label for="instructor">Instructor Designation</label>
                        <input type="text" name="ins_designation" class="form-control" id="designation" placeholder="Course Instructor Designation">
                        @error('ins_designation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> 

                    <div class="form-group">
                        <label for="whatlearn">What You Will Learn From This Course?</label>
                        <textarea name="whatlearn" class="form-control" id="whatlearn"
                            placeholder="What You Will Learn From This Course?"></textarea>
                        @error('whatlearn')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="aboutcourse">About The Course</label>
                        <textarea name="aboutcourse" class="form-control" id="about"
                            placeholder="About The Course"></textarea>
                        @error('aboutcourse')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="coursesyllabus">Course Syllabus</label>
                        <textarea name="coursesyllabus" class="form-control" id="syllabus"
                            placeholder="Course Syllabus"></textarea>
                        @error('coursesyllabus')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="hoursdetails">Hours Required Details</label>
                        <textarea name="hoursdetails" class="form-control" id="hoursdetails"
                            placeholder="Hours Required Info"></textarea>
                        @error('hoursdetails')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Course Price</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="course Price">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="courseimage"> Cover Image</label>
                        <input type="file" name="courseimage" id="courseimage">
                    </div>
                    <div class="form-group">
                        <label for="clink">Course Link</label>
                        <input type="text" name="courselink"  class="form-control" id="courselink">
                        @error('clink')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="negotiations">
                        <input type="checkbox" name="negotiations" id="negotiations">
                        Negotiable?</label>
                    </div>
                    <div class="form-group">
                        <label for="active">
                        <input type="checkbox" name="active" id="active">
                        Active</label>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-info">
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('cp/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('cp/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <script>
        $(function() {
            // Summernote
            $('#syllabus').summernote()
        })
        $(function() {
            // Summernote
            $('#about').summernote()
        })
        $(function() {
            // Summernote
            $('#whatlearn').summernote()
        })
        $(function() {
            // Summernote
            $('#hoursdetails').summernote()
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
