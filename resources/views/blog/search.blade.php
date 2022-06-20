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
                    <div class="h1 bold text-white">{{ $type }}</div>
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
        <div class="col-12">
            <div class="col-md-4 m-auto text-center">
                <form action="
                @if ($type == 'News')
                {{ route('welcome.blogSearch',['type'=>'news','search'=>'blog','in'=>'in']) }}
                @elseif($type == 'Blog')
                {{ route('welcome.blogSearch',['type'=>'blog','search'=>'blog','in'=>'in']) }}
                    @elseif ($type == 'Event')
                    {{ route('welcome.blogSearch',['type'=>'event','search'=>'blog','in'=>'in']) }}
                @endif
                " method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="q" placeholder="Search" value="{{ $search??null }}">
                        <div class="input-group-append">
                          <span class="input-group-text"><button class="searchBtn" type="submit"><i class="fas fa-search"></i></button></span>
                        </div>
                      </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="blog-posts">
                    <div class="row">

                        @forelse ($data as $item)
                            <div class="col-md-4 col-lg-3">
                                <article class="post post-medium border-0 pb-0 mb-5">
                                    <div class="post-image">
                                        @if ($type == 'Blog')
                                            <a
                                                href="{{ route('welcome.blogDetails', ['blog' => $item->id, 'title' => mySlug($item->title)]) }}">
                                                <img src=" {{ route('imagecache', ['template' => 'pfimd', 'filename' => $item->fi()]) }}"
                                                    class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0"
                                                    alt="">
                                            @elseif ($type == "News")
                                                <a
                                                    href="{{ route('welcome.newsDetails', ['news' => $item->id, 'title' => mySlug($item->title)]) }}">
                                                    <img src=" {{ route('imagecache', ['template' => 'pfimd', 'filename' => $item->fi()]) }}"
                                                        class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0"
                                                        alt="">
                                                @elseif ($type == "Event")
                                                    <a
                                                        href="{{ route('welcome.eventDetails', ['event' => $item->id, 'title' => mySlug($item->title)]) }}">
                                                        <img src=" {{ route('imagecache', ['template' => 'pfimd', 'filename' => $item->fi()]) }}"
                                                            class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0"
                                                            alt="">
                                        @endif


                                        {{-- @if ($type == 'Blog')
                                    {{ route('welcome.blogDetails',['blog'=>$item->id,'title'=>mySlug($item->title)]) }}
                                        @elseif ($type == "News")
                                        {{ route('welcome.newsDetails',['news'=>$item->id,'title'=>mySlug($item->title)]) }}
                                        @elseif ($type == "Event")
                                        {{ route('welcome.eventDetails',['event'=>$item->id,'title'=>mySlug($item->title)]) }}
                                    @endif --}}
                                    </div>

                                    <div class="post-content">

                                        <h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a href="
                                                              @if ($type=='Blog' )
                                                {{ route('welcome.blogDetails', ['blog' => $item->id, 'title' => mySlug($item->title)]) }}
                                            @elseif ($type == "News")
                                                {{ route('welcome.newsDetails', ['news' => $item->id, 'title' => mySlug($item->title)]) }}
                                            @elseif ($type == "Event")
                                                {{ route('welcome.eventDetails', ['event' => $item->id, 'title' => mySlug($item->title)]) }}
                        @endif
                        ">{{ mb_substr($item->title, 0, 20) }}</a></h2>
                        <p>{{ mb_substr($item->excerpt, 0, 136) }}</p>

                        <div class="post-meta">
                            <span><i class="far fa-user"></i> By <a
                                    href="#">{{ $item->user ? $item->user->name : null }}</a> </span>
                            <span class="fs-10"><i class="far fa-folder "></i>
                                @if ($item->blogCategories)
                                    @foreach ($item->blogCategories as $bcat)
                                        @if ($type == 'Blog')
                                            <a
                                                href="{{ route('welcome.catWiseBlog', ['cat' => $bcat->id, 'title' => mySlug($bcat->name)]) }}">{{ $bcat->name }}</a>
                                        @elseif($type == 'News')
                                            <a
                                                href="{{ route('welcome.catWiseNews', ['cat' => $bcat->id, 'title' => mySlug($bcat->name)]) }}">{{ $bcat->name }}</a>
                                        @elseif ($type == 'Event')
                                            <a
                                                href="{{ route('welcome.catWiseEvent', ['cat' => $bcat->id, 'title' => mySlug($bcat->name)]) }}">{{ $bcat->name }}</a>
                                        @endif
                                    @endforeach
                                @endif
                            </span>

                            <span class="d-block mt-2 "><a href="
                                     @if ($type=='Blog' )
                                    {{ route('welcome.blogDetails', ['blog' => $item->id, 'title' => mySlug($item->title)]) }}
                                @elseif ($type == "News")
                                    {{ route('welcome.newsDetails', ['news' => $item->id, 'title' => mySlug($item->title)]) }}
                                @elseif ($type == "Event")
                                    {{ route('welcome.eventDetails', ['event' => $item->id, 'title' => mySlug($item->title)]) }}
                                    @endif
                                    " class="btn btn-xs btn-light text-1 text-uppercase">Read More</a></span>
                        </div>

                    </div>
                    </article>
                </div>
            @empty
                <div class="text-center text-danger h3">No {{ $type }} Found</div>
                @endforelse

            </div>

            <div class="row">
                <div class="col">
                   {{ $data->render() }}
                </div>
            </div>

        </div>
    </div>

    </div>
    </div>
@endsection

@push('js')
@endpush
