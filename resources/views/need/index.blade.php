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
                    <h4>Post a Need</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('welcome.storeNewNeedFromGuest') }}" method="POST"
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
                            <div class="col-md-12 col-12 m-auto">
                                <div class="card">
                                    <div class="card-header">Just Post What You Need</div>
                                    <div class="card-body">
                                        <form action="{{ route('user.storeNeeds') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" class="form-control" name="title"
                                                    placeholder="I Need Web Developer">
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="workstation">Workstation</label>
                                                <select id="workstation" name="workstation"
                                                    class="form-control selectCat @error('workstation') is-invalid @enderror"
                                                    id="workstation" data-placeholder="Select Workstation"
                                                    data-url={{ route('welcome.searchCategoryAjax') }}>
                                                    <option value="">Select Workstation</option>
                                                    @foreach ($workstation as $wt)
                                                        <option value="{{ $wt->id }}">
                                                            {{ $wt->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <select id="category" name="category" class="form-control">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="closed_date">Closed Date</label>
                                                <input type="date" class="form-control" name="closed_date">
                                                @error('closed_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea name="description"
                                                    class="form-control @error('description') is-invalid @enderror"
                                                    rows="10" id="description"
                                                    placeholder="Description">{!! old('description') !!}</textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input class="btn btn-info" type="submit" name="Submit">
                                            </div>
                                        </form>
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
            $('.select2').select2({
                theme: 'bootstrap4'
            });

            $('.step2-select').select2({
                theme: 'bootstrap4',
                // minimumInputLength: 1,
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
                            obj.id = obj.id || obj.id;
                            return obj;
                        });
                        var data = $.map(data, function(obj) {
                            obj.text = obj.mobile;
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
        });
        $('#newUser').click(function(e) {
            e.preventDefault();

            $("#hideShow").toggle();
        });
    </script>
    <script>
        $('select#workstation').on('change', function() {
            var st = $(this).val();
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: st,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    console.log(data.categories);
                    $('#category').empty();
                    $.each(data.categories, function(index, categories) {
                        $('select#category').append('<option value="' +
                            categories.id + '">' + categories.name.en +
                            '</option>');
                        // console.log(categories.id);
                    })
                }
            });
        });

        $('select#category').on('change', function() {
            var st = $(this).val();
            var url = $(this).attr('data-url');
            var user = $('select#user').val();
            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: st,
                    user: user,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    console.log(data)
                    $('.another').empty();
                    $('.another').append(data.html);

                }
            });
        });
    </script>
@endpush
