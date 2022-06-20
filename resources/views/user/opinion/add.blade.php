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
                        <p class="m-0">   {{__('opinions.add_opinions')}}</p>
                        <p class="m-0">
                            <a class="btn btn-dark" href="{{ route('user.myOpinions') }}">   {{__('opinions.my_opinions')}}</a>
                            <a class="btn btn-dark" href="{{ route('user.allOpinions') }}">   {{__('opinions.all_opinions')}}</a>
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-8 col-sm-12 m-auto">
                            <form action="{{ route('user.storeOpinions') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="opinion">{{__('opinions.msg')}}</label>
                                <textarea type='text' name="opinion" id="opinion" cols="3" rows="3" class="form-control"></textarea>
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
