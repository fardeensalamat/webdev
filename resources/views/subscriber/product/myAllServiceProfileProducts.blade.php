@extends('subscriber.layouts.userMaster')

@push('css')

    <style>
        @media only screen and (max-width: 540px) {
            h3 {
                font-size: 17px;
            }

            .card-body {
                padding: 0;
            }

            .center {
                text-align: center;
            }

            .details {
                margin: 5px 0px;
            }

        }

        @media only screen and (max-width: 786px) {
            .center {
                text-align: center;
            }

            .details {
                margin: 5px 0px;
            }

        }

    </style>

@endpush

@section('content')
    <br>
    @include('alerts.alerts')
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4>All Products of {{ $profile->name }}({{ $profile->id }}) <br>
                        <strong>Cat: </strong>{{ $profile->category->name }}
                        <strong>SS: </strong>{{ $profile->workstation->title }}

                    </h4>
                    <p><a href="{{ route('subscriber.newProfileProduct', ['profile' => $profile->id, 'subscription' => $subscription->subscription_code]) }}"
                            class="btn btn-success">Add Product</a></p>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" style="white-space: nowrap">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Action</th>
                                <th>Product Name</th>
                                <th>Product image</th>
                                <th>Product Description</th>
                                <th>Purchase Price</th>
                                <th>Deleted Price</th>
                                <th>Sale Price</th>
                                <th>Status</th>
                                <th>Replace Guaranty</th>
                                <th>Max Delivery Days</th>
                                <th>Active/Inactive</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($my_service_products as $product)
                                <tr>
                                    <td>{{ 1 }}</td>
                                    <td>
                                       <div class="btn-group btn-sm">
                                        <a href="{{ route('welcome.productShare', ['product' => $product->id, 'reffer' => $subscription->subscription_code,'profile'=>$profile->id]) }}"
                                            class="btn btn-success btn-xs">View</a>
                                        <a href="{{ route('subscriber.editProfileServiceProduct', ['profile' => $profile->id,'product' => $product->id, 'subscription' => $subscription->subscription_code]) }}"
                                            class="btn btn-info btn-xs">Edit</a>
                                            <a onclick="return confirm('Are you sure? you want to delete this product?')" href="{{ route('subscriber.deleteServiceProfileProduct', ['product' => $product->id, 'subscription' => $subscription->subscription_code]) }}"
                                                class="btn btn-danger btn-xs">Delete</a>
                                       </div>
                                        {{-- <a onclick="return confirm('Are you sure? you want to delete this product?')"
                                            href="{{ route('subscriber.deleteServiceProfileProduct', ['product' => $product->id, 'subscription' => $subscription->subscription_code]) }}"
                                            class="btn btn-danger btn-xs">Delete</a> --}}
                                </td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                     <img 
                                        src="{{ route('imagecache', ['template' => 'ppxxs', 'filename' =>$product->fi()]) }}"
                                        alt="sans" />
                                        
                                        {{-- {{ $product->feature_image_name }} --}}
                                    </td>
                                    <td>
                                        {{ custom_title(html_entity_decode($product->description),20) }}
                                    </td>
                                    <td>{{ $product->purchase_price }}</td>
                                    <td>{{ $product->deleted_price }}</td>
                                    <td>{{ $product->sale_price }}</td>
                                    <td>
                                        @if ($product->status == 'pending')
                                            <span class="text-warning">pending</span>
                                        @elseif ($product->status == 'approved')
                                            <span class="text-success">Approved</span>
                                        @elseif ($product->status == 'canceled')
                                            <span class="text-info">Cancled</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->replace_guaranty?'Guaranteed':'' }}</td>
                                    <td>{{ $product->max_delivery_days }}</td>
                                    <td>
                                        @if ($product->active == 1)
                                            <span class="text-succes">Active</span>
                                        @else
                                            <span class="text-danger">Inactive</span>
                                        @endif
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="50" class="m-auto text-center">No Service product found</td>
                                </tr>

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>




    </section>
@endsection
