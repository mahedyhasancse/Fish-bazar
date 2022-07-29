<?php

$categories = App\ProductCategory::where('parent_id', null)->take(7)->get();
$cart = \Cart::getContent();
$recipemenus = App\Recipe::where('parent_id', null)->get();
$brands = App\Brand::all();
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap');

    .mini_cart {
        font-family: 'Noto Sans TC', sans-serif;
    }

    .color_four .search_box button {
        color: white;
        background: #48893e;
    }

    .col-lg-8 ul li:hover a {
        background: #296d54 !important;
        color: #fff !important;
        cursor: pointer;

    }

    .main_menu nav>ul>li>a {
        font-size: 17px;

    }

    .logo img {
        max-width: 150px !important;

    }

    #scrollUp {
        background: #28bf9e;
    }
</style>
<!--offcanvas menu area start-->
<div class="off_canvars_overlay">
</div>
<div class="offcanvas_menu">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="canvas_open text-white" style="font-weight:bold">
                    <a href="javascript:void(0)"><i class="icon-menu"></i></a>
                </div>
                <div class="offcanvas_menu_wrapper">
                    <div class="canvas_close">
                        <a href="javascript:void(0)"><i class="icon-x"></i></a>
                    </div>
                    <div class="header_social text-right">
                        <ul>
                        </ul>
                    </div>
                    <div class="search_container">
                        <form action="{{route('search.product')}}" method="get">
                            @csrf
                            <div class="search_box">
                                <input class="" placeholder="Search product..." name="name" type="text">
                                <button type="submit"><span class="lnr lnr-magnifier"></span></button>
                            </div>
                        </form>
                    </div>

                    <div class="call-support">
                        <p><a href="tel:+447711232329">+447711232329</a> Customer Support</p>
                    </div>
                    <div id="menu" class="text-left ">
                        <ul class="offcanvas_main_menu">
                            <li>
                                @if(auth()->user())
                                <a href="{{ route('login') }}"> <i class="fa fa-user fa-md"></i> {{ auth()->user()->username }}</a>
                                @else
                                <a href="{{ route('login') }}"> <i class="fa fa-user fa-md"></i> Login / Register</a>
                                @endif
                            </li>

                            @foreach($categories as $category)
                            @if ($category->subcategories->count() > 0)
                            <li class="menu-item-has-children">
                                @else
                            <li>
                                @endif
                                <a class="" href="{{route('category.product',$category->id)}}"> {{$category->name}}</a>
                                @if ($category->subcategories->count() > 0)
                                <ul class="sub-menu">
                                    @foreach ($category->subcategories as $subcat)
                                    <li class="menu-item-has-children">
                                        <a href="{{route('category.product',$subcat->id)}}">{{ $subcat->name }}</a>
                                        @if ($subcat->subcategories->count() > 0)
                                        <ul class="sub-menu">
                                            @foreach ($subcat->subcategories as $subsubcat)
                                            <li><a href="{{route('category.product',$subsubcat->id)}}">{{ $subsubcat->name }}</a></li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach

                            <li class="menu-item-has-children">
                                <a href="{{route('value1.product')}}"> £1 Value</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{route('offerProducts')}}">Offers</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{route('shop')}}">Shop</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{route('all.recipes')}}"> Recipes</a>
                                @if ($recipemenus->count() > 0)
                                <ul class="sub-menu">
                                    @foreach ($recipemenus as $item)
                                    <li><a href="{{route('recipesByCategory', $item->id)}}">{{ $item->title }}</a></li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ route('about') }}">about Us</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ route('contact') }}"> Contact Us</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a class="px-2 rounded" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementByzId('logout-form').submit();"> <i class="fa fa-power-off"></i> logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="offcanvas_footer">
                        <span><a href="#"><i class="fa fa-envelope-o"></i>contact@divinegreen.co.uk</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--offcanvas menu area end-->

<header>
    <div class="main_header color_four">
        <!-- <div class="panel panel-cart carthead">
            <div class="panel-heading text-center mini_cart_wrapper">
                <a href="javascript:void(0)" id="cartMinimize" onclick="return false"><i class="fa fa-shopping-cart"></i> <br> <span id="cartheadcount">{{ $cart->count() }}</span> items </a>
                <div id="cartheadprice" class="clearFix">£{{\Cart::getTotal()}}</div>
            </div>
        </div> -->

        <div class="header_middle header_middle5 text-whtie" style=" background-image:url('/frontend/img/Header.png');color:white; background-repeat:no-repeat;background-size:cover;  ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                        <div class="logo text-center">
                            <a href="/"><img style="margin-left:100px;margin:20px;min-width:220px !important" src="{{asset('/frontend/fishbazaar.png')}}" alt=""></a>
                        </div>

                    </div>
                    <!-- <div class="col-lg-4">
                  
                    <a href="" class=""> <img style="width:300px; margin-left:100px" src="/frontend/top-deliver.png" /></a>

                   </div> -->
                    <!--<div class="col-lg-5 col_search5 ">-->
                    <!--    <div class="search_box search_five">-->

                    <!--    </div>-->
                    <!--</div>-->
                    <style>
                    </style>
                    <div class="col-lg-8 col-md-7 col-sm-7 col-12">
                        <div class="header_account_area">
                            <div class="header_account_list register text-danger">
                                <ul>
                                    @if(auth()->user())
                                    <li>
                                        <h4><a onclick="event.preventDefault();showdashboardtoggle();" href="{{ route('login') }}"> <i class="fa fa-user-o fa-lg text-white"></i><strong> {{ auth()->user()->username }}</strong></a></h4>
                                    </li>
                                    @else
                                    <li>
                                        <h4><a href="{{ route('login') }}"> <i class="fa fa-user-o fa-lg mr-2 text-white"></i><strong>Login</strong></a></h4>
                                    </li>
                                    @endif
                                </ul>
                                <div id="dashboardtoggle" class="" style="position: absolute; background-color: white; padding: 8px 10px; border-radius: 5px; display:none">
                                    <ul class="d-flex flex-column">
                                        <li class="py-1"><a class="px-2 rounded" href="{{ route('login') }}">dashboard</a></li>
                                        <li class="py-1"> <a class="px-2 rounded" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"> <i class="fa fa-power-off"></i> logout</a></li>
                                    </ul>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <script>
                                        var abc = 0

                                        function showdashboardtoggle() {
                                            if (abc == 0) {
                                                $("#dashboardtoggle").css("display", 'block')
                                                abc = 1
                                            } else {
                                                $("#dashboardtoggle").css("display", 'none')
                                                abc = 0
                                            }
                                        }
                                    </script>
                                </div>
                            </div>
                            <div class="header_account_list header_wishlist text-danger ">
                                <a href="{{ route('wishlist') }}" style="color:red;"><span class="lnr lnr-heart text-white"></span> <span class="item_count bg-danger ">@if(auth()->user() && auth()->user()->wishlist){{ auth()->user()->wishlist->count() }}@else 0 @endif</span> </a>
                            </div>
                            <style>
                                .u a {
                                    float: left;
                                    overflow: hidden;
                                    margin: 0;
                                    padding: 3px;
                                }
                            </style>

                            <div class="header_account_list header_wishlist text-right u d-flex" style="margin-top:-10px">
                                <a href=""><img width="40" height="40" src="/frontend/img/linkedin.png" /></a>
                                <a href="https://www.instagram.com/"><img width="40" height="40" src="/frontend/img/instagram.png" /></a>
                                <a href="https://www.facebook.com/"> <img width="40" height="40" src="/frontend/img/facebook.png" /></a>
                                <a href="https://www.youtube.com/?gl=BD"> <img width="40" height="40" src="/frontend/img/youtube.png" /></a>
                                <span class="">
                                    <a id="button"><img src="/frontend/top.png" class="border" alt="" style="border-radius:5px"></a>
                                </span>
                            </div>
                            <div class="header_account_list  mini_cart_wrapper" style="">
                                <a href="javascript:void(0)"><span class="lnr lnr-cart text-white"></span><span id="cartheadcount">{{ $cart->count() }}</span></a>
                                <!--mini cart-->
                                <div class="mini_cart">
                                    <div class="cart_gallery">
                                        <div class="cart_close">
                                            <div class="cart_text">
                                                <h3><i class="fa fa-shopping-cart"></i> cart</h3>
                                            </div>
                                            <div class="mini_cart_close">
                                                <a href="javascript:void(0)"><i class="icon-x"></i></a>
                                            </div>
                                        </div>
                                        <div id="loadingcart" class='text-center' style="padding-top: 50%; display:none;"><img src='{{ asset('frontend/img/loading.gif') }}'></div>
                                        <div id="loadedcart" class="row pl-2 d-block text-danger" style="overflow: auto; height:70vh">
                                            @foreach($cart as $c)
                                            @php
                                            $product= App\Product::find($c->id);
                                            @endphp
                                            <div id="cart_item_{{ $product->id }}">
                                                <div class="row mx-1 pl-2">
                                                    <div class="cart_img">
                                                        <a href="#"><img src="{{asset($product->image[0]->image)}}" alt=""></a>
                                                    </div>
                                                    <div class="cart_p_name  ">
                                                        <a href="#">{{$product->name}}</a>
                                                    </div>

                                                </div>
                                                <div class="row mx-3 justify-content-between " style="margin-top: 0.3rem">
                                                    <div class="col-xs-5 text-center cart-button">
                                                        <div class="d-flex" style="width: 33%">
                                                            <button onclick="rmpdfmcart({{ $product->id }})" class="btn btn-primary btn-sm">-</button>
                                                            <input id="cartqty_{{ $product->id }}" class="cartqty text-center" type="number" min="1" value="{{ $c->quantity }}">
                                                            <button onclick="addpdtocart({{ $product->id }})" class="btn btn-primary btn-sm">+</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 cart_info text-center">
                                                        <p id="cartpdqty_{{ $product->id }}" style="margin: 0;">
                                                            {{$c->quantity}} x <span> £{{$c->price}} </span>
                                                        </p>
                                                        <p style="margin: 0;">
                                                            {{ $product->productDetails->model }}
                                                        </p>
                                                    </div>
                                                    <div class="col-xs-1">
                                                        <div class="cart_remove">
                                                            <button onclick="rmvfmcart({{ $product->id }})" type="submit" style="border:none;"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr style="margin-top: 0.3rem;margin-bottom: 0.3rem; border: 0; border-top: 1px solid rgb(64 169 68 / 34%);">
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="mini_cart_footer pl-2 text-white text-right" style="background:#48893e;border:2px solid white;">
                                        <div class="mini_cart_table" style="background:#48893e;">
                                            <div class="">
                                                <div class="">
                                                    <span style="font-size:17px;">Sub Total = </span>
                                                    <span id="cartsubtotal" class="price" style="font-size:17px;"> £ {{\Cart::getTotal()}}</span>
                                                </div>
                                                <div class="" style="background:#4c9c3a;padding:6px">
                                                    <span style="font-size:17px;"><strong>Total =</strong> </span>
                                                    <span id="carttotal" class="price" style="font-size:17px;"> £ {{\Cart::getTotal()}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="cart_button text-center" style="padding:0 30px 30px 30px">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a href="{{route('show.cart')}}" style="background:#499638;"><i class="fa fa-shopping-cart"></i> View cart</a>
                                                </div>
                                                <div class="col-md-6">
                                                    @if(Session::has('postcode'))
                                                    <a href="{{url('user/checkout')}}/ha/ha" style="background:#499638;"><i class="fa fa-sign-in"></i> Checkout</a>
                                                    @else
                                                    <a href="" onclick="event.preventDefault();" data-toggle="modal" data-target="#postcodeModal" style="background:#499638;"><i class="fa fa-sign-in"></i> Checkout</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!--mini cart end-->
                            </div>
                        </div>
                        <div class="justify-content-right">
                            <div class="col-md-auto text-white text-center rounded" style="background:#f4f4f4;box-shadow: 2px 2px 10px #ff0000db; position: absolute; z-index: 100000">
                                <div id="newpost" class="justify-content-center text-dark p-4">
                                    <h3 class="text-danger" style="font-weight:bold">Free Next Day Delivery <span style="color:red;font-size:40px" class="fa fa-truck mt-2"></span></h3>
                                    <h4 class="">When You Spend £50 Online!!</h4>
                                    <div id="postcodeSpace">
                                        @if (Session::has('postcode'))
                                        <p style="font-weight:bold">
                                            <i style="color: green" class=" fa fa-check"></i> Great news! We'll deliver your shop to {{ strtoupper(Session::get('postcode')[0]) }} <br> for free when you spend over £50!
                                            <a class="changecode" onclick="removePostcode()">Change Postcode</a>
                                        </p>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a class="btn border" href="/booking">Book Slots</a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a class="btn" href="" style="background:#38c79f;color:white;font-weight:bold">
                                                            Continue
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <p style="font-weight:bold">Check if we can deliver. Please enter your postcode <br> below to check if we are able to deliver to your address.</p>
                                        <div class="row justify-content-center">
                                            <div class="col-md-8-auto">
                                                <form action="" method="get">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input style="border:1px solid red" type="text" id="post_code" name="post_code" placeholder="Post code" class="form-control w-100 text-left" required>
                                                            <br>
                                                            <span id="postcodeError" style="color: red"></span>
                                                        </div>
                                                        <div id="postcodebutton" class="col-md-6">
                                                            <button class="btn" onclick="event.preventDefault();checkPostcode();" style="background:#38c79f;color:white;font-weight:bold">
                                                                Check Postcode
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom sticky-header" style="background-image:url('/frontend/img/topmenu.png');font-weight:bold;font-size:20px; ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-11">
                        <div class="main_menu menu_position a ">
                            <nav>
                                <ul class="justify-content-between">
                                    @foreach($categories as $category)
                                    @if($category->subcategories->count() > 0)
                                    <li class="mega_items">
                                        <a class="text-white" href="{{route('category.product',$category->id)}}"> {{$category->name}} <i class="fa fa-angle-down"></i></a>
                                        @else
                                        <style>
                                            .nb:hover {
                                                background-color: red;
                                                padding: 2px;
                                                border-radius: 10px;
                                            }
                                        </style>
                                        <a class="text-white nb" style="font-size: 17px; line-height: 50px;  text-transform: capitalize;font-weight: 400;position: relative;" href="{{route('category.product',$category->id)}}"> {{$category->name}}</i></a>
                                        @endif
                                        @if ($category->subcategories->count() > 0)
                                        <div class="mega_menu " style="">
                                            <ul class="mega_menu_inner d-flex flex-column">
                                                <div class="row">
                                                    <style></style>
                                                    <div class="mt-4 col-md-6">
                                                        @foreach ($category->subcategories as $subcat)
                                                        <div class="col-md-12">
                                                            <li class="ml-2" style="padding: 5px; padding-left: 8px; width:100%;  margin-bottom: 5px;">
                                                                <a class="rmhover" href="{{route('category.product',$subcat->id)}}">{{ $subcat->name }}</a>
                                                            </li>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="mt-4 col-md-6">
                                                        <h3 class="card-header bg-dark text-white mb-2">Our Popular Brands</h3>
                                                        @foreach($brands as $band)
                                                        <div class="ml-2">
                                                            <a class="rmhover m-4" href="{{route('brand.product',$band->id)}}">{{ $band->name }}</a>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </ul>
                                        </div>
                                        @endif
                                    </li>
                                    @endforeach

                                    <li> <a class="text-white" href="{{route('offerProducts')}}">Offers</a></li>
                                    <li> <a class="text-white" href="{{route('shop')}}">Shop</a></li>
                                    <li> <a class="text-white" href="{{route('value1.product')}}"> £1 Value</a></li>
                                    <style>
                                        .recipemenu {
                                            min-width: auto !important;
                                            height: auto;
                                        }

                                        .rmhover:hover {
                                            background-color: #08a997;
                                            border-radius: 5px;
                                            color: white !important;
                                        }
                                    </style>
                                    <li class="mega_items"><a class="text-white" href="{{route('all.recipes')}}"> Recipes <i class="fa fa-angle-down"></i></a>
                                        @if ($recipemenus->count() > 0)
                                        <div class="mega_menu ">
                                            <ul class="mega_menu_inner d-flex flex-column col-md-4">
                                                @foreach ($recipemenus as $item)
                                                <li class="rmhover" style="border-bottom: 1px solid grey; padding-top: 5px; padding-left: 8px;">
                                                    <a class="rmhover" href="{{ route('recipesByCategory', $item->id) }}">{{ $item->title }}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                    </li>
                                    <!-- <li><a style="color: white" href="{{route('about')}}">About Us<i class=""></i></a></li>
                                    <li><a class="text-white" href="{{ route('contact') }}"> Contact Us</a></li> -->
                                    <li class="text-center">
                                        <form action="{{route('search.product')}}" method="get">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-dark mt-2" data-toggle="modal" data-target="#exampleModal1515">
                                                <strong><span class="lnr lnr-magnifier "></span></strong>
                                            </button>
                                            <!-- Modal -->
                                        </form>
                                    </li>

                                </ul>

                            </nav>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>

<!--header area end-->
<div class="modal fade" id="exampleModal1515" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search Here</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{route('search.product')}}" method="get">
                    @csrf
                    <div class="search_box">
                        <input class="border" style="border:1px solid green" placeholder="Search product..." name="name" type="text">
                        <button type="submit"><span class="lnr lnr-magnifier"></span></button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>