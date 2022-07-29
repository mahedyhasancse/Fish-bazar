<?php
if (auth()->user()->is_admin) {
    $extend = "layouts.admin.app";
} else {
    $extend = "layouts.app";
}
?>
<style>

</style>
@extends($extend)
@section('content')
<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class=""><strong>Order By:</strong></strong> {{$order->user->username}}</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Email: {{$order->user->email}}</strong></p>
                            <p><strong>Phone: {{$order->user->phone}}</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    @if($order->status=="pick from the shop")
                    <div></div>
                    @else
                    <div class="card">
                        <div class="card-header">
                            <h4><strong>Shipped To:</strong>{{$order->shipped->s_name}}</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Post Code: {{$order->shipped->post_code}}</strong></p>
                            <p><strong>Phone:{{$order->shipped->s_phone}}</strong></p>
                            <p><strong>Address: {{$order->shipped->s_address_line_1}}</strong></p>
                            <p><strong>Address2: {{$order->shipped->s_address_line_2}}</strong></p>
                           @if(count($order->user->delivery)>0)
                           <h4 class="bg-dark text-white card p-2 col-md-6">
                                Last Booking Slots
                            </h4>
                            <h4><strong> Time: {{$order->user->delivery->last()->time}} </strong></h4>
                            <h4><strong> Date: {{$order->user->delivery->last()->date}} </strong></h4>
                           <p>  {{$order->user->delivery->last()->created_at->diffForHumans()}} </p>
                           @else
                           <div></div>
                           @endif
                            
                        </div>
                    </div>
                    @endif
                </div>
                @if(auth()->user()->is_admin)
                <div class="col-md-12 text-center">
                    @if($order->status=="Payment From Card")
                    <div class="card">
                        <div class="card-header">
                            <h4><strong>Card Info</strong></h4>
                        </div>
                        @foreach($order->card as $card)
                        <div class="card-body" style="color:black">

                            <p> <strong>Total Amount:</strong> {{$card->order->total}}</p>
                            <p> <strong>Card on name:</strong> {{$card->name}}</p>
                            <p><strong>Card Number:</strong> {{$card->card_no}}</p>
                            <p><strong>Eexpiry Month: {{$card->expiry_month}}</strong></p>
                            <p><strong>Eexpiry Year: {{$card->expiry_year}}</strong></p>
                            <p><strong>Cvv:</strong> {{$card->cvv}}</p>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @else
                <div class="col-md-12 text-center">
                    @if($order->status=="Payment From Card")
                    <div class="card">
                        <div class="card-header">
                            <h4><strong>Card Info</strong></h4>
                        </div>
                        @foreach($order->card as $card)
                        <div class="card-body" style="color:black">

                            <p> <strong>Total Amount:</strong> {{$card->order->total}}</p>
                            <p> <strong>Card on name:</strong> {{$card->name}}</p>
                            <p><strong>Card Number:</strong> {{substr($card->card_no,0,4)}} <span class="pt-4">************</span> </p>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endif
                <div class="col-md-12 w-100">
                    <div class="card">
                        <div class="card-header"><strong>Order Details for: {{$order->order_no}}</strong></div>
                        <div class="card-body">
                            <div class="x-content">
                                <table id="details" class="table table-striped table-responsive">
                                    <thead>
                                        <tr class="bg-info text-white">
                                            <th>Product Image</th>
                                            <th>Product Title</th>
                                            <th>product Price</th>
                                            <th>Order Quantity</th>
                                            <th>Payment Status</th>
                                            <th>Order Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach($order->orderDetails as $od)
                                            <td><a href="{{route('productDetails',[$od->product->id,Str::slug($od->product->name)])}}"><img width="70px" src="{{asset($od->product->image[0]->image)}}" alt=""></a></td>
                                            <td><a href="{{route('productDetails',[$od->product->id,Str::slug($od->product->name)])}}">{{$od->product->name}}</a></td>
                                            <td>
                                                @if($od->product->offer)
                                                <span class="current_price">&#xa3; {{$od->product->offer->offerPrice}}</span><br>
                                                <del class="old_price">&#xa3; {{$od->product->price}} </del><br>
                                                @else
                                                <span class="current_price">&#xa3; {{$od->product->price}}</span><br>
                                                @endif

                                            </td>
                                            <td>{{$od->quantity}}</td>
                                            <td>{{$order->status}}</td>
                                            <td>
                                                <p class="text-success text-center">{{$od->status}}</p>
                                                @if($od->status == 'Order shift' && !auth()->user()->is_admin)
                                                <p>Please enter your feedback</p>
                                                <div class="text-center">
                                                    <div class='starrr' id='star1'></div>
                                                </div>
                                                <style>
                                                    .starrr a {
                                                        color: #de8d47;
                                                        font-size: 18px;
                                                    }
                                                </style>
                                                <form action="{{route('user.product.rating',$order->id)}}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control rating" value="" name="rating">
                                                        @error('rating')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <textarea name="feedback" id="feedback" cols="30" rows="5" class="form-control"></textarea>
                                                        @error('feedback')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <input type="submit" value="Provide Feedback" class="btn btn-info text-white ">
                                                </form>
                                                @endif
                                                @if($od->status == 'Completed')
                                                <style>
                                                    .starrr a {
                                                        color: #de8d47;
                                                        font-size: 18px;
                                                    }
                                                </style>
                                                @foreach($od->rating as $r)
                                                <div class="starrr" style="margin-left:10px">

                                                    <?php
                                                    $rated = $r->rating;
                                                    $unrated = 5 - $rated;
                                                    while ($rated > 0) {
                                                        echo ('<a class="fa fa-star" style="color:"></a>');
                                                        $rated--;
                                                    }
                                                    while ($unrated > 0) {
                                                        echo ('<a class="fa fa-star-o  text-warning"></a>');
                                                        $unrated--;
                                                    }
                                                    ?>
                                                </div>
                                                <p>{{$r->feedback}}</p>
                                                @endforeach
                                                @endif
                                            </td>
                                        </tr>
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
<script src="{{asset('/js/starrr.js')}}"></script>
<script>
    var $ = jQuery
    $('#star1').starrr({
        change: function(e, value) {

            if (value) {
                $('.rating').val(value);
            }
        }
    })
    $('#details').DataTable({
        lengthMenu: [
            [5, 10, 20, 50, -1],
            [5, 10, 20, 50, "All"]
        ],
        'order': ['0', 'desc'],
    });
</script>
@endsection