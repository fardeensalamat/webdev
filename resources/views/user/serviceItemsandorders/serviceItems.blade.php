@extends('user.layouts.userMaster')
@push('css')


@endpush

@section('content')
    <section class="content">
        <br>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-title"> {{ __('servicelist.all_service_items') }} </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" style="white-space: nowrap">
                        <thead>
                            <tr>
                                <th>{{ __('servicelist.sl') }} </th>
                                <th>{{ __('servicelist.action') }} </th>
                                <th>{{ __('servicelist.image') }} </th>
                                <th>{{ __('servicelist.title') }} </th>
                                <th>{{ __('servicelist.price') }} </th>
                                <th>{{ __('servicelist.negotiations') }} </th>
                                <th>{{ __('servicelist.service_profile') }} </th>
                                <th>{{ __('servicelist.category') }} </th>
                                <th>{{ __('servicelist.workstation') }} </th>
                                <th>{{ __('servicelist.date') }} </th>
                                <th>{{ __('servicelist.status') }} </th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ( $serviceItems as $si)
                           <tr>
                            <td>{{ $si->id }}</td>
                            <td>
                                <div class="btn-group btn-sm">
                                    @if ($si->status == 'approved')
                                    <a href="{{ route('welcome.serviceItemShare',['item'=>$si->id,'profile'=>$si->service_profile_id,'reffer'=>$si->subscriber->subscription_code]) }}" class="btn btn-info">Details</a>
                                    @endif
                                    
                                    <a href="{{ route('subscriber.editServiceItems',['item'=>$si->id,'profile'=>$si->service_profile_id,'subscription'=>$si->subscriber->subscription_code]) }}" class="btn btn-success">Edit</a>
                                </div>
                            </td>
                            <td><img src="{{ route('imagecache', [ 'template'=>'sbixs','filename' => $si->fi() ]) }}" alt=""></td>
                            <td>{{ $si->title }}</td>
                            <td>{{ $si->price }}</td>
                            <td>{{ $si->negotiations ? 'Yes': 'NO' }}</td>
                            <td>{{ $si->serviceProfile ? $si->serviceProfile->name : null }}</td>
                            <td>{{ $si->category ? $si->category->name : null }}</td>
                            <td>{{ $si->workstation ? $si->workstation->title: null }}</td>
                            <td>{{ \Carbon\Carbon::parse($si->created_at)->format('Y-m-d') }}</td>
                            <td>{{ $si->status }}</td>
                        </tr>
                           @empty
                               <tr>
                                   <td colspan="">No Item Found</td>
                               </tr>
                           @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')

@endpush
