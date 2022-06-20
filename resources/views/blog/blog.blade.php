@extends('theme.prt.layouts.prtMaster')

@section('title')
    {{ env('APP_NAME_BIG') }}
@endsection
@section('meta')
@endsection

@push('css')
<style>
    button.searchBtn {
    outline: none;
    border: none;
    background-color: #fff !important;
}
span.input-group-text {
    border-left: none;
    background: transparent;
    border: none;
}
input.form-control {
    border: none;
}
.input-group.mb-3 {
    border: 1px solid;
}
</style>
@endpush

@section('contents')
    <section class="page-header page-header-modern bg-color-primary page-header-md">
        <div class="container">
            <div class="row">
                <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                    <div class="h1 bold text-white">Blogs</div>
                </div>
                <div class="col-md-4 order-1 order-md-2 align-self-center">
                    <ul class="breadcrumb d-block text-md-right breadcrumb-light">
                        <li><a href="/">Home</a></li>
                        <li class="active">Blogs</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-3 order-lg-2">
                <aside class="sidebar">
                    <form action="{{ route('welcome.blogSearch',['type'=>'blog','search'=>'blog','in'=>'in']) }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="q" placeholder="Search">
                            <div class="input-group-append">
                              <span class="input-group-text"><button class="searchBtn" type="submit"><i class="fas fa-search"></i></button></span>
                            </div>
                          </div>
                    </form>
                    <h5 class="font-weight-bold pt-4">Categories</h5>
                    <ul class="nav nav-list flex-column mb-5">
                        @forelse ($categories as $category)
                            <li class="nav-item"><a class="nav-link" href="{{ route('welcome.catWiseBlog',['cat'=>$category->id,'title'=>mySlug($category->name)]) }}">{{ $category->name }}
                                    ({{ $category->count('blog') }})</a></li>
                        @empty
                        @endforelse
                </aside>
            </div>
            <div class="col-lg-9 order-lg-1">
                <div class="blog-posts">
                    @forelse ($blogs as $blog)
                        <article class="post post-large">
                            <div class="post-image">
                                <a
                                    href="{{ route('welcome.blogDetails', ['title' => mySlug($blog->title), 'blog' => $blog->id]) }}">
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
                                        href="{{ route('welcome.blogDetails', ['title' => mySlug($blog->title), 'blog' => $blog->id]) }}">

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
                                                <a href="{{ route('welcome.catWiseBlog', ['cat' => $bcat->id, 'title' => mySlug($bcat->name)]) }}">{{ $bcat->name }}</a>,
                                            @endforeach
                                        @endif

                                    </span>
                                    {{-- <span><i class="far fa-comments"></i> <a href="#">12 Comments</a></span> --}}
                                    <span class="d-block d-sm-inline-block float-sm-right mt-3 mt-sm-0"><a
                                            href="{{ route('welcome.blogDetails', ['title' => 'blog', 'blog' => $blog->id]) }}"
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
                            {{ $blogs->render() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
