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
                           Applicant Category List
                        </h3>
                        <div class="card-tools">
                            <a class="btn btn-default text-dark btn-sm" href="{{route('admin.createapplicantcategory')}}" >
                                <i class="fa fa-plus"></i> Add New Category</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">


                            <table class="table table-hover">


                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Service Charge</th>
                                        <th>Salary</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php $i = 1; ?>

                                    <?php $i = ($datas->currentPage() - 1) * $datas->perPage() + 1; ?>

                                    @foreach ($datas as $data)


                                        <tr>

                                            <td>{{ $i }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->salary_type }}</td>
                                            <td>{{ $data->service_charge }}</td>
                                            <td>{{ $data->salary_amount }}</td>   
                                            <td>



                                                <div class="btn-group btn-group-xs">

                                                    <a class="btn btn-info btn-xs"
                                                    href="{{route('admin.editapplicantcategory',$data->id)}}">Edit</a>
                                                    <a class="btn btn-danger btn-xs"
                                                        href="{{route('admin.deleteapplicantcategory',$data->id)}}">Delete</a>
                                                </div>


                                            </td>

                                        </tr>

                                        <?php $i++; ?>

                                    @endforeach
                                </tbody>

                            </table>

                            {{ $datas->render() }}

                        </div>



                    </div>
                </div>
            </div>
        </div>



        
    </section>
@endsection


@push('js')


    

@endpush
