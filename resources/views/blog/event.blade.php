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
                    <div class="h1 bold text-white">Events</div>
                </div>
                <div class="col-md-4 order-1 order-md-2 align-self-center">
                    <ul class="breadcrumb d-block text-md-right breadcrumb-light">
                        <li><a href="/">Home</a></li>
                        <li class="active">Events</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="col-md-4 m-auto text-center">
                    <form action="{{ route('welcome.blogSearch',['type'=>'event','search'=>'blog','in'=>'in']) }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="q" placeholder="Search">
                            <div class="input-group-append">
                              <span class="input-group-text"><button class="searchBtn" type="submit"><i class="fas fa-search"></i></button></span>
                            </div>
                          </div>
                    </form>
                </div>
            </div>
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
@endsection

@push('js')
@endpush
