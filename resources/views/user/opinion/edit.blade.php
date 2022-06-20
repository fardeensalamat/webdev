@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        @include('alerts.alerts')
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="d-flex justify-content-between">
                        <p class="pt-2 m-0"> Edit Opinions</p>
                        <p class="m-0">
                            <a class="btn btn-dark" href="{{ route('user.myOpinions') }}"> My Opinions</a>
                            <a class="btn btn-dark" href="{{ route('user.addOpinions') }}"> Add Opinion</a>
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-8 col-sm-12 m-auto">
                            <form action="{{ route('user.updateOpinion') }}" method="POST">
                                @csrf
                                <input type="hidden" name="opinion_id" value="{{ $user_opinion->id }}">
                                <div class="form-group">
                                    <label for="opinion">Write What in your mind</label>
                                <textarea type='text' name="opinion" id="opinion" cols="3" rows="3" class="form-control">{{ $user_opinion->opinion??'' }}</textarea>
                                @error('opinion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-info">
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')


@endpush
