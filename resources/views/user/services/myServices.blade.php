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
                    <h3>{{__('myservices.my_business_profiles')}}</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>{{__('myservices.sl_no')}}</th>
                                    <th>{{__('myservices.action')}}</th>
                                    <th>{{__('myservices.service_profile')}}</th>
                                    <th>{{__('myservices.service_station')}}</th>
                                    <th>{{__('myservices.service_category')}}</th>
                                    <th>{{__('myservices.service_type')}}</th>
                                    <th>{{__('myservices.expired_date')}}</th>
                                    <th>{{__('myservices.pay_status')}}</th>
                                    <th>{{__('myservices.status')}}</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl = 1; ?>
                                @forelse ($all_profiles as $profile)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td><a class="btn btn-info btn-xs"
                                                href="{{ route('subscriber.myProfileDetails', ['subscription' => $profile->ownerSubscription->subscription_code, 'profile_type' => $profile->profile_type,'id'=>$profile->id]) }}">View</a>
                                            @if ($profile->status)
                                            @if ($profile->open)
                                            <a class="btn btn-danger btn-xs"
                                                href="{{ route('user.myServicesprofileUpdate', ['profile' => $profile->id,'open'=>"closed"]) }}">Closed</a>
                                        @else
                                            <a class="btn btn-success btn-xs"
                                                href="{{ route('user.myServicesprofileUpdate', ['profile' => $profile->id,'open'=>"open"]) }}">Open</a>
                                        @endif
                                            @endif
                                        </td>
                                        <td><a
                                                href="{{ route('subscriber.myProfileDetails', ['subscription' => $profile->ownerSubscription->subscription_code, 'profile_type' => $profile->profile_type,'id'=>$profile->id]) }}">{{ $profile->name }}</a>
                                        </td>
                                        <td>{{ $profile->workstation->title ?? '' }}</td>
                                        <td>{{ $profile->category->name ?? ''}}</td>
                                        <td>
                                            {{-- {{ $profile->profile_type }} --}}
                                            @if ($profile->profile_type == 'business')
                                                <span class='text-success'>Business</span>
                                            @else
                                                <span class='text-danger'>{{ ucwords($profile->profile_type) }}</span>
                                            @endif

                                        </td>
                                        <td>
                                            {{date("d-m-Y", strtotime( $profile->expired_at)) }}
                                            
                                        </td>
                                        <td>
                                            @if ($profile->paystatus == 1)
                                                <span class='text-success'>Paid</span>
                                            @else
                                            <a class="btn btn-danger btn-xs"
                                            href="{{ route('user.myServicesprofileUpdate', ['profile' => $profile->id,'open'=>"pay"]) }}">Pay</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($profile->status == 1)
                                                <span class='text-success'>Approved</span>
                                            @else
                                                <span class='text-danger'>Pending</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $all_profiles->render() }}
            </div>
        </div>

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
        });
    </script>

@endpush
