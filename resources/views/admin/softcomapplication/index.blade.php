@extends('admin.layouts.adminMaster')

@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('cp/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
    <section class="content">

        <br>
        <div class="row">

            <div class="col-sm-12">

                @include('alerts.alerts')

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Application List
                        </h3>
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
                                        <th>Status</th>
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
                                                    {{$data->applicantcategory->name ?? ''}}
                                                </td>
                                                <td>{{$data->nid}}</td>
                                                <td>
                                                    @if($data->status==0)
                                                        Pending
                                                    @elseif($data->status==1)
                                                       Approved
                                                    @elseif($data->status==2)
                                                      Rejected
                                                    @endif
                                                </td>
                                                <td><img src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $data->pi()]) }}" alt="..." width="130" class="rounded mb-2 img-thumbnail"></td>
                                                <td>
                                                    <div class="btn-group btn-sm">
                                                        <a href="{{route('admin.applicationdetails',$data->id)}}" class="btn btn-xs btn-warning">Details</a>
                                                        @if($data->status==0)
                                                            <a href="{{route('admin.applicationupdate',['id'=>$data->id,'type'=>'1'])}}" class="btn btn-xs btn-primary">Approved</a>
                                                            <a href="{{route('admin.applicationupdate',['id'=>$data->id,'type'=>'2'])}}" class="btn btn-xs btn-danger">Rejected</a>
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
            </div>
        </div>



        
    </section>
@endsection


@push('js')


    

@endpush
