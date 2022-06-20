@extends('admin.layouts.adminMaster')

@push('css')
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
                            All Opinions
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Action</th>
                                        <th>Opinions</th>
                                        <th>User/Tenants</th>
                                        <th>Featured</th>
                                        <th>Status</th>
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>

                                    <?php $i = ($all_opinions->currentPage() - 1) * $all_opinions->perPage() + 1; ?>

                                    @foreach ($all_opinions as $op)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>
                                                <div class="btn-group btn-sm">
                                                    @if(Auth::user()->roleItems()->count() < 1)
                                                    <a onclick="return confirm('are you sure for delete this openion?')" href="{{ route('admin.deleteOpinion',['opinion'=>$op->id]) }}" class="btn btn-danger btn-xs">Delete</a>
                                                    @endif
                                                    <a href="{{ route('admin.viewOpinion',['opinion'=>$op->id]) }}" class="btn btn-info btn-xs">Details</a>
                                                    <a href="{{ route('admin.editOpinion',['opinion'=>$op->id]) }}" class="btn btn-warning btn-xs">Edit</a>

                                                    @if ( $op->status == 'pending')
                                                    <a href="{{ route('admin.updateOpinionStatus',['opinion'=>$op->id,'status'=>'lived']) }}" class="btn btn-success btn-xs">Live</a>
                                                    <a href="{{ route('admin.updateOpinionStatus',['opinion'=>$op->id,'status'=>'cancled']) }}" class="btn btn-secondary btn-xs">Cancele</a>
                                                    @elseif ($op->status == 'cancled')
                                                    <a href="{{ route('admin.updateOpinionStatus',['opinion'=>$op->id,'status'=>'lived']) }}" class="btn btn-success btn-xs">Live</a>
                                                    @endif
                                                    @if ($op->featured == false)
                                                    <a href="{{ route('admin.updateOpinionStatus',['opinion'=>$op->id,'status'=>'featured']) }}" class="btn btn-dark btn-xs">Featured</a>
                                                    @endif
                                                </div>
                                            </td>

                                            <td>{{ $op->opinion }}</td>
                                            <td>
                                                {{ $op->user? $op->user->name :null }} ({{$op->user ? $op->user->id :null }})
                                            </td>
                                            <td>@if ($op->featured)
                                                <span class="text-success">Yes</span>
                                                @else
                                                <span class="text-danger">No</span>
                                            @endif</td>
                                            <td>
                                                @if ($op->status == 'cancled')
                                                    <span class="badge badge-danger">
                                                        Cancled
                                                    </span>
                                                    @elseif ($op->status== 'lived')
                                                    <span class="badge badge-success">
                                                       Lived
                                                    </span>
                                                    @else
                                                    <span class="badge badge-warning">
                                                       Pending
                                                    </span>
                                                @endif
                                            </td>
                                            
                                        </tr>

                                        <?php $i++; ?>

                                    @endforeach
                                </tbody>

                            </table>

                            {{ $all_opinions->render() }}

                        </div>



                    </div>
                </div>
            </div>
        </div>



    </section>
@endsection


@push('js')

@endpush
