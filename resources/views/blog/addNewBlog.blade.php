@extends('theme.prt.layouts.prtMaster')

@section('title')
    {{ env('APP_NAME_BIG') }}
@endsection
@section('meta')
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('cp/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.css') }}">
    <style>
        li.select2-selection__choice {
            color: black !important;
            background: #cecece;
        }

        .select2-dropdown .select2-search__field:focus,
        .select2-search--inline .select2-search__field:focus {
            outline: none !important;
            border: none !important;
        }

        span.select2-selection__choice__remove {
            color: red !important;
        }

        .card {
            border: 1px solid #17a2b8;
        }

        label {
            font-weight: 500 !important;
            color: black;
        }

    </style>
@endpush

@section('contents')
    @include('alerts.alerts')
    <br>
    <section class="content">
        <div class="container">
            <div class="card">
                <div class="card-header bg-info">
                    <h4>Post a Blog/Event/News</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('welcome.storeNewBlogFromUser') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @if (!Auth::check())
                            <div class="card">
                                <div class="card-header text-center">{{ __('Registration') }}</div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email"
                                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="mobile"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>

                                        <div class="col-md-6">
                                            <input id="mobile" type="text"
                                                class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                                value="{{ old('mobile') }}" autocomplete="mobile" autofocus>

                                            @error('mobile')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" autocomplete="new-password">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="active" id="active"
                                                    checked>

                                                <label class="form-check-label" for="active">
                                                    {{ __('Active') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="type">Select Post Type</label>
                                        <select name="type" id="type"
                                            class="form-control @error('type') is-invalid @enderror">
                                            <option value="">Select Type</option>
                                            <option value="blog">Blog</option>
                                            <option value="news">News</option>
                                            <option value="event">Event</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" name="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                value="{{ old('title') }}">
                                        </div>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description"
                                                class="form-control @error('description') is-invalid @enderror" rows="10"
                                                id="description"
                                                placeholder="Description">{!! old('description') !!}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="excerpt">Excerpt</label>
                                            <textarea name="excerpt"
                                                class="form-control @error('excerpt') is-invalid @enderror" rows="3"
                                                id="excerpt" maxlength="240"
                                                placeholder="Excerpt of Post">{{ old('excerpt') }}</textarea>
                                            @error('excerpt')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tag">Select Tags</label>
                                        <select id="tags" name="tags[]"
                                            class="form-control select2-tags select2-container step2-select select2 @error('tags') is-invalid @enderror"
                                            data-placeholder="Select Tags From list or Add New"
                                            data-ajax-url="{{ route('welcome.selectTagsOrAddNew') }}"
                                            data-ajax-cache="true" data-ajax-dataType="json" data-ajax-delay="200"
                                            multiple="multiple" style="width: 100%;">
                                            @if (old('tags'))
                                                @foreach (old('tags') as $tagg)
                                                    <option selected="selected">{{ $tagg }}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <label for="categories">Categories</label>
                                        <select id="categories" name="categories[]" multiple
                                            class="form-control selectCat @error('categories') is-invalid @enderror"
                                            id="categories" data-placeholder="Select Categories">
                                            @foreach ($cats->chunk(2) as $cats2)
                                                @foreach ($cats2 as $cat)
                                                    <option value="{{ $cat->id }}">
                                                        {{ $cat->name }}</option>

                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="col-md-12">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" name="publish" checked>Publish Instantly</label>
                                </div>
                            </div>
                        </div> --}}

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="feature_image">Image</label>
                                            <input type="file" name="feature_image"
                                                class="@error('feature_image') is-invalid @enderror">
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <input type="submit" class="btn btn-info px-5 py-2 d-inline-block" value="Submit">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('cp/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('cp/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#description').summernote({
        height: 150
    });
            $('.selectCat').select2();
            $('.select2-tags').select2({
                minimumInputLength: 1,
                tags: true,
                tokenSeparators: [','],
                ajax: {
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        // alert(data[0].s);
                        var data = $.map(data, function(obj) {
                            obj.id = obj.id || obj.name;
                            return obj;
                        });
                        var data = $.map(data, function(obj) {
                            obj.text = obj.text || obj.name;
                            return obj;
                        });
                        return {
                            results: data,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    }
                },
            });

            //////////////////




            $(document).on('click', '#btn-feature', function(e) {
                e.preventDefault();
                $('#my_feature_img').click();
            });
        });
    </script>
@endpush
