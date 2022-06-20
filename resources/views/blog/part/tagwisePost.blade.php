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
                    <div class="h1 bold text-white">{{ strtoupper($type) }}</div>
                </div>
                <div class="col-md-4 order-1 order-md-2 align-self-center">
                    <ul class="breadcrumb d-block text-md-right breadcrumb-light">
                        <li><a href="/">Home</a></li>
                        <li class="active">{{ $type }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
                <h4><b>Tag: </b> {{ $tag }}</h4>
            </div>
            <div class="col-lg-3 order-lg-2">
                <aside class="sidebar">
                    <h5 class="font-weight-bold pt-4">Tags</h5>
                    @foreach ($tags as $tag)
                        @if ($type == 'news')
                            <a
                                href="{{ route('welcome.tagWisePost', ['type' => 'news', 'tag' => $tag->id, 'title' => mySlug($tag->name)]) }}"><span
                                    class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">{{ $tag->name }}</span></a>
                        @elseif ($type== 'event')
                            <a
                                href="{{ route('welcome.tagWisePost', ['type' => 'event', 'tag' => $tag->id, 'title' => mySlug($tag->name)]) }}"><span
                                    class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">{{ $tag->name }}</span></a>
                        @elseif ($type== 'blog')
                            <a
                                href="{{ route('welcome.tagWisePost', ['type' => 'blog', 'tag' => $tag->id, 'title' => mySlug($tag->name)]) }}"><span
                                    class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">{{ $tag->name }}</span></a>
                        @endif

                    @endforeach
                </aside>
            </div>
            <div class="col-lg-9 order-lg-1">
                <div class="blog-posts">
                    @forelse ($posts as $post)
                        <article class="post post-large">
                            <div class="post-image">
                                <a href="
                                               @if ($type=='blog' )
                                    {{ route('welcome.blogDetails', ['title' => mySlug($post->title), 'blog' => $post->id]) }}
                                @elseif ($type== 'news')
                                    {{ route('welcome.newsDetails', ['title' => mySlug($post->title), 'news' => $post->id]) }}
                                @elseif ($type== 'event')
                                    {{ route('welcome.eventDetails', ['title' => mySlug($post->title), 'event' => $post->id]) }}
                    @endif
                    ">
                    <img src="{{ route('imagecache', ['template' => 'fifb', 'filename' => $post->fi()]) }}"
                        class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="">
                    </a>
                </div>

                <div class="post-date">
                    <span class="day">{{ \Carbon\Carbon::parse($post->created_at)->format('d') }}</span>
                    <span class="month">{{ \Carbon\Carbon::parse($post->created_at)->format('M') }}</span>
                </div>

                <div class="post-content">

                    <h2 class="font-weight-semibold text-6 line-height-3 mb-3">
                        <a href="
                                  @if ($type=='blog' )
                            {{ route('welcome.blogDetails', ['title' => mySlug($post->title), 'blog' => $post->id]) }}
                        @elseif ($type== 'news')
                            {{ route('welcome.newsDetails', ['title' => mySlug($post->title), 'news' => $post->id]) }}
                        @elseif ($type== 'event')
                            {{ route('welcome.eventDetails', ['title' => mySlug($post->title), 'event' => $post->id]) }}
                            @endif
                            ">

                            {{ $post->title }}</a>
                    </h2>
                    <p>
                        @if ($post->excerpt)
                            {{ $post->excerpt }}..
                        @else{
                            {{ mb_substr($post->description, 0, 230) }}...
                            }
                        @endif
                    </p>

                    <div class="post-meta">
                        <span><i class="far fa-user"></i> By <a
                                href="#">{{ $post->user ? $post->user->name : '' }}</a> </span>
                        <span><i class="far fa-folder"></i>
                            @if ($post->blogCategories)
                                @foreach ($post->blogCategories as $bcat)
                                    @if ($type == 'news')
                                        <a
                                            href="{{ route('welcome.catWiseNews', ['cat' => $bcat->id, 'title' => mySlug($bcat->name)]) }}">{{ $bcat->name }}</a>
                                    @elseif ($type == 'blog')
                                        <a
                                            href="{{ route('welcome.catWiseBlog', ['cat' => $bcat->id, 'title' => mySlug($bcat->name)]) }}">{{ $bcat->name }}</a>
                                    @elseif ($type == 'event')
                                        <a
                                            href="{{ route('welcome.catWiseEvent', ['cat' => $bcat->id, 'title' => mySlug($bcat->name)]) }}">{{ $bcat->name }}</a>
                                    @endif

                                @endforeach
                            @endif

                        </span>
                        <span><i class="far fa-comments"></i> <a href="#">12 Comments</a></span>
                        <span class="d-block d-sm-inline-block float-sm-right mt-3 mt-sm-0"><a href="
                                     @if ($type=='blog' )
                                {{ route('welcome.blogDetails', ['title' => mySlug($post->title), 'blog' => $post->id]) }}
                            @elseif ($type== 'news')
                                {{ route('welcome.newsDetails', ['title' => mySlug($post->title), 'news' => $post->id]) }}
                            @elseif ($type== 'event')
                                {{ route('welcome.eventDetails', ['title' => mySlug($post->title), 'event' => $post->id]) }}
                                @endif
                                "
                                class="btn btn-xs btn-light text-1 text-uppercase">Read
                                More</a></span>
                    </div>

                </div>
                </article>

            @empty
                <h3 class="text-danger text-center">No {{ $type }} Found</h3>
                @endforelse

                <div class="row">
                    <div class="col-md-5 col-12 m-auto">
                        {{ $posts->render() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>
@endsection

@push('js')
@endpush
