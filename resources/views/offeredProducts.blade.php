@extends('layouts.app')
@section('content')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>Offers</h3>
                    <ul>
                        <li><a href="/">home</a></li>
                        <li>Offers</li>
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
                        <p>All Offered Products</p>
                    </div>
                </div>
                <!--shop toolbar end-->
                <div class="row shop_wrapper">
                    @foreach($offers as $offer)
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12" style="padding: none;">
                        <div class="single_product " style="height: 450px; background-color: white;">
                            <div class="product_thumb text-center">
                                <a class="primary_img " href="{{route('productDetails',[$offer->product->id,Str::slug($offer->product->name)])}}"><img style="max-height:250px;max-width:250px;" src="{{$offer->product->image[0]->image}}" alt=""></a>
                                <a class="secondary_img" href="{{route('productDetails',[$offer->product->id,Str::slug($offer->product->name)])}}"><img src="{{$offer->product->image[0]->image}}" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">Sale</span>
                                    <span class="label_new">New</span>
                                </div>
                                <div class="action_links">
                                    <ul>
                                        @if (auth()->user())
                                        @php
                                        $wish = App\Wishlist::where('user_id', auth()->user()->id)->where('product_id', $offer->product->id)->first();
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
                                        <li class="wishlist text-center"><a href="{{ route('add.to.wishlist', $offer->product->id) }}" title="Add to Wishlist"><span class="lnr lnr-heart"></span></a></li>
                                        @endif
                                        @else
                                        <li class="wishlist text-center"><a href="{{ route('add.to.wishlist', $offer->product->id) }}" title="Add to Wishlist"><span class="lnr lnr-heart"></span></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="product_content grid_content">
                                <h4 class="product_name"><a href={{ route('productDetails', [$offer->product->id,Str::slug($offer->product->name)]) }}">{{substr($offer->product->name,0,45)}}</a></h4>
                                <p><a href="#">{{$offer->product->category->name}}</a></p>
                                <div class="price_box">
                                    <span class="current_price">&#xa3; {{$offer->offerPrice}}</span><br>
                                    <span class="old_price">&#xa3; {{$offer->product->price}} </span><br>
                                    <strong></strong>{{$offer->product->productDetails->model}}<br>
                                    @php
                                    $value= 0;
                                    $cart = \Cart::get($offer->product->id);
                                    @endphp
                                    @if (isset($cart) && !empty($cart))
                                    @php
                                    $value = $cart->quantity;
                                    @endphp
                                    @endif
                                    <div class="d-flex justify-content-center">
                                        <div id="cartbuttons_{{ $offer->product->id }}" class="px-2 d-flex">
                                            @if (Session::has('postcode'))
                                            @if ($value > 0)
                                            <button onclick="rmfmcart({{ $offer->product->id }})" class="btn btn-primary ">-</button>
                                            <input style="width: 40px" id="pdcartqty_{{ $offer->product->id }}" class="cartqty text-center" type="number" min="1" value="{{ $cart->quantity }}">
                                            <button onclick="addtocart({{ $offer->product->id }})" class="btn btn-primary ">+</button>
                                            @else
                                            <input id="pdcartqty_{{ $offer->product->id }}" type="hidden" name="quantity" value="0">
                                            <button onclick="addtocart({{ $offer->product->id }})" class="btn btn-md text-white w-90 ml-2" style="border-radius:5px;background:#40A944;padding:7px 15px; margin-right: 5px;">Add To Basket</button>
                                            @endif
                                            @else
                                            <button data-toggle="modal" data-target="#postcodeModal" class="btn btn-md text-white w-90 ml-2" style="border-radius:5px;background:#40A944;padding:7px 15px; margin-right: 5px;">Add To Basket</button>
                                            @endif
                                        </div>
                                        {{-- <a href="#" data-toggle="modal" data-target="#modal_box_{{ $offer->product->id }}" title="quick view"> <span class=" fa fa-eye" style=" font-size:14px;padding:11px 10px;background:#40A944;color:white; border-radius:5px;"></span></a> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="product_content list_content">
                                <h4 class="product_name"><a href="product-details.html">{{substr($offer->product->category->name,0,40)}}</a></h4>
                                <p><a href="#">{{substr($offer->product->category->name,0,40)}}</a></p>
                                <div class="price_box">
                                    <span class="current_price">£{{$offer->offerPrice}}</span>
                                    <span class="old_price">£{{ $offer->product->price }}</span>
                                </div>
                                <div class="product_desc">
                                    <p>{{$offer->product->descripiton}}</p>
                                </div>
                                <div class="action_links list_action_right">
                                    <ul>
                                        <li class="quick_button"><a href="#" data-toggle="modal" data-target="#modal_box_{{ $offer->product->id }}" title="quick view"> <span class="lnr lnr-magnifier"></span></a></li>
                                        <li class="wishlist"><a href="{{ route('add.to.wishlist', $offer->product->id) }}" title="Add to Wishlist"><span class="lnr lnr-heart"></span></a></li>
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
                            <li class="current">1</li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li class="next"><a href="#">next</a></li>
                            <li><a href="#">>></a></li>
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