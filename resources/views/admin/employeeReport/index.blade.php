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
                          Admin Panel:  {{__('employeeReport.employeereport')}}
                        </h3>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">


                            <table class="table table-hover">


                                <thead>
                                    <tr>
                                        <th>{{__('employeeReport.sl')}}</th>
                                        <th>Name</th>
                                        <th>Start Image</th>
                                        <th>End Image</th>
                                        <th>Start Time/Location</th>
                                        <th>End Time/Location</th>
                                        <th>{{__('employeeReport.type')}}</th>
                                        <th>Date</th>

                                        <th>{{__('employeeReport.action')}}</th>

                                    </tr>
                                </thead>

                                <tbody>

                                <?php $i = 1; ?>



                                @foreach ($datas as $data)


                                    <tr>

                                        <td>{{ $i }}</td>
                                        <td>{{ $data->user->name ?? ''}}</td>
                                        <td><img class="img-fluid" src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $data->er()]) }}" alt=""></td>
                                        <td><img class="img-fluid" src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $data->erl()]) }}" alt=""></td>

                                        <td>{{$data->created_at->format('g:i:s A')}} / {{$data->start_location}}</td>
                                        @if($data->status != 'start')
                                        <td>{{$data->updated_at->format('g:i:s A')}}/{{$data->end_location}}</td>
                                        @else
                                            <td></td>
                                        @endif

                                        <td>{{ $data->type }}</td>
                                        <td>{{ $data->date }}</td>

                                        <td>
                                            <a class="btn btn-success btn-xs" href="{{route('admin.deleteEmployeeReport',$data->id)}}">Edit</a><br>

                                            <a class="btn btn-danger btn-xs" href="{{route('admin.deleteEmployeeReport',$data->id)}}">Delete</a>
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

