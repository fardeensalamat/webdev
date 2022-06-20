@extends('admin.layouts.adminMaster')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/lightslider/lightslider.css') }}">
    <style>
        .card {
            background-color: #fff;
            padding: 14px;
            border: none
        }

        .demo {
            width: 100%
        }

        img {
            display: block;
            height: auto;
            width: 100%
        }

        hr {
            color: #d4d4d4
        }

        .badge {
            padding: 5px !important;
            padding-bottom: 6px !important
        }

        .badge i {
            font-size: 10px
        }

        .profile-image {
            width: 35px
        }

        .comment-ratings i {
            font-size: 13px
        }

        .username {
            font-size: 12px
        }

        .comment-profile {
            line-height: 17px
        }

        .store-image {
            width: 42px
        }

        .dot {
            height: 10px;
            width: 10px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px
        }

        .bullet-text {
            font-size: 12px
        }

        .my-color {
            margin-top: 10px;
            margin-bottom: 10px
        }

        label.radio {
            cursor: pointer
        }

        label.radio input {
            position: absolute;
            top: 0;
            left: 0;
            visibility: hidden;
            pointer-events: none
        }

        label.radio span {
            border: 2px solid #8f37aa;
            display: inline-block;
            color: #8f37aa;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            text-transform: uppercase;
            transition: 0.5s all
        }

        label.radio .red {
            background-color: red;
            border-color: red
        }

        label.radio .blue {
            background-color: blue;
            border-color: blue
        }

        label.radio .green {
            background-color: green;
            border-color: green
        }

        label.radio .orange {
            background-color: orange;
            border-color: orange
        }

        label.radio input:checked+span {
            color: #fff;
            position: relative
        }

        label.radio input:checked+span::before {
            opacity: 1;
            content: '\2713';
            position: absolute;
            font-size: 13px;
            font-weight: bold;
            left: 4px
        }

        .card-body {
            padding: 0.3rem 0.3rem 0.2rem
        }

    </style>

@endpush

@section('content')
    <br>
    <section class="content">
        <div class="card card-solid">
            <div class="card-header bg-info">
                <div class="card-title">All Course Items</div>
            </div>
            @include('alerts.alerts')
            <div class="container-fluid mt-2 mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" style="white-space: nowrap">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Action</th>
                                    <th>Course Name</th>
                                    <th>Instructor Name</th>
                                    <th>Course Price</th>
                                    <th>Status</th>
                                    <th>Negotiable</th>
                                    <th>Active/Inactive</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($courseItems as $item)
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="btn-group btn-sm">
                                                <a href="{{ route('admin.courseItemsEdit', ['item' => $item->id]) }}" class="btn btn-xs btn-primary">Edit</a>
                                                <a href="{{ route('admin.courseItemsDelete', ['item' => $item->id]) }}" class="btn btn-xs btn-danger">Delete</a>
                                                <a href="{{ route('welcome.courseShare',['product'=>$item->id,'profile'=>$item->serviceProfile->id,'reffer'=>$item->subscriber->subscription_code]) }}" class="btn btn-xs btn-warning">Details</a>
                                            </div>
                                            
                                        </td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->ins_name }}</td>
                                        <td>{{ $item->price }} SCB</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            @if ($item->negotiations)
                                            <span class="text-warning">Negotiation</span>
                                            @else
                                            <span class="text-success">Fixed Price</span>
                                            @endif    
                                        </td>
                                        <td>
                                            @if ($item->active)
                                                <span class="text-success">Actived</span>
                                                @else
                                                <span class="text-danger">Inactived</span>
                                            @endif
                                        
                                        </td>
                                    </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $courseItems->render() }}
                </div>
            </div>
    </section>
@endsection
@push('js')
    <script src="{{ asset('assets/lightslider/lightslider.js') }}"></script>

    <script>
        $('#lightSlider').lightSlider({
            gallery: true,
            item: 1,
            loop: true,
            slideMargin: 0,
            thumbItem: 9
        });
    </script>
@endpush
