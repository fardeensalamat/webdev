@extends('subscriber.layouts.userMaster')

@push('css')

    <link rel="stylesheet" href="{{ asset('cp/plugins/summernote/summernote-bs4.css') }}">

@endpush
@section('content')
    <br>

    <section class="content">
        @include('alerts.alerts')
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="card-title">Edit Service Item</div>
                    <div class="card-title "><a class="btn btn-outline-danger" href="{{ route('subscriber.allServiceItems', ['profile' => $serviceProfile->id, 'subscription' => $subscription->subscription_code]) }}">View All Service Items</a></div>
                </div>
               
            </div>
            <div class="card-body">
                <form
                    action="{{ route('subscriber.updateServiceItems', ['profile' => $serviceProfile, 'subscription' => $subscription->subscription_code,'item'=>$serviceItem]) }}"
                    enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Service Title</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ old('title')??$serviceItem->title }}" placeholder="Service Title">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="excerpt">Short Description</label>
                        <textarea name="excerpt" class="form-control" id="excerpt"
                            placeholder="Short Description">{{ old('excerpt')??$serviceItem->excerpt }}</textarea>
                        @error('excerpt')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Service Description</label>
                        <textarea name="description" class="form-control" id="description"
                            placeholder="Service Description">{{ old('description')??$serviceItem->description }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Service Price</label>
                        <input type="number" class="form-control" value="{{ old('price')??$serviceItem->price }}" id="price" name="price" placeholder="Service Price">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="negotiations">
                        <input type="checkbox" name="negotiations" {{ $serviceItem->negotiations ? 'checked':'' }} id="negotiations">
                        Negotiable?</label>
                    </div>
                    <div class="form-group">
                        <label for="active">
                        <input type="checkbox" {{ $serviceItem->active ? 'checked':'' }} name="active" id="active">
                        Active</label>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-info">
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('cp/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('cp/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <script>
        $(function() {
            // Summernote
            $('#description').summernote()
        })
        $(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.filter-container').filterizr({
                gutterPixels: 3
            });
            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
    </script>
@endpush
