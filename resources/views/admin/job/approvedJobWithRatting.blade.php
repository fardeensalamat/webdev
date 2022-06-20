@extends('admin.layouts.adminMaster')

@push('css')
@endpush

@section('content')
<br>
<div class="col-md-2"></div>
<div class="col-sm-10">
    @include('alerts.alerts')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Give rating to {{$work->subscriber ? $work->subscriber->name : ''}} ({{$work->subscriber ? $work->subscriber->subscription_code : ''}}) work (Job Id {{$work->job ? $work->job->id : ''}})</h3>
        </div>
        <div class="card-body">
            <form action="{{route('admin.rejectReason',['work'=>$work,'status'=>$status])}}"  method="post" class="form-group">
                @csrf
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-6">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Rate this worker</h3>
                            </div>
                            <div class="card-body">
                                <label for="">Opinion</label>
                                <textarea name="reason" id="" cols="30" rows="2" class="form-control">{!!$work->job_owner_note!!}</textarea>
                                <br>
                                <label for="">Rating (Out of 5)</label>
                                <input type="number" name="ratting" class="form-control" value="5">
                                <br>


                                <button type="submit" class="mt-2 btn btn-success btn-sm">Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>


            </form>
        </div>
    </div>
</div>
@endsection


@push('js')

@endpush
