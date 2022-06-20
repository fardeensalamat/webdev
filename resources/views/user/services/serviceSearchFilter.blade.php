@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">
        <br>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.servicesSearchFilterDashboard') }}" method="get">
                        {{-- @csrf --}}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="service_station" id="service_station" class="form-control"
                                        data-url="{{ route('user.searchCategoryAjax') }}">
                                        <option value="">Select Service Station</option>
                                        @foreach ($service_station as $st)
                                            <option @if ($service_station_id == $st->id) selected @endif value="{{ $st->id }}">{{ $st->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="workstation_cat" id="workstation_cat" required class="form-control">
                                        <option value="">Select Service Station</option>
                                        @foreach ($station_wise_cat as $cat)
                                            <option {{ $selected_category->id == $cat->id ? 'selected' : 'not' }}
                                                value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input class="btn btn-success" type="submit" value="Search">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    <div class="card card-primary card-outline">
                        <div class="card-body p-2">
                            <h3 class="card-title ">Soft Market</h3>
                        </div>
                    </div>
    
                </div>
            </div>
            <div class="row">
                @forelse ( $shops as  $cat )
                    @include('user.softmarkets.includes.shopCardSmall')
                @empty
                    <h3 class="text-danger text-center">No Service Found</h3>
                @endforelse
                <div class="col-md-12">
                    {{ $shops->appends(['pages' => 2, 'service_station' => $service_station_id, 'workstation_cat' => $workstation_cat])->render() }}
                </div>
                {{-- {{ $shops->render() }} --}}
            </div>
            {{-- <div class="card">
                <div class="card-header w3-indigo">
                    <h3>Services Search</h3>
                </div>
                <div class="card-body">
                    <form action="" method="get">
                        <div class="form-group">
                            <select name="service_station" id="service_station" required class="form-control"
                                data-url="{{ route('user.searchCategoryAjax') }}">
                                <option value="">Select Service Station</option>
                                @foreach ($service_station as $st)
                                    <option @if ($service_station_id == $st->id) selected @endif value="{{ $st->id }}">{{ $st->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <select name="workstation_cat" id="workstation_cat" required class="form-control">
                                <option value="">Select Service Station</option>
                                @foreach ($station_wise_cat as $cat)
                                    <option {{ $selected_category->id == $cat->id ? 'selected' : 'not' }}
                                        value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-success" type="submit" value="Search">
                        </div>
                    </form>
                </div>
            </div> --}}
        </div>
        {{-- @if (isset($services))
            <div class="container">
                <div class="row">
                    @forelse ($services as $profile)
                        <div class="col-sm-6 col-md-4 col-12  mt-3 mb-2 mb-md-0">
                            <!-- Box Comment -->
                            <div class="card card-widget p-0">
                                <div class="card-header">
                                    <div class="user-block">
                                        <a
                                            href="{{ route('welcome.profileShare', ['reffer' => $profile->ownerSubscription->subscription_code, 'profile' => $profile]) }}">
                                            <img class=" img-circle"
                                                src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $profile->fi()]) }}"
                                                alt="sans" /></a>
                                        <span class="username"><a
                                                href="{{ route('welcome.profileShare', ['reffer' => $profile->ownerSubscription->subscription_code, 'profile' => $profile]) }}">{{ custom_name($profile->name, 20) }}</a>
                                        </span>
                                        <span
                                            class="description">{{ ucfirst(custom_name($profile->category->name, 12)) }}
                                            ,{{ ucfirst(custom_name($profile->workstation->title, 12)) }} </span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-toggle="tooltip"
                                            title="Mark as read">
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
                        <h3 class="text-danger m-auto">Not Found</h3>
                    @endforelse

                </div>
                {{ $services->appends(['pages' => 2, 'service_station' => $service_station_id, 'workstation_cat' => $workstation_cat])->render() }}

            </div>
        @endif --}}

        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')

    <script>
        function subscribeId(actionUrl) {
            $("#subscribeForm").attr("action", actionUrl);
        }
        $(document).ready(function() {
            $('select').change(function() {
                if ($(this).val() === "new")
                    $('.hideme').show();
                else
                    $('.hideme').hide();
            }).change();
            $('select#service_station').on('change', function() {
                var st = $(this).val();
                var url = $(this).attr('data-url');
                $.ajax({
                    url: url,
                    method: 'post',
                    data: {
                        id: st,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        // console.log(data.subcategories)
                        $('#workstation_cat').empty();
                        $.each(data.categories, function(index, categories) {

                            $('select#workstation_cat').append('<option value="' +
                                categories.id + '">' + categories.name.en +
                                '</option>');
                            // console.log(categories.id);
                        })
                    }
                });
            });


        });
    </script>

@endpush
