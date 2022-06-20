@extends('theme.prt.layouts.prtMaster')

@section('title')
    {{ env('APP_NAME_BIG') }}
@endsection
@section('meta')
@endsection

@push('css')

@endpush

@section('contents')
    <section class="page-header page-header-modern bg-color-primary page-header-md">
        <div class="container">
            <div class="row">
                <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                    <div class="h1 bold text-white">
                        <a class="bold text-white" href="{{ route('welcome.blog',['type'=>'news']) }}">News</a>
                    </div>
                </div>
                <div class="col-md-4 order-1 order-md-2 align-self-center">
                    <ul class="breadcrumb d-block text-md-right breadcrumb-light">
                        <li><a href="/">Home</a></li>
                        <li class="active">News</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-3 order-lg-2">
                <aside class="sidebar">
                    <h5 class="font-weight-bold pt-4">Categories</h5>
                    <ul class="nav nav-list flex-column mb-5">
                        @forelse ($categories as $category)
                                    <li class="nav-item"><a class="nav-link {{ $category->id == $cat->id ? 'active' :null }}" href="{{ route('welcome.catWiseNews',['cat'=>$category->id,'title'=>mySlug($category->name)]) }}">{{ $category->name }}
                                        ({{ $category->count('news') }})</a></li>
                        @empty

                        @endforelse
                </aside>
            </div>
            <div class="col-lg-9 order-lg-1">
                <div class="blog-posts">
                    @forelse ($cat->catwisePost('news') as $blog)
                        <article class="post post-large">
                            <div class="post-image">
                                <a
                                    href="{{ route('welcome.newsDetails', ['title' => mySlug($blog->title), 'news' => $blog->id]) }}">
                                    <img src="{{ route('imagecache', ['template' => 'fifb', 'filename' => $blog->fi()]) }}"
                                        class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="">
                                </a>
                            </div>
                            <div class="post-date">
                                <span
                                    class="day">{{ \Carbon\Carbon::parse($blog->created_at)->format('d') }}</span>
                                <span
                                    class="month">{{ \Carbon\Carbon::parse($blog->created_at)->format('M') }}</span>
                            </div>

                            <div class="post-content">

                                <h2 class="font-weight-semibold text-6 line-height-3 mb-3"><a
                                        href="{{ route('welcome.newsDetails', ['title' => mySlug($blog->title), 'news' => $blog->id]) }}">

                                        {{ $blog->title }}</a></h2>
                                <p>
                                    @if ($blog->excerpt)
                                        {{ $blog->excerpt }}..
                                    @else{
                                        {{ mb_substr($blog->description, 0, 230) }}...
                                        }
                                    @endif
                                </p>

                                <div class="post-meta">
                                    <span><i class="far fa-user"></i> By <a
                                            href="#">{{ $blog->user ? $blog->user->name : '' }}</a> </span>
                                    <span><i class="far fa-folder"></i>
                                        @if ($blog->blogCategories)
                                            @foreach ($blog->blogCategories as $bcat)
                                                <a href="{{ route('welcome.catWiseNews',['cat'=>$bcat->id,'title'=>mySlug($bcat->name)]) }}">{{ $bcat->name }}</a>,
                                            @endforeach
                                        @endif

                                    </span>
                                    {{-- <span><i class="far fa-comments"></i> <a href="#">12 Comments</a></span> --}}
                                    <span class="d-block d-sm-inline-block float-sm-right mt-3 mt-sm-0"><a
                                            href="{{ route('welcome.newsDetails', ['title' => mySlug($blog->title), 'news' => $blog->id]) }}"
                                            class="btn btn-xs btn-light text-1 text-uppercase">Read
                                            More</a></span>
                                </div>

                            </div>
                        </article>

                    @empty
                        <h3 class="text-danger text-center">No BLog Found</h3>
                    @endforelse

                    <div class="row">
                        <div class="col-md-5 col-12 m-auto">
                            {{-- {{ $data->render() }} --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
@endpush
