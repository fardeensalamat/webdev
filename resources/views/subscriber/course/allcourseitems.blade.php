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
    @include('alerts.alerts')
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4>All Course of {{ $serviceProfile->name }}({{ $serviceProfile->id }}) <br>
                        <strong>Cat: </strong>{{ $serviceProfile->category->name }}
                        <strong>SS: </strong>{{ $serviceProfile->workstation->title }}

                    </h4>
                    <p><a href="{{ route('subscriber.newCourse', ['profile' => $serviceProfile->id, 'subscription' => $subscription->subscription_code]) }}"
                            class="btn btn-success">Add Course Item</a></p>
                </div>

            </div>
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
                                            <a href="{{ route('subscriber.courseItemsDelete',['item'=>$item->id]) }}" class="btn btn-xs btn-danger">Delete</a>
                                            <a href="{{ route('subscriber.editCourseItems',['item'=>$item->id,'profile'=>$serviceProfile->id,'subscription'=>$subscription->subscription_code]) }}" class="btn btn-xs btn-success">Edit</a>
                                            <a href="{{ route('welcome.courseShare',['product'=>$item->id,'profile'=>$serviceProfile->id,'reffer'=>$subscription->subscription_code]) }}" class="btn btn-xs btn-warning">Details</a>
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
            </div>
        </div>

    </section>
@endsection
