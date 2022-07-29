<?php

use App\CategoryBanner;

$categories = App\ProductCategory::latest()->get();
?>
@extends('layouts.app')
@section('content')
<style>
    /* .a {
        margin: 5px;
    } */
    .ab {
        background: #fff;

    }

    .a ul li {
        float: left;
        overflow: hidden;
        margin: 0;
    }

    /* Paste this css to your style sheet file or under head tag */
    /* This only works with JavaScript, 
if it's not present, don't show loader */
    .no-js #loader {
        display: none;
    }

    .js #loader {
        display: block;
        position: absolute;
        left: 100px;
        top: 0;
    }

    .se-pre-con {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url(frontend/img/Preloader_3.gif) center no-repeat #fff;
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
<script>
    //paste this code under head tag or in a seperate js file.
    // Wait for window load
    $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
    });
</script>

<div class="se-pre-con"></div>
<!--home three bg area start-->
<div class="ab p-1">
    <div class="container ">
        <div class="row" style="">

            <div class="col-md-8 text-center mt-4 mb-4">
                @include('layouts.partials.slider')
            </div>
            <div class="col-md-4 text-center" style="margin-top:65px">
                @foreach($videos as $video)
                <video controls poster="{{asset('frontend/img/video_image.jpg')}}">
                    <source src="{{asset($video->links)}}" type="video/mp4">
                </video>
                @endforeach
                <?php
                $ctgs = App\CategoryBanner::latest()->take(1)->get();
                ?>
                @foreach($ctgs as $ct)
                <a href="{{route('category.product',$ct->category->id)}}"> <img width="320px" class="mt-4" src="{{asset($ct->image)}}" alt=""></a>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row  p-4  mt-2 text-center" style="background:#f4f4f4">
        <div class="col-md-12 responsive">
            <a href="{{route('booking')}}">
                <img src="{{asset('frontend/delivery-banner.PNG')}}" alt="">
            </a>
        </div>
        <div class="row text-white text-center" style="background:#f4f4f4">
            <div class="col-md-6">
                <div style="text-align:justify" class=" text-dark p-4 w-100 ">
                    <h4 class="text-danger" style="font-weight:bold;font-size:25px">Free Next Day Delivery <span style="color:red;font-size:40px" class="fa fa-truck mt-2"></span></h4>
                    <p class="" style="font-weight:bold;font-size:16px">When You Spend £50 Online!!</p>
                </div>
            </div>
            <div class="col-md-6 align-right" style="margin-top:50px;">
                <div id="postcodeflex" class="row">
                    @if(Session::has('postcode'))
                    <div class="col-md-6 text-center text-dark">
                        <i style="color: green" class=" fa fa-check"></i> Great! We'll deliver to {{ strtoupper(Session::get('postcode')[0]) }} Postcode, not right?
                        <a class="changecode" onclick="removePostcode()">Change it</a>
                    </div>
                    <div class="col-md-6 text-left">
                        <a class="btn border" href="/booking">Book Slot</a>
                    </div>

                    @else
                    <div class="col-md-6 text-center">
                        <input style="border:1px solid #0096cf" type="text" id="postcode2" name="post_code" placeholder="Enter Post Code" class="form-control w-100 text-left" required>
                        <br>
                        <span id="postcodeErrorFlex" style="color: red"></span>
                    </div>
                    <div class="col-md-6 text-left">
                        <button class="btn" onclick="event.preventDefault();checkPostcode();" style="background:#0096cf;color:white;font-weight:bold">
                            Check Postcode
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="home3_bg_area product_five">
    <div class="container">
        <div class="row a">
            <div class="col-md-12 text-center">
                <div class="col-md-12">
                    <h2 for="" class="w-100 text-center">
                        <strong> Our Popular Categories</strong>
                        <hr class="col-md-6" style="border:2px solid #fff">
                    </h2>
                </div>
                <ul>
                    <div class="col-md-12 ">
                        <div class="row justify-content-center">
                            @foreach($categories as $category)
                            @if($category->image)
                            <div class="col-md-2 mahedy col-sm-3 col-xs-5 text-center" style="font-family:Arial;font-weight:bold;font-size:18px;height:130px; margin:2px;background:#3497a1;color:white;border-radius:5px">
                                <div class="col-md-12 text-white">
                                    <a style="margin-top:10px !important;" href="{{route('category.product',$category->id)}}">
                                        <p style="margin-top:20px;">{{$category->name}}</p>
                                    </a>
                                    <a href="{{route('category.product',$category->id)}}">
                                        <img style="position: absolute;
                                                top: 24px;
                                                right: 15px;" height="120px" width="120px" src="{{$category->image}}" alt="">
                                    </a>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </div>
    <!-- bus -->
    <div class="row text-center p-4">
        <div class="col-md-12">
            <a href="{{route('shop')}}"> <img src="{{asset('frontend/free_delivery.png')}}" alt=""></a>
        </div>

    </div>
    <div class="row p-4">
        <div class="col-md-12">
            <h1 class="text-center">Find Us</h1>
            <hr class="" style="width:30%;border:2px solid #fdfdfd ">
        </div>
        <div class="container p-4" style="font-family:arial">
            <div class="row">
                <div class="col-md-6 card p-2">
                    <h3 class="card-header p-2 text-center" style="font-weight:bold;padding:5px 0;background:#3497a1;font-size: 23px; color:white ">Bus Station Near By The Shop</h3>
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($buses as $key => $bus)
                            <div class="carousel-item {{$key==0 ? 'active':''}}">
                                <a href="{{$bus->description}}" target="_blank"> <img max-height="500" class="d-block w-100" src="{{asset($bus->image)}}" alt="First slide"></a>
                                <div class="carousel-caption d-none d-md-block">
                                    <h2 style="font-weight:bold;color:yellow">{{$bus->name}}</h2>
                                    <h4 style="font-weight:bold;color:black"><a target="_blank" href="{{$bus->description}}" class="btn text-white" style="background:#3497a1;"> Go To Google Map</a></h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 card p-2 text-center">
                    <div id="carouselExampleControls1" class="carousel slide" data-ride="carousel">
                        <h3 class="card-header p-2" style="font-weight:bold;padding:5px 0; background:#3497a1;  color:white;   font-size: 23px;">Train Station Near By The Shop</h3>
                        <div class="carousel-inner">
                            @foreach($trains as $key => $train)
                            <div class="carousel-item {{$key==0 ? 'active':''}}">
                                <a href="{{$train->description}}" target="_blank"> <img class="d-block w-100" src="{{asset($train->image)}}" alt="First slide"></a>
                                <div class="carousel-caption d-none d-md-block">
                                    <h2 style="font-weight:bold;color:yellow">{{$train->name}}</h2>
                                    <h4 style="font-weight:bold;color:black"><a target="_blank" href="{{$train->description}}" class="btn text-white" style="background:#3497a1;"> Go To Google Map</a></h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls1" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container p-4" style="font-family:arial">
            <div class="row">
                <div class="col-md-6 card p-2">
                    <h3 class="card-header p-2 text-center" style="font-weight:bold;padding:5px 0; background:#3497a1;font-size: 23px;color:white">Car Parking Near By The Shop</h3>
                    <div id="carouselExampleControls2" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($cars as $key => $car)
                            <div class="carousel-item {{$key==0 ? 'active':''}}">
                                <a href="{{$car->description}}" target="_blank"><img class="d-block w-100" src="{{asset($car->image)}}" alt="First slide"></a>
                                <div class="carousel-caption d-none d-md-block">
                                    <h2 style="font-weight:bold;color:yellow">{{$car->name}}</h2>
                                    <h4 style="font-weight:bold;color:black"><a target="_blank" href="{{$car->description}}" class="btn text-white" style="background:#3497a1;"> Go To Google Map</a></h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls2" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls2" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 card p-2">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <h3 class="card-header p-2  text-center" style="font-weight:bold;padding:5px 0; background:#3497a1; color:white;   font-size: 23px; ">Click and Collect</h3>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <a href="{{route('booking')}}"> <img class="d-block w-100" src="{{asset('frontend/click.jpg')}}" alt="First slide"></a>
                                <div class="carousel-caption d-none d-md-block">
                                    <h4 style="font-weight:bold;color:black">
                                        @if(Session::has('postcode'))
                                        <a target="_blank" href="{{route('booking')}}" class="btn text-white btn-lg p-2" style="background:#ff4d21;border-radius:10px;border:3px solid #003952"> Booking Slot</a>
                                        @else
                                        <a href="" onclick="event.preventDefault();" data-toggle="modal" data-target="#postcodeModal" style="background:#ff4d21;border-radius:10px;border:3px solid #003952" class="btn text-white btn-lg p-2"> Booking Slot</a>
                                        @endif
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- train -->
    <!--home three bg area start-->
    <div class="home3_bg_area product_five">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="productbg_right_left">
                        <div class="deals_prodict_three">
                            <div style="background:#009e9d" class="deals_title">
                                <h2>Valuable Deals</h2>
                            </div>
                            <div class="deals_prodict_inner3">
                                <div class="product_carousel deals3_column1 owl-carousel">
                                    @if (isset($offers))
                                    @foreach ($offers as $offer)
                                    <article class="single_product">
                                        <figure>
                                            <div class="product_thumb">
                                                <a class="primary_img" href="{{ route('productDetails', [$offer->product->id, Str::slug($offer->product->name)]) }}"><img src="{{ asset($offer->product->image[0]->image) }}"></a>
                                                @if (!empty($offer->product->image[1]))
                                                <a class="secondary_img" href="{{ route('productDetails', [$offer->product->id, Str::slug($offer->product->name)]) }}"><img src="{{ asset($offer->product->image[1]->image) }}"></a>
                                                @else
                                                <a class="secondary_img" href="{{ route('productDetails', [$offer->product->id, Str::slug($offer->product->name)]) }}"><img src="{{ asset($offer->product->image[0]->image) }}"></a>
                                                @endif
                                                <div class="label_product">
                                                    <span class="label_sale">Sale</span>
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
                                                                    document.getElementById('wish-delete-offer-{{ $wish->id }}').submit()}">
                                                                <span class="fa fa-heart"></span>
                                                            </a></li>
                                                        <form action="{{ route('deletewishlist', $wish->id) }}" id="wish-delete-offer-{{ $wish->id }}" method="post">
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
                                            <figcaption class="product_content">
                                                <h4 class="product_name"><a href="{{ route('productDetails', [$offer->product->id, Str::slug($offer->product->name)]) }}">{{ $offer->product->name }}</a></h4>
                                                <p><a href="#">Fruits</a></p>
                                                <div class="price_box">
                                                    <span class="current_price">£{{ $offer->offerPrice }}</span>
                                                    <span class="old_price">£{{ $offer->product->price }}</span>
                                                </div>
                                                <div class="product_timing">
                                                    <div data-countdown="{{ $offer->validTill }}"></div>
                                                </div>
                                                @php
                                                $value= 0;
                                                $crt = \Cart::get($offer->product->id);
                                                @endphp
                                                @if (isset($crt) && !empty($crt))
                                                @php
                                                $value = $crt->quantity;
                                                @endphp
                                                @endif
                                                <div id="cartbuttons_{{ $offer->product->id }}" class="addto_cart_btn">
                                                    @if ($value > 0)
                                                    <input id="pdcartqty_{{ $offer->product->id }}" type="hidden" name="quantity" value="{{ $crt->quantity }}">
                                                    @else
                                                    <input id="pdcartqty_{{ $offer->product->id }}" type="hidden" name="quantity" value="0">
                                                    @endif
                                                    @if (Session::has('postcode'))
                                                    <button onclick="addtocart({{ $offer->product->id }})" class="btn btn-md text-white w-90 ml-2" style="border-radius:5px;background:#009e9d;padding:7px 15px; margin-right: 5px;"><i class="fa fa-cart-plus"></i> Grab the offer Now</button>
                                                    @else
                                                    <button onclick="event.preventDefault();" data-toggle="modal" data-target="#postcodeModal" class="btn btn-md text-white w-90 ml-2" style="border-radius:5px;background:#009e9d;padding:7px 15px; margin-right: 5px;"><i class="fa fa-cart-plus"></i> Grab the offer Now</button>
                                                    @endif
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </article>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="banner_thumb text-center">
                            @php
                            $bbnr=App\CategoryBanner::first();
                            @endphp
                            <a href="{{route('category.product',$bbnr->category->id)}}"><img style="max-width:350px;" src="{{asset($bbnr->image)}}" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="productbg_right_side">
                        <div class="small_product_inner3">
                            <div class="section_title">
                            </div>
                            @php
                            $brandbannerfirst = App\BrandBanner::latest()->first();
                            @endphp
                            <div class="single_banner">
                                <div class="banner_thumb">
                                    <a href="{{route('shop')}}"><img width="100%" src="{{ asset($brandbannerfirst->image) }}" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="product_conatiner3">
                            <div class="section_title">
                            </div>
                            <div class="row">
                                @php
                                use App\Product;
                                $catbanners = App\CategoryBanner::latest()->take(1)->get();
                                @endphp
                                @foreach($catbanners as $b)
                                <div class="col-lg-12 col-md-12 mb-5">
                                    <div class="single_banner text-center">
                                        <div class="banner_thumb">
                                            <a href="{{route('category.product',$b->category->id)}}"><img style="max-width:700px;" src="{{$b->image}}" alt="780x500"></a>
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
        <!--home three bg area end-->
        <div class="row" id="Recipes">
            <div class="col-md-12 container">
                <h2 style="padding:20px" class="text-center"><strong>Our Recipes</strong></h2>

                <div class="col-md-12  bg-white text-black" style="padding:20px">
                    <div class="row">
                        @foreach($recipes as $recipe)
                        <div class="col-md-6 p-2">

                            <iframe width="100%" height="375px" src="{{ $recipe->link }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </iframe>

                            <h2 style="padding:20px 0px;color:green;font-weight:bold" class""> {{$recipe->title}}</h2>
                            <p style="font-size:16px; text-align:justify"> <strong> {!!$recipe->content!!}</strong></p>
                            <button style="" class="btn btn-success text-left p-2 mt-2 btn-md " data-toggle="modal" data-target="#exampleModal{{$recipe->id}}">Read More</button>
                        </div>
                        <div class="modal fade" id="exampleModal{{$recipe->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{$recipe->title}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p style="font-size:18px; text-align:justify"> <strong>{{$recipe->content}}</strong></p>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
        <!--Category banner area start-->
        <section class="blog_section">
            <div class="container">
                <div class="row">
                    <div class="blog_carousel blog_column3 owl-carousel">
                        @php
                        $catbanners = App\CategoryBanner::latest()->get();
                        @endphp
                        @foreach ($catbanners as $catbanner)
                        <div class="col-lg-3 catbanner d-block">
                            <article class="single_blog">
                                <figure>
                                    <div class="blog_thumb">
                                        <a href="{{ route('category.product',$catbanner->category->id) }}"><img style="height:300px; width:400px" src="{{ $catbanner->image }}" alt=""></a>
                                    </div>
                                    {{-- <figcaption class="blog_content">
                                   <footer class="blog_footer">
                                        <a href="blog-details.html">Show more</a>
                                    </footer>
                                </figcaption> --}}
                                </figure>
                            </article>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!--Category Banner area end-->
        <!--banner fullwidth area satrt-->
        <div class="banner_fullwidth">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="banner_full_content">
                            <p>Black Fridays !</p>
                            <h2>Sale 50% OFf <span>all vegetable products</span></h2>
                            <a href="shop">discover now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--banner fullwidth area end-->


        <!--blog area start-->
        <!--blog area end-->



        <!--instagram area start-->

        <!--instagram area end-->

        <!--brand area start-->
        <div class="brand_area">
            <h3 class="text-center"><strong> Our Product Brand</strong></h3>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="brand_container owl-carousel ">
                            <?php
                            $brands = App\Brand::latest()->get();
                            ?>
                            @foreach($brands as $b)
                            <div class="single_brand">
                                <a href="{{route('brand.product',$b->id)}}"><img style="height: 120px;" src="{{ asset($b->image) }}" alt=""></a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--brand area end-->
        <!--brand area end-->
        <div class="brand_area">
            <h3 class="text-center"><strong class=""> <i class="fa fa-instagram text-danger" aria-hidden="true"></i> Our Customer Review </strong></h3>
            <p class="text-danger text-center">Join With Us In Instagram</p>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="brand_container owl-carousel ">
                            @foreach($instagrams as $a)
                            <div class="single_brand">
                                <a href="{{$a->link}}" target="_blank"><img max-width="400" src="{{asset($a->image)}}" alt=""></a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection