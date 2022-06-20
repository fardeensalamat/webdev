@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header {{ $dashboard_title == 'Paid' ? 'w3-deep-purple' : 'w3-green' }}">
                    <h3>{{ $dashboard_title }} {{__('myservices.dashboard')}}</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>{{__('myservices.sl_no')}}</th>
                                    <th>{{__('myservices.action')}}</th>
                                    <th>{{__('myservices.service_station')}}</th>
                                    <th>{{__('myservices.service_category')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl = 1; ?>
                                @forelse ($accounts as $account)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td><a class="btn btn-info btn-xs"
                                                href="{{ route('user.subscriptionDashboard', ['subscription' => $account->subscription_code]) }}">View</a> <span class="badge badge-success">{{ $account->subscription_code }}</span>
                                        </td>
                                        <td><a
                                                href="{{ route('user.subscriptionDashboard', ['subscription' => $account->subscription_code]) }}">{{ $account->workStation->title }}</a>
                                        </td>
                                        <td>{{ $account->category ? $account->category->name : '' }}</td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $accounts->render() }}
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
