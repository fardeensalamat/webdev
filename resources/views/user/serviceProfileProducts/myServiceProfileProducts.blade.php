@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        @include('alerts.alerts')
        <div class="container-fluid">
            <div class="card">
                <div class="card-header w3-teal">
                    <h3>{{ __('productlist.products') }} </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" style="white-space: nowrap">
                            <thead>
                                <tr>
                                    <th>{{ __('productlist.sl') }} </th>
                                    <th>{{ __('productlist.action') }} </th>
                                    <th>{{ __('productlist.workstation') }} </th>
                                    <th>{{ __('productlist.category') }} </th>
                                    <th>{{ __('productlist.service_profile') }} </th>
                                    <th>{{ __('productlist.product_name') }} </th>
                                    <th>{{ __('productlist.sale_price') }} </th>
                                    <th>{{ __('productlist.status') }} </th>
                                    {{-- <th>{{ __('productlist.replace_guaranty') }} </th> --}}
                                    {{-- <th>{{ __('productlist.max_delivery_days') }} </th> --}}
                                    <th>{{ __('productlist.active') }} </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <form action="{{ route('user.updateproductpricelist') }}" method="POST">
                                @csrf

                                <?php $i = ($myallProducts->currentPage() - 1) * $myallProducts->perPage() + 1; ?>
                                @forelse ($myallProducts as $product)
                                    <tr>
                                        <input type="hidden" name="id[]" value="{{$product->id}}">
                                        <td>{{ $i }}</td>
                                        <td>
                                            <a href="{{ route('user.editMyServieProfileProducts', ['product' => $product->id]) }}"
                                                class="btn btn-success btn-xs">Edit</a>
                                            {{-- <a onclick="return confirm('Are you sure?. you want to delete this Product?');" href="{{ route('user.deleteMyServieProfileProducts',['product'=>$product->id]) }}" class="btn btn-danger btn-xs">Delete</a> --}}
                                        </td>
                                        <td>{{ $product->workstation->title ?? ''}}</td>
                                        <td>{{ $product->category->name ?? ''}}</td>
                                        <td> {{$product->serviceProfile->name ?? ''}}</td>
                                        <td>{{ $product->name ?? ''}}</td>
                                        <td><input type="text" name="sale_price[]" value="{{ $product->sale_price ?? ''}}" class="form-control"></td>
                                        <td>{{ $product->status ?? ''}}</td>
                                        {{-- <td>{{ $product->replace_guaranty ? 'Guaranteed' : '' }}</td> --}}
                                        {{-- <td>{{ $product->max_delivery_days ?? ''}}</td> --}}
                                        <td>
                                            @if ($product->active)
                                                <a href="{{ route('user.myServieProfileProductsUpdateActive', ['active' => 'inactive', 'product' => $product->id]) }}"
                                                    class="btn btn-success btn-xs">Inactive</a>
                                            @else
                                                <a href="{{ route('user.myServieProfileProductsUpdateActive', ['active' => 'active', 'product' => $product->id]) }}"
                                                    class="btn btn-danger btn-xs">Active</a>
                                            @endif
                                        </td>

                                    </tr>
                                    <?php $i++; ?>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-danger text-center">No Order Found In Your Products
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <td colspan="6"></td>
                                <td><button class="btn btn-info" type="submit">Update Price</button></td>
                            </tfoot>
                        </form>
                        </table>
                    </div>
                </div>
                {{ $myallProducts->render() }}
            </div>

            {{-- <div class="card">
                <div class="card-header w3-teal">
                    <h3>{{ __('productlist.services') }} </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" style="white-space: nowrap">
                            <thead>
                                <tr>
                                    <th>{{ __('productlist.sl') }}</th>
                                    <th>{{ __('productlist.action') }}</th>
                                    <th>{{ __('productlist.workstation') }}</th>
                                    <th>{{ __('productlist.category') }} </th>
                                    <th>{{ __('productlist.service_profile') }} </th>
                                    <th>{{ __('productlist.product_name') }} </th>
                                    <th>{{ __('productlist.status') }}</th>
                                    <th>{{ __('productlist.replace_guaranty') }} </th>
                                    <th>{{ __('productlist.max_delivery_days') }}</th>
                                    <th>{{ __('productlist.active') }}</th>

                          

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>

                                <?php $i = ($myallServices->currentPage() - 1) * $myallServices->perPage() + 1; ?>
                                @forelse ($myallServices as $product)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            <a href="{{ route('user.editMyServieProfileProducts', ['product' => $product->id]) }}"
                                                class="btn btn-success btn-xs">Edit</a>
                                          
                                        </td>
                                        <td>{{ $product->workstation->title }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->service_profile_id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->status }}</td>
                                        <td>{{ $product->replace_guaranty ? 'Guaranteed' : '' }}</td>
                                        <td>{{ $product->max_delivery_days }}</td>
                                        <td>
                                            @if ($product->active)
                                                <a href="{{ route('user.myServieProfileProductsUpdateActive', ['active' => 'inactive', 'product' => $product->id]) }}"
                                                    class="btn btn-success btn-xs">Inactive</a>
                                            @else
                                                <a href="{{ route('user.myServieProfileProductsUpdateActive', ['active' => 'active', 'product' => $product->id]) }}"
                                                    class="btn btn-danger btn-xs">Active</a>
                                            @endif
                                        </td>

                                    </tr>
                                    <?php $i++; ?>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-danger text-center">No Order Found In Your Products
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $myallServices->render() }}
            </div>
        </div> --}}

        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')

    <script>
        function subscribeId(actionUrl) {
            $("#subscribeForm").attr("action", actionUrl);
        }
        $(document).ready(function() {
            $('select').change(function() {
                if ($(this).val() === "new")
                    $('.hideme').show();
                else
                    $('.hideme').hide();
            }).change();
        });
    </script>

@endpush
