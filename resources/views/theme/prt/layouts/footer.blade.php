<style>
    .footer-bottom-bg-custom {
        /*background: #003366 !important;*/
        background: #000033 !important;
        /* background: #04252b !important; */


        color: #fff;
    }

    .footer-top-bg-custom {
        /*background: #001a33 !important;*/
        background: #000052 !important;
        /* background: #074351 !important; */

        color: #fff;
    }

</style>
<div class="divider divider-style-4 pattern pattern-1 taller">
    <i class="fas fa-chevron-down w3-hover-shadow"></i>
</div>
<footer id="footer" class="bg-color-primary- footer-top-bg-custom border-top-0 ">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="py-1">
                    @if (isset($websiteParameter->logo_alt))
                        <p class="text-white"><img class="" alt="{{ env('APP_NAME_BIG') }}" width="80"
                                src="{{ asset('storage/logo/' . $websiteParameter->logo_alt) }}"></p>
                    @else
                        <p class="text-white">{{ env('APP_NAME_BIG') }}</p>
                    @endif
                </div>
                <div class="py-1">
                    <i class="fab fa-whatsapp text-4 p-relative text-white"></i>
                    <a class="text-white pl-2"
                        href="tel:{{ $websiteParameter->contact_mobile ?? '' }}">{!! $websiteParameter->contact_mobile ?? '' !!}</a>
                </div>
                <div class="py-1">
                    <i class="far fa-envelope text-4 p-relative text-white"></i>
                    <a class="text-white pl-2"
                        href="mailto:{{ $websiteParameter->contact_email ?? '' }}">{!! $websiteParameter->contact_email ?? '' !!}</a>
                </div>

                <div class="py-1">
                    <i class="fas fa-map-marker-alt text-4 p-relative text-white"></i>
                    <span class="text-4 p-relative text-white">
                        {!! $websiteParameter->footer_address ?? '' !!}
                    </span>

                </div>

            </div>

            <div class="col-md-4 col-sm-6">
                <h4 class="text-white">Our Policies</h4>
                <div class="row">

                    @if (isset($footer))
                        @php
                            if ($footer->count() > 12) {
                                $chnk = $footer->count() / 3;
                            } else {
                                $chnk = 6;
                            }
                        @endphp

                        @foreach ($footer->chunk(6) as $footerChunk)
                            <div class="@if ($chnk == 6)col-md-6 @else col-md-4 @endif">
                                <ul class="list list-icons list-icons-sm mb-0 text-white">
                                    @foreach ($footerChunk as $page)
                                        <li>
                                            <i class="fas fa-angle-right top-8 text-white"></i>
                                            <a class="link-hover-style-1 text-white"
                                                href="{{ route('welcome.page', [$page->id, $page->route_name]) }}">{{ $page->page_title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
            <div class="col-md-2">
                <h4 class="text-white">Our Pages</h4>
                <ul class="list list-icons list-icons-sm mb-0 text-white">
                    <li>
                        <i class="fas fa-angle-right top-8 text-white"></i>
                        <a class="link-hover-style-1 text-white"
                            href="{{ route('welcome.blog', ['type' => 'blog']) }}">Blog
                        </a>
                    </li>
                    <li>
                        <i class="fas fa-angle-right top-8 text-white"></i>
                        <a class="link-hover-style-1 text-white"
                            href="{{ route('welcome.blog', ['type' => 'news']) }}">News
                        </a>
                    </li>
                    <li>
                        <i class="fas fa-angle-right top-8 text-white"></i>
                        <a class="link-hover-style-1 text-white"
                            href="{{ route('welcome.blog', ['type' => 'event']) }}">Events
                        </a>
                    </li>
                    <li>
                        <i class="fas fa-angle-right top-8 text-white"></i>
                        <a class="link-hover-style-1 text-white" href="{{ route('welcome.addNewBlog') }}">Post a blog
                        </a>
                    </li>
                    <li>
                        <i class="fas fa-angle-right top-8 text-white"></i>
                        <a class="link-hover-style-1 text-white" href="{{ route('welcome.postNeed') }}">Post a Need
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-6">
                <h4 class="text-white text-center">Follow Us</h4>

                <div class="pl-lg-5">

                    <p class="text-6 text-center text-white">Social Media</p>

                    <div class="text-center">
                        <a class="text-white px-3" href="{{ $websiteParameter->fb_page_link ?? '' }}"><i
                                class="fab fa-facebook text-5"></i></a>
                        <a class="text-white px-3" href="{{ $websiteParameter->twitter_url ?? '' }}"><i
                                class="fab fa-twitter text-5"></i></a>
                        <a class="text-white px-3" href="{{ $websiteParameter->youtube_url ?? '' }}"><i
                                class="fab fa-youtube text-5"></i></a>
                        <br> <br>
                        <div class="d-none d-sm-block">

                            {{-- <img width="160" class="rounded" src="{{asset('img/mln.jpg')}}" alt="{{env('APP_NAME_BIG')}}"> --}}
                        </div>

                    </div>


                </div>

            </div>

            <?php $socialFbGroups = \App\Models\SocialGroup::where('active', true)
                ->where('type', 'facebook')
                ->latest()
                ->get(); ?>
            <?php $socialYtGroups = \App\Models\SocialGroup::where('active', true)
                ->where('type', 'youtube')
                ->latest()
                ->get(); ?>
                <?php $socialOtGroups = \App\Models\SocialGroup::where('active', true)
                ->where('type', 'others')
                ->latest()
                ->get(); ?>
            {{-- <div class="col-sm-12">
        @if (!count($socialFbGroups) < 1)
        <div class="row">
            <div class="col-xs-6 col-sm-3 col-md-2">
                <p>
                    <i class="fab fa-facebook"></i> Facebook Groups:
                </p>
                @foreach ($socialFbGroups as $sfb)
                <a class="text-white" href="{{ $sfb->link }}">{{ $sfb->title }}</a>
            @endforeach
            </div>
        </div>
        @endif
        @if (!count($socialYtGroups) < 1)
        <div class="row">
            <div class="col-xs-6 col-sm-3 col-md-2">
                <p>
                    <i class="fab fa-youtube"></i> Youtube Groups:
                </p>
                @foreach ($socialYtGroups as $sfb)
                <a class="text-white" href="{{ $sfb->link }}">{{ $sfb->title }}</a>
            @endforeach
            </div>
        </div>
        @endif
    </div> --}}
            @if (!count($socialFbGroups) < 1)
                <div class="col-md-12 col-6 my-2 text-white">
                    <div class="row">
                        <div class="col-sm-2"><i class="fab fa-facebook"></i> Facebook:</div>
                        <div class="col-sm-10">
                            <div class="row">
                            @foreach ($socialFbGroups as $sfb)
                                    <div class="col-xs-6 col-sm-3 col-md-2"> <a class="text-white"
                                            href="{{ $sfb->link }}">{{ $sfb->title }}</a></div>
                            @endforeach
                        </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (!count($socialYtGroups) < 1)
            <div class="col-md-12 col-6 my-2 text-white">
                <div class="row">
                    <div class="col-sm-2"><i class="fab fa-youtube"></i> Youtube:</div>
                    <div class="col-sm-10">
                        <div class="row">
                        @foreach ($socialYtGroups as $syt)
                                <div class="col-xs-6 col-sm-3 col-md-2"> 
                                    <a class="text-white" href="{{ $syt->link }}">{{ $syt->title }}</a>
                                </div>
                        @endforeach
                    </div>
                    </div>
                </div>
            </div>
            @endif
            @if (!count($socialOtGroups) < 1)
            <div class="col-md-12 col-6 my-2 text-white">
                <div class="row">
                    <div class="col-sm-2"><i class="fa fa-heart"></i> Others:</div>
                    <div class="col-sm-10">
                        <div class="row">
                        @foreach ($socialOtGroups as $sot)
                                <div class="col-xs-6 col-sm-3 col-md-2"> 
                                    <a class="text-white" href="{{ $sot->link }}">{{ $sot->title }}</a>
                                </div>
                        @endforeach
                    </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div
        class="footer-copyright bg-color-primary- footer-bottom-bg-custom bg-color-scale-overlay bg-color-scale-overlay-2">
        <div class="bg-color-scale-overlay-wrapper">
            <div class="container py-2">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">

                            <p class="text-white">

                                © Copyright {{ date('Y') }} | {{ $_SERVER['SERVER_NAME'] }} | Site by <a
                                class="text-white" href="{{ url('https://sc-bd.com') }}"
                                title="#softcom">sc-bd.com</a>
                                |<a class="text-white" href="{{ url('assets/softcommerce.apk') }}"
                                    title="#App">Download App</a>
                            <div class="d-none">
                                © Copyright {{ date('Y') }} | {{ env('APP_NAME_BIG') }} | Site by <a
                                    class="text-white" href="{{ url('https://sc-bd.com') }}"
                                    title="#softcom">sc-bd.com</a>|<a
                                    class="text-white" href="{{ url('assets/softcommerce.apk') }}"
                                    title="#App">Download App</a>
                            </div>

                            <br>

                            <img width="160" class="rounded" src="{{ asset('img/pay.png') }}" alt="Pay">

                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</footer>
