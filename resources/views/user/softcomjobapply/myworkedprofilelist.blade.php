@extends('user.layouts.userMaster')

@section('content')
    <br>

    <section class="content">
        <div class="card">
            @include('alerts.alerts')
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        Worked Profile List
                     </h3>
                 
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" style="white-space: nowrap">
                        <div class="thead">
                            <tr>
                                <th>#SN</th>
                                <th>Owner Name</th>
                                <th>Owner Mobile</th>
                                <th>Profile</th>
                                <th>Assign For</th>
                                <th>Action</th>
                            </tr>
                            <tbody>
                                <?php $i = 1; ?>
                
                                <?php $i = (($datas->currentPage() - 1) * $datas->perPage() + 1); ?>
                                @forelse ($datas as $data)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $data->profileowner->name ?? ''}}</td>
                                        <td>{{ $data->profileowner->mobile ?? ''}}</td>
                                        <td>{{$data->serviceprofile->name ?? ''}}</td>
                                        <td>{{$data->sdate ?? ''}} TO {{$data->edate ?? ''}}</td>
                                        <td>
                                            <div class="btn-group btn-group-xs">
                                                @if($data->edate >= today())
                                                    <a class="btn btn-info btn-xs"
                                                    href="{{ route('subscriber.myProfileDetails', ['subscription' => $data->serviceprofile->ownerSubscription->subscription_code, 'profile_type' => $data->serviceprofile->profile_type,'id'=>$data->serviceprofile->id,'worker_id'=>$data->id]) }}">Profile</a>

                                                @endif
                                                @if($data->applicantcategory->name=='Shop Manager')
                                                    @if($data->salary==0)
                                                        <a class="btn btn-danger btn-xs"
                                                        href="{{ route('user.WorkerGetSalary',$data->id) }}">Get Salary</a>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-danger">No Profile Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </div>
                    </table>
                </div>
                {{ $datas->render() }}
            </div>

        </div>
    </section>
@endsection
@push('js')

@endpush
