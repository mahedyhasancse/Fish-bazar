@extends('layouts.app')
@section('content')
<style>
    
    .shopping_cart_area{
     font-family: -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif   
    }
    tbody{
        font-size:18px;
    }
</style>
<div class="shopping_cart_area mt-70" >
        <div class="container">  
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="cart_page table-responsive">
                            @if(($products) && !$products->isEmpty() )
                                <table>
                            <thead>
                                <tr>
                                    <th class="product_remove">Delete</th>
                                    <th class="product_thumb">Image</th>
                                    <th class="product_name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product_quantity">Quantity</th>
                                    <th class="product_total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                <form action="{{route('delete.cart',$product->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <td class="product_remove"><button style="border:none;font-size:18px;background:none" class="fa fa-trash-o" name="submit" type="submit"></button></td>
                                </form>
                                    <td class="product_thumb"><a href="{{asset($product->image[0]->image)}}"><img src="{{asset($product->image[0]->image)}}" alt=""></a></td>
                                    <td class="product_name"><a href="{{route('productDetails',[$product->id,Str::slug($product->name)])}}">{{$product->name}}</a></td>
                                    <td class="product-price">&#163 {{$product->price}}</td>
                                    <form action="{{route('update.cart',$product->id)}}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <td class="product-quantity">
                                        <input style="width:40%" value="{{$product->quantity}}" type="number" min="1" name="quantity">
                                        <button title="Update" style="border:none;padding:8px; font-weight:bold;" class="fa fa-refresh bg-dark text-white" name="submit" type="submit"></button>
                                    </td>
                                    </form>
                                    <td class="product_total">&#163 {{$product->subTotal}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="alert alert-danger">
                         No Product Add To Cart!!
                        </div>
                        @endif   
                            </div>      
                        </div>
                     </div>
                 </div>
                 <!--coupon code area start-->
                <div class="coupon_area">
                    <div class="row">
                        <!-- <div class="col-lg-6 col-md-6">
                            <div class="coupon_code left">
                                <h3>Coupon</h3>
                                <div class="coupon_inner">   
                                    <p>Enter your coupon code if you have one.</p>                                
                                    <input placeholder="Coupon code" type="text">
                                    <button type="submit">Apply coupon</button>
                                </div>    
                            </div>
                        </div> -->
                        <div class="col-lg-6 col-md-6">
                            <div class="coupon_code right">
                                <h3>Cart Totals</h3>
                                <div class="coupon_inner">
                                   <div class="cart_subtotal">
                                       <p>Subtotal</p>
                                       <p class="cart_amount"> &#163 {{$cart['subTotal']}}</p>
                                   </div>
                                   <div class="cart_subtotal ">
                                       <p>Shipping (Express)</p>
                                       <p class="cart_amount">Flat Rate:  {{$cart['subTotal']+0}}</p>
                                   </div>
                                   <a href="#">Calculate shipping</a>

                                   <div class="cart_subtotal">
                                       <p style="font-size:20px"><strong>Total = </strong></p>
                                       <p class="cart_amount"> &#163 {{$cart['subTotal']+0}}</p>
                                   </div>
                                   <div class="checkout_btn">
                                       @if (Session::has('postcode'))
                                       <a href="{{url('user/checkout')}}/ha/ha">Proceed to Checkout</a>
                                       @else
                                       <a href="" onclick="event.preventDefault();" data-toggle="modal" data-target="#postcodeModal" >Proceed to Checkout</a>
                                       @endif
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--coupon code area end--> 
        </div>     
    </div>
     <!--shopping cart area end -->
@endsection
@section('scripts')
<script>
    function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition,showError);
            } else {
                $('.geo-alert').html('Please alow location otherwise we will not be able to provide you to distance');
            }
        }
        function showPosition(position) {
            document.getElementById("checkout").href="{{url('user/checkout')}}"+"/"+position.coords.latitude+"/"+position.coords.longitude;
        }
        function showError(error) {
            var x = $('.geo-alert');
            switch(error.code) {
                case error.PERMISSION_DENIED:
                x.html('<div class="alert alert-danger">Please alow location otherwise we will not be able to detect your address automatically</div>');
                break;
                case error.POSITION_UNAVAILABLE:
                x.html('<div class="alert alert-danger">Location information is unavailable.</div>');
                break;
                case error.TIMEOUT:
                x.html('<div class="alert alert-danger">The request to get user location timed out.</div>');
                break;
                case error.UNKNOWN_ERROR:
                x.html('<div class="alert alert-danger">An unknown error occurred.</div>');
                break;
            }
        }
        (function() {
            getLocation();

        })();

</script>
@endsection