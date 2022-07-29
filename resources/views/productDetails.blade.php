<?php
$sizes = explode(',', $product->productDetails->size);
$colors = explode(',', $product->productDetails->color);
?>
@extends('layouts.app')
@section('content')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="/">home</a></li>
                        <li>product details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--product details start-->
<div class="product_details mt-60 mb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product-details-tab">
                    <div id="img-1" class="zoomWrapper single-zoom">
                        <a href="">
                            <img id="zoom1" src="{{asset($product->image[0]->image)}}" data-zoom-image="{{asset($product->image[0]->image)}}" alt="big-1">
                        </a>
                    </div>
                    <div class="single-zoom-thumb">

                        <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                            @foreach($product->image as $image)
                            <li>
                                <a href="#" class="elevatezoom-gallery " data-update="" data-image="{{asset($image->image)}}" data-zoom-image="{{asset($image->image)}}">
                                    <img src="{{$image->image}}" alt="zo-th-1" />
                                </a>
                            </li>
                            <li>
                                <?php $i = 0; ?>
                                <a href="#" class="elevatezoom-gallery  {{($i == 0)? 'active' : ''}}" data-update="" data-image="{{$image->image}}" data-zoom-image="{{asset($image->image)}}">
                                    <img src="{{asset($image->image)}}" alt="zo-th-1" />
                                </a>
                                <?php $i++; ?>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product_d_right">

                    <h1><a href="#">{{$product->name}}</a></h1>
                    <div class="product_nav">
                        <ul>
                            {{-- <li class="prev"><a href="product-details.html"><i class="fa fa-angle-left"></i></a></li>
                                <li class="next"><a href="variable-product.html"><i class="fa fa-angle-right"></i></a></li> --}}
                        </ul>
                    </div>
                    <div class=" product_ratting">
                        <?php
                        $rated = floor($product->rating->average('rating'));
                        $unrated = 5 - $rated;
                        while ($rated > 0) {
                            echo ('<a class="fa fa-star" style="font-size: 20px;color: #ffd119 !important;margin:5px 2.5px"></a>');
                            $rated--;
                        }
                        while ($unrated > 0) {
                            echo ('<a class="fa fa-star-o" style="font-size: 20px;color: #ffd119 !important;margin:5px 2.5px"></a>');
                            $unrated--;
                        }
                        ?>
                        <span>({{count($product->rating)}})</span>
                    </div>
                    <div class="price_box">
                        @if ($product->offer)
                        <span class="current_price">£{{$product->offer->offerPrice}}</span>
                        <span class="old_price">£{{ $product->price }}</span>
                        @else
                        <span class="current_price">£{{$product->price}}</span>
                        @endif
                        <br>
                        <span>{{ $product->productDetails->model }}</span>
                    </div>
                    <br>
                    <div class="product_desc">
                        <h4>Description:</h4>
                        <p>@php
                            echo nl2br($product->description);
                            @endphp</p>
                    </div>
                    <div class="product_desc">
                        <h4>Available quantity: {{ $product->quantity}} </h4>
                    </div>
                    <form method="post" action="{{route('add.cart',$product->id)}}">
                        @csrf
                        <div class="product_variant quantity">
                            <label>quantity</label>
                            <input min="1" max="100" value="1" type="number" name="quantity">
                            @if (Session::has('postcode'))
                            <button class="button" type="submit">Add to cart</button>
                            @else
                            <button class="button" onclick="event.preventDefault();" data-toggle="modal" data-target="#postcodeModal">Add to cart</button>
                            @endif
                        </div>
                        <div class="product_meta">
                            <span>Category: <a href="#">{{$product->category->name}}</a></span>
                        </div>
                    </form>
                    <div class="priduct_social">
                        <ul>
                            <li><a class="facebook" href="#" title="facebook"><i class="fa fa-facebook"></i> Like</a></li>
                            <li><a class="twitter" href="#" title="twitter"><i class="fa fa-twitter"></i> tweet</a></li>
                            <li><a class="pinterest" href="#" title="pinterest"><i class="fa fa-pinterest"></i> save</a></li>
                            <li><a class="google-plus" href="#" title="google +"><i class="fa fa-google-plus"></i> share</a></li>
                            <li><a class="linkedin" href="#" title="linkedin"><i class="fa fa-linkedin"></i> linked</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--product details end-->

<!--product info start-->
<div class="product_d_info mb-65">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product_d_inner">
                    <div class="product_info_button">
                        <ul class="nav" role="tablist">
                            <li>
                                <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Description</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews ({{count($product->rating)}})</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                            <div class="product_info_content">
                                <p>@php echo nl2br($product->description) @endphp</p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="reviews_wrapper">
                                <h2>Feedback From Customers:</h2>

                                @foreach($product->rating as $p)
                                <div class="reviews_comment_box">
                                    <div class="comment_thmb">
                                        <img src="{{ asset('frontend/img/blog/comment2.jpg') }}" alt="">
                                    </div>
                                    <div class="comment_text">
                                        <div class="reviews_meta">
                                            <div class="star_rating">
                                                <?php
                                                $rated = floor($product->rating->average('rating'));
                                                $unrated = 5 - $rated;
                                                while ($rated > 0) {
                                                    echo ('<a class="fa fa-star" style="font-size: 20px;color: #ffd119 !important;margin:5px 2.5px"></a>');
                                                    $rated--;
                                                }
                                                while ($unrated > 0) {
                                                    echo ('<a class="fa fa-star-o" style="font-size: 20px;color: #ffd119 !important;margin:5px 2.5px"></a>');
                                                    $unrated--;
                                                }
                                                ?>
                                            </div>
                                            <p class=""><strong class="card col-md-4 p-2">{{$p->orderDetails->order->user->username}}</strong><br>  {{$p->feedback}}
                                            <span class="blockquote-footer">{{$p->created_at->diffForHumans()}}</span></p>
                                        </div>
                                    </div>

                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product info end-->


@endsection