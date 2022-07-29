@extends('layouts.app')

@section('content')

<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                   <h3>Free Delivery</h3>
                    <ul>
                        <li><a href="/">home</a></li>
                        <li>Free Delivery</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--contact map start-->
<div class="container">
    <div class="my-3">
 <img src="{{asset('frontend/img/free_delivery.jpg')}}" alt="">
 </div>
 <div>
    </div>
</div>
<!--contact area end-->
@endsection
