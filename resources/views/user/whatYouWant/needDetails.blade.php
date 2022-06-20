@extends('user.layouts.userMaster')
@push('css')

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
            {{-- <div class="row">
                <div class="col-md-5 col-12 m-auto">
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
                                    <input class="btn btn-info" type="submit" name="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                    <div class="col-md-8 col-12 m-auto">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>{{ $need->title }} <div class="span badge badge-warning">({{ $totalBids }} bid)</div>  </h4>
                                    </div>
                                    <div class="card-body">
                                        <p><b>Description: </b>{!! $need->description !!}</p>
                                        <b>Cat: </b> {{ $need->category? $need->category->name:null }}
                                        <b>SS: </b> {{ $need->workstation? $need->workstation->title:null }}
                                        {{-- {{ Auth::user()->havBizProfile($item->ws_cat_id, $item->workstation_id) }} --}}
                                    </div>
                                    @if (!Auth::user()->bidded($need->id) )
                                    <div class="card-footer">
                                        <form action="{{ route('user.storeBid') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="service_profile" value="{{ Auth::user()->havBizProfile($need->ws_cat_id,$need->workstation_id)->id }}">
                                            <input type="hidden" name="need_id" value="{{ $need->id }}">
                                            
                                            <div class="form-group">
                                                <label for="price">Expected Price</label>
                                                <input type="price" class="form-control" name="price"
                                                    placeholder="750">
                                                @error('price')
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
                                                <label for="delivery_date">Delivery Date</label>
                                                 <input type="date" name="delivery_date" class="form-control">
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input class="btn btn-info" type="submit" name="Bid Now">
                                            </div>
                                        </form>
                                    </div>
                                    @endif
                                    
                                </div>
                            </div>
                            <div class="col-12">
                                <?php $i = 1; ?>

                                <?php $i = ($bids->currentPage() - 1) * $bids->perPage() + 1; ?>
                                @forelse ($bids as $bid)
                                    <div class="card {{ $bid->user_id == Auth::id()? 'bg-warning':null }}">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <a href="{{ route('welcome.profileShare',['profile'=>$bid->service_profile,'reffer'=>$bid->serviceProfile->ownerSubscription->subscription_code]) }}">
                                                        {{ $i }}. 
                                                        <img src="{{ route('imagecache', [ 'template'=>'ppsm','filename' => $bid->serviceProfile->fi() ]) }}" alt="" class="rounded-circle">
                                                        {{ $bid->serviceProfile? $bid->serviceProfile->name :null }}
                                                    </a>
                                                </div>
                                                <div class="col-md-5">
                                                   <b>Description: </b> {{ $bid->description }}
                                                </div>
                                                <div class="col-md-4">
                                                    <b>Price: </b> {{ $bid->price }} <small>SCB</small>
                                                    <b>Delivery Date: </b> {{ \Carbon\Carbon::parse($bid->delivery_date)->format('Y-m-d') }} 
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++; ?>
                                @empty
                                    
                                @endforelse
                            </div>
                        </div>
                    </div>

            </div>
            
        </div><!-- /.container-fluid -->

    </section>
@endsection

@push('js')
    <script>
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
