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
                          Admin Panel:  {{__('employeeReport.employeereport')}}
                        </h3>
                       
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">


                            <table class="table table-hover">


                                <thead>
                                    <tr>
                                        <th>{{__('employeeReport.sl')}}</th>
                                        <th>{{__('employeeReport.type')}}</th>
                                        <th>{{__('employeeReport.date')}}</th>
                                        <th>{{__('employeeReport.note')}}</th>
                                        <th>{{__('employeeReport.specialnote')}}</th>
                                        <th>{{__('employeeReport.userid')}}</th>
                                        <th>{{__('employeeReport.action')}}</th>
        
                                    </tr>
                                </thead>

                                <tbody>

                                <?php $i = 1; ?>

                                

                                @foreach ($datas as $data)


                                    <tr>

                                        <td>{{ $i }}</td>
                                        <td>{{ $data->type }}</td>
                                        <td>{{ $data->date }}</td>
                                        <td>{{ $data->note }}</td>
                                        <td>{{ $data->special_note }}</td>
                                       <td>{{ $data->user->name}}</td>
                                        <td> <a class="btn btn-danger btn-xs" href="{{route('admin.deleteEmployeeReport',$data->id)}}">Delete</a></td>
                                       

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
