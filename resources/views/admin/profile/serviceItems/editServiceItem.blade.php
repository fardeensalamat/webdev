@extends('admin.layouts.adminMaster')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/lightslider/lightslider.css') }}">
    <style>
        .card {
            background-color: #fff;
            padding: 14px;
            border: none
        }

        .demo {
            width: 100%
        }

        img {
            display: block;
            height: auto;
            width: 100%
        }

        hr {
            color: #d4d4d4
        }

        .badge {
            padding: 5px !important;
            padding-bottom: 6px !important
        }

        .badge i {
            font-size: 10px
        }

        .profile-image {
            width: 35px
        }

        .comment-ratings i {
            font-size: 13px
        }

        .username {
            font-size: 12px
        }

        .comment-profile {
            line-height: 17px
        }

        .store-image {
            width: 42px
        }

        .dot {
            height: 10px;
            width: 10px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px
        }

        .bullet-text {
            font-size: 12px
        }

        .my-color {
            margin-top: 10px;
            margin-bottom: 10px
        }

        label.radio {
            cursor: pointer
        }

        label.radio input {
            position: absolute;
            top: 0;
            left: 0;
            visibility: hidden;
            pointer-events: none
        }

        label.radio span {
            border: 2px solid #8f37aa;
            display: inline-block;
            color: #8f37aa;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            text-transform: uppercase;
            transition: 0.5s all
        }

        label.radio .red {
            background-color: red;
            border-color: red
        }

        label.radio .blue {
            background-color: blue;
            border-color: blue
        }

        label.radio .green {
            background-color: green;
            border-color: green
        }

        label.radio .orange {
            background-color: orange;
            border-color: orange
        }

        label.radio input:checked+span {
            color: #fff;
            position: relative
        }

        label.radio input:checked+span::before {
            opacity: 1;
            content: '\2713';
            position: absolute;
            font-size: 13px;
            font-weight: bold;
            left: 4px
        }

        .card-body {
            padding: 0.3rem 0.3rem 0.2rem
        }

    </style>
<link rel="stylesheet" href="{{ asset('cp/plugins/summernote/summernote-bs4.css') }}">
@endpush

@section('content')
    <br>
    <section class="content">
        <div class="card card-solid">
            <div class="card-header bg-info">
                <div class="card-title">Edit Service Items</div>
            </div>
            @include('alerts.alerts')
            <div class="container-fluid mt-2 mb-3">
                <div class="card-body">
                    <form
                    action="{{ route('admin.updateServiceItem', ['item'=>$serviceItem]) }}"
                    enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Service Title</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ old('title')??$serviceItem->title }}" placeholder="Service Title">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="excerpt">Short Description</label>
                        <textarea name="excerpt" class="form-control" id="excerpt"
                            placeholder="Short Description">{{ old('excerpt')??$serviceItem->excerpt }}</textarea>
                        @error('excerpt')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Service Description</label>
                        <textarea name="description" class="form-control" id="description"
                            placeholder="Service Description">{{ old('description')??$serviceItem->description }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Service Price</label>
                        <input type="number" class="form-control" value="{{ old('price')??$serviceItem->price }}" id="price" name="price" placeholder="Service Price">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-contrl" name="image">
                        <img class="" style="width:120px !important; height: 120px !important;" src="{{ route('imagecache', [ 'template'=>'ppmd','filename' => $serviceItem->fi() ]) }}" alt="" srcset="">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="negotiations">
                        <input type="checkbox" name="negotiations" {{ $serviceItem->negotiations ? 'checked':'' }} id="negotiations">
                        Negotiable?</label>
                    </div>
                    <div class="form-group">
                        <label for="active">
                        <input type="checkbox" {{ $serviceItem->active ? 'checked':'' }} name="active" id="active">
                        Active</label>
                    </div>
                    <div class="form-group">
                        <label for="status"> Status</label>
                        <select name="status" id="status" class="form-control">
                            <option {{ $serviceItem->status== 'approved' ? 'selected':'' }} value="">Select Status</option>
                            <option {{ $serviceItem->status== 'approved' ? 'selected':'' }} value="approved">Approved</option>
                            <option {{ $serviceItem->status== 'pending' ? 'selected':'' }} value="pending">Pending</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-info">
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