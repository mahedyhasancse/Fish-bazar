<?php
$orders = auth()->user()->orders;
?>
@extends('layouts.app')

@section('content')
<!-- @if(Session::has('success'))
toastr.success("{{Session::get('success')}}")
@endif -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->

<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>My Account</h3>
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li>My account</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->
<!-- my account start  -->
<section class="main_content_area" style="margin:0 10%; font-weight:bold">
    <div class="container-fluid">
        <div class="account_dashboard">
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <!-- Nav tabs -->
                    <div class="dashboard_tab_button">
                        <ul role="tablist" class="nav flex-column dashboard-list">

                            <li> <a href="#orders" data-toggle="tab" class="nav-link active">Orders</a></li>
                            <li><a href="#account-details" data-toggle="tab" class="nav-link">Account details</a></li>
                            <li><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off"></i>Logout</a>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard_content">
                        <!-- <div class="tab-pane fade show active" id="dashboard">
                            <h3>Dashboard </h3>
                            <h2 class=" alert alert-success">Welcome to Divine Green</h2>
                        </div> -->
                        <div class="tab-pane  fade show active col-md-12 fade w-100" id="orders">
                            <h2 class=" text-dark text-center m-2">Your Order Lists</h2>
                            <hr width="80%">
                            <div class="row justify-content-center col-md-12" style="font-size:16px;padding:10px;width:100%">
                                <div class="col-md-12 w-100 pb-2">
                                    <div class="card">
                                        <div class="card-header text-center bg-success text-white">Click and Collect</div>
                                        <div class="card-body">
                                            <div class="x-content">
                                                <table id="pending" class="table table-striped table-responsive table-bordered text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>Order ID</th>
                                                            <th>Post Code</th>
                                                            <th>Booking time</th>
                                                            <th>Booking Day</th>
                                                            <th>Collection Method</th>
                                                            <th>Product Name</th>
                                                            <th>Status</th>
                                                            <th>Note</th>
                                                            <th>Total Amount</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach($orders as $order)
                                                        @if($order->status=='pick from the shop')
                                                        <tr>
                                                            <td>{{$order->order_no}}</td>
                                                            <td>{{$order->shipped->post_code}}</td>
                                                            @foreach($order->time as $t)
                                                            <td>{{$t->time}}</td>
                                                            <td>{{$t->date}}</td>
                                                            <td>{{$t->quick ?? 'Noraml'}}</td>
                                                            <td>
                                                                @foreach($order->orderDetails as $od)
                                                                <li> <a href="{{route('productDetails',[$od->product->id,Str::slug($od->product->name)])}}">{{$od->product->name}}</a> x <span class="text-danger"> {{$od->quantity}}</span></li>
                                                                @endforeach
                                                            </td>
                                                            <td>{{$order->status}}</td>
                                                            <td>{{$order->note?? 'NULL'}}</td>
                                                            <td>{{$order->total}}</td>
                                                            @endforeach
                                                            <td>
                                                                <a href="{{route('order.details',$order->id)}}" class=" text-white btn btn-success btn-sm mb-2">View Details</a>
                                                                <!-- <a href="{{route('user.order.cancel',$order->id)}}" class="btn btn-danger btn-sm">Cancel Order</a> -->
                                                                <button type="button" class="btn bg-danger text-white btn-sm" data-toggle="modal" data-target="#exampleModal">
                                                                    Cancel Order
                                                                </button>
                                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-body">
                                                                                <h3 class="text-center p-4 card   bg-danger text-white"> Cancel Order?</h3>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn bg-success text-white" data-dismiss="modal">Close</button>
                                                                                <a href="{{route('user.order.cancel',$order->id)}}" class="btn btn-danger text-white">Cancel Order</a>
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
                                <div class="col-md-12 w-100 pb-2">
                                    <div class="card">
                                        <div class="card-header text-center bg-success text-white">Order Status</div>
                                        <div class="card-body">
                                            <div class="x-content">
                                                <table id="table" class="table table-striped table-responsive table-bordered text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>Order Date</th>
                                                            <th>Order ID</th>
                                                            <th>No of Products</th>
                                                            <th>Product Name</th>
                                                            <th>Payment Status</th>
                                                            <th>Trx ID</th>
                                                            <th>Note</th>
                                                            <th>Total Amount</th>
                                                            <th> Paid</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach($orders as $order)
                                                        @if($order->status=='Payment From Card'||$order->status=='Cash on delivery' || $order->status=='Payment On Paypal' || $order->status=='Order Process:full |take Cash on Delivery'||$order->status=='Order Process:full |Payment On PayPal')
                                                        <tr>
                                                            <td>{{$order->created_at->format('d/m/Y')}}</td>
                                                            <td>{{$order->order_no}}</td>
                                                            <td>{{$order->orderDetails->sum('quantity')}}</td>
                                                            <td>
                                                                @foreach($order->orderDetails as $p)
                                                                <a style="text-align:justify" href="{{route('productDetails',[$p->product->id,Str::slug($p->product->name)])}}">
                                                                    <li>{{$p->product->name}}</li>
                                                                </a>
                                                                @endforeach
                                                            </td>
                                                            <td>{{$order->status}}</td>
                                                            <td>{{($order->trx_id)?? 'N/A'}}</td>
                                                            <td>{{($order->note) ?? "N/A"}}</td>
                                                            <td>{{$order->total}}</td>
                                                            <td>{{$order->paid}}</td>
                                                            <td>
                                                                <a href="{{route('order.details',$order->id)}}" class=" mt-2 text-white btn btn-success btn-sm mb-2">View Details</a>
                                                                <!-- <a href="{{route('user.order.cancel',$order->id)}}" class="btn btn-danger btn-sm">Cancel Order</a> -->
                                                                @if($order->status=='Cash on delivery' || $order->status=='Payment From Card' || $order->status=='Payment On Paypal' )
                                                                <button type="button" class="btn bg-danger text-white btn-sm" data-toggle="modal" data-target="#exampleModal1">
                                                                    Cancel Order
                                                                </button>
                                                                @endif
                                                                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-body">
                                                                                <h3 class="text-center p-4 card bg-danger text-white"> Cancel Order?</h3>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn bg-success text-white" data-dismiss="modal">Close</button>
                                                                                <a href="{{route('user.order.cancel',$order->id)}}" class="btn btn-danger text-white">Cancel Order</a>
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

                        <div class="tab-pane fade" id="account-details">
                            <h3>Account details <a style="color: blue" href="{{ route('edit.profile',auth()->user()->id) }}"><i class="fa fa-pencil"></i></a> </h3>
                            <div class="login">
                                <div class="login_form_container">
                                    <div class="account_login_form">
                                        <table class="table">
                                            <tr>
                                                <td>First Name: </td>
                                                <td>: </td>
                                                <td>{{ auth()->user()->first_name }} </td>
                                            </tr>
                                            <tr>
                                                <td>Last Name</td>
                                                <td>:</td>
                                                <td>{{ auth()->user()->last_name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Username: </td>
                                                <td>: </td>
                                                <td>{{ auth()->user()->username }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email: </td>
                                                <td>: </td>
                                                <td>{{ auth()->user()->email }}</td>
                                            </tr>
                                            <tr>
                                                <td>Phone: </td>
                                                <td>: </td>
                                                <td>{{ auth()->user()->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td>Address: </td>
                                                <td>: </td>
                                                <td>{{ auth()->user()->address }}</td>
                                            </tr>
                                            <tr>
                                                <td>Street: </td>
                                                <td>: </td>
                                                <td>
                                                    <address>{{ auth()->user()->street }}</address>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Post Code: </td>
                                                <td>: </td>
                                                <td>
                                                    <address>{{ auth()->user()->post_code ?? 'NULL' }}</address>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- my account end   -->
@endsection
@section('scripts')


<script type="text/javascript">
    $(document).ready(function() {
        $('#pending').DataTable({
            // lengthMenu: [
            //     [5, 10, 20, 50, -1],
            //     [5, 10, 20, 50, "All"]
            // ],
            // 'order': ['0', 'desc'],
        });
        $('#table').DataTable({
            // lengthMenu: [
            //     [5, 10, 20, 50, -1],
            //     [5, 10, 20, 50, "All"]
            // ],
            // 'order': ['0', 'desc'],
        });
    });
</script>
@endsection