<?php
$orders = auth()->user()->orders;
?>
@extends('layouts.user.app')
@section('content')
<div class="container ">
    <div class="row justify-content-center" style="font-size:16px;padding:10px;">
        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center bg-info text-white">Payment Varification Pending Order</div>
                        <div class="card-body">
                            <div class="x-content">
                                <table id="pending" class="table table-striped table-bordered text-center">
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
                                        @if($order->status=='Cash on delivery')
                                        <tr>
                                            <td>{{$order->created_at->toDateTimeString()}}</td>
                                            <td>{{$order->order_no}}</td>
                                            <td>{{$order->orderDetails->sum('quantity')}}</td>
                                            <td>
                                                @foreach($order->orderDetails as $p)
                                                {{$p->product->name}}
                                                @endforeach
                                            </td>
                                            <td>{{$order->status}}</td>
                                            <td>{{($order->trx_id)?? 'N/A'}}</td>
                                            <td>{{($order->note) ?? "N/A"}}</td>
                                            <td>{{$order->total}}</td>
                                            <td>{{$order->paid}}</td>
                                            <td>
                                                <a href="{{route('order.details',$order->id)}}" class="btn btn-info btn-sm mb-2">View Details</a>
                                                <a href="{{route('user.order.cancel',$order->id)}}" class="btn btn-danger btn-sm">Cancel Order</a>

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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-center text-white">
                            Payment Verify orders
                        </div>
                        <div class="card-body">
                            @if(isset($orders) && !$orders->isEmpty())
                            <div class="x_content">
                                <table id="payment_verify_order" class="table table-striped table-bordered text-center">
                                    <thead>
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
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        @if($order->status=="Payment Varified")
                                        <td>{{$order->created_at->format('d-m-Y H:i')}}</td>
                                        <td>{{$order->order_no}}</td>
                                        <td>{{$order->orderDetails->sum('quantity')}}</td>
                                        <td>
                                            @foreach($order->orderDetails as $o)
                                            {{$o->product->name}},
                                            @endforeach
                                        </td>
                                        <td>{{$order->status}}</td>
                                        <td>{{($order->trx_id) ?? 'N/A'}}</td>
                                        <td>{{($order->note)?? 'N/A'}}</td>
                                        <td>{{$order->total}}</td>
                                        <td>{{$order->paid}}</td>
                                        <td>
                                            <a href="{{route('order.details',$order->id)}}" class="btn btn-primary btn-sm">View Details</a>
                                        </td>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-success text-white text-center">Processed Order</div>
                        <div class="card-body">
                            @if(isset($orders) && !$orders->isEmpty())
                            <div class="x_content">
                                <table id="process_order" class="table table-striped table-bordered text-center">
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
                                            <th>Paid</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        @if($order->status == 'Order Process:full |take Cash on Delivery')
                                        <tr>
                                            <td>{{$order->created_at->toDateTimeString()}}</td>
                                            <td>{{$order->order_no}}</td>
                                            <td>{{$order->orderDetails->sum('quantity')}}</td>

                                            <td>
                                                @foreach($order->orderDetails as $od)
                                                {{$od->product->name}},
                                                @endforeach
                                            </td>

                                            <td>{{$order->status}}</td>
                                            <td>{{($order->trx_id) ?? "N/A"}}</td>
                                            <td>{{($order->note) ?? "N/A"}}</td>
                                            <td>{{$order->total}}</td>
                                            <td>{{$order->paid}}</td>

                                            <td>
                                                <a href="{{route('order.details',$order->id)}}" class="btn btn-success btn-sm">View Details</a>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-danger text-white text-center">Cancel Order</div>
                        <div class="card-body">
                            <div class="x_content">
                                @if(isset($orders) && !$orders->isEmpty())
                                <table id="cancel_order" class="table table-striped table-bordered">
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
                                            <th>Paid</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        @if($order->status=="Payment Cancel")
                                        <tr>
                                            <td>{{$order->created_at->toDateTimeString()}}</td>
                                            <td>{{$order->order_no}}</td>
                                            <td>{{$order->orderDetails->sum('quantity')}}</td>

                                            <td>
                                                @foreach($order->orderDetails as $od)
                                                {{$od->product->name}},
                                                @endforeach
                                            </td>

                                            <td>{{$order->status}}</td>
                                            <td>{{($order->trx_id) ?? "N/A"}}</td>
                                            <td>{{($order->note) ?? "N/A"}}</td>
                                            <td>{{$order->total}}</td>
                                            <td>{{$order->paid}}</td>

                                            <td>
                                                <a href="{{route('order.details',$order->id)}}" class="btn btn-primary  btn-sm">View Details</a>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach

                                    </tbody>
                                </table>
                                @endif
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
        $('#pending').DataTable({
            lengthMenu: [
                [5, 10, 20, 50, -1],
                [5, 10, 20, 50, "All"]
            ],
            'order': ['0', 'desc'],
        });
        $('#cancel_order').DataTable({
            lengthMenu: [
                [5, 10, 20, 50, -1],
                [5, 10, 20, 50, "All"]
            ],
            'order': ['0', 'desc'],
        });
        $('#payment_verify_order').DataTable({
            lengthMenu: [
                [5, 10, 20, 50, -1],
                [5, 10, 20, 50, "All"]

            ],
        });
        $('#process_order').DataTable({
            lengthMenu: [
                [5, 10, 20, 50, -1],
                [5, 10, 20, 50, "All"]

            ],
        });
    });
</script>
@endsection
