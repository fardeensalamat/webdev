@extends('user.layouts.userMaster')

@section('content')
    <br>

    <section class="content">
        <div class="card">
            @include('alerts.alerts')
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        Application List
                     </h3>
                     <div class="card-tools">
                         <a class="btn btn-default text-dark btn-sm" href="{{route('user.SoftcomJobApplyForm')}}" >
                             <i class="fa fa-plus"></i>New Apply</a>
                     </div>
                 
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
                                <th>NID</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            <tbody>
                                <?php $i = 1; ?>
                
                                <?php $i = (($datas->currentPage() - 1) * $datas->perPage() + 1); ?>
                                @forelse ($datas as $data)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $data->name ?? ''}}</td>
                                        <td>{{ $data->mobile ?? ''}}</td>
                                        <td>
                                           {{$data->applicantcategory->name}}
                                        </td>
                                        <td>{{$data->nid}}</td>
                                        <td><img src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $data->pi()]) }}" alt="..." width="130" class="rounded mb-2 img-thumbnail"></td>
                                        <td>
                                            <div class="btn-group btn-group-xs">

                                                {{-- <a class="btn btn-info btn-xs"
                                                href="{{route('user.editdeliveryman',$data->id)}}">Edit</a> --}}
                                                <a class="btn btn-danger btn-xs"
                                                    href="{{route('user.SoftcomJobApplyDelete',$data->id)}}">Delete</a>



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
