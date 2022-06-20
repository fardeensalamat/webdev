@extends('admin.layouts.adminMaster')

@push('css')



@endpush

@section('content')
  <section class="content">

  	<br>
  	<div class="container-fluid">
        <!-- Info boxes -->
        @if (Auth::user()->roleItems()->count() < 1)
        <div class="row">
        	<div class="col-12 col-sm-6 col-md-3">
            <a href="{{ route('admin.serviceProductslist') }}">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-tshirt"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Item</span>
                  <span class="info-box-number">{{$service_item}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            
            </a>
           
          </div>
          <!-- /.col -->
        
          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>
           
              <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ route('admin.serviceProductOrderList') }}">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fab fa-gg"></i></span>
  
                  <div class="info-box-content">
                    <span class="info-box-text">Total Sales</span>
                    <span class="info-box-number">{{$total_order}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </a>
         
           
            </div>
            <!-- /.col -->
     
          

        
            <div class="col-12 col-sm-6 col-md-3">
              <a href="{{ route('admin.serviceProductOrderList') }}">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-money-bill"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Amount</span>
                  <span class="info-box-number">{{$total_order_amount}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </a>
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <a href="{{ route('admin.serviceProductOrderList') }}">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-money-bill"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Sales Commission</span>
                  <span class="info-box-number">{{$commission}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </a>
            </div>
            <!-- /.col -->
         

        </div>
        @endif
        <!-- /.row -->
        <div class="card-body bg-info">
          <h3 class="">Last Five Product Orders</h3>
      </div>
      <div class="card">
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-striped table-white" style="white-space: nowrap">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>Date</th>
                              <th>Tenant</th>
                              <th>Service Profile</th>
                              <th>Quantity</th>
                              <th>Price</th>
                              <th>Payment Status</th>
                              <th>Order Status</th>
                             
                              <th>Action</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                          <?php $i = 1; ?>
                          @forelse ($orders as $order)
                              <tr>
                                  <td>{{ $i++ }}</td>
                                  <td>{{ $order[$order->order_status."_at"]}}</td>
                                  <td>@if ($order->user)
                                      <a class="btn btn-xs {{ $order->user->active ? '' : 'btn-danger' }} w3-round w3-border"
                                          href="{{ route('admin.usersAll', ['user' => $order->user]) }}">{{ $order->user_id }}</a>
                                  @endif</td>
                                  <td>{{ $order->serviceProfile->name }} ({{ $order->service_profile_id }})</td>
                                  <td>{{ $order->total_quantity }}</td>
                                  <td>{{ $order->total_sale_price }}</td>
                                  <td>{{ $order->payment_status }}</td>
                                  <td>{{ $order->order_status }}</td>
                                
                                  <td><a href="{{ route('admin.serviceProductOrderDetails', ['order' => $order->id, 'profile' => $order->service_profile_id]) }}"
                                    class="btn btn-info btn-xs">Details</a></td>
                                  
                              </tr>
                          @empty
                              <tr>
                                  <td colspan="9" class="text-danger">No Order Found</td>
                              </tr>
                          @endforelse
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
        <div class="card">
          <div class="card-header bg-info">
            <div class="card-title">Last Five Service Order</div>
        </div>
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-striped" style="white-space: nowrap">
                      <thead>
                          <tr>
                              <th>#SL</th>
                              <th>Date</th>
                              <th>Item Name</th>
                              {{-- <th>Item Price</th> --}}
                              {{-- <th>Order Price</th> --}}
                              <th>Confirm Price</th>
                              <th>Order Status</th>
                              <th>Payment Status</th>
                              <th>Service Profile</th>
                              <th>User</th>
                             
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @forelse ($serviceItemOrders as $order)
                          <tr>
                             <td>{{ $order->id }}</td>
                             <td>{{ $order->created_at }}</td>
                             <td>{{ $order->serviceitem->title }}</td>
                             {{-- <td>{{ $order->serviceitem->price }}</td> --}}
                             {{-- <td>{{ $order->final_price }}</td> --}}
                             <td>{{ $order->order_confirmed_balance }}</td>
                             <td>{{ $order->order_status }}</td>
                             <td>{{ $order->payment_status }}</td>
                             <td>{{ $order->serviceProfile->name }}</td>
                             <td>{{ $order->user->name }}</td>
                             <td>
                                <div class="btn-group btn-sm">
                                    <a href="{{ route('admin.serviceItemOrdersDetails',['order'=>$order->id]) }}" class="btn btn-info btn-xs">Details</a>
                                </div>
                            </td>
                             
                         </tr>
                          @empty
                              
                          @endforelse
                         
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
        <div class="card-header bg-info">
          <div class="card-title">Last Five Service Items</div>
      </div>
      <div class="container-fluid mt-2 mb-3">
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-striped">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Action</th>
                              <th>Image</th>
                              <th>Service Title</th>
                              <th>Service Description</th>
                              <th>Status</th>
                              <th>Active</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $i = 1; ?>
                          @forelse ($serviceItems as $item)
                              <tr>
                                  <td>{{ $i++ }}</td>
                                  <td>
                                      <div class="btn-group btn-sm">

                                          @if ($item->status == 'pending')
                                              <a href="{{ route('admin.serviceItemsStatusUpdate', ['item' => $item->id,'status'=>'approved']) }}" onclick="return confirm('are you sure? you want to approve this service item?')"
                                                  class="btn btn-warning btn-xs">Approve</a>

                                          @endif


                                          <a href="{{ route('admin.serviceItemsEdit', ['item' => $item->id]) }}"
                                              class="btn btn-info btn-xs">Edit</a>
                                          @if (Auth::user()->roleItems()->count() < 1)
                                              <a href="{{ route('admin.serviceItemsDelete', ['item' => $item->id]) }}"
                                                  class="btn btn-danger btn-xs">Delete</a>
                                          @endif
                                          <a href="{{ route('admin.serviceItemsDetails', ['item' => $item->id]) }}"
                                              class="btn btn-success btn-xs">Details</a>
                                      </div>
                                  </td>
                                  <td><img class="img-fluid"
                                          src="{{ route('imagecache', ['template' => 'sbixs', 'filename' => $item->fi()]) }}"
                                          alt=""></td>
                                  <td>{{ $item->title }}</td>
                                  <td>{{ mb_substr($item->excerpt, 0, 40) }}</td>
                                  <td>
                                      @if ($item->status == 'pending')
                                          <span class="badge badge-danger">Pending</span>
                                      @elseif ($item->status == 'approved')
                                          <span class="badge badge-success">Approved</span>
                                      @endif
                                  </td>
                                  <td>
                                      @if ($item->active)
                                          <span class="badge badge-success">Actived</span>
                                      @else
                                          <span class="badge badge-danger">Inactivate</span>

                                      @endif
                                  </td>
                              </tr> 
                             
                          @empty

                          @endforelse
                      </tbody>
                  </table>
              </div>
          </div>



    
      
  	</div>
  

      </div><!-- /.container-fluid -->
    


  
  </section>
@endsection


@push('js')

 



@endpush

