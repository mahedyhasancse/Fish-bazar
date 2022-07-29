@extends('layouts.admin.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-white text-center bg-info">
                            <strong>Card Payments</strong>
                        </div>
                        <div class="card-body">
                            <div class="x_content">
                                <table id="card" class="table table-striped table-bordered table-responsive" style="text-align:center;">
                                    <thead>
                                        <th>Order Date</th>
                                        <th>Order Number</th>
                                        <th>Product Details</th>
                                        <th>Specifications</th>
                                        <th>Note & Status </th>
                                        <th>User Details</th>
                                        <th>Order Total</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        @if($order->status=='Payment From Card' )
                                        <tr>
                                            <td>{{$order->created_at->format('d-m-Y H:i')}}</td>
                                            <td>{{$order->order_no}}</td>
                                            <td>
                                                @foreach($order->orderDetails as $od)
                                                <a href="{{asset($od->product->image[0]->image)}}">
                                                    <img width="80px" height="80px" src="{{asset($od->product->image[0]->image)}}" alt="">
                                                </a>
                                                <p class="mb-2">Product Name: <strong> <a href="{{route('productDetails',[$od->product->id,Str::slug($od->product->name)])}}"> {{$od->product->name}}</a></strong></p>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($order->orderDetails as $od)
                                                <p>Product price: <strong>
                                                        @if($od->product->offer)
                                                        <span class="current_price">&#xa3; {{$od->product->offer->offerPrice}}</span><br>
                                                        <del class="old_price">&#xa3; {{$od->product->price}} </del><br>
                                                        @else
                                                        <span class="current_price">&#xa3; {{$od->product->price}}</span><br>
                                                        @endif
                                                    </strong></p>
                                                <p>Order quantity: <strong>{{$od->quantity}}</strong></p>
                                                @endforeach
                                            </td>
                                            <td>
                                                <p>Payment Status: <strong>{{$order->status}}</strong> </p>
                                                @foreach($order->orderDetails as $od)
                                                <p>Order Status: <strong>{{$od->status}}</strong></p>
                                                @endforeach
                                            </td>
                                            <td>
                                                <p>Name: <strong>{{$order->user->username}}</strong></p>
                                                <p>Email: <strong>{{$order->user->email}}</strong></p>
                                                <p>phone: <strong>{{$order->user->phone}}</strong></p>
                                            </td>
                                            <td>
                                                <p> <strong>{{$order->total}} &#128;</strong> </p>
                                            </td>
                                            <td>
                                                <a href="{{route('order.details',$order->id)}}" class="btn btn-info btn-sm mb-2">View Details</a>
                                                <a href="{{route('order.paypal',$order->id)}}" class="btn btn-success btn-sm mb-2">Confirm Order</a>
                                                <!-- <a href="{{route('order.cancel.admin',$order->id)}}" class="btn btn-danger btn-sm">Cancel Order</a> -->
                                                <button type="button" class="btn bg-danger text-white btn-sm" data-toggle="modal" data-target="#exampleModal1">
                                                    Cancel Order
                                                </button>
                                                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <h3 class="text-center p-4 card bg-danger text-white"> Cancel Order?</h3>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn bg-success text-white" data-dismiss="modal">Close</button>
                                                                <a href="{{route('order.cancel.admin',$order->id)}}" class="btn btn-danger text-white">Cancel Order</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-white text-center bg-success">
                            <strong>Payment On PayPal</strong>
                        </div>
                        <div class="card-body">
                            <div class="x_content">
                                <table id="order" class="table table-striped table-bordered table-responsive" style="text-align:center;">
                                    <thead>
                                        <th>Order Date</th>
                                        <th>Order Number</th>
                                        <th>Product Details</th>
                                        <th>Specifications</th>
                                        <th>Note & Status </th>
                                        <th>User Details</th>
                                        <th>Order Total</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        @if($order->status=='Payment On Paypal' )
                                        <tr>
                                            <td>{{$order->created_at->format('d-m-Y H:i')}}</td>
                                            <td>{{$order->order_no}}</td>
                                            <td>
                                                @foreach($order->orderDetails as $od)
                                                <a href="{{asset($od->product->image[0]->image)}}">
                                                    <img width="80px" height="80px" src="{{asset($od->product->image[0]->image)}}" alt="">
                                                </a>
                                                <p class="mb-2">Product Name: <strong> <a href="{{route('productDetails',[$od->product->id,Str::slug($od->product->name)])}}"> {{$od->product->name}}</a></strong></p>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($order->orderDetails as $od)
                                                <p>Product price: <strong>
                                                        @if($od->product->offer)
                                                        <span class="current_price">&#xa3; {{$od->product->offer->offerPrice}}</span><br>
                                                        <del class="old_price">&#xa3; {{$od->product->price}} </del><br>
                                                        @else
                                                        <span class="current_price">&#xa3; {{$od->product->price}}</span><br>
                                                        @endif
                                                    </strong></p>
                                                <p>Order quantity: <strong>{{$od->quantity}}</strong></p>
                                                @endforeach
                                            </td>
                                            <td>
                                                <p>Payment Status: <strong>{{$order->status}}</strong> </p>
                                                @foreach($order->orderDetails as $od)
                                                <p>Order Status: <strong>{{$od->status}}</strong></p>
                                                @endforeach
                                            </td>
                                            <td>
                                                <p>Name: <strong>{{$order->user->username}}</strong></p>
                                                <p>Email: <strong>{{$order->user->email}}</strong></p>
                                                <p>phone: <strong>{{$order->user->phone}}</strong></p>
                                            </td>
                                            <td>
                                                <p> <strong>{{$order->total}} &#128;</strong> </p>
                                            </td>
                                            <td>
                                                <a href="{{route('order.details',$order->id)}}" class="btn btn-info btn-sm mb-2">View Details</a>
                                                <a href="{{route('order.paypal',$order->id)}}" class="btn btn-success btn-sm mb-2">Confirm Order</a>
                                                <!-- <a href="{{route('order.cancel.admin',$order->id)}}" class="btn btn-danger btn-sm">Cancel Order</a> -->


                                                <button type="button" class="btn bg-danger text-white btn-sm" data-toggle="modal" data-target="#exampleModal2">
                                                    Cancel Order
                                                </button>
                                                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <h3 class="text-center p-4 card bg-danger text-white"> Cancel Order?</h3>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn bg-success text-white" data-dismiss="modal">Close</button>
                                                                <a href="{{route('order.cancel.admin',$order->id)}}" class="btn btn-danger text-white">Cancel Order</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-white text-center bg-success">
                            <strong> Cash on Delivery</strong>
                        </div>
                        <div class="card-body">
                            <div class="x_content">
                                <table id="order" class="table table-striped table-bordered table-responsive" style="text-align:center;">
                                    <thead>
                                        <th>Order Date</th>
                                        <th>Order Number</th>
                                        <th>Product Details</th>
                                        <th>Specifications</th>
                                        <th>Note & Status </th>
                                        <th>User Details</th>
                                        <th>Order Total</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        @if($order->status=='Cash on delivery' )
                                        <tr>
                                            <td>{{$order->created_at->format('d-m-Y H:i')}}</td>
                                            <td>{{$order->order_no}}</td>
                                            <td>
                                                @foreach($order->orderDetails as $od)
                                                <a href="{{asset($od->product->image[0]->image)}}">
                                                    <img width="80px" height="80px" src="{{asset($od->product->image[0]->image)}}" alt="">
                                                </a>
                                                <p class="mb-2">Product Name: <strong><a href="{{route('productDetails',[$od->product->id,Str::slug($od->product->name)])}}">{{$od->product->name}}</a></strong></p>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($order->orderDetails as $od)
                                                <p>Product price: <strong>
                                                        @if($od->product->offer)
                                                        <span class="current_price">&#xa3; {{$od->product->offer->offerPrice}}</span><br>
                                                        <del class="old_price">&#xa3; {{$od->product->price}} </del><br>
                                                        @else
                                                        <span class="current_price">&#xa3; {{$od->product->price}}</span><br>
                                                        @endif
                                                    </strong></p>
                                                <p>Order quantity: <strong>{{$od->quantity}}</strong></p>
                                                @endforeach
                                            </td>
                                            <td>
                                                <p>Payment Status: <strong>{{$order->status}}</strong> </p>
                                                @foreach($order->orderDetails as $od)
                                                <p>Order Status: <strong>{{$od->status}}</strong></p>
                                                @endforeach
                                            </td>
                                            <td>
                                                <p>Name: <strong>{{$order->user->username}}</strong></p>
                                                <p>Email: <strong>{{$order->user->email}}</strong></p>
                                                <p>phone: <strong>{{$order->user->phone}}</strong></p>
                                            </td>
                                            <td>
                                                <p> <strong>{{$order->total}} &#128;</strong> </p>
                                            </td>
                                            <td>
                                                <a href="{{route('order.details',$order->id)}}" class="btn btn-info btn-sm mb-2">View Details</a>
                                                <a href="{{route('order.confirm',$order->id)}}" class="btn btn-success btn-sm mb-2">Confirm Order</a>
                                                <!-- <a href="{{route('order.cancel.admin',$order->id)}}" class="btn btn-danger btn-sm">Cancel Order</a> -->
                                                

                                                <button type="button" class="btn bg-danger text-white btn-sm" data-toggle="modal" data-target="#exampleModal3">
                                                    Cancel Order
                                                </button>
                                                <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <h3 class="text-center p-4 card bg-danger text-white"> Cancel Order?</h3>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn bg-success text-white" data-dismiss="modal">Close</button>
                                                                <a href="{{route('order.cancel.admin',$order->id)}}" class="btn btn-danger text-white">Cancel Order</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-white text-center bg-primary">
                            <strong> Processed Orders</strong>
                        </div>
                        <div class="card-body">
                            <div class="x_content">
                                <table id="process_order" class="table table-striped table-bordered table-responsive" style="text-align:center;">
                                    <thead>
                                        <th>Order Date</th>
                                        <th>Order Number</th>
                                        <th>Product Details</th>
                                        <th>Specifications</th>
                                        <th>Note & Status </th>
                                        <th>User Details</th>
                                        <th>Order Total</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        @foreach($order->orderDetails as $p) @endforeach
                                        @if($p->status=='Order Confirmed' || $p->status=='Order shift' || $p->status=='Completed')
                                        <tr>
                                            <td>{{$order->created_at->format('d-m-Y H:i')}}</td>
                                            <td>{{$order->order_no}}</td>
                                            <td>
                                                @foreach($order->orderDetails as $od)
                                                <a href="{{asset($od->product->image[0]->image)}}">
                                                    <img width="80px" height="80px" src="{{asset($od->product->image[0]->image)}}" alt="">
                                                </a>
                                                <p class="mb-2">Product Name: <strong><a href="{{route('productDetails',[$od->product->id,Str::slug($od->product->name)])}}">{{$od->product->name}}</a></strong></p>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($order->orderDetails as $od)
                                                <p>Product price: <strong>
                                                        @if($od->product->offer)
                                                        <span class="current_price">&#xa3; {{$od->product->offer->offerPrice}}</span><br>
                                                        <del class="old_price">&#xa3; {{$od->product->price}} </del><br>
                                                        @else
                                                        <span class="current_price">&#xa3; {{$od->product->price}}</span><br>
                                                        @endif
                                                    </strong></p>
                                                <p>Order quantity: <strong>{{$od->quantity}}</strong></p>
                                                @endforeach
                                            </td>
                                            <td>
                                                <p>Payment Status: <strong>{{$order->status}}</strong> </p>
                                                @foreach($order->orderDetails as $od)
                                                <p>Order Status: <strong>{{$od->status}}</strong></p>
                                                @endforeach
                                            </td>
                                            <td>
                                                <p>Name: <strong>{{$order->user->username}}</strong></p>
                                                <p>Email: <strong>{{$order->user->email}}</strong></p>
                                                <p>phone: <strong>{{$order->user->phone}}</strong></p>
                                            </td>
                                            <td>
                                                <p> <strong>{{$order->total}} &#128;</strong> </p>
                                            </td>
                                            @if($p->status=="Order shift")
                                            <td>
                                                <h4 class="text-success">Product Shift!</h4>
                                            </td>
                                            @elseif($p->status=="Completed")
                                            <td>
                                                <h4 class="text-success">Completed!</h4>
                                                <form action="{{route('order.delete',$order->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" style="">Delete Order</button>
                                                </form>
                                            </td>
                                            @else
                                            <td>
                                                <a href="{{route('order.details',$order->id)}}" class="btn btn-info btn-sm mb-2">View Details</a>

                                                <a href="{{route('product.shift',$order->id)}}" class="btn btn-success btn-sm "> product shipping</a>
                                                <!-- <a href="{{route('order.cancel.admin',$order->id)}}" class="btn btn-danger btn-sm mt-2">Cancel Order</a> -->


                                                <button type="button" class="btn bg-danger text-white btn-sm mt-2" data-toggle="modal" data-target="#exampleModal4">
                                                    Cancel Order
                                                </button>
                                                <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <h3 class="text-center p-4 card bg-danger text-white"> Cancel Order?</h3>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn bg-success text-white" data-dismiss="modal">Close</button>
                                                                <a href="{{route('order.cancel.admin',$order->id)}}" class="btn btn-danger text-white">Cancel Order</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                            @endif
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-danger text-center text-white">
                            Cancel Orders
                        </div>
                        <div class="card-body">
                            <div class="x_content">
                                <table id="cancel_orders" class=" table table-striped table-bordered table-responsive">
                                    <thead>
                                        <th>Order Date</th>
                                        <th>Order Number</th>
                                        <th>Product Details</th>
                                        <th>Specifications</th>
                                        <th>Note & Status </th>
                                        <th>User Details</th>
                                        <th>Order Total</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        @foreach($order->orderDetails as $p) @endforeach
                                        @if($p->status=='Order Cancel' )
                                        <tr>
                                            <td>{{$order->created_at->format('d-m-Y H:i')}}</td>
                                            <td>{{$order->order_no}}</td>
                                            <td>
                                                @foreach($order->orderDetails as $od)
                                                <p class="mb-2">Product Name: <strong><a href="{{route('productDetails',[$od->product->id,Str::slug($od->product->name)])}}">{{$od->product->name}}</a></strong></p>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($order->orderDetails as $od)
                                                <p>Product price: <strong>
                                                        @if($od->product->offer)
                                                        <span class="current_price">&#xa3; {{$od->product->offer->offerPrice}}</span><br>
                                                        <del class="old_price">&#xa3; {{$od->product->price}} </del><br>
                                                        @else
                                                        <span class="current_price">&#xa3; {{$od->product->price}}</span><br>
                                                        @endif
                                                    </strong></p>
                                                <p>Order quantity: <strong>{{$od->quantity}}</strong></p>
                                                @endforeach
                                            </td>
                                            <td>
                                                <p>Payment Status: <strong>{{$order->status}}</strong> </p>
                                                @foreach($order->orderDetails as $od)
                                                <p>Order Status: <strong>{{$od->status}}</strong></p>
                                                @endforeach
                                            </td>
                                            <td>
                                                <p>Name: <strong>{{$order->user->username}}</strong></p>
                                                <p>Email: <strong>{{$order->user->email}}</strong></p>
                                                <p>phone: <strong>{{$order->user->phone}}</strong></p>
                                            </td>
                                            <td>
                                                <p> <strong>{{$order->total}} &#128;</strong> </p>
                                            </td>
                                            <td>
                                                <a href="{{route('order.details',$order->id)}}" class="btn btn-info btn-sm mb-2">View Details</a>
                                                <form action="{{route('order.delete',$order->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm mb-2">Delete Order</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    var $ = jQuery;
    $(document).ready(function() {
        $('#Payment_verification_order').DataTable({
            lengthMenu: [
                [5, 10, 20, 50, -1],
                [5, 10, 20, 50, "All"]
            ],
            'order': ['0', 'desc'],
        });
        $('#order').DataTable({
            lengthMenu: [
                [5, 10, 20, 50, -1],
                [5, 10, 20, 50, "All"]
            ],
            'order': ['0', 'desc'],
        });
        $('#Processed').DataTable({
            lengthMenu: [
                [5, 10, 20, 50, -1],
                [5, 10, 20, 50, "All"]
            ],
            'order': ['0', 'desc'],
        });
        $('#Varify').DataTable({
            lengthMenu: [
                [5, 10, 20, 50, -1],
                [5, 10, 20, 50, "All"]
            ],
            'order': ['0', 'desc'],
        });
        $('#cancel_orders').DataTable({
            lengthMenu: [
                [5, 10, 20, 50, -1],
                [5, 10, 20, 50, "All"]
            ],
            'order': ['0', 'desc'],
        });
        $('#process_order').DataTable({
            lengthMenu: [
                [5, 10, 20, 50, -1]
                [5, 10, 20, 50, "All"]
            ],
            'order': ['0', 'desc'],
        });
        $('#card').DataTable({
            lengthMenu: [
                [5, 10, 20, 50, -1]
                [5, 10, 20, 50, 'All']

            ],
            'order': ['0', 'desc'],
        });

    });
</script>
@endsection