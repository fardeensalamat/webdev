@extends('user.layouts.userMaster')

@push('css')


@endpush
@section('content')

    <section class="content">
        <br>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('user.servicesSearchFilterDashboard') }}" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="service_station" id="service_station" class="form-control"
                                    data-url="{{ route('user.searchCategoryAjax') }}">
                                    <option value="">Select Service Station</option>
                                    @foreach ($service_station as $st)
                                        <option value="{{ $st->id }}">{{ $st->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="workstation_cat" id="workstation_cat" class="form-control">
                                    <option value="">Select Category</option>
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
            @forelse ($softmarkets as $softmarket)
            <div class="col-md-3 col-6">
                <a href="{{ route('user.catwiseShop', ['cat' => $softmarket->id]) }}">
                <div class="card">
                    <div class="card-header text-center">
                        <img src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $softmarket->ci()]) }}"
                                                alt="..." width="130" class="mb-2 img-thumbnail img-fluid">
                    </div>
                    <div class="card-body">
                        <p class="m-0"> <a
                            href="{{ route('user.catwiseShop', ['cat' => $softmarket->id]) }}"
                            class="btn w3-purple btn-sm btn-block">{{ mb_substr($softmarket->name,0,16) }}..</a></p>
                    </div>
                </a>
                </div>
            </div>
                {{-- <div class="col-md-3">
                    <a href="{{ route('user.catwiseShop', ['cat' => $softmarket->id]) }}">
                        <div class="card">
                            <div class="bg-white shadow rounded overflow-hidden">
                                <div class="px-4 pt-0 pb-4 cover"
                                    style="background-image: url({{ route('imagecache', ['template' => 'pfism', 'filename' => $softmarket->cai()]) }}); background-size: cover; background-repeat: no-repeat;background-position: center center; z-index:1;">
                                    <div class="media align-items-end profile-head" style=" transform: translateY(5rem);">
                                        <div class="profile m-auto">
                                            <img src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $softmarket->ci()]) }}"
                                                alt="..." width="130" class="mb-2 img-thumbnail"
                                                style="border-radius: 50% !important; z-index: 9999">

                                            <p class="my-1"> <a
                                                    href="{{ route('user.catwiseShop', ['cat' => $softmarket->id]) }}"
                                                    class="btn w3-purple btn-sm btn-block">{{ mb_substr($softmarket->name,0,16) }}..</a></p>
                                        </div>

                                    </div>
                                    <div class=" p-4 d-flex justify-content-end text-center">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <h5 class="font-weight-bold mb-0 d-block">

                                                </h5>
                                                <small class="text-muted"></small>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div> --}}
            @empty

            @endforelse

            <div class="col-md-12">
                {{ $softmarkets->render() }}
            </div>
            
        </div>
        
        {{-- <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @forelse ( $shops as  $cat )
                        @include('user.softmarkets.includes.shopCardSmall')
                    @empty
                        <h3 class="text-danger text-center">No Service Found</h3>
                    @endforelse

                    {{ $shops->render() }}
                </div>
            </div>
        </div> --}}


            {{-- <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="card card-widget mt-1">
                    <div class="card-body p-1">

                        <div class="input-group ">
                            <input type="text"  data-url="{{ route('user.searchLeftCategoryAjax') }}"
                                class="form-control ajax-data-search" placeholder="Category Search"
                                aria-label="Category Search" aria-describedby="basic-addon2" >
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-4 col-md-3">
                <div class="card card-widget">
                    <div class="card-body p-1">
                        <div class="cat-content-div p-1 ajax-data-container">
                            @include('user.softmarkets.includes.leftSideCategoryList')
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-8 col-md-9 col-lg-9">
                <div class="row">
                    @forelse ( $shops as  $cat )
                        @include('user.softmarkets.includes.shopCardSmall')
                    @empty
                        <h3 class="text-danger text-center">No Service Found</h3>
                    @endforelse

                    {{ $shops->render() }}
                </div>
            </div>
        </div> --}}

    </section>
@endsection


@push('js')
    <script type="text/javascript" src="{{ asset('cp/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
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

            $(function() {
                $('.cat-content-div').slimScroll({
                    height: '500px',
                    size: '4px',
                });
            });

        });
    </script>
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
            ///Extra

            $('select#service_station').on('hover', function() {
                alert($(this).val());
            });
            //Extra end

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
