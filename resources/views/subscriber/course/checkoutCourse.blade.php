@extends('subscriber.layouts.userMaster')

@push('css')

@endpush
@section('content')
    <br>

    <section class="content">
        <div class="card">
            <div class="card-header bg-info">
                <div class="d-flex justify-content-between">
                    <div class="user-block">
                        <div class="a">
                            <img class="img-circle"
                                src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $profile->fi()]) }}"
                                alt="">
                            <span class="username"><b>SS: </b> {{ $profile->workstation->title }}</span>
                            <span class="username"><b>Cat: </b> {{ $profile->category->name }}</span>
                        </div>
                    </div>
                    <div class="user-block">
                        <span class="username"><b>Current Balance: </b> {{ $user->balance }}</span>
                        @if ($user->balance < $total_amount)
                        <a class="username btn btn-warning btn-xs" href="{{ route('user.userBalance') }}">Add Balance</a>
                        
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            @include('alerts.alerts')
           

            <div class="card-body">
                <h4 class="m-auto text-center">Course Information</h4>
                <div class="table-responsive">
                    <table class="table table-striped" style="white-space: nowrap">
                        <div class="thead">
                            <tr>
                                <th>#SN</th>
                                <th>Course name</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </div>
                        <tbody>
                            <?php $i = 1; ?>
                            @forelse ($allCartProducts as $item)
                                @csrf
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->course->title }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->quantity * $item->course->price }}</td>
                                    <td><a class="btn btn-danger btn-xs" onclick="return confirm('Are you sure? You want to delete this product from your cart?')" href="{{ route('subscriber.deleteCartProduct',['cart'=>$item->id,'profile'=>$profile->id,'subscription'=>$subscription->subscription_code]) }}">Delete</a> 
                                       
                                        </td>
                                </tr>
                                <?php $i++; ?>
                            @empty
                            <tr>
                                <td colspan="7" class="text-danger text-center">No Product Found In your Cart</td>
                            </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                   
                   
                </div>
                
                <h4 class="m-auto text-center">Payment Confirmation</h4>
                <article class="box my-3 bg-light p-3">
                    <dl class="list-align text-muted">
                        <dt>Total price:</dt>
                        <dd class="text-right">BDT {{ $total_amount }}</dd>
                    </dl>
                    <dl class="list-align">
                        <dt><strong>Grand Total:</strong></dt>
                        <dd class="text-right">
                            <strong class="grandTotalPrice60">BDT {{ $total_amount }}</strong>
                        </dd>
                    </dl>
                </article>
                <form
                    action="{{ route('subscriber.courseOrderSubmit', ['profile' => $profile->id, 'subscription' => $subscription->subscription_code]) }}"
                    method="post">
                    @csrf
                    <input type="hidden" name="cat_id" placeholder="cat_id" value="{{ old('cat_id') ?? $profile->ws_cat_id }}"
                            class="form-control">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="name" value="{{ old('name') ?? $user->name }}"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="E-mail" class="form-control"
                            value="{{ old('email') ?? $user->email }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" placeholder="phone" class="form-control"
                            value="{{ old('phone') ?? $user->mobile }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="delivery_address"  value="{{ old('address') ?? $user->address }}" placeholder="Delivery Address" class="form-control">
                    </div>
                    <style>
                        #flexRadioDefault1{
                            border:2px solid white;
                            box-shadow:0 0 0 1px #392;
                            appearance:none;
                            border-radius:50%;
                            width:12px;
                            height:12px;
                            background-color:#fff;
                            transition:all ease-in 0.2s;

                            }
                            #flexRadioDefault1:checked{
                            background-color:#392;
                            }
                            #flexRadioDefault2{
                            border:2px solid white;
                            box-shadow:0 0 0 1px #932;
                            appearance:none;
                            border-radius:50%;
                            width:12px;
                            height:12px;
                            background-color:#fff;
                            transition:all ease-in 0.2s;

                            }
                            #flexRadioDefault2:checked{
                            background-color:#932;
                            }
                    </style>
                    <div class="form-group">
                          <div class="form-check form-check-inline">
                            <input class="form-check-input " type="radio" name="paymod" id="flexRadioDefault2" value="bysoft" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                              By Soft Wallet
                            </label>
                          </div>
                    </div>
                  
                     
                  
                    <div class="form-group my-2">
                        <input type="submit" class="btn btn-dark" value="Enroll">
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('js')

@endpush
