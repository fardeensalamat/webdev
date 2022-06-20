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
    <div role="main" class="main">
        <section class="page-header page-header-modern bg-color-primary page-header-md">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                        <div class="h1 bold text-white">Opinions</div>
                    </div>
                    <div class="col-md-4 order-1 order-md-2 align-self-center">
                        <ul class="breadcrumb d-block text-md-right breadcrumb-light">
                            <li><a href="/">Home</a></li>
                            <li class="active">Opinions</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-4 order-lg-2">
                    <aside class="sidebar">
                        <div class="tabs">
                            <ul class="nav nav-tabs nav-justified flex-column flex-md-row pb-2" style="border: 0.5px solid #17a2b8">
                                <li class="nav-item ">
                                    <a class="nav-link a  font-weight-bold" style="font-weight: 700 !important" href="#popular10" data-toggle="tab">Popular</a>
                                </li>
                                <li class="nav-item font-weight-bold ">
                                    <a class="nav-link a active" style="font-weight: 700 !important" href="#recent10" data-toggle="tab">Featured</a>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <div id="popular10" class="tab-pane">
                                    @forelse ($populerOpenions->take(10) as  $populerO)
                                    <div class="card" style="background-color: #f8f9fa">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="user-block">
                                                        <img class=" img-circle"
                                                            src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $populerO->user->fi()]) }}" style="width:40px; border-radius:50%"
                                                            alt="sans" />
                                                        <span class="username text-dark" style="font-size: 14px">
                                                            {{ $populerO->user ? $populerO->user->name : null }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    {{ $populerO->opinion }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty

                                @endforelse
                                </div>
                                <div id="recent10" class="tab-pane active">
                                    @forelse ($opinions->where('featured',true)->take(10) as  $featuredO)
                                        <div class="card" style="background-color: #f8f9fa">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="user-block">
                                                            <img class=" img-circle"
                                                                src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $featuredO->user->fi()]) }}" style="width:40px; border-radius:50%"
                                                                alt="sans" />
                                                            <span class="username text-dark" style="font-size: 14px">
                                                                {{ $featuredO->user ? $featuredO->user->name : null }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        {{ $featuredO->opinion }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty

                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
                <div class="col-lg-8 order-lg-1">

                    
                    <div class="blog-posts">
                        <div class="card-body">
                            @forelse ($opinions as $opinion)
                            {{ $opinion->visitIncrement() }}
                            <div class="col-12  mt-3 mb-2 mb-md-0">
                                <div class="card card-widget p-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="user-block">
                                                    <img class=" img-circle"
                                                        src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $opinion->user->fi()]) }}" style="width:40px; border-radius:50%"
                                                        alt="sans" />
                                                    <span class="username text-dark" style="font-size: 14px">
                                                        {{ $opinion->user ? $opinion->user->name : null }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                {{ $opinion->opinion }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h2 class="m-auto text-danger">No Opinions Found</h2>
                        @endforelse
                           </div>
                           
                       </div>

                        <div class="row">
                            <div class="col-md-5 col-12 m-auto">
                                {{ $opinions->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush
