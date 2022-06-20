@extends('admin.layouts.adminMaster')

@push('css')

<link rel="stylesheet" href="{{ asset('cp/plugins/summernote/summernote.css') }}">

@endpush

@section('content')
    <section class="content">

        <br>
        <div class="container-fluid">
            @include('alerts.alerts')
            <div class="card">
                <div class="card-header bg-success">
                    <h3>Edit Needs <a href="{{ route('admin.needs') }}" class="btn btn-info btn-xs">Back</a></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5 col-12 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.updateNeed') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="need_id" value="{{ $need->id }}">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" name="title"
                                                placeholder="I Need Web Developer"
                                                value="{{ $need->title ?? old(title) }}">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" cols="30" rows="3"
                                                class="form-control">{{ $need->description ?? old('description') }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="service_station">Service Station</label>
                                            <select name="service_station" id="service_station" class="form-control"
                                                data-url="{{ route('user.searchCategoryAjax') }}">
                                                <option value="">Select Service Station</option>
                                                @foreach ($service_station as $st)
                                                    <option {{ $need->workstation_id == $st->id ? 'selected' : null }}
                                                        value="{{ $st->id }}">{{ $st->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('service_station')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="workstation_cat">Category</label>
                                            <select name="workstation_cat" id="workstation_cat" class="form-control">
                                                @if ($categories and $selected_cat)
                                                    @foreach ($categories as $cat)
                                                        <option {{ $selected_cat->id == $cat->id ? 'selected' : null }}
                                                            value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">Select Category</option>
                                                @endif

                                                @error('workstation_cat')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="">Select Status</option>
                                                <option {{ $need->status == 'pending' ? 'selected' : null }}
                                                    value="pending">Pending</option>
                                                <option {{ $need->status == 'rejected' ? 'selected' : null }}
                                                    value="rejected">Rejected</option>
                                                <option {{ $need->status == 'approved' ? 'selected' : null }}
                                                    value="approved">Approved</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input class="btn btn-info" type="submit" name="Update">
                                        </div>
                                    </form>
                                </div>
                            </div>
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
        $('select#service_station').on('change', function() {
            var st = $(this).val();
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: st,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    // console.log(data.subcategories)
                    $('#workstation_cat').empty();
                    $.each(data.categories, function(index, categories) {
                        $('select#workstation_cat').append('<option value="' +
                            categories.id + '">' + categories.name.en +
                            '</option>');
                        // console.log(categories.id);
                    })
                }
            });
        });

        $('#description').summernote();
    </script>



@endpush
