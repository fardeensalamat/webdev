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
                <div class="h1 bold text-white">Events</div>
            </div>
            <div class="col-md-4 order-1 order-md-2 align-self-center">
                <ul class="breadcrumb d-block text-md-right breadcrumb-light">
                    <li><a href="/">Home</a></li>
                    <li class=""> <a href="{{ route('welcome.blog',['type'=>'event']) }}">Events</a> </li>
                    <li class="">{{ mb_substr($event->title,0,30) }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>
    <div class="container py-4">
        <div class="row">
            <div class="col">
                <div class="blog-posts single-post">

                    <article class="post post-large blog-single-post border-0 m-0 p-0">
                        <div class="post-image ml-0">
                            <a href="">
                                <img src="{{ route('imagecache', ['template' => 'fifb', 'filename' => $event->fi()]) }}"
                                    class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="">
                            </a>
                        </div>

                        <div class="post-date ml-0">
                            <span
                            class="day">{{ \Carbon\Carbon::parse($event->created_at)->format('d') }}</span>
                        <span
                            class="month">{{ \Carbon\Carbon::parse($event->created_at)->format('M') }}</span>
                        </div>

                        <div class="post-content ml-0">

                            <h2 class="font-weight-bold"><a href="#">{{ $event->title }}</a></h2>

                            <div class="post-meta">
                                <span><i class="far fa-user"></i> By <a href="#">{{ $event->user ? $event->user->name : '' }}</a> </span>
                                    <span><i class="far fa-folder"></i> 
                                        @if ($event->blogCategories )
                                            @foreach ($event->blogCategories  as $bcat)
                                            <a href="{{ route('welcome.catWiseBlog',['cat'=>$bcat->id,'title'=>mySlug($bcat->title)]) }}">{{ $bcat->name }}</a>,
                                            @endforeach
                                        @endif
                                        
                                    </span>
                                    <span><i class="fas fa-tags"></i>
                                        <?php $tags= explode(',',$event->tags); ?>
                                        @if ($tags)
                                            @foreach ($tags as $tag)
                                            <a
                                            href="{{ route('welcome.tagWisePost', ['type' => 'event','tag'=>1, 'title' => $tag]) }}">{{ $tag }}</a>,
                                            @endforeach
                                        @endif
    
                                    </span>
                            </div>

                            <div style="white-space: pre-wrap;">
                                {!! $event->description !!}
                            </div>


                            <div class="post-block mt-5 post-share">
                                <h4 class="mb-3">Share this Post</h4>

                                <!-- AddThis Button BEGIN -->
                                <div class="addthis_inline_share_toolbox"></div>
                                <!-- AddThis Button END -->

                            </div>

                            <div class="post-block mt-4 pt-2 post-author">
                                <h4 class="mb-3">Author</h4>
                                <div class="img-thumbnail img-thumbnail-no-borders d-block pb-3">
                                    <a href="#">
                                        <img src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $event->user->fi()]) }}" alt="">
                                    </a>
                                </div>
                                <p><strong class="name"><a href="#" class="text-4 pb-2 pt-2 d-block">{{ $event->user? $event->user->name :null }}</a></strong></p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio,
                                    gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et,
                                    interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim ornare
                                    nisi, vitae mattis nulla ante id dui. </p>
                            </div>
                        </div>
                    </article>

                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6187671346fae48e"></script>
@endpush
