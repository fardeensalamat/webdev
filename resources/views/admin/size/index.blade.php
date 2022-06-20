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
                            All Sizes
                        </h3>
                        <div class="card-tools">
                            <a class="btn btn-default text-dark btn-sm" href="{{route('admin.createsize')}}" >
                                <i class="fa fa-plus"></i> Add New Sizes</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">


                            <table class="table table-hover">


                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Size</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php $i = 1; ?>

                                    <?php $i = ($sizes->currentPage() - 1) * $sizes->perPage() + 1; ?>

                                    @foreach ($sizes as $size)


                                        <tr>

                                            <td>{{ $i }}</td>
                                            <td>{{ $size->name }}</td>
                                            <td>{{ $size->sval }}</td>
                                            <td>{{ $size->category->name }}</td>



                                            <td>



                                                <div class="btn-group btn-group-xs">

                                                    <a class="btn btn-info btn-xs"
                                                    href="{{ route('admin.editsize', $size->id) }}">Edit</a>
                                                    <a class="btn btn-danger btn-xs"
                                                        href="{{ route('admin.deletesize', $size->id) }}">Delete</a>



                                                </div>


                                            </td>

                                        </tr>

                                        <?php $i++; ?>

                                    @endforeach
                                </tbody>

                            </table>

                            {{ $sizes->render() }}

                        </div>



                    </div>
                </div>
            </div>
        </div>



        
    </section>
@endsection


@push('js')


    

@endpush
