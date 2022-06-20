@extends('user.layouts.userMaster')

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
                    <p>Upload New Product <br>
                        <strong> Cat: </strong> {{ $product->category->name }} <strong>SS:
                        </strong>{{ $product->workStation->title }}
                        <strong>Biz Name: </strong>
                        {{ $product->serviceProfile->name }}({{ $product->serviceProfile->id }})

                    </p>
                    {{-- <p><strong>Cat: </strong> {{ $product->category->name  }}</p>
                    <p><strong>SS: </strong>{{ $product->workStation->title }}</p> --}}
                    <p><a href="{{ route('user.myServieProfileProducts') }}"
                            class="btn btn-info">Back</a></p>
                </div>

            </div>
            <div class="card-body">
                <form action="{{ route('subscriber.createServiceProduct') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" name="service_product_id" value="{{ $product->id }}">
                    {{-- <input type="hidden" name="subscription" value="{{ $subscription->subscription_code }}"> --}}

                    <div class="form-group my-2">
                        <label for="name">Product Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ $product->name ?? old('name') }}">
                    </div>
                    <div class="form-group my-2">
                        <label for="purchase_price">Purchase Price</label>
                        <input type="text" name="purchase_price" id="purchase_price" class="form-control"
                            value="{{ $product->purchase_price ?? old('purchase_price') }}" placeholder="Optional">
                    </div>

                    <div class="form-group my-2">
                        <label for="deleted_price">Regular Price</label>
                        <input type="text" name="deleted_price" id="deleted_price" class="form-control"
                            value="{{ $product->deleted_price ?? old('deleted_price') }}" placeholder="Optional">
                    </div>

                    <div class="form-group my-2">
                        <label for="sale_price">Sale Price</label>
                        <input type="text" name="sale_price" id="sale_price" class="form-control"
                            value="{{ $product->sale_price ?? old('sale_price') }}" placeholder="Optional">
                    </div>
                    <div class="form-group my-2">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Select Status</option>
                            <option {{ $product->status == 'draft' ? 'selected' : '' }} value="draft">Draft</option>
                            <option {{ $product->status == 'pending' ? 'selected' : '' }} value="pending">Pending
                            </option>
                        </select>
                    </div>
                    <div class="form-group my-2">
                        <label for="max_delivery_days">Probable Max Delivery Days</label>
                        <input type="number" name="max_delivery_days" id="max_delivery_days" class="form-control"
                            value="{{ $product->max_delivery_days ?? old('max_delivery_days') }}" placeholder="Optional">
                    </div>

                    <div class="form-group my-2">
                        <label for="feature_image_name">Feature Image</label>
                        <input type="file" name="feature_image_name" id="feature_image_name" class="form-control">
                        @if ($product->feature_image_name)
                            <br>
                            <a data-toggle="lightbox"
                            href="{{ route('imagecache', ['template' => 'ppxlg', 'filename' => $product->fi()]) }}">  <img class="img-fluid"
                            src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $product->fi()]) }}"
                            alt=""></a>
                          
                        @endif

                    </div>

                    <div class="form-group">
                        <label>Gallery Image </label>
                        @if ($errors->has('gallery_image'))
                            <p style="color: red;margin: 0;">{{ $errors->first('gallery_image') }}</p>
                        @endif
                        <input name="gallery_image[]" type="file" class="form-control" multiple />

                        @if ($product->galary_image)
                            <br>

                            <div class="row">
                                @foreach ($product->galary_image as $item)
                                    <div class="w3-display-container mx-1">
                                        <a data-toggle="lightbox"
                                            href="{{ route('imagecache', ['template' => 'ppxlg', 'filename' => $item->img_name]) }}"><img
                                                class="img-fluid" style="opacity: .5;"
                                                src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $item->img_name]) }}"
                                                alt=""></a>
                                        <div class="w3-display-topright w3-container">
                                            <a class="text-red" href="{{ route('subscriber.deleteServiceProductImages',['image'=>$item->id]) }}"
                                                onclick="return confirm('are you sure? you want to delete this image');"><i
                                                    class="far fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        @endif
                    </div>

                    <div class="form-group my-2">
                        <input type="checkbox" name="active" id="active" {{ $product->active == 1 ? 'checked' : '' }}>
                        <label for="active">Active</label>
                    </div>
                    <div class="form-group my-2">
                        <input type="checkbox" name="replace_guaranty" id="replace_guaranty" {{ $product->replace_guaranty == 1 ? 'checked' : '' }}>
                        <label for="replace_guaranty">Replacement Guaranteed</label>
                    </div>

                    <div class="form-group my-2">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="8" class="form-control">@if ($product->description) {{ $product->description }} @endif @if (old('description'))
                                        {{ old('description') }}
                                    @endif</textarea>
                    </div>
                    <div class="form-group my-2">
                        <input type="submit" class="btn btn-info">
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
