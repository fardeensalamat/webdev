@extends('user.layouts.userMaster')

@section('content')
    <br>

    <section class="content">
        <div class="card">
            @include('alerts.alerts')
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        My Profile Worker List
                     </h3>
                 
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" style="white-space: nowrap">
                        <div class="thead">
                            <tr>
                                <th>#SN</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Category</th>
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
                                        <td>{{ $data->worker->name ?? ''}}</td>
                                        <td>{{ $data->worker->mobile ?? ''}}</td>
                                        <td>
                                            {{$data->applicantcategory->name ?? ''}}
                                        </td>
                                        <td>{{$data->serviceprofile->name ?? ''}}</td>
                                        <td>{{$data->sdate ?? ''}} TO {{$data->edate ?? ''}}</td>
                                        <td>
                                            <div class="btn-group btn-group-xs">
                                                <a class="btn btn-info btn-xs"
                                                    href="{{route('user.MyProfileworkerdetails',$data->worker_id)}}">Details</a>
                                                    <a class="btn btn-warning btn-xs"
                                                    href="{{route('user.editworkeraccess',$data->id)}}">Edit</a>
                                                
                                                @if($data->edate <= today() && $data->salary_status==1)
                                                <a class="btn btn-danger btn-xs"
                                                        href="{{ route('user.WorkerRenew',$data->id) }}">Renew</a>

                                                @endif



                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-danger">No Application Found</td>
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
