@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        @include('alerts.alerts')
        <div class="container-fluid">
            <div class="card">
                <div class="card-header w3-teal">
                    <h3>{{ $status }} Bids</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" style="white-space: nowrap">
                            <thead>
                                <tr>
                                    <th>{{__('bids.sl_no')}}</th>
                                    <th>{{__('bids.action')}}</th>
                                    <th>{{__('bids.work_title')}}</th>
                                    <th>{{__('bids.work_description')}}</th>
                                    <th>{{__('bids.bid_description')}}</th>
                                    <th>{{__('bids.bid_price')}}</th>
                                    <th>{{__('bids.category')}}</th>
                                    <th>{{__('bids.workstation')}}</th>
                                    <th>{{__('bids.service_profile')}}</th>
                                    <th>{{__('bids.status')}}</th>
                                    <th>{{__('bids.delivery_date')}}</th>
                                    {{-- <th>Payment Status</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>

                                <?php $i = ($bids->currentPage() - 1) * $bids->perPage() + 1; ?>
                                @forelse ($bids as $bid)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                          <div class="btn-group btn-sm">
                                            <a href="{{ route('user.myBidDetails',['bid'=>$bid->id]) }}" class="btn btn-info btn-xs">Details</a>
                                            
                                          </div>
                                        </td>
                                        <td><a href="{{ route('user.needDetails',['need'=>$bid->need->id]) }}">{{ $bid->need->title }} </a></td>
                                        <td>{{ mb_substr($bid->need->description,0,20) }}..</td>
                                        <td>{{ $bid->description }}</td>
                                        <td>{{ $bid->price }}</td>
                                        <td>{{ $bid->workstation ? $bid->workstation->title :null }}</td>
                                        <td>{{ $bid->category ? $bid->category->name :null }}</td>
                                        <td><a href="{{ route('welcome.profileShare',['profile'=>$bid->service_profile,'reffer'=>$bid->serviceProfile->ownerSubscription->subscription_code]) }}">{{ $bid->serviceProfile->name }}</a></td>
                                        <td>{{ $bid->status }}</td>
                                        <td>{{ $bid->delivery_date }}</td>
                                        {{-- <td>{{ $bid->paymentStatus()->payment_status }}</td> --}}
                                    </tr>
                                    <?php $i++; ?>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-danger text-center">No Bid Found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $bids->render() }}
            </div>
        </div>

        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')

@endpush
