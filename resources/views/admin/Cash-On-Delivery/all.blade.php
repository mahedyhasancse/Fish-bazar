@extends('layouts.admin.app')
@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-header text-center bg-info text-white">Click and Collect</div>
    <div class="card-body">
      @if(isset($orders) && $orders->isEmpty())
      <div class="alert alert-danger">No order add yet!</div>
      @else
      <div class="x_content">
        <table id="userShow" class="table table-striped table-bordered table-responsive" style="text-align:center;">
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
                <a href="{{route('order.details',$order->id)}}" class=" text-white btn btn-info btn-sm mb-2">View Details</a>
                <a href="" class=" text-white btn btn-success btn-sm mb-2">Confirm</a>
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
      @endif
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
  var $ = jQuery;
  $(document).ready(function() {
    $('#userShow').DataTable({
      "order": ['0', 'desc'],
    });
  });
</script>
@endsection