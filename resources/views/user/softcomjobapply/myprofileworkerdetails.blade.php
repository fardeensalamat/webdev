@extends('user.layouts.userMaster')

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
                            Worker Details
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" style="white-space: nowrap">
                                <div class="thead">
                                    <tr>
                                        <th>Heading</th>
                                        <th>Details</th>
                                    </tr>
                                    <tbody>
                                            <tr>
                                                <td>Name</td>
                                                <td>{{ $data->name ?? ''}}</td>
                                                
                                            </tr>
                                            <tr>
                                                <td>Mobile</td>
                                                <td>{{ $data->mobile ?? ''}}</td>
                                                
                                            </tr>
                                            <tr>
                                                <td>Candidate Image</td>
                                                <td><img src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $data->pi()]) }}" alt="..." width="130" class="rounded mb-2 img-thumbnail"></td>
                                                
                                            </tr>
                                            <tr>
                                                <td>NID</td>
                                                <td>{{ $data->nid ?? ''}}</td>
                                                
                                            </tr>
                                            <tr>
                                                <td>NID Image</td>
                                                <td><img src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $data->ni()]) }}" alt="..." width="130" class="rounded mb-2 img-thumbnail"></td>
                                                
                                            </tr>
                                            <tr>
                                                <td>Category</td>
                                                <td>
                                                    {{$data->applicantcategory->name ?? ''}}
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <td>Qualification</td>
                                                <td>
                                                    {!! html_entity_decode($data->qualification) !!}
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <td>Description</td>
                                                <td>
                                                    {!! html_entity_decode($data->description) !!}
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>
                                                    @if($data->status==0)
                                                        Pending
                                                    @elseif($data->status==1)
                                                       Approved
                                                    @elseif($data->status==2)
                                                      Rejected
                                                    @endif
                                                </td>
                                                
                                            </tr>
                                           
                                    </tbody>
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        
    </section>
@endsection


@push('js')


    

@endpush
