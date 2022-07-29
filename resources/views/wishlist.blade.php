@extends('layouts.app')

@section('content')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                   <h3>Wishlist</h3>
                    <ul>
                        <li><a href="/">home</a></li>
                        <li>Wishlist</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->


<!--wishlist area start -->
<div class="wishlist_area mt-60">
    <div class="container">
        <form action="#">
            <div class="row">
                <div class="col-12">
                    <div class="table_desc wishlist">
                        <div class="cart_page table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product_thumb">Image</th>
                                        <th class="product_name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product_quantity">Stock Status</th>
                                        <th class="product_total">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($wishes->count() > 0 )
                                        @foreach ($wishes as $wish)
                                        <tr style="border-bottom: 2px solid rgba(0, 0, 0, 0.575)">
                                            <td class="product_thumb"><a href="{{route('productDetails',[$wish->product->id,Str::slug($wish->product->name)])}}"><img src="{{ asset($wish->product->image[0]->image) }}" alt=""></a></td>
                                            <td class="product_name"><a href="{{route('productDetails',[$wish->product->id,Str::slug($wish->product->name)])}}">{{ $wish->product->name }}</a></td>
                                            <td class="product-price">
                                                @if ($wish->product->offer)
                                                <span class="current_price">£{{ $wish->product->offer->offerPrice }}</span> <br>
                                                <span class="old_price">£{{ $wish->product->price }}</span>
                                                @else
                                                <span class="current_price">£{{ $wish->product->price }}</span>
                                                @endif
                                            </td>
                                            <td class="product_quantity">
                                                @if ($wish->product->quantity > 0)
                                                In Stock
                                                @else
                                                Out of Stock
                                                @endif
                                            </td>
                                            <td class="product_total">
                                                <div class="d-flex justify-content-between">
                                                    <a style="background-color: red" href="" onclick="event.preventDefault();
                                                    if(confirm('Are you sure to delete?')){
                                                        document.getElementById('wish-delete-{{ $wish->id }}')
                                                    .submit()}"><i class="fa fa-trash"></i></a>
                                                    <form action="{{ route('deletewishlist', $wish->id) }}" id="wish-delete-{{ $wish->id }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                    @if ($wish->product->quantity > 0)
                                                    <a href="" onclick="event.preventDefault();
                                                        document.getElementById('cart-add-{{ $wish->id }}').submit()"><i class="fa fa-cart-plus"></i></a>
                                                    <form method="post" action="{{route('add.cart',$wish->product->id)}}" id="cart-add-{{ $wish->id }}">
                                                        @csrf
                                                        <input type="hidden" name="quantity" value="1" >
                                                    </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>No product found on wish list.</tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>

                    </div>
                 </div>
             </div>

        </form>
        <div class="row">
            <div class="col-12">
                 {{-- <div class="wishlist_share">
                    <h4>Share on:</h4>
                    <ul>
                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                        <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                        <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div> --}}
            </div>
        </div>

    </div>
</div>
<!--wishlist area end -->
@endsection
