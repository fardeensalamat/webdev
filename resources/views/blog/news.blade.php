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
                    <div class="h1 bold text-white">News</div>
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
    <div class="container">
        <div class="row pb-1">
            <div class="col-12">
                <div class="col-md-4 m-auto text-center">
                    <form action="{{ route('welcome.blogSearch',['type'=>'news','search'=>'blog','in'=>'in']) }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="q" placeholder="Search">
                            <div class="input-group-append">
                              <span class="input-group-text"><button class="searchBtn" type="submit"><i class="fas fa-search"></i></button></span>
                            </div>
                          </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 mb-4 pb-2">
                <a href="#">
                    <?php
                    $fp = $news->latest()->first();
                    ?>

                    <article
                        class="thumb-info thumb-info-no-borders thumb-info-bottom-info thumb-info-bottom-info-dark thumb-info-bottom-info-show-more thumb-info-no-zoom border-radius-0">
                        <div class="thumb-info-wrapper thumb-info-wrapper-opacity-6">
                            <img src="{{ route('imagecache', ['template' => 'cpxs', 'filename' => $fp->fi()]) }}"
                                class="img-fluid" alt="How To Take Better Concert Pictures in 30 Seconds">
                            <div class="thumb-info-title bg-transparent p-4">
                                <div class="thumb-info-type bg-color-dark px-2 mb-1">{{ $fp->cats() }}</div>
                                <div class="thumb-info-inner mt-1">
                                    <h2 class="font-weight-bold text-color-light line-height-2 text-5 mb-0">
                                      <a href="{{ route('welcome.blogDetails',['blog'=>$fp->id,'title'=>mySlug($fp->title)]) }}"> {{ $fp->title }}</a></h2>
                                </div>
                                <div class="thumb-info-show-more-content">
                                    <p class="mb-0 text-1 line-height-9 mb-1 mt-2 text-light opacity-5">{{ $fp->excerpt }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </article>
                </a>
            </div>
            <div class="col-lg-5">
                <?php
                $posts = $news
                    ->orderBy('id', 'DESC')
                    ->take(2)
                    ->get();
                
                ?>
                @foreach ($posts as $p)
                    <article
                        class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-4 mb-2">
                        <div class="row align-items-center pb-1">
                            <div class="col-sm-5">
                                <a
                                    href="{{ route('welcome.newsDetails', ['news' => $p->id, 'title' => mySlug($p->title)]) }}">
                                    <img src="{{ route('imagecache', ['template' => 'pplg', 'filename' => $p->fi()]) }}"
                                        class="img-fluid border-radius-0" alt="Simple Ways to Have a Pretty Face">
                                </a>
                            </div>
                            <div class="col-sm-7 pl-sm-1">
                                <div class="thumb-info-caption-text">
                                    <div
                                        class="thumb-info-type text-light text-uppercase d-inline-block bg-color-dark px-2 m-0 mb-1 float-none">
                                        <a href="{{ route('welcome.catWiseNews',['cat'=>$p->blogCategories->first()->id, 'title'=>mySlug($p->blogCategories->first()->name)]) }}"
                                            class="text-decoration-none text-color-light">{{ $p->blogCategories ? $p->blogCategories->first()->name :null}}</a>
                                    </div>
                                    <h2 class="d-block line-height-2 text-4 text-dark font-weight-bold mt-1 mb-0">
                                        <a href="{{ route('welcome.newsDetails', ['news' => $p->id, 'title' => mySlug($p->title)]) }}"
                                            class="text-decoration-none text-color-dark">{{ $p->title }}</a>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach


            </div>
        </div>

        <div class="row pb-1 pt-2">
            <div class="col-md-9">
                @foreach ($cats as $cat)
                    <div class="heading heading-border heading-middle-border">
                        <h3 class="text-4"><strong
                                class="font-weight-bold text-1 px-3 text-light py-2 bg-secondary">{{ $cat->name }}</strong>
                        </h3>
                    </div>
                    {{-- @forelse ($cat->posts as $cp) --}}
                    <div class="row pb-1">
                        <div class="col-lg-6 mb-4 pb-1">
                            <?php
                            $first_post = $cat->catwisePost('news')->last();
                            ?>
                            <article
                                class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-2 mb-2">
                                <div class="row">
                                    <div class="col">
                                        <a
                                            href="{{ route('welcome.newsDetails', ['news' => $first_post->id, 'title' => mySlug($first_post->title)]) }}">
                                            <img src="{{ route('imagecache', ['template' => 'fifb', 'filename' => $first_post->fi()]) }}"
                                                class="img-fluid border-radius-0" alt="Why should I buy a smartwatch?">
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="thumb-info-caption-text">
                                            <div class="d-inline-block text-default text-1 mt-2 float-none">
                                                <a href="{{ route('welcome.newsDetails', ['news' => $p->id, 'title' => mySlug($first_post->title)]) }}"
                                                    class="text-decoration-none text-color-default">{{ \Carbon\Carbon::parse($p->created_at)->format('F d, Y') }}</a>
                                            </div>
                                            <h4 class="d-block line-height-2 text-4 text-dark font-weight-bold mb-0">
                                                <a href="{{ route('welcome.newsDetails', ['news' => $p->id, 'title' => mySlug($first_post->title)]) }}"
                                                    class="text-decoration-none text-color-dark">{{ $first_post->title }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="col-lg-6">
                            @foreach ($cat->catwisePost('news')->where('id','!=',$first_post->id)->take(4) as $cp)
                                <article
                                    class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-4 mb-2">
                                    <div class="row align-items-center pb-1">
                                        <div class="col-sm-4">
                                            <a
                                                href="{{ route('welcome.newsDetails', ['news' => $cp->id, 'title' => mySlug($cp->title)]) }}">
                                                <img src="{{ route('imagecache', ['template' => 'pplg', 'filename' => $cp->fi()]) }}" class="img-fluid border-radius-0"
                                                    alt="{{ $cp->title }}">
                                            </a>
                                        </div>
                                        <div class="col-sm-8 pl-sm-0">
                                            <div class="thumb-info-caption-text">
                                                <div class="d-inline-block text-default text-1 float-none">
                                                    <a href="{{ route('welcome.newsDetails', ['news' => $cp->id, 'title' => mySlug($cp->title)]) }}"
                                                        class="text-decoration-none text-color-default">{{ \Carbon\Carbon::parse($cp->created_at)->format('F d, Y') }}</a>
                                                </div>
                                                <h4
                                                    class="d-block pb-2 line-height-2 text-3 text-dark font-weight-bold mb-0">
                                                    <a href="{{ route('welcome.newsDetails', ['news' => $cp->id, 'title' => mySlug($cp->title)]) }}"
                                                        class="text-decoration-none text-color-dark">{{ $cp->title }}</a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach

                        </div>
                    </div>

                @endforeach

                <div class="text-center py-3 mb-4">

                    <a href="#" target="_blank"
                        class="d-block">
                        <img alt="Porto" class="img-fluid pl-3" src="https://www.softcodeint.com/img/https.jpg">
                    </a>
                </div>

                <div class="row pb-1 pt-3">
                    <div class="col-md-6">
                        <h3 class="font-weight-bold text-3 mb-0">Popular Posts</h3>
                        <ul class="simple-post-list">
                            @foreach ($news->orderBy('id','ASC')->take(6)->get() as $pp)
                            <li>
                                <article>
                                    <div class="post-image">
                                        <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                            <a href="{{ route('welcome.newsDetails', ['news' => $pp->id, 'title' => mySlug($pp->title)]) }}">
                                                <img src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $pp->fi()]) }}" class="border-radius-0" width="50"
                                                    height="50" alt="Simple Ways to Have a Pretty Face">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-info">
                                        <div class="post-meta">
                                            {{ \Carbon\Carbon::parse($pp->created_at)->format('F d, Y') }}
                                        </div>
                                        <h4 class="font-weight-normal text-3 mb-0"><a href="{{ route('welcome.newsDetails', ['news' => $pp->id, 'title' => mySlug($pp->title)]) }}"
                                                class="text-dark">{{ $pp->title }}</a></h4>
                                    </div>
                                </article>
                            </li>
                            @endforeach
                          

                        </ul>

                    </div>
                    <div class="col-md-6">

                        <h3 class="font-weight-bold text-3 mb-0 mt-4 mt-md-0">Recent Posts</h3>

                        <ul class="simple-post-list">

                            @foreach ($news->orderBy('id','DESC')->take(6)->get() as $pp)
                            <li>
                                <article>
                                    <div class="post-image">
                                        <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                            <a href="{{ route('welcome.newsDetails', ['news' => $pp->id, 'title' => mySlug($pp->title)]) }}">
                                                <img src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $pp->fi()]) }}" class="border-radius-0" width="50"
                                                    height="50" alt="Simple Ways to Have a Pretty Face">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-info">
                                        <div class="post-meta">
                                            {{ \Carbon\Carbon::parse($pp->created_at)->format('F d, Y') }}
                                        </div>
                                        <h4 class="font-weight-normal text-3 mb-0"><a href="{{ route('welcome.newsDetails', ['news' => $pp->id, 'title' => mySlug($pp->title)]) }}"
                                                class="text-dark">{{ $pp->title }}</a></h4>
                                    </div>
                                </article>
                            </li>
                            @endforeach
                        </ul>

                    </div>
                </div>

            </div>

            <div class="col-md-3">

                <h3 class="font-weight-bold text-3 pt-1">Featured Posts</h3>

                <div class="pb-2">

                    <div class="mb-4 pb-2">
                        <article
                            class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-2 mb-2">
                            <div class="row">
                                <div class="col">
                                    <a href="blog-post.html">
                                        <img src="img/blog/default/blog-65.jpg" class="img-fluid border-radius-0"
                                            alt="Main Reasons To Stop Texting And Driving">
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="thumb-info-caption-text">
                                        <div class="d-inline-block text-default text-1 mt-2 float-none">
                                            <a href="blog-post.html"
                                                class="text-decoration-none text-color-default">January 12, 2019</a>
                                        </div>
                                        <h4 class="d-block line-height-2 text-4 text-dark font-weight-bold mb-0">
                                            <a href="blog-post.html" class="text-decoration-none text-color-dark">Main
                                                Reasons To Stop Texting And Driving</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>

                    <div class="mb-4 pb-2">
                        <article
                            class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-2 mb-2">
                            <div class="row">
                                <div class="col">
                                    <a href="blog-post.html">
                                        <img src="img/blog/default/blog-66.jpg" class="img-fluid border-radius-0"
                                            alt="Tips to Help You Quickly Prepare your Lunch">
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="thumb-info-caption-text">
                                        <div class="d-inline-block text-default text-1 mt-2 float-none">
                                            <a href="blog-post.html"
                                                class="text-decoration-none text-color-default">January 12, 2019</a>
                                        </div>
                                        <h4 class="d-block line-height-2 text-4 text-dark font-weight-bold mb-0">
                                            <a href="blog-post.html" class="text-decoration-none text-color-dark">Tips to
                                                Help You Quickly Prepare your Lunch</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>

                <aside class="sidebar pb-4">
                    <div id="instafeedNoMargins" class="mb-4 pb-1"></div>
                    <h5 class="font-weight-bold pt-4 mb-2">Tags</h5>
                    <div class="mb-3 pb-1"> 
                        @foreach ($tags as $tag)
                        <a href="{{ route('welcome.tagWisePost',['type'=>'news','tag'=>$tag->id,'title'=>mySlug($tag->name)])}}"><span
                            class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">{{ $tag->name }}</span></a>
                        @endforeach
                        
                        
                    </div> <a href="https://themeforest.net/item/porto-responsive-html5-template/4106987" target="_blank"
                        class="my-4 pt-3 d-block"> <img alt="Porto" class="img-fluid"
                            src="img/blog/blog-ad-1-medium.jpg"> </a>
                    <h5 class="font-weight-bold pt-4">Find us on Facebook</h5>
                    <div class="fb-page" data-href="https://www.facebook.com/OklerThemes/" data-small-header="true"
                        data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true">
                        <blockquote cite="https://www.facebook.com/OklerThemes/" class="fb-xfbml-parse-ignore"><a
                                href="https://www.facebook.com/OklerThemes/">Okler Themes</a></blockquote>
                    </div>
                </aside>

                <h5 class="font-weight-bold pt-1">Recent Comments</h5>

                <ul class="list-unstyled mb-4 pb-1 pt-2">

                    <li class="pb-3 text-2">
                        <a href="#" rel="external nofollow" class="font-weight-bold text-dark">John Doe</a> on <a
                            href="blog-post.html" class="text-dark">Main Reasons To Stop Texting And Driving</a>
                    </li>

                    <li class="pb-3 text-2">
                        <a href="#" rel="external nofollow" class="font-weight-bold text-dark">John Doe</a> on <a
                            href="blog-post.html" class="text-dark">Tips to Help You Quickly Prepare your Lunch</a>
                    </li>

                    <li class="pb-3 text-2">
                        <a href="#" rel="external nofollow" class="font-weight-bold text-dark">John Doe</a> on <a
                            href="blog-post.html" class="text-dark">Why should I buy a smartwatch?</a>
                    </li>

                    <li class="pb-3 text-2">
                        <a href="#" rel="external nofollow" class="font-weight-bold text-dark">John Doe</a> on <a
                            href="blog-post.html" class="text-dark">The best augmented reality smartglasses</a>
                    </li>

                    <li class="pb-3 text-2">
                        <a href="#" rel="external nofollow" class="font-weight-bold text-dark">John Doe</a> on <a
                            href="blog-post.html" class="text-dark">12 Healthiest Foods to Eat for Breakfast</a>
                    </li>
                </ul>

            </div>

        </div>
    </div>
@endsection

@push('js')
@endpush
