@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        @include('alerts.alerts')
        <div class="container-fluid">
            <div class="card">
                <div class="card-header w3-indigo">
                    <h3>Notifications</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Message</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php $i = ($notifications->currentPage() - 1) * $notifications->perPage() + 1; ?>
                                @forelse ($notifications as $data)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $data->title }}</td>
                                        <td>{{ $data->messages }}</td>
                                        <td>{{ $data->type }}</td>
                                        <td>{{date("d-m-Y", strtotime($data->date))}}</td>
                                        <td>@if ($data->status=="1")
                                               <p style='color:brown'><b>Unread</b> </p>
                                            @else
                                               <p style="color:#5ad607"><b>Read</b> </p>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('user.notificationsdetails',$data->id)}}" class="btn btn-info btn-xs">View</a>
                                                {{-- <a href="" class="btn btn-warning btn-xs">Read</a>
                                                <a href="" class="btn btn-danger btn-xs">Unread</a> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $notifications->render() }}
                </div>
            </div>
        </div>
        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')



@endpush
