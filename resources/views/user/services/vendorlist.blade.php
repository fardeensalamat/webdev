@extends('user.layouts.userMaster')

@push('css')
    {{-- <style>
    @media only screen and (max-width: 600px) {
        center {
    text-align: center;
        }
} --}}
    {{-- </style> --}}


@endpush
@section('content')
    <br>

    <section class="content">
        <div class="card">
            @include('alerts.alerts')
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3>All Vendor</h3>
                 
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" style="white-space: nowrap">
                        <div class="thead">
                            <tr>
                                <th>#SN</th>
                                <th>Shop Name</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                            <tbody>
                                <?php $i = 1; ?>
                
                                <?php $i = (($vendors->currentPage() - 1) * $vendors->perPage() + 1); ?>
                                @forelse ($vendors as $vendor)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $vendor->serviceProfile->name ?? ''}}</td>
                                        <td>{{ $vendor->serviceProfile->address ?? ''}}</td>
                                        <td><a href="{{ route('welcome.profileShare', ['profile' => $vendor->service_profile_id, 'reffer' => $subscriber->subscription_code]) }}" class="btn btn-primary">Go To Shop</a></td>
                                    </tr>
                                    <?php $i++; ?>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-danger">No Vendor Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </div>
                    </table>
                </div>
                {{ $vendors->render() }}
            </div>

        </div>
    </section>
@endsection
@push('js')

@endpush
