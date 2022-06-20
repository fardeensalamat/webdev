@extends('admin.layouts.adminMaster')

@push('css')



@endpush

@section('content')
    <section class="content">
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 m-auto">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3>{{ $need->title }}</h3>
                        </div>
                        <div class="card-body">
                            <p><b>Description: </b> {!! html_entity_decode($need->description) !!}</p>
                            <p><b>Category: </b>{{ $need->category ? $need->category->name : null }}</p>
                            <p><b>WorkStation: </b>{{ $need->workstation ? $need->workstation->title : null }}</p>
                            <p><b>User: </b>{{ $need->user ? $need->user->name : null }}</p>
                            <p><b>Status: </b>
                                @if ($need->status == 'approved')
                                    <span class="badge badge-success">Approved</span>
                                @elseif ($need->status == 'rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                @else
                                    <span class="badge badge-warning">Pending</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection


@push('js')





@endpush
