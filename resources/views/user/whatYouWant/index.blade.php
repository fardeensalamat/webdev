@extends('user.layouts.userMaster')
@push('css')
<link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.css') }}">
    <style>
        .Mydashbord {
            width: 100%;
        }



        select {
            text-transform: none;
            padding: 5px;
            border-radius: 9%;
            border: 2px solid #007bff;
        }

        .click-button-saif {
            border-radius: 88%;
            padding: 10px 15px;
            border: 1px solid #ff5722;
            background-color: #ff5722;
        }

        .demo-saif {
            margin-left: 73px;
            margin-top: -27px;
            /* background: white; */
            padding: 3px 5px;
        }

        .textcontent1-saif {
            position: absolute;
            left: 35%;
            top: 28%;
            color: white;
        }

        .fa-universal-access:before {
            content: "\f29a";
            font-size: 35px;
            color: white
        }

        .fa-heart:before {
            content: "\f004";
            font-size: 35px;
            color: white
        }

        .fa-cart-arrow-down:before {
            content: "\f218";
            font-size: 35px;
            color: white
        }

        .textscontent-saif {

            width: 200px;
            height: 200px;
            background-color: #009688;
            border-radius: 70%;
            margin: 0px auto;
        }

        @media only screen and (max-width: 580px) {
            h3 {
                font-size: 17px;
            }

            .custom-design {
                padding: 0;
            }

            .center {
                text-align: center;
            }

            .details {
                margin: 5px 0px;
            }

            .textscontent-saif {
                width: 120px;
                height: 120px;
                background-color: #009688;
                border-radius: 70%;
                margin: 0px auto;
            }

            .textcontent1-saif {
                position: absolute;
                left: 28%;
                top: 28%;
                color: white;
            }

            .textcontent .fa-heart {
                margin-left: 10px;
            }


        }

        @media only screen and (max-width: 376px) {
            .textscontent-saif {
                width: 100px;
                height: 100px;
                background-color: #009688;
                border-radius: 70%;
                margin: 0px auto;
            }

            .textcontent1-saif {
                position: absolute;
                left: 28%;
                top: 28%;
                color: white;
            }

            .fa-universal-access:before {
                content: "\f29a";
                font-size: 18px;
                color: white
            }

            .fa-heart:before {
                content: "\f004";
                font-size: 18px;
                color: white
            }

            .fa-cart-arrow-down:before {
                content: "\f218";
                font-size: 18px;
                color: white
            }

            .textscontent-saif h3 {
                font-size: 15px;
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
    <section class="content">
        <br>
        <div class="container-fluid">
            <!-- /.row -->
            @include('alerts.alerts')
            <div class="row">
                <div class="col-md-8 col-12 m-auto">
                    <div class="card">
                        <div class="card-header">What You Need?</div>
                        <div class="card-body">
                            <form action="{{ route('user.storeNeeds') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title"
                                        placeholder="I Need Web Developer">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="3"
                                        class="form-control"></textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="closed_date">Closed Date</label>
                                    <input type="date" class="form-control" name="closed_date">
                                    @error('closed_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- <div class="form-group">
                                    <select name="service_station" id="service_station" class="form-control"
                                        data-url="{{ route('user.searchCategoryAjax') }}">
                                        <option value="">Select Service Station</option>
                                        @foreach ($service_station as $st)
                                            <option value="{{ $st->id }}">{{ $st->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('service_station')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <select name="workstation_cat" id="workstation_cat" class="form-control">
                                        <option value="">Select Category</option>
                                        @error('workstation_cat')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="active"> Active
                                    </label>
                                </div> --}}
                                <div class="form-group">
                                    <input class="btn btn-info" type="submit" name="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

            </div>
            <div class="row">
                <div class="col-md-5 col-12 m-auto">
                    <?php $i = 1; ?>

                    <?php $i = ($needs->currentPage() - 1) * $needs->perPage() + 1; ?>
                    @forelse ($needs as $item)
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="font-weight-bold"><a
                                                href="{{ route('user.needDetails', ['need' => $item->id]) }}">{{ mb_substr($item->title, 0, 40) }}..</a>
                                        </h3>
                                        <p class="font-italic">{{ mb_substr($item->description, 0, 120) }}.. </p>

                                        <?php
                                        $closed_date = \Carbon\Carbon::now()->diffInDays($item->closed_date, false);
                                        ?>
                                        <b>
                                            @if ($closed_date <= 2)
                                                <span class="badge badge-danger"> {{ $closed_date }} Day
                                                    Remining</span>
                                            @elseif ($closed_date <=3) <span class="badge badge-warning">
                                                    {{ $closed_date }} Day
                                                    Remining</span>
                                                @else
                                                    <span class="badge badge-success"> {{ $closed_date }} Day
                                                        Remining</span>

                                            @endif


                                        </b>
                                        {{-- @if ($item->avaragePrice() > 0)
                                            <p> <b>Avarage Bidding Price:</b> <span
                                                    class="badge badge-info">{{ number_format($item->avaragePrice(), 2, '.', ' ') }}
                                                    SCB</span> </p>
                                        @endif --}}

                                        <hr>
                                        <div class="d-flext justify-content-between">
                                            <b>Cat: </b> {{ $item->category ? $item->category->name : null }}
                                            <b>SS: </b> {{ $item->workstation ? $item->workstation->title : null }}
                                            @if (Auth::user()->havBizProfile($item->ws_cat_id))

                                                @if (Auth::user()->bidded($item->id))
                                                    <a href="{{ route('user.needDetails', ['need' => $item->id]) }}"
                                                        class="badge badge-warning">Already Bidded</a>
                                                @elseif (Auth::id() == $item->user_id)

                                                @else
                                                    <a href="{{ route('user.needDetails', ['need' => $item->id]) }}"
                                                        class="badge badge-success">Bid Now</a>
                                                @endif
                                            @else
                                            @endif
                                            <b>
                                                <a class="addTofavourite"
                                                    href="{{ route('user.addTofavourite', ['typeid' => $item->id, 'type' => 'needs']) }}">

                                                    @if ($item->isMyFavourite())
                                                        <i class="fas fa-save w3-text-red"></i>
                                                    @else
                                                        <i class="fas fa-save w3-text-gray"></i>
                                                    @endif


                                                </a>
                                            </b>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- //DDD --}}
                            {{-- <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        {{ $item->title }}
                                    </div>
                                    <div class="card-body">
                                        <p>{!! html_entity_decode($item->description) !!}</p>
                                        <b>Cat: </b> {{ $item->category ? $item->category->name : null }}
                                        <b>SS: </b> {{ $item->workstation ? $item->workstation->title : null }}
                                        @if (Auth::user()->havBizProfile($item->ws_cat_id))

                                            @if (Auth::user()->bidded($item->id))
                                                <a href="{{ route('user.needDetails', ['need' => $item->id]) }}"
                                                    class="badge badge-warning">Already Bidded</a>
                                            @elseif (Auth::id() == $item->user_id)

                                            @else
                                                <a href="{{ route('user.needDetails', ['need' => $item->id]) }}"
                                                    class="badge badge-info">Bid Now</a>
                                            @endif
                                        @else
                                        @endif
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    @empty
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    Not Found
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

            </div>
            {{-- <div class="row">
                  @forelse ($needs as $item)
                  <div class="col-md-4">
                      <div class="card">
                          <div class="card-header bg-dark">
                              {{ $item->title }}
                          </div>
                          <div class="card-body">
                              <p>{{ $item->description }}</p>
                              <b>Cat: </b> {{ $item->category->name }}
                              <b>SS: </b> {{ $item->workstation->title }}
                          </div>
                      </div>
                    </div>
                  @empty
                      
                  @endforelse

            </div> --}}
        </div><!-- /.container-fluid -->

    </section>
@endsection

@push('js')

<script src="{{ asset('cp/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $('#description').summernote({
            height: 150
        });
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
    </script>
@endpush
