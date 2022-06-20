@extends('user.layouts.userMaster')

@push('css')

    <style>
        a.a.active {
            background-color: #17a2b8 !important;
            color: #fff !important;
        }

    </style>

@endpush

@section('content')
    <section class="content">

        <br>
        @include('alerts.alerts')
        <div class="card-body bg-info">
            <div class="d-flex justify-content-between">
                <p class="pt-2 m-0"> {{__('opinions.all_opinions')}}</p>
                <p class="m-0">
                    <a class="btn btn-dark" href="{{ route('user.myOpinions') }}"> {{__('opinions.my_opinions')}}</a>
                    <a class="btn btn-dark" href="{{ route('user.addOpinions') }}"> {{__('opinions.add_opinions')}}</a>
                </p>
            </div>
        </div>

        <div class="row pt-3">
            <div class="col-sm-6 order-sm-12">
                <div class="card" style="border-left:2px solid #17a2b8">
                    <div class="card-body">
                        <div class="tabs">
                            <ul class="nav nav-tabs nav-justified flex-column flex-md-row " style="border: 0.5px solid #17a2b8">
                                <li class="nav-item ">
                                    <a class="nav-link a  font-weight-bold" style="font-weight: 700 !important" href="#popular10" data-toggle="tab">{{__('opinions.popular')}}</a>
                                </li>
                                <li class="nav-item font-weight-bold ">
                                    <a class="nav-link a active" style="font-weight: 700 !important" href="#recent10" data-toggle="tab">{{__('opinions.featured')}}</a>
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
                                                            src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $populerO->user->fi()]) }}"
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
                                                                src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $featuredO->user->fi()]) }}"
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
                    </div>
                </div>
            </div>
            <div class="col-sm-6 order-sm-1">
               <div class="card" style="border-right:2px solid #17a2b8">
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
                                                src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $opinion->user->fi()]) }}"
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
                   {{ $opinions->render() }}
               </div>
            </div>
        </div>
        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')


@endpush
