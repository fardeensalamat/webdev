@extends('user.layouts.userMaster')
@push('css')

<link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.css') }}">


@endpush

@section('content')
    <section class="content">
        <br>
        <div class="container-fluid">
            <!-- /.row -->
            @include('alerts.alerts')
            <div class="row">
                <div class="col-md-8 col-12 m-auto">
                    <div class="card">
                        <div class="card-header bg-info">Edit Need</div>
                        <div class="card-body">
                            <form action="{{ route('user.myNeedUpdate') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title"
                                        placeholder="I Need Web Developer" value="{{ $need->title ?? old('title')}}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="3"
                                        class="form-control">{{ $need->description ?? old('description')}}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="closed_date">Closed Date</label>
                                    <input type="date" class="form-control" value="{{ \Carbon\Carbon::parse($need->closed_date)->format('Y-m-d') }}" name="closed_date">
                                    @error('closed_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-info" type="submit" value="Update" >
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </section>
@endsection

@push('js')

<script src="{{ asset('cp/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
    
        $('#description').summernote({
            height: 150
        });
</script>
@endpush
