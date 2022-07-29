<?php

use Carbon\Carbon;

$current = Carbon::now()->format('l - d F');
$day2 = Carbon::now()->addDay(1)->format('l - d F');
$day3 = Carbon::now()->addDay(2)->format('l - d F');
$day4 = Carbon::now()->addDay(3)->format('l - d F');
$day5 = Carbon::now()->addDay(4)->format('l - d F');
$day6 = Carbon::now()->addDay(5)->format('l - d F');
?>
@extends('layouts.app')
@section('style')
<style type="text/css">
    .a {
        font-family: -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    .box {
        color: black;
        display: none;
        margin-top: 20px;
    }

    .check {
        background: #ffffff;
    }

    .cash label {
        border: 2px solid #296d54;
        border-radius: 5px;
        padding: 5px;
        max-width: 250px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 16px;
        background-color: #afefbb;

    }

    .stepwizard-step {
        align-self: center;
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
@endsection
@section('content')
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
<div>
    <div class="se-pre-con"></div>
    <div class="container">
        <div class="row p-4">
            <div class="col-md-12">
                <img src="{{asset('frontend/free_delivery.png')}}" alt="">
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



    <div class="container">
        <h2 class="text-center">Home Delivery Slots</h2>
        <hr class="w-50">
        <h4>Available times: {{$current}}— {{$day6}}</h4>
        <form action="{{route('delivery.slots')}}" method="post">
            @csrf
            <div class="col-md-12">
                <div class="form-group col-md-12 date">
                    <div class="row">
                        <div class="stepwizard  mt-2" style="font-size:18px;padding:15px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row setup-panel" style="padding-right:20px; font-size:20px">
                                        <div class="col-md-2 col-sm-4 col-xs-6 stepwizard-step">

                                            <label for="d112">
                                                <a href="#step-7" id="d112" class="btn btn-default btn border" style="font-size:20px;margin:0;padding:10px;">
                                                    <input type="radio" id="d112" value="<?php echo $current ?>" name="date" hidden /> Today
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-md-2 col-sm-4 col-xs-6 stepwizard-step " style="padding:20px; font-size:20px">

                                            <label for="d113">
                                                <a href="#step-8" id="d113" class="btn btn-default btn border" style="font-size:20px;margin:0;padding:10px;">
                                                    <input type="radio" id="d113" value="<?php echo $day2 ?>" name="date" hidden /><?php echo $day2 ?>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-md-2 col-sm-4 col-xs-6 stepwizard-step" style="padding:20px; font-size:20px">
                                            <label for="d12">
                                                <a href="#step-9" class="btn btn-default btn border" style="font-size:20px;margin:0;padding:10px;" disabled="disabled">
                                                    <input type="radio" id="d12" value="<?php echo $day3 ?>" name="date" hidden /><?php echo $day3 ?>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-md-2 col-sm-4 col-xs-6 stepwizard-step" style=" font-size:20px">
                                            <label for="d13">
                                                <a href="#step-10" class="btn btn-default btn  border" disabled="disabled" style="font-size:20px;margin:0;padding:10px;" disabled="disabled">
                                                    <input type="radio" id="d13" class="btn" value="<?php echo $day4 ?>" name="date" hidden /><?php echo $day4 ?>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-md-2 col-sm-4 col-xs-6 stepwizard-step" style="padding:20px; font-size:20px">
                                            <label for="d14">
                                                <a href="#step-11" class="btn btn-default btn border" disabled="disabled" style="font-size:20px;margin:0;padding:10px;">
                                                    <input type="radio" id="d14" class="btn" value="<?php echo $day5 ?>" name="date" hidden /> <?php echo $day5 ?></a>
                                            </label>
                                        </div>
                                        <div class="col-md-2 col-sm-4 col-xs-6 stepwizard-step" style="padding:20px; font-size:20px">
                                            <label for="d15">
                                                <a href="#step-12" z class="btn btn-default btn border" style="font-size:20px;margin:0;padding:10px;" disabled="disabled">
                                                    <input type="radio" id="d15" class="btn" value="<?php echo $day6 ?>" name="date" hidden /> <?php echo $day6 ?></a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row setup-content" id="step-7">
                        <div class="col-xs-6 col-md-offset-3 container">
                            <div class="col-md-12" style="font-size:20px">
                                <label for="a1" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" value="8.00 to 10.00" name="time" id="a1"> 8.00 to 10.00  <span class="text-dark btn-sm ml-4" style="border-radius:10px; margin-left:100px">Available</span>
                                        <span class=" p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px">Booking Delivery</span> </strong>
                                </label> <br>
                                <label for="b1" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" name="time" value="11.00 to 13.00" id="b1"> 11.00 to 13.00 <span class="  text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="btn-sm p-2 btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span></strong>
                                </label><br>
                                <label for="c1" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" name="time" value=" 14.00 to 16.00" id="c1"> 14.00 to 16.00 <span class=" text-dark btn-sm ml-4" style="border-radius:10px;">Available</span>
                                        <span class="btn-sm p-2  btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span></strong>
                                </label><br>
                                <label for="d1" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" value="17.00 to 19.00" name="time" id="d1"> 17.00 to 19.00 <span class=" text-dark btn-sm ml-4" style="border-radius:10px;">Available</span>
                                        <span class="btn-sm p-2  btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span>
                                    </strong>
                                </label><br>
                                <label for="f1" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" value=" 20.00 to 22.00" name="time" id="f1"> 20.00 to 22.00 <span class=" text-dark btn-sm ml-4" style="border-radius:10px;">Available</span>
                                        <span class="btn-sm p-2  btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span>
                                    </strong>
                                </label><br>
                                @error('time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row setup-content" id="step-8">
                        <div class="col-xs-6 col-md-offset-3 container">
                            <div class="col-md-12" style="font-size:20px">
                                <label for="a2" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" name="time" id="a2" value="8.00 to 10.00"> 8.00 to 10.00 <span class=" text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span> </strong>
                                </label> <br>
                                <label for="b2" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" name="time" value="11.00 to 13.00" id="b2">11.00 to 13.00<span class="  text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span></strong>
                                </label><br>
                                <label for="c2" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" name="time" value="14.00 to 16.00" id="c2"> 14.00 to 16.00 <span class=" text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span></strong>
                                </label><br>
                                <label for="d2" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" value="17.00 to 19.00 " name="time" id="d2"> 17.00 to 19.00 <span class="text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span></strong>
                                </label><br>
                                <label for="f2" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" name="time" value="20.00 to 22.00 " id="f2"> 20.00 to 22.00 <span class=" text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4">Booking Delivery</span></strong>
                                </label><br>
                               
                                <label for="sel2" class="p-4">
                                    <input id="sel2" type="checkbox" value="<?php echo $day2 ?>" name="date"> <small style="font-weight:bold">Are You Ready for Booking Devlivery? </small>
                                </label>
                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @error('time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row setup-content" id="step-9">
                        <div class="col-xs-6 col-md-offset-3 container">

                            <div class="col-md-12" style="font-size:20px">
                                <label for="a3" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" name="time" id="a3" value=" 8.00 to 10.00">  8.00 to 10.00 <span class="  text-dark btn-sm ml-4" style="border-radius:10px; margin-left:100px">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span> </strong>
                                </label> <br>
                                <label for="b3" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" name="time" value="11.00 to 13.00" id="b3">11.00 to 13.00<span class="text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span></strong>
                                </label><br>
                                <label for="c3" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" name="time" value="14.00 to 16.00" id="c3">14.00 to 16.00 <span class=" text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4">Booking Delivery</span></strong>
                                </label><br>
                                <label for="d3" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" value="  17.00 to 19.00" name="time" id="d3">  17.00 to 19.00 <span class="  text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span></strong>
                                </label><br>
                                <label for="f3" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" name="time" id="f3" value="20.00 to 22.00"> 20.00 to 22.00  <span class=" text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span></strong>
                                </label><br>
                                <label for="sel3" class="p-4">
                                    <input id="sel3" type="checkbox" value="<?php echo $day3 ?>" name="date"> <small style="font-weight:bold">Are You Ready for Booking Devlivery? </small>
                                </label>
                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @error('time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row setup-content" id="step-10">
                        <div class="col-xs-6 col-md-offset-3 container">
                            <div class="col-xs-6 col-md-offset-3 container">
                                <div class="col-md-12" style="font-size:20px">
                                    <label for="a4" style="background:#fff;padding:15px;" class="col-md-12 ">
                                        <strong> <input type="radio" name="time" value="8.00 to 10.00" id="a4"> 8.00 to 10.00 <span class="  text-dark btn-sm ml-4" style="border-radius:10px; margin-left:100px">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span></strong>
                                    </label> <br>
                                    <label for="b4" style="background:#fff;padding:15px;" class="col-md-12 ">
                                        <strong> <input type="radio" name="time" value="11.00 to 13.00" id="b4"> 11.00 to 13.00<span class="  text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span></strong>
                                    </label><br>
                                    <label for="c4" style="background:#fff;padding:15px;" class="col-md-12 ">
                                        <strong> <input type="radio" name="time" value="14.00 to 16.00" id="c4">14.00 to 16.00 <span class=" text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span></strong>
                                    </label><br>
                                    <label for="d4" style="background:#fff;padding:15px;" class="col-md-12 ">
                                        <strong> <input type="radio" value="17.00 to 19.00 " name="time" id="d4"> 17.00 to 19.00 <span class="text-dark btn-sm ml-4" style="border-radius:10px;"> Available</span>
                                            <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;"> Booking Delivery </span></strong>
                                    </label><br>
                                    <label for="f4" style="background:#fff;padding:15px;" class="col-md-12 ">
                                        <strong> <input type="radio" name="time" id="f4" value="20.00 to 22.00">20.00 to 22.00 <span class=" text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span></strong>
                                    </label><br>
                                    <label for="sel4" class="p-4">
                                        <input id="sel4" type="checkbox" value="<?php echo $day4 ?>" name="date"> <small style="font-weight:bold">Are You Ready for Booking Devlivery? </small>
                                    </label>
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    @error('time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row setup-content" id="step-11">
                        <div class="col-xs-6 col-md-offset-3 container">
                            <div class="col-md-12" style="font-size:20px">
                                <label for="a5" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" name="time" id="a5" value="8.00 to 10.00"> 8.00 to 10.00 <span class="  text-dark btn-sm ml-4" style="border-radius:10px; margin-left:100px">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span> </strong>
                                </label> <br>
                                <label for="b5" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" id="b5" name="time" value="11.00 to 13.00"> 11.00 to 13.00 <span class="  text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span></strong>
                                </label><br>
                                <label for="c5" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" name="time" id="c5" value="14.00 to 16.00">14.00 to 16.00 <span class=" text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span></strong>
                                </label><br>
                                <label for="d5" style="background:#fff;padding:15px;" class="col-md-12">
                                    <strong> <input type="radio" name="time " value="17.00 to 19.00" id="d5"> 17.00 to 19.00 <span class="  text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span></strong>
                                </label><br>
                                <label for="f5" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" name="time" id="f5" value="20.00 to 22.00">20.00 to 22.00 <span class=" text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span></strong>
                                </label><br>
                                <label for="sel5" class="p-4">
                                    <input id="sel5" type="checkbox" value="<?php echo $day5 ?>" name="date"> <small style="font-weight:bold">Are You Ready for Booking Devlivery? </small>
                                </label>
                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @error('time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row setup-content" id="step-12">
                        <div class="col-xs-6 col-md-offset-3 container">
                            <div class="col-md-12" style="font-size:20px">
                                <label for="a6" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" name="time" id="a6" value="8.00 to 10.00"> 8.00 to 10.00 <span class="  text-dark btn-sm ml-4" style="border-radius:10px; margin-left:100px">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span> </strong>
                                </label> <br>
                                <label for="b6" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" name="time" value="11.00 to 13.00" id="b6"> 11.00 to 13.00 <span class="  text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span></strong>
                                </label><br>
                                <label for="c6" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" name="time" id="c6" value="14.00 to 16.00"> 14.00 to 16.00 <span class=" text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span></strong>
                                </label><br>
                                <label for="d6" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" name="time" id="d6" value="17.00 to 19.00"> 17.00 to 19.00 <span class=" text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span></strong>
                                </label><br>
                                <label for="f6" style="background:#fff;padding:15px;" class="col-md-12 ">
                                    <strong> <input type="radio" name="time" id="f6" value="20.00 to 22.00"> 20.00 to 22.00 <span class=" text-dark btn-sm ml-4" style="border-radius:10px;">Available</span> <span class="p-2 btn-sm btn-success text-white  ml-4" style="border-radius:8px;">Booking Delivery</span></strong>
                                </label><br>
                           
                                <label for="sel6" class="p-4">
                                    <input id="sel6" type="checkbox" value="<?php echo $day6 ?>" name="date"> <small style="font-weight:bold">Are You Ready for Booking Devlivery? </small>
                                </label>
                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @error('time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn  btn-md m-4  p-2 text-white" type="submit" style="font-size:18px;border-radius:8px;background:#28bf9e">Add Booking Delivery</button>
        </form>
    </div>
    <div class="container">
        <h2 class="text-center">Click and Collect Slots</h2>
        <hr class="w-50">
        <h4>Available times: {{$current}} — {{$day6}} </h4>
        <div class="col-md-12">
            <div class="form-group col-md-12 date">
                <div class="row">
                    <div class="stepwizard  mt-2" style="font-size:18px;padding:15px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row setup-panel" style="padding-right:20px; font-size:20px">
                                    <div class="col-md-2 col-sm-4 col-xs-6 stepwizard-step">

                                        <label for="d112">
                                            <a href="#step-1" id="d112" class="btn btn-default btn border" style="font-size:20px;margin:0;padding:10px;">
                                                <input type="radio" id="d112" value="<?php echo $current ?>" name="date" hidden /> Today
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-6 stepwizard-step " style="padding:20px; font-size:20px">

                                        <label for="d113">
                                            <a href="#step-2" id="d113" class="btn btn-default btn border" style="font-size:20px;margin:0;padding:10px;">
                                                <input type="radio" id="d113" value="<?php echo $day2 ?>" name="date" hidden /><?php echo $day2 ?>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-6 stepwizard-step" style="padding:20px; font-size:20px">
                                        <label for="d12">
                                            <a href="#step-3" class="btn btn-default btn border" style="font-size:20px;margin:0;padding:10px;" disabled="disabled">
                                                <input type="radio" id="d12" value="<?php echo $day3 ?>" name="date" hidden /><?php echo $day3 ?>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-6 stepwizard-step" style=" font-size:20px">
                                        <label for="d13">
                                            <a href="#step-4" class="btn btn-default btn  border" disabled="disabled" style="font-size:20px;margin:0;padding:10px;" disabled="disabled">
                                                <input type="radio" id="d13" class="btn" value="<?php echo $day4 ?>" name="date" hidden /><?php echo $day4 ?>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-6 stepwizard-step" style="padding:20px; font-size:20px">
                                        <label for="d14">
                                            <a href="#step-5" class="btn btn-default btn border" disabled="disabled" style="font-size:20px;margin:0;padding:10px;">
                                                <input type="radio" id="d14" class="btn" value="<?php echo $day5 ?>" name="date" hidden /> <?php echo $day5 ?></a>
                                        </label>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-6 stepwizard-step" style="padding:20px; font-size:20px">
                                        <label for="d15">
                                            <a href="#step-6" z class="btn btn-default btn border" style="font-size:20px;margin:0;padding:10px;" disabled="disabled">
                                                <input type="radio" id="d15" class="btn" value="<?php echo $day6 ?>" name="date" hidden /> <?php echo $day6 ?></a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-1">
                    <div class="col-xs-6 col-md-offset-3 container">
                        <div class="col-md-12" style="font-size:20px">
                            <label for="a1" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>11.00 to 12.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px; margin-left:100px">Available</span> </strong>
                            </label> <br>
                            <label for="b1" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>12.30 to 13.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="c1" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>13.30 to 14.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="d1" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>14.30 to 15.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="f1" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>15.30 to 16.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="gg" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>16.30 to 17.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="g1" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>17.30 to 18.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="e1" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>18.30 to 19.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="h1" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>19.30 to 20.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="i1" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>20.30 to 21.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="j1" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>21.30 to 22.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="k1" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>22.30 to 23.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            @error('time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-2">
                    <div class="col-xs-6 col-md-offset-3 container">
                        <div class="col-md-12" style="font-size:20px">
                            <label for="a2" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>11.00 to 12.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px; margin-left:100px">Available</span> </strong>
                            </label> <br>
                            <label for="b2" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>12.30 to 13.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="c2" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>13.30 to 14.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="d2" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>14.30 to 15.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="f2" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>15.30 to 16.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="gg2" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>16.30 to 17.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="g2" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>17.30 to 18.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="e2" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>18.30 to 19.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="h2" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>19.30 to 20.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="i2" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>20.30 to 21.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="j2" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>21.30 to 22.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="k2" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>22.30 to 23.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            @error('time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-3">
                    <div class="col-xs-6 col-md-offset-3 container">
                        <div class="col-md-12" style="font-size:20px">
                            <label for="a3" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>11.00 to 12.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px; margin-left:100px">Available</span> </strong>
                            </label> <br>
                            <label for="b3" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>12.30 to 13.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="c3" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>13.30 to 14.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="d3" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>14.30 to 15.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="f3" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>15.30 to 16.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="gg3" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>16.30 to 17.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="g3" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>17.30 to 18.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="e3" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>18.30 to 19.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="h3" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>19.30 to 20.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="i3" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>20.30 to 21.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="j3" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>21.30 to 22.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="k3" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>22.30 to 23.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            @error('time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-4">
                    <div class="col-xs-6 col-md-offset-3 container">
                        <div class="col-md-12" style="font-size:20px">
                            <label for="a4" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>11.00 to 12.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px; margin-left:100px">Available</span> </strong>
                            </label> <br>
                            <label for="b4" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>12.30 to 13.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="c4" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>13.30 to 14.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="d4" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>14.30 to 15.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="f4" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>15.30 to 16.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="gg4" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>16.30 to 17.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="g4" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>17.30 to 18.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="e4" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>18.30 to 19.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="h4" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>19.30 to 20.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="i4" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>20.30 to 21.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="j4" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>21.30 to 22.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="k4" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>22.30 to 23.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            @error('time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-5">

                    <div class="col-xs-6 col-md-offset-3 container">
                        <div class="col-md-12" style="font-size:20px">
                            <label for="a5" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>11.00 to 12.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px; margin-left:100px">Available</span> </strong>
                            </label> <br>
                            <label for="b5" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>12.30 to 13.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="c5" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>13.30 to 14.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="d5" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>14.30 to 15.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="f5" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>15.30 to 16.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="gg5" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>16.30 to 17.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="g5" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>17.30 to 18.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="e5" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>18.30 to 19.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="h5" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>19.30 to 20.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="i5" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>20.30 to 21.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="j5" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>21.30 to 22.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="k5" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>22.30 to 23.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            @error('time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-6">
                    <div class="col-xs-6 col-md-offset-3 container">
                        <div class="col-md-12" style="font-size:20px">
                            <label for="a6" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>11.00 to 12.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px; margin-left:100px">Available</span> </strong>
                            </label> <br>
                            <label for="b6" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>12.30 to 13.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="c6" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>13.30 to 14.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="d6" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>14.30 to 15.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="f6" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>15.30 to 16.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="gg6" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>16.30 to 17.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="g6" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>17.30 to 18.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label><br>
                            <label for="e6" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>18.30 to 19.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="h6" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>19.30 to 20.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="i6" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>20.30 to 21.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="j6" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>21.30 to 22.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            <label for="k6" style="background:#fff;padding:15px;" class="col-md-12 ">
                                <strong>22.30 to 23.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                            </label>
                            @error('time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="{{route('shop')}}" class="btn  btn-md m-4  p-2 text-white" style="font-size:18px;border-radius:8px;background:#28bf9e">
        Go To Shoping
    </a>

</div>



@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
    // $(document).click(function() {
    //     $('name="date"').click(function() {
    //         var inputValue = $(this).val();
    //     });

    // });
    // $(document).ready(function() {
    //     $('input[type="radio"]').click(function() {
    //         var inputValue = $(this).attr("value");
    //         $("." + inputValue).toggle();
    //     });
    //     $('input[type="text"]').click(function() {
    //         var inputValue = $(this).attr("value");
    //         $("." + inputValue);
    //     });

    // });
    $(document).ready(function() {
        var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn'),
            allPrevBtn = $('.prevBtn');

        allWells.hide();

        navListItems.click(function(e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                $item = $(this);

            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-success').addClass('btn-default');
                $item.addClass('btn-success');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });

        allPrevBtn.click(function() {
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

            prevStepWizard.removeAttr('disabled').trigger('click');
        });

        allNextBtn.click(function() {
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url']"),
                isValid = true;

            $(".form-group").removeClass("has-error");
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }

            if (isValid)
                nextStepWizard.removeAttr('disabled').trigger('click');
        });

        $('div.setup-panel div a.btn-success').trigger('click');
    });
</script>

@endsection