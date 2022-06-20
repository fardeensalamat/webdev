@extends('subscriber.layouts.userMaster')

@push('css')
    {{-- <style>
    @media only screen and (max-width: 600px) {
        center {
    text-align: center;
        }
} --}}
    {{-- </style> --}}


@endpush
@section('content')
    <br>
    <section class="content">
        <div class="card">
            @include('alerts.alerts')
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3>Cart Page</h3>
                    <p><b>Cat: </b>{{ $profile->category->name }} <b>SS:
                    </b>{{ $profile->workstation->title }}</p>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" style="white-space: nowrap">
                        <div class="thead">
                            <tr>
                                <th>#SN</th>
                                <th>Product name</th>
                                <th>Product Image</th>
                                <th>Quantity</th>
                                <th>Sale Price</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </div>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php $i = ($allCartProducts->currentPage() - 1) * $allCartProducts->perPage() + 1; ?>
                            @forelse ($allCartProducts as $item)
                            <form action="{{ route('subscriber.updateCartProduct',['cart'=>$item->id]) }}" method="POST">
                                @csrf
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>
                                        <img src="{{ route('imagecache', ['template' => 'ppmd','filename' =>$item->product->fi()]) }}" alt="sans" />
                                    </td>
                                    <td><input type="number" name="quantity" value="{{ $item->quantity }}"></td>
                                    <td>{{ $item->product->sale_price }}</td>
                                    <td>{{ $item->quantity * $item->product->sale_price }}</td>
                                    <td><a class="btn btn-danger btn-xs" onclick="return confirm('Are you sure? You want to delete this product from your cart?')" href="{{ route('subscriber.deleteCartProduct',['cart'=>$item->id,'profile'=>$profile->id,'subscription'=>$subscription->subscription_code]) }}">Delete</a> 
                                        <button class="btn btn-info btn-xs" type="submit">Update</button>
                                        </td>
                                </tr>
                            </form>
                                <?php $i++; ?>
                            @empty
                            <tr>
                                <td colspan="7" class="text-danger text-center">No Product Found In your Cart</td>
                            </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                    {{ $allCartProducts->render() }}
                   
                </div>
            </div>
          <div class="card">
              <div class="card-body">
                <a href="{{ route('welcome.profileShare',['profile'=>$profile->id,'reffer'=>$subscription->subscription_code]) }}" class="btn btn-danger py-2">Continue Shoping </a>
                <a href="{{ route('subscriber.checkoutServiceProducts',['profile'=>$profile->id,'subscription'=>$subscription->subscription_code]) }}" class="btn btn-dark py-2">Checkout</a>
              </div>
          </div>
        </div>
    </section>
@endsection
@push('js')

@endpush
