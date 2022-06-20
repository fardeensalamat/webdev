@extends('subscriber.layouts.userMaster')

@push('css')

    <style>
        @media only screen and (max-width: 540px) {
            h3 {
                font-size: 17px;
            }

            .card-body {
                padding: 0;
            }

            .center {
                text-align: center;
            }

            .details {
                margin: 5px 0px;
            }

        }

        @media only screen and (max-width: 786px) {
            .center {
                text-align: center;
            }

            .details {
                margin: 5px 0px;
            }

        }

    </style>

@endpush

@section('content')
    <br>
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                Find A Profile
            </div>
        </div>
        <div class="row">
            {{-- <?php
            //$p = $profiles->where('user_id', \Auth::id())->where('status', false);
            ?>
            @if ($p)
                @foreach ($profiles as $profile)
                    Hello
                @endforeach
            @else
                Hi
            @endif
dddd
            @foreach ($profiles as $profile)
            @if ($profile->status == false and $profile->user_id == \Auth::id())
                
            @endif
        @endforeach --}}
        



            @forelse ($profiles as $profile)

            {{-- @if ($profile->user_id == Auth::id() and ($profile->status == false))
               {{ $profile }}
            @endif --}}
                <div class="col-sm-6 col-md-4 col-12  mt-3 mb-2 mb-md-0">
                    <!-- Box Comment -->
                    <div class="card card-widget p-0">
                        <div class="card-header">
                            <div class="user-block">
                                <a
                                    href="{{ route('welcome.profileShare', ['reffer' => $subscription->subscription_code, 'profile' => $profile]) }}">
                                    <img class=" img-circle"
                                        src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $profile->img_name]) }}"
                                        alt="sans" /></a>
                                <span class="username"><a
                                        href="{{ route('welcome.profileShare', ['reffer' => $subscription->subscription_code, 'profile' => $profile]) }}">{{ custom_name($profile->name, 20) }}</a>
                                </span>
                                <span class="description">{{ ucfirst(custom_name($profile->category->name, 12)) }}
                                    ,{{ ucfirst(custom_name($profile->workstation->title, 12)) }} </span>
                            </div>
                            <!-- /.user-block -->
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Mark as read">
                                    <i class="far fa-circle"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>

                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p class="mb-0">{{ ucfirst(custom_name($profile->short_bio, 120)) }}</p>
                            @if ($profile->freeValues())
                                @foreach ($profile->freeValues()->where('profile_card_display', true) as $value)
                                    @if ($value->field_type == 'string')
                                        <p class="my-0"><b>{{ $value->profile_info_key }}</b>:
                                            {{ $value->profile_info_value }}</p>

                                    @elseif($value->field_type == 'text')

                                        <p class="my-0"><b>{{ $value->profile_info_key }}</b>:</p>
                                        {!! $value->profile_info_value !!}

                                    @elseif($value->field_type == 'integer')

                                        <p class="my-0"><b>{{ $value->profile_info_key }}</b>:
                                            {{ $value->profile_info_value }}</p>

                                    @elseif($value->field_type == 'float')

                                        <p class="my-0"><b>{{ $value->profile_info_key }}</b>:
                                            {{ $value->profile_info_value }}</p>

                                    @elseif($value->field_type == 'image')

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="my-0"><b>{{ $value->profile_info_key }}</b>:
                                                </p>
                                            </div>
                                            <div class="col-sm-6"><img class="rounded w3-border"
                                                    src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $value->profile_info_value]) }}"
                                                    alt="sans" width="100" /></div>
                                        </div>
                                        <br>


                                    @elseif($value->field_type == 'doc')

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="my-0"><b>{{ $value->profile_info_key }}</b>:
                                                </p>
                                            </div>
                                            <div class="col-sm-6"><img class="rounded w3-border"
                                                    src="{{ asset('img/word.png') }}" alt="msword" width="100" />
                                                <a class="btn btn-xs btn-primary"
                                                    href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}"
                                                    download="{{ 'id_' . $profile->id . '_' . $profile->name . '_' . $value->profile_info_key }}">Download</a>
                                            </div>
                                        </div>

                                        <br>

                                    @elseif($value->field_type == 'pdf')

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="my-0"><b>{{ $value->profile_info_key }}</b>:
                                                </p>
                                            </div>
                                            <div class="col-sm-6"><img class="rounded w3-border"
                                                    src="{{ asset('img/pdf.png') }}" alt="pdf" width="100" />
                                                <a class="btn btn-xs btn-primary"
                                                    href="{{ asset('storage/service/profile/' . $value->profile_info_value) }}">Download</a>
                                            </div>

                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <!-- /.card-footer -->
                        <div class="card-footer text-center" style="background-color: #f8f9fa">
                            <p>© Copyright {{ date('Y') }} | {{ $_SERVER['SERVER_NAME'] }}</p>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
            @empty

            @endforelse
        </div>
    @endsection
