@extends('admin.layouts.adminMaster')

@section('content')
    <section class="content">

        <br>
        <div class="row">

            <div class="col-sm-12">

                @include('alerts.alerts')

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                          Admin Activity Log
                        </h3>
                        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">


                            <table class="table table-hover">


                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Subject</th>
                                        <th>URL</th>
                                        <th>Method</th>
                                        <th>Ip</th>
                                        <th width="300px">User Agent</th>
                                        <th>Admin</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @if($logs->count())
                                        @foreach($logs as $key => $log)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $log->subject }}</td>
                                            <td class="text-success">{{ $log->url }}</td>
                                            <td><label class="label label-info">{{ $log->method }}</label></td>
                                            <td class="text-warning">{{ $log->ip }}</td>
                                            <td class="text-danger">{{ $log->agent }}</td>
                                            <td>{{ $log->admin->name }}</td>
                                            <td>{{ $log->created_at }}</td>
                                            <td>
                                                <div class="btn-group btn-group-xs">

                                                   
                                                    <a class="btn btn-danger btn-xs"
                                                        href="{{ route('admin.LogActivityDelete', $log->id) }}">Delete</a>



                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>

                            </table>

                            {{ $logs->render() }}

                        </div>



                    </div>
                </div>
            </div>
        </div>



        
    </section>
@endsection


@push('js')


    

@endpush
