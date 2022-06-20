@extends('admin.layouts.adminMaster')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @include('alerts.alerts')
                <div class="card card-primary">
                    <div class="card-header">
                        All Service Profile Products
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped table-border table-sm" style="white-space: nowrap" >
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Action</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Service Station</th>
                                        <th>Category</th>
                                        <th>Service Profile</th>
                                        <th>Purchase Price</th>
                                        <th>Regular Price</th>
                                        <th>Sale Price</th>
                                        <th>Status</th>
                                        <th>Active</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>

                                <?php $i = (($products->currentPage() - 1) * $products->perPage() + 1); ?>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    @if ($product->status == 'approved')
                                                    <a href="{{ route('admin.serviceProductUpdate',['type'=>'reject','product'=>$product->id]) }}" class="btn btn-warning btn-xs">Reject</a>
                                                    @endif


                                                    @if ($product->status == 'pending')
                                                    <a href="{{ route('admin.serviceProductUpdate',['type'=>'approved','product'=>$product->id]) }}" class="btn btn-info btn-xs">Approved</a>
                                                    <a href="{{ route('admin.serviceProductUpdate',['type'=>'reject','product'=>$product->id]) }}" class="btn btn-warning btn-xs">Reject</a>

                                                    @endif

                                                    @if ($product->status == 'reject')
                                                    <a href="{{ route('admin.serviceProductUpdate',['type'=>'approved','product'=>$product->id]) }}" class="btn btn-info btn-xs">Approved</a>
                                                    @endif
                                                    <a href="{{ route('admin.serviceProductDetails',['product'=>$product->id]) }}" class="btn btn-success btn-xs">Details</a>
                                                    @if(Auth::user()->roleItems()->count() < 1)
                                                    <a onclick="return confirm('Are you sure? You want to delete this product');" href="{{ route('admin.serviceProductUpdate',['type'=>'archived','product'=>$product->id]) }}" class="btn btn-danger btn-xs">Delete</a>
                                                    @endif

                                                   
                                                    
                                                </div>
                                            </td>
                                            <td>{{ ucfirst($product->name) }}</td>
                                            <td><img src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $product->fi()]) }}" alt=""></td>
                                            <td>{{ ucfirst($product->workstation->title) }}</td>
                                            <td>{{ ucfirst($product->category->name) }}</td>
                                            <td>{{ ucfirst($product->serviceProfile? $product->serviceProfile->name:null) }} ({{$product->serviceProfile? $product->serviceProfile->id : null  }})</td>
                                            <td>{{ ucfirst($product->purchase_price) }}</td>
                                            <td>{{ ucfirst($product->deleted_price) }}</td>
                                            <td>{{ ucfirst($product->sale_price) }}</td>
                                            <td>
                                                {{ $product->status}}
                                            </td>
                                            <td>@if ($product->active)
                                                <span class="text-success">Active</span>
                                                @else
                                                <span class="text-danger">Inactive</span>
                                            @endif</td>

                                            
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        {{ $products->render() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
