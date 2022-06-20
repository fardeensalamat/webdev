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
                           Slider List
                        </h3>
                        <div class="card-tools">
                            <a class="btn btn-default text-dark btn-sm" href="{{route('admin.createslider')}}" >
                                <i class="fa fa-plus"></i> Add New Slider</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">


                            <table class="table table-hover">


                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Link Title</th>
                                        <th>Link</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php $i = 1; ?>

                                    <?php $i = ($datas->currentPage() - 1) * $datas->perPage() + 1; ?>

                                    @foreach ($datas as $data)


                                        <tr>

                                            <td>{{ $i }}</td>
                                            <td>{{ $data->title }}</td>
                                            <td><img class="img-fluid" src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $data->si()]) }}" alt=""></td>
                                            <td>{{ $data->linktitle }}</td>
                                            <td>{{ $data->link }}</td>
                                            <td>{{ $data->description }}</td>
                                            
                                            <td>



                                                <div class="btn-group btn-group-xs">

                                                    <a class="btn btn-info btn-xs"
                                                    href="{{route('admin.editslider',$data->id)}}">Edit</a>
                                                    <a class="btn btn-danger btn-xs"
                                                        href="{{route('admin.deleteslider',$data->id)}}">Delete</a>



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
