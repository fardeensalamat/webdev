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
                            All Thana
                        </h3>
                        <div class="card-tools">
                            <a class="btn btn-default text-dark btn-sm" href="{{route('admin.createthana')}}" >
                                <i class="fa fa-plus"></i> Add New thana</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">


                            <table class="table table-hover">


                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Bangla Name</th>
                                        <th>District</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php $i = 1; ?>

                                    <?php $i = ($thanas->currentPage() - 1) * $thanas->perPage() + 1; ?>

                                    @foreach ($thanas as $thana)


                                        <tr>

                                            <td>{{ $i }}</td>
                                            <td>{{ $thana->name }}</td>
                                            <td>{{ $thana->bn_name }}</td>
                                            <td>{{ $thana->district->name }}</td>



                                            <td>



                                                <div class="btn-group btn-group-xs">

                                                    <a class="btn btn-info btn-xs"
                                                    href="{{ route('admin.editthana', $thana->id) }}">Edit</a>
                                                    {{-- <a class="btn btn-danger btn-xs"
                                                        href="{{ route('admin.deletethana', $thana->id) }}">Delete</a> --}}



                                                </div>


                                            </td>

                                        </tr>

                                        <?php $i++; ?>

                                    @endforeach
                                </tbody>

                            </table>

                            {{ $thanas->render() }}

                        </div>



                    </div>
                </div>
            </div>
        </div>



        
    </section>
@endsection


@push('js')


    

@endpush
