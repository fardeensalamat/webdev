<style>
        
    .slider-custom-caption {

margin-top: -120px;    
/*border: 1px solid #fff;*/
}

.owl-prev,.owl-next
{
background: #000033 !important;
/* background: #04252b !important; */

}

.slider-card-bg-color
{
background: #00003398 !important;
color: #fff !important;
}
.item-hover-border:hover{
    border: 2px solid white;
}



@media only screen and (max-width: 600px) {
.slider-custom-caption {
margin-top: 0px;  

}

.slider-custom-caption h2
{
font-size: 19px !important;
}


.slider-custom-caption h4
{
font-size: 16px !important;
}


.text-6{
font-size: 18px !important;
}

}


</style>


<div class="z-index-1 appear-animation" data-appear-animation="fadeInDownShorter" data-appear-animation-delay="100">
    <div class="owl-carousel owl-theme full-width owl-loaded owl-drag owl-carousel-init m-0 mb-4" data-plugin-options="{'items': 1, 'loop': true, 'nav': true, 'dots': false,
            {{-- 'animateOut':'fadeOut', --}}
            {{-- 'animateOut': 'slideOutLeft', 'animateIn': 'slideInRight', --}} 'autoplayHoverPause':false,  'autoplay':true, 'autoplayTimeout': 5000}">
          @php 
            $datas=\App\Models\Slider::get();
          @endphp
        @foreach ($datas as $data)   
            <div>
                <img src="{{ route('imagecache', ['template' => 'slider', 'filename' => $data->si()]) }}" class="img-fluid" alt="">

                <div class="row slider-custom-caption">

                
                    <div class="col-md-12">

                        <div class="container p-0">
                            

                            <div class="w3-card">
                                <div class="card w3-card-4 slider-card-bg-color">
                                    <div class="card-body py-1 pb-3 w3-animate-zoom">


                                        <div class="row">
                                            <div class="col-sm-8">

                                                <h2 class="w3-text-white pt-0">{{$data->title}}</h2>
                                                <h4 class="w3-text-white">{{$data->description}}</h4>
                                                
                                            </div>
                                            <div class="col-sm-4">

                                                <div class="text-center">

                                                        <div class="d-none d-sm-block">
                                                            <br> <br>
                                                        </div>

                                                        @if(!Auth::check())
                                                            <a style="background: #000052 !important;" class="  btn btn-xl btn-outline btn-light  w3-indigo btn-quaternary" data-target="#modal_register"  data-toggle="modal" href="#"> <i class="far fa-check-circle"></i> {{$data->linktitle}}</a>
                                                        @endif

                                                

                                                </div>
                                        
                                            </div>
                                        </div>
                                

                                
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
                
            </div>
        @endforeach
        
    </div>
</div>
                 
{{-- <section>
    <div class="container-fluid">
        <div class="">
            <h1><b>Who we are</b></h1>
        </div>
        <div class="row">
            <div class="col-md-4 w-100" style="background: url({{ asset('img/1.jpg') }}) no-repeat center; background-size:auto 100%; height: 400px">
                <div class="card w3-indigo m-2" style="position: absolute; bottom: 5px; right: 0">
                    <div class="p-2 text-justify">
                        Research Council of Health is an independent, specialist awarding organisation based in London, United Kingdom, which pioneers the most innovative qualifications in the healthcare industry. We design, develop, deliver and award qualifications for health professionals.
                        <a class="btn btn-xs"  style="background-color: #e20e5a; color: white" href="">read more</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center" style=" height: 400px; background-color: #F7F7F7">
                <div class="m-auto">
                    <div class="p-2">
                        <div class="my-auto p-2 py-4 text-justify" style="border: 3px solid grey;">
                            <h4>Why Research Council of Health ?</h4>
                            Students, academics, and professionals come to the Research Council of Health from all over the world because of its international presence, collaborative ethos, research excellence and prestigious study programmes in the health sectors.<br>
                                Research Council of Health has built a strong and diverse international network of academics, alumni, students and partners. They all contribute to our mission of improving health care worldwide. 
                                <a class="btn w3-purple btn-xs" href="">read more</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" style="background: url({{ asset('img/2.jpg') }}) no-repeat center; background-size:auto 100%; height: 400px">
                <div class="card w3-indigo m-2" style="position: absolute; bottom: 5px; right: 0">
                    <div class="p-2 text-justify">
                        We work with our impressive partners to fight disease, help people live longer and better lives, protect this planet and strive to make a difference to the world.  Together we make a remarkable impact now and in the future.
                        <a class="btn btn-xs" style="background-color: #e20e5a; color: white" href="">read more</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}


<br>
<section>
    <div class="container" style="margin-top: -60px;">
        <div class="card py-3" style="background-color: #F7F7F7 !important">
            <div class="row">
                <div class="col-md-3 col-sm-6 text-center border-right">
                    {{-- <i class="fas fa-spa fa-5x"></i>     --}}
                    <i class="fas fa-briefcase fa-5x"></i>
                    <h2>Freelancing</h2>
                </div>
                <div class="col-md-3 col-sm-6 text-center border-right">
                    {{-- <i class="fas fa-cogs fa-5x"></i> --}}
                    <i class="fas fa-book-open fa-5x"></i>
                    <h2>Education</h2>
                </div>
                <div class="col-md-3 col-sm-6 text-center border-right">
                    <i class="fas fa-sync-alt fa-5x"></i>
                    <h2>Inclusivity</h2>
                </div>
                <div class="col-md-3 col-sm-6 text-center">
                    <i class="fab fa-connectdevelop fa-5x"></i>
                    <h2>Engagement</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-6">
                <div>
                    <h1 style="font-weight: 800">Our Goals</h1>
                </div>
                <div class="">
                    <p>Soft Commerce Ltd aims at facilitating the people with the ultimate taste of digitalized global world by being a major contributor of the existing government of any country.</p>

                    <p>Primarily we are operating only in Bangladesh and have already introduced a lot of sophisticated digital services to its citizens to convert their sad, miserable and monotonous life into happy, relaxed and aristocratic one.</p>
                    <p> 
                    By our special freelancing platform, we are letting even the common people, who are considered to be the family of SoftCode Int.,  having a very basic knowledge of internet earn a handsome amount of money by doing freelancing work; experts have found this platform as a diamond mine. <br>
                    We have targeted to make a safe, secure and highly profitable trade-space for both the farmers and the consumers where there would be no middlemen through one of our sophisticated digital services named “Farmers’ World”. <br>
                    Education system is going to be completely converted into online education by our super useful service ‘e-Education.’ We want to allow everyone have the taste of premium education online at a very low cost, and at the same time popularize the concept of online education to the mass level.    
                    </p>
                    <p>
                        <a class="btn btn-primary" href="">Read more...</a>
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <br><br><br>
                <div class="row">
                    <div class="col-md-6 p-0 m-0">
                        <div class="w3-blue text-center p-1" style="width: 100%; height: 200px">
                            <div class="item-hover-border h-100 pt-4">
                                <i class="fas fa-heartbeat fa-6x"></i>
                                <h3>Freelancing</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-0 m-0">
                        <div class="w3-lime text-center p-1" style="width: 100%; height: 200px">
                            <div class="item-hover-border h-100 pt-4">
                                <i class="fas fa-laptop fa-6x"></i>
                                <h3>Education</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-0 m-0">
                        <div class="w3-orange text-center p-1" style="width: 100%; height: 200px">
                            <div class="item-hover-border h-100 pt-4">
                                <i class="fas fa-edit fa-6x"></i>
                                <h3>Examination and Assessments</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-0 m-0">
                        <div class="w3-green text-center p-1" style="width: 100%; height: 200px">
                            <div class="item-hover-border h-100 pt-4">
                                <i class="fas fa-users fa-6x"></i>
                                <h3>Join Us</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</section>
{{-- <section class="mt-5">
    <div class="container-fluid p-0 m-0">
        <div>
            <h1 class="px-3" style="font-weight: 800">A New Era for Medical Professionals</h1>
        </div>
        <div class="p-0 m-0" style="background: url({{ asset('img/join-the-college.jpg') }}) no-repeat center; background-size: 100% 100%; height: 400px;">
            <div class="container justift-content-center">
                <div class="row d-flex pt-5">
                    <div class="text-white text-justify my-5 p-3" style="border:2px solid white; margin: auto !important" >
                        
                        <p class="text-white py-2">The role of the medical professionals and scientists has expanded and with it the need for a team of well-trained, competent and caring professionals; this, in turn, has placed a great demand on students, colleges and practices. <br>
                            RCH aims to make training and professional development more accessible and an integral part of medical practice. Training the next generation not only benefits the individuals and the practices, but is essential for the future success of the profession as a whole and ultimately for peoples welfare.<br>
                            
                        <a class="btn btn-primary" href="">read more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section> --}}

{{-- work station list --}}
<div class="container mt-lg-0 mt-3">
    <section class="page-header page-header-modern page-header-background page-header-background-sm overlay overlay-color-primary overlay-show overlay-op-8 mb-5" style="background-image: url(img/page-header/page-header-elements.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-self-center p-static order-2 text-center">
                    <h1>Available Work Station For You</h1>    
                </div>
            </div>
        </div>
    </section>
</div>
    @php
        $workstations = App\Models\WorkStation::latest()->paginate(16);
    @endphp
<section>
    <div class="container">
        <div class="row">
            @foreach ($workstations as $item)
            <div class="col-md-6 col-lg-3 mb-5 mb-lg-4">
                <div class="w3-card">
                    <div class="card">
                        <a href="{{route('welcome.workstationDetails',$item)}}">
                        <img class="card-img-top" src="{{ route('imagecache', [ 'template'=>'cpmd','filename' => $item->imageName() ]) }}" alt="Card Image">
                        </a>
                        <div class="card-body px-2 py-1">
                            <h4 class="card-title mb-1 text-4 p-0 font-weight-bold ">{{$item->title}}</h4>
                            <p class="card-text mb-0">{{$item->description}}</p>
                            <a href="{{route('welcome.workstationDetails',$item)}}" class="read-more text-color-primary font-weight-semibold text-2">Read More <i class="fas fa-angle-right position-relative top-1 ml-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
    
    
</section>
{{-- ./work station list --}}

{{-- Events & News Section --}}
<section class="mt-5">
    <div class="container">
        <div>
            <h1 class="px-3" style="font-weight: 800">Events</h1>
        </div>
        <div class="row">
            @php
            $events = App\Models\Blog::where('type', 'event')
                ->where('publish_status', 'published')
                ->orderBy('id', 'DESC')
                ->paginate(9);
                

            @endphp

            @foreach ($events as  $event)
            <div class="col-md-4 col-sm-6 p-2 mt-3">
                <article class="post post-medium border-0 rounded h-100 w3-hover-shadow-">

                    <div class="post-content">
                        <a href="{{ route('welcome.eventDetails', ['title' => mySlug($event->title), 'event' => $event->id]) }}">
                            <div class="h2 font-weight-semibold text-5 line-height-6 mt-3 mb-2"
                                style="padding: 30px 10px; background: url({{ route('imagecache', ['template' => 'cpxs', 'filename' => $event->fi()]) }}); color: #fff;  border-radius: 20px 5px 5px 5px; ">
                                {{ mb_substr($event->title,0,25) }}</div>

                        </a>
                        <div class="post-meta px-2">
                            <span><i class="fas fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($event->created_at)->format('D') }}  {{ \Carbon\Carbon::parse($event->created_at)->format('d-M-Y') }}</span>

                            <a href="{{ route('welcome.eventDetails', ['title' => mySlug($event->title), 'event' => $event->id]) }}"
                                class="btn btn-outline btn-rounded btn-quaternary float-right btn-with-arrow mb-2">Read More
                                <span><i class="fas fa-chevron-right"></i></span></a>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        <div class="col-md-5 col-12 m-auto">
            {{ $events->render() }}
        </div>
        </div>
    </div>

</section>
<section class="mt-5">
    <div class="container">
        <div>
            <h1 class="px-3" style="font-weight: 800">News</h1>
        </div>
        <div class="row">
            @php
            $news = App\Models\Blog::where('type', 'news')
                ->where('publish_status', 'published')
                ->orderBy('id', 'DESC')
                ->paginate(9);
                

            @endphp

            @foreach ($news as  $new)
            <div class="col-md-4 col-sm-6 p-2 mt-3">
                <article class="post post-medium border-0 rounded h-100 w3-hover-shadow-">

                    <div class="post-content">
                        <a href="{{ route('welcome.newsDetails', ['title' => mySlug($new->title), 'news' => $new->id]) }}">
                            <div class="h2 font-weight-semibold text-5 line-height-6 mt-3 mb-2"
                                style="padding: 30px 10px; background: url({{ route('imagecache', ['template' => 'cpxs', 'filename' => $new->fi()]) }}); color: #fff;  border-radius: 20px 5px 5px 5px; ">
                                {{ mb_substr($new->title,0,25) }}</div>

                        </a>
                        <div class="post-meta px-2">
                            <span><i class="fas fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($new->created_at)->format('D') }}  {{ \Carbon\Carbon::parse($new->created_at)->format('d-M-Y') }}</span>

                            <a href="{{ route('welcome.newsDetails', ['title' => mySlug($new->title), 'news' => $new->id]) }}"
                                class="btn btn-outline btn-rounded btn-quaternary float-right btn-with-arrow mb-2">Read More
                                <span><i class="fas fa-chevron-right"></i></span></a>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        <div class="col-md-5 col-12 m-auto">
            {{ $news->render() }}
        </div>
        </div>
    </div>

</section>

<section class="mt-5">
    <div class="container">
        <div>
            <h1 class="px-3" style="font-weight: 800">Blogs</h1>
        </div>
        <div class="row">
            @php
            $blogs = App\Models\Blog::where('type', 'blog')
                ->where('publish_status', 'published')
                ->orderBy('id', 'DESC')
                ->paginate(6);
                

            @endphp

            @foreach ($blogs as  $blog)
            <div class="col-md-4 col-sm-6 p-2 mt-3">
                <article class="post post-medium border-0 rounded h-100 w3-hover-shadow-">

                    <div class="post-content">
                        <a href="{{ route('welcome.blogDetails', ['title' => mySlug($blog->title), 'blog' => $blog->id]) }}">
                            <div class="h2 font-weight-semibold text-5 line-height-6 mt-3 mb-2"
                                style="padding: 30px 10px; background: url({{ route('imagecache', ['template' => 'cpxs', 'filename' => $blog->fi()]) }}); color: #fff;  border-radius: 20px 5px 5px 5px; ">
                                {{ mb_substr($blog->title,0,25) }}</div>

                        </a>
                        <div class="post-meta px-2">
                            <span><i class="fas fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($blog->created_at)->format('D') }}  {{ \Carbon\Carbon::parse($blog->created_at)->format('d-M-Y') }}</span>

                            <a href="{{ route('welcome.blogDetails', ['title' => mySlug($blog->title), 'blog' => $blog->id]) }}"
                                class="btn btn-outline btn-rounded btn-quaternary float-right btn-with-arrow mb-2">Read More
                                <span><i class="fas fa-chevron-right"></i></span></a>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        <div class="col-md-5 col-12 m-auto">
            {{ $news->render() }}
        </div>
        </div>
    </div>

</section>
{{-- End Events and News Section  --}}



<div class="container">
    <h1></h1>
</div>