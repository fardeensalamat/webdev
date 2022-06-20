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
                            All Units
                        </h3>
                        <div class="card-tools">
                            <a class="btn btn-default text-dark btn-sm" href="{{route('admin.createunit')}}" >
                                <i class="fa fa-plus"></i> Add New Units</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">


                            <table class="table table-hover">


                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php $i = 1; ?>

                                    <?php $i = ($units->currentPage() - 1) * $units->perPage() + 1; ?>

                                    @foreach ($units as $unit)


                                        <tr>

                                            <td>{{ $i }}</td>
                                            <td>{{ $unit->name }}</td>
                                            <td>{{ $unit->category->name }}</td>



                                            <td>



                                                <div class="btn-group btn-group-xs">

                                                    <a class="btn btn-info btn-xs"
                                                    href="{{ route('admin.editunit', $unit->id) }}">Edit</a>
                                                    <a class="btn btn-danger btn-xs"
                                                        href="{{ route('admin.deleteunit', $unit->id) }}">Delete</a>



                                                </div>


                                            </td>

                                        </tr>

                                        <?php $i++; ?>

                                    @endforeach
                                </tbody>

                            </table>

                            {{ $units->render() }}

                        </div>



                    </div>
                </div>
            </div>
        </div>



        
    </section>
@endsection


@push('js')


    

@endpush
