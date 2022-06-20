@extends('user.layouts.userMaster')

@section('content')
    <section class="content">

        <br>
        <div class="row">

            <div class="col-sm-12">

                @include('alerts.alerts')

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                          Withdraw Account List
                        </h3>
                        <div class="card-tools">
                            <a class="btn btn-default text-dark btn-sm" href="{{route('user.addwithdrawalaccount')}}" >
                                <i class="fa fa-plus"></i> Add Withdraw Account</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">


                            <table class="table table-hover">


                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Number</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php $i = 1; ?>
                                    @foreach ($datas as $data)


                                        <tr>

                                            <td>{{ $i }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->number }}</td>
                                            <td>{{ $data->type }}</td>
                                            <td>



                                                <div class="btn-group btn-group-xs">

                                                    <a class="btn btn-info btn-xs"
                                                    href="{{route('user.withdrawalaccountedit',$data->id)}}">Edit</a>
                                                    <a class="btn btn-danger btn-xs"
                                                        href="{{route('user.withdrawalaccountdelete',$data->id)}}">Delete</a>



                                                </div>


                                            </td>

                                        </tr>

                                        <?php $i++; ?>

                                    @endforeach
                                </tbody>

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
