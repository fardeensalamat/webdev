@extends('subscriber.layouts.userMaster')

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
                    <h3>All Customer</h3>
                    <p><strong>Cat: </strong>{{ $profile->category->name }} <strong>SS:
                        </strong>{{ $profile->workstation->title }}</p>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" style="white-space: nowrap">
                        <div class="thead">
                            <tr>
                                <th>#SN</th>
                                <th>Name</th>
                                <th>Address</th>
                            </tr>
                            <tbody>
                                <?php $i = 1; ?>
                
                                <?php $i = (($customers->currentPage() - 1) * $customers->perPage() + 1); ?>
                                @forelse ($customers as $customer)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $customer->user->name ?? ''}}</td>
                                        <td>{{ $customer->user->address ?? ''}}</td>
                                    </tr>
                                    <?php $i++; ?>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-danger">No Customer Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </div>
                    </table>
                </div>
                {{ $customers->render() }}
            </div>

        </div>
    </section>
@endsection
@push('js')

@endpush
