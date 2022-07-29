@extends('layouts.app')
@section('content')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>New Product</h3>
                    <ul>
                        <li><a href="/">home</a></li>
                        <li>shop</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->
@php
$carts= \Cart::getContent();
@endphp
<!--shop  area start-->
<div class="shop_area shop_reverse mt-70 mb-70">
    <div class="container">
        <div class="row">
            @include('layouts.partials.sideFront')
            <div class="col-lg-9 col-md-12">
                <!--shop wrapper start-->
                <!--shop toolbar start-->
                <div class="shop_toolbar_wrapper">
                    <div class="shop_toolbar_btn">

                        <button data-role="grid_3" type="button" class=" btn-grid-3" data-toggle="tooltip" title="3"></button>

                        <button data-role="grid_4" type="button" class="active btn-grid-4" data-toggle="tooltip" title="4"></button>

                    </div>
                    <div class="page_amount">
                        <p>All Products</p>
                    </div>
                </div>
                <!--shop toolbar end-->
                <div class="row shop_wrapper">
                    @foreach($products as $product)
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12" style="padding: none;">
                        <div class="single_product " style="height: 450px; background-color: white;">
                            <div class="product_thumb text-center">
                                    <a class="primary_img " href="{{route('productDetails',[$product->id,Str::slug($product->name)])}}"><img style="max-height:250px;max-width:250px;" src="{{$product->image[0]->image}}" alt=""></a>
                                    <a class="secondary_img" href="{{route('productDetails',[$product->id,Str::slug($product->name)])}}"><img src="{{$product->image[0]->image}}" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">Sale</span>
                                        <span class="label_new">New</span>
                                    </div>
                                    <div class="action_links">
                                        <ul>
                                            @if (auth()->user())
                                            @php
                                                $wish = App\Wishlist::where('user_id', auth()->user()->id)->where('product_id', $product->id)->first();
                                            @endphp
                                                @if (!empty($wish))

                                                <li class="wishlist"><a href="" title="Remove from Wishlist" onclick="event.preventDefault();
                                                    if(confirm('Are you sure to delete?')){
                                                        document.getElementById('wish-delete-{{ $wish->id }}').submit()}">
                                                        <span class="fa fa-heart"></span>
                                                    </a></li>
                                                <form action="{{ route('deletewishlist', $wish->id) }}" id="wish-delete-{{ $wish->id }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                @else
                                                <li class="wishlist text-center"><a href="{{ route('add.to.wishlist', $product->id) }}" title="Add to Wishlist"><span class="lnr lnr-heart"></span></a></li>
                                                @endif
                                            @else
                                                <li class="wishlist text-center"><a href="{{ route('add.to.wishlist', $product->id) }}" title="Add to Wishlist"><span class="lnr lnr-heart"></span></a></li>
                                            @endif
                                        </ul>
                                </div>
                            </div>
                             <div class="product_content grid_content">
  

                                <h4 class="product_name"><a href={{ route('productDetails', [$product->id,Str::slug($product->name)]) }}">{{substr($product->name,0,45)}}</a></h4>
                                <p><a href="#">{{$product->category->name}}</a></p>
                               <div class="price_box">
                                    @if ($product->offer)
                                    <span class="current_price">&#xa3; {{$product->offer->offerPrice}}</span><br>
                                    <span class="old_price">&#xa3; {{$product->price}} </span><br>
                                    @else
                                    <span class="current_price">&#xa3; {{$product->price}}</span><br>
                                    @endif
                                    <strong></strong>{{$product->productDetails->model}}<br>
                                    @php
                                    $value= 0;
                                    $cart = \Cart::get($product->id);
                                    @endphp
                                    @if (isset($cart) && !empty($cart))
                                    @php
                                        $value = $cart->quantity;
                                    @endphp
                                    @endif
                                    <div class="d-flex justify-content-center">
                                        <div id="cartbuttons_{{ $product->id }}" class="px-2 d-flex">
                                        @if (Session::has('postcode'))
                                           @if ($value > 0)
                                                <button onclick="rmfmcart({{ $product->id }})" class="btn btn-primary ">-</button>
                                                <input style="width: 40px" id="pdcartqty_{{ $product->id }}" class="cartqty text-center" type="number" min="1" value="{{ $cart->quantity }}">
                                                <button onclick="addtocart({{ $product->id }})" class="btn btn-primary ">+</button>
                                            @else
                                                <input id="pdcartqty_{{ $product->id }}" type="hidden" name="quantity" value="0">
                                                <button onclick="addtocart({{ $product->id }})" class="btn btn-md text-white w-90 ml-2" style="border-radius:5px;background:#40A944;padding:7px 15px; margin-right: 5px;">Add To Basket</button>
                                            @endif
                                        @else
                                                <button onclick="event.preventDefault();" data-toggle="modal" data-target="#postcodeModal" class="btn btn-md text-white w-90 ml-2" style="border-radius:5px;background:#40A944;padding:7px 15px; margin-right: 5px;">Add To Basket</button>
                                        @endif
                                    </div>
                                        {{-- <a href="#" data-toggle="modal" data-target="#modal_box_{{ $product->id }}" title="quick view"> <span class=" fa fa-eye" style=" font-size:14px;padding:11px 10px;background:#40A944;color:white; border-radius:5px;"></span></a> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="product_content list_content">
                                <h4 class="product_name"><a href="product-details.html">{{$product->name}}t</a></h4>
                                <p><a href="#">{{$product->category->name}}</a></p>
                                <div class="price_box">
                                    @if ($product->offer)
                                        <span class="current_price">£{{$product->offer->offerPrice}}</span>
                                        <span class="old_price">£{{ $product->price }}</span>
                                    @else
                                        <span class="current_price">£{{$product->price}}</span>
                                    @endif
                                </div>
                                <div class="product_desc">
                                    <p>{{$product->descripiton}}</p>
                                </div>
                                <div class="action_links list_action_right">
                                    <ul>
                                        <li class="add_to_cart"><a href="cart.html" title="Add to cart">Add to Cart</a></li>
                                        <li class="quick_button"><a href="#" data-toggle="modal" data-target="#modal_box_{{ $product->id }}"  title="quick view"> <span class="lnr lnr-magnifier"></span></a></li>
                                         <li class="wishlist"><a href="{{ route('add.to.wishlist', $product->id) }}" title="Add to Wishlist"><span class="lnr lnr-heart"></span></a></li>
                                        <li class="compare"><a href="#" title="Add to Compare"><span class="lnr lnr-sync"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="shop_toolbar t_bottom">
                    <div class="pagination">
                        <ul>
                            <li class="current">{{$products->links()}}</li>
                        </ul>
                    </div>
                </div>
                <!--shop toolbar end-->
                <!--shop wrapper end-->
            </div>
        </div>
    </div>
</div>
<!--shop  area end-->
@endsection
