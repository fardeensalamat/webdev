@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">
        <br>
        <div class="card">
            <div class="card-header bg-info">
                <div class="d-flex justify-content-between">
                 <p>Openion of {{ $opinion->user->name }}</p>
                </div>
            </div>
            <div class="card-body">
                <p><strong>Opinion: </strong>{{ $opinion->opinion }}</p>
            </div>
            <div class="card-footer bg-secondary">
                <p class="">{{ \Carbon\Carbon::parse($opinion->created_at)->diffForHumans() }}</p>
            </div>
        </div>
        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')


@endpush
