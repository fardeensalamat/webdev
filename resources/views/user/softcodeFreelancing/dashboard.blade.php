@extends('user.layouts.userMaster')

@push('css')


@endpush

@section('content')
    <section class="content">


        <div class="row">
            <div class="col-sm-12">
                <div class="card card-warning card-outline mt-2">
                    <div class="card-body    p-2">
                        <h3 class="card-title"> <i class="fas fa-tasks w3-text-deep-orange"></i> Softcode Freelancing</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                @if ($subscription)


                    <a class="btn btn-app w3-deep-orange w3-round-large" title="Find a job" data-toggle="tooltip"
                        href="{{ route('subscriber.subscriptionFindJob', $subscription->subscription_code) }}">
                        {{-- <span class="badge bg-danger"></span> --}}
                        <i class="fas fa-search w3-text-white"></i> Find a Job
                    </a>

                    <a class="btn btn-app w3-green w3-round-large" title="Post a Job" data-toggle="tooltip"
                        href="{{ route('subscriber.subscriptionPostJob', $subscription->subscription_code) }}">
                        {{-- <span class="badge bg-danger"></span> --}}
                        <i class="fas fa-plus-square w3-text-white"></i> Post a Job
                    </a>


                    <a class="btn btn-app w3-teal w3-round-large" title="My Posted Jobs" data-toggle="tooltip"
                        href="{{ route('subscriber.subscriptionPostedJob', $subscription->subscription_code) }}">
                        {{-- <span class="badge bg-danger"></span> --}}
                        <i class="fas fa-tasks w3-text-white"></i> Posted Jobs
                    </a>

                    <a class="btn btn-app w3-teal w3-round-large" title="My Job-Works" data-toggle="tooltip"
                        href="{{ route('subscriber.subscriptionMyJobWork', $subscription->subscription_code) }}">
                        {{-- <span class="badge bg-danger"></span> --}}
                        <i class="fas fa-tasks w3-text-white"></i> My Works
                    </a>





                @else

                    <div class="card card-widget">
                        <div class="card-body">
                            You need to subscribe, then you will get access.
                        </div>
                    </div>



                @endif

            </div>
        </div>

    </section>
@endsection


@push('js')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>


@endpush
