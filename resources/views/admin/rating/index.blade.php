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
                            All Review And Rating
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">


                            <table class="table table-hover">


                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Rating</th>
                                        <th>Comments</th>
                                        <th>User</th>
                                        <th>Profile</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php $i = 1; ?>

                                    <?php $i = ($rating->currentPage() - 1) * $rating->perPage() + 1; ?>

                                    @foreach ($rating as $rate)


                                        <tr>

                                            <td>{{ $i }}</td>
                                            <td>{{ $rate->rating }}</td>
                                            <td>{{ $rate->comments }}</td>
                                            <td>{{ $rate->user->name }}</td>
                                            <td>{{ $rate->profile->name }}</td>
                                            <td>{{ $rate->status }}</td>
                                            <td>{{ $rate->created_at }}</td>



                                            <td>



                                                <div class="btn-group btn-group-xs">

                                                    <a class="btn btn-info btn-xs"
                                                    href="{{ route('admin.editrating', $rate->id) }}">Edit</a>
                                                    <a class="btn btn-danger btn-xs"
                                                        href="{{ route('admin.deleterating', $rate->id) }}">Delete</a>



                                                </div>


                                            </td>

                                        </tr>

                                        <?php $i++; ?>

                                    @endforeach
                                </tbody>

                            </table>

                            {{ $rating->render() }}

                        </div>



                    </div>
                </div>
            </div>
        </div>



        
    </section>
@endsection


@push('js')


    

@endpush
