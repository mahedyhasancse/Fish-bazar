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
</style>
@endsection
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (Session::has('success'))
<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <p>{{ Session::get('success') }}</p>
</div>
@endif
<div class="card container a">
    <div class="card-header text-center">
        <h3 style="font-weight:bold;color:#296d54">Add Payment</h3>
    </div>
    <div class="">
        <form method="POST" action="{{route('order.payment',$order->id)}}" id="checkout-form">
            @csrf
            <div class="col-md-12 mb-20">
                <div class="form-group ">
                    <h3>
                        <label class="" style="font-size:26px;font-weight:bold">
                            <input type="radio" class="" name="payment" id="pfs" value="pfs" />
                            Pick From The Shop</label>
                    </h3>
                </div>
                <style>
                    .date a input {
                        font-size: 17px;
                        flex-wrap: wrap;
                        font-weight: bold;
                    }
                </style>
                <div class="form-group  pfs box col-md-12 date">
                    <div class="col-md-12">
                        <div class="form-group col-md-12 date">
                            <h4 class="card-header text-center">Please Select Collection Time:(11.00  to 23.00 )</h4>
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
                                        <label for="a1" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input class="pt-2" id="a1" type="radio" name="time" value="11.00  to 12.00 " /> <strong>11.00  to 12.00 <span class="bg-success  text-white btn-sm m-4" style="border-radius:10px;">Available</span></strong>
                                        </label> <br>
                                        <label for="b1" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="b1" type="radio" name="time" value="12.30  to 13.00"> <strong> 12.30  to 13.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="c1" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="c1" type="radio" name="time" value="13.30  to 14.00 "> <strong>13.30  to 14.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="d1" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="d1" type="radio" name="time" value="14.30  to 15.00 "> <strong>14.30  to 15.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="f1" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="f1" type="radio" name="time" value="15.30  to 16.00 "> <strong>15.30  to 16.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="g1" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="g1" type="radio" name="time" value="16.30  to 17.00 "> <strong>16.30  to 17.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="h1" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="h1" type="radio" name="time" value="17.30  to 18.00 "> <strong>17.30  to 18.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="i1" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="i1" type="radio" name="time" value="18.30  to 19.00 "> <strong>18.30  to 19.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                        <label for="j1" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="j1" type="radio" name="time" value="19.30  to 20.00 "> <strong>19.30  to 20.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                        <label for="k1" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="k1" type="radio" name="time" value="20.30  to 21.00 "> <strong>19.30  to 20.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                           <label for="l1" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="l1" type="radio" name="time" value="21.30  to 22.00 "> <strong>21.30  to 22.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                           <label for="m1" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="m1" type="radio" name="time" value="22.30  to 23.00 "> <strong>22.30  to 23.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                        <label for="sel1" class="p-4">
                                            <input id="sel1" type="checkbox" value="<?php echo $current ?>" name="date"> <small style="font-weight:bold">Are You Ready for Booking? </small>
                                        </label>
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
                            <div class="row setup-content" id="step-2">
                                <div class="col-xs-6 col-md-offset-3 container">
                                    <div class="col-md-12" style="font-size:20px">

                                            <label for="a2" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input class="pt-2" id="a2" type="radio" name="time" value="11.00  to 12.00 " /> <strong>11.00  to 12.00 <span class="bg-success  text-white btn-sm m-4" style="border-radius:10px;">Available</span></strong>
                                        </label> <br>
                                        <label for="b2" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="b2" type="radio" name="time" value="12.30  to 13.00"> <strong> 12.30  to 13.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="c2" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="c2" type="radio" name="time" value="13.30  to 14.00 "> <strong>13.30  to 14.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="d2" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="d2" type="radio" name="time" value="14.30  to 15.00 "> <strong>14.30  to 15.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="f2" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="f2" type="radio" name="time" value="15.30  to 16.00 "> <strong>15.30  to 16.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="g2" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="g2" type="radio" name="time" value="16.30  to 17.00 "> <strong>16.30  to 17.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="h2" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="h2" type="radio" name="time" value="17.30  to 18.00 "> <strong>17.30  to 18.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="i2" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="i2" type="radio" name="time" value="18.30  to 19.00 "> <strong>18.30  to 19.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                        <label for="j2" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="j2" type="radio" name="time" value="19.30  to 20.00 "> <strong>19.30  to 20.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                        <label for="k2" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="k2" type="radio" name="time" value="20.30  to 21.00 "> <strong>19.30  to 20.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                           <label for="l2" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="l2" type="radio" name="time" value="21.30  to 22.00 "> <strong>21.30  to 22.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                           <label for="m2" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="m2" type="radio" name="time" value="22.30  to 23.00 "> <strong>22.30  to 23.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                        <label for="sel2" class="p-4">
                                            <input id="sel2" type="checkbox" value="<?php echo $day2 ?>" name="date"> <small style="font-weight:bold">Are You Ready for Booking? </small>
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
                            <div class="row setup-content" id="step-3">
                                <div class="col-xs-6 col-md-offset-3 container">
                                    <div class="col-md-12" style="font-size:20px">

                                         <label for="a3" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input class="pt-2" id="a3" type="radio" name="time" value="11.00  to 12.00 " /> <strong>11.00  to 12.00 <span class="bg-success  text-white btn-sm m-4" style="border-radius:10px;">Available</span></strong>
                                        </label> <br>
                                        <label for="b3" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="b3" type="radio" name="time" value="12.30  to 13.00"> <strong> 12.30  to 13.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="c3" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="c3" type="radio" name="time" value="13.30  to 14.00 "> <strong>13.30  to 14.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="d3" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="d3" type="radio" name="time" value="14.30  to 15.00 "> <strong>14.30  to 15.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="f3" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="f3" type="radio" name="time" value="15.30  to 16.00 "> <strong>15.30  to 16.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="g3" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="g3" type="radio" name="time" value="16.30  to 17.00 "> <strong>16.30  to 17.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="h3" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="h3" type="radio" name="time" value="17.30  to 18.00 "> <strong>17.30  to 18.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="i3" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="i3" type="radio" name="time" value="18.30  to 19.00 "> <strong>18.30  to 19.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                        <label for="j3" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="j3" type="radio" name="time" value="19.30  to 20.00 "> <strong>19.30  to 20.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                        <label for="k3" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="k3" type="radio" name="time" value="20.30  to 21.00 "> <strong>19.30  to 20.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                           <label for="l3" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="l3" type="radio" name="time" value="21.30  to 22.00 "> <strong>21.30  to 22.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                           <label for="m3" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="m3" type="radio" name="time" value="22.30  to 23.00 "> <strong>22.30  to 23.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                        <label for="sel3" class="p-4">
                                            <input id="sel3" type="checkbox" value="<?php echo $day3 ?>" name="date"> <small style="font-weight:bold">Are You Ready for Booking? </small>
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
                            <div class="row setup-content" id="step-4">
                                <div class="col-xs-6 col-md-offset-3 container">
                                    <div class="col-md-12" style="font-size:20px">

                                        <label for="a4" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input class="pt-2" id="a4" type="radio" name="time" value="11.00  to 12.00 " /> <strong>11.00  to 12.00 <span class="bg-success  text-white btn-sm m-4" style="border-radius:10px;">Available</span></strong>
                                        </label> <br>
                                        <label for="b4" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="b4" type="radio" name="time" value="12.30  to 13.00"> <strong> 12.30  to 13.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="c4" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="c4" type="radio" name="time" value="13.30  to 14.00 "> <strong>13.30  to 14.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="d4" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="d4" type="radio" name="time" value="14.30  to 15.00 "> <strong>14.30  to 15.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="f4" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="f4" type="radio" name="time" value="15.30  to 16.00 "> <strong>15.30  to 16.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="g4" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="g4" type="radio" name="time" value="16.30  to 17.00 "> <strong>16.30  to 17.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="h4" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="h4" type="radio" name="time" value="17.30  to 18.00 "> <strong>17.30  to 18.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="i4" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="i4" type="radio" name="time" value="18.30  to 19.00 "> <strong>18.30  to 19.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                        <label for="j4" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="j4" type="radio" name="time" value="19.30  to 20.00 "> <strong>19.30  to 20.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                        <label for="k4" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="k4" type="radio" name="time" value="20.30  to 21.00 "> <strong>19.30  to 20.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                           <label for="l4" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="l4" type="radio" name="time" value="21.30  to 22.00 "> <strong>21.30  to 22.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                           <label for="m4" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="m4" type="radio" name="time" value="22.30  to 23.00 "> <strong>22.30  to 23.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                        <label for="sel4" class="p-4">
                                            <input id="sel4" type="checkbox" value="<?php echo $day4 ?>" name="date"> <small style="font-weight:bold">Are You Ready for Booking? </small>
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

                        <div class="row setup-content" id="step-5">

                            <div class="col-xs-6  container">
                                <div class="col-md-12" style="font-size:20px">

                                          <label for="a5" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input class="pt-2" id="a5" type="radio" name="time" value="11.00  to 12.00 " /> <strong>11.00  to 12.00 <span class="bg-success  text-white btn-sm m-4" style="border-radius:10px;">Available</span></strong>
                                        </label> <br>
                                        <label for="b5" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="b5" type="radio" name="time" value="12.30  to 13.00"> <strong> 12.30  to 13.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="c5" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="c5" type="radio" name="time" value="13.30  to 14.00 "> <strong>13.30  to 14.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="d5" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="d5" type="radio" name="time" value="14.30  to 15.00 "> <strong>14.30  to 15.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="f5" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="f5" type="radio" name="time" value="15.30  to 16.00 "> <strong>15.30  to 16.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="g5" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="g5" type="radio" name="time" value="16.30  to 17.00 "> <strong>16.30  to 17.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="h5" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="h5" type="radio" name="time" value="17.30  to 18.00 "> <strong>17.30  to 18.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="i5" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="i5" type="radio" name="time" value="18.30  to 19.00 "> <strong>18.30  to 19.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                        <label for="j5" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="j5" type="radio" name="time" value="19.30  to 20.00 "> <strong>19.30  to 20.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                        <label for="k5" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="k5" type="radio" name="time" value="20.30  to 21.00 "> <strong>19.30  to 20.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                           <label for="l5" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="l5" type="radio" name="time" value="21.30  to 22.00 "> <strong>21.30  to 22.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                           <label for="m5" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="m5" type="radio" name="time" value="22.30  to 23.00 "> <strong>22.30  to 23.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                    <label for="sel5" class="p-4">
                                        <input id="sel5" type="checkbox" value="<?php echo $day5 ?>" name="date"> <small style="font-weight:bold">Are You Ready for Booking? </small>
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
                        <div class="row setup-content" id="step-6">
                            <div class="col-xs-6 col-md-offset-3 container">
                                <div class="col-md-12" style="font-size:20px">

                                               <label for="a6" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input class="pt-2" id="a6" type="radio" name="time" value="11.00  to 12.00 " /> <strong>11.00  to 12.00 <span class="bg-success  text-white btn-sm m-4" style="border-radius:10px;">Available</span></strong>
                                        </label> <br>
                                        <label for="b6" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="b6" type="radio" name="time" value="12.30  to 13.00"> <strong> 12.30  to 13.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="c6" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="c6" type="radio" name="time" value="13.30  to 14.00 "> <strong>13.30  to 14.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="d6" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="d6" type="radio" name="time" value="14.30  to 15.00 "> <strong>14.30  to 15.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="f6" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="f6" type="radio" name="time" value="15.30  to 16.00 "> <strong>15.30  to 16.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="g6" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="g6" type="radio" name="time" value="16.30  to 17.00 "> <strong>16.30  to 17.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="h6" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="h6" type="radio" name="time" value="17.30  to 18.00 "> <strong>17.30  to 18.00 <span class="bg-success  text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label><br>
                                        <label for="i6" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="i6" type="radio" name="time" value="18.30  to 19.00 "> <strong>18.30  to 19.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                        <label for="j6" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="j6" type="radio" name="time" value="19.30  to 20.00 "> <strong>19.30  to 20.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                        <label for="k6" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="k6" type="radio" name="time" value="20.30  to 21.00 "> <strong>19.30  to 20.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                           <label for="l6" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="l6" type="radio" name="time" value="21.30  to 22.00 "> <strong>21.30  to 22.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                           <label for="m6" style="background:#f4f4f4;padding:15px;" class="col-md-12 ">
                                            <input id="m6" type="radio" name="time" value="22.30  to 23.00 "> <strong>22.30  to 23.00 <span class="bg-success text-white btn-sm ml-4" style="border-radius:10px;">Available</span></strong>
                                        </label>
                                    <label for="sel7" class="p-4">
                                        <input id="sel7" type="checkbox" value="<?php echo $day6 ?>" name="date"> <small style="font-weight:bold">Are You Ready for Booking? </small>
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
                        <!-- <button type="submit" class="btn  btn-md m-4 p-2 text-white" style="font-size:18px;border-radius:8px;background:#0295cf;">
                Booking Now
            </button> -->
                    </div>
                </div>
            </div>


            <div class="col-md-12 mb-20">
                <div class="form-group ">
                    <h3>
                        <label class="" style="font-size:26px;font-weight:bold">
                            <input type="radio" class="" name="payment" id="cod" value="cod" />
                            Cash On Delivery</label>
                    </h3>
                </div>
                <style>
                    .date a input {
                        font-size: 17px;
                        flex-wrap: wrap;
                        font-weight: bold;
                    }
                </style>
            </div>
    </div>
    <div class="col-md-12 mb-20">
        <div class="form-group ">
            <h3>
                <label class="">
                    <input type="radio" name='payment' value="paypal" id="paypal" /> <img style="max-width:95px;max-height:75px" src="{{ asset('frontend/img/icon/1.png') }}" alt="paypal" /></label>
            </h3>
        </div>
        <!-- <h4 class="paypal box">
            <p class=" pb-4 pt-4 col-md-8 text-danger"> Please click paypal checkout and complete your payment.<br>Otherwise your order is not countable !! </p>
            <script src="https://www.paypalobjects.com/api/checkout.js"></script>

            <div id="paypal-button"></div>
            <div id="paypal-button"></div>
            <script src="https://www.paypalobjects.com/api/checkout.js"></script>
            <script>
                var amount = '{{$order->total}}';
                paypal.Button.render({
                    // Configure environment
                    env: 'sandbox',
                    client: {
                        sandbox: 'AZ6p4Lc1oblfOmyatvhnVLB-0FO5joMY1ahQrXkxyiIQ4BDHL2l40vANycQ0lTY8JCGdEdeTRD2iQJUd',
                        production: 'EPy0gWIqZhyYiSonMmRFFOCnvjDxNDZhMVvtn7LTbf3D4JO0sRqtybd2bFszQxemoKhji6jgokW8v791'
                    },
                    // Customize button (optional)
                    locale: 'en_US',
                    style: {
                        size: 'medium',
                        color: 'gold',
                        shape: 'pill',
                    },

                    // Enable Pay Now checkout flow (optional)
                    commit: true,

                    // Set up a payment
                    payment: function(data, actions) {
                        return actions.payment.create({
                            transactions: [{
                                amount: {
                                    total: amount,
                                    currency: 'EUR'
                                }
                            }]
                        });
                    },
                    // Execute the payment
                    onAuthorize: function(data, actions) {
                        return actions.payment.execute().then(function() {
                            // Show a confirmation message to the buyer
                            window.alert('Thank you for your purchase!');
                        });
                    }
                }, '#paypal-button');
            </script>
        </h4> -->
    </div>

    <div class="col-md-12 mb-20">
        <div class="form-group ">
            <h3>
                <label class="">
                    <input type="radio" name='payment' value="other" id="other" /> <img style="max-width:160px;max-height:100px" src="{{ asset('frontend/img/icon/3.png') }}" alt="paypal" /></label>
            </h3>
        </div>
        <h4 class="other box">
            <p class=" pb-4 pt-4 col-md-8 text-dark"> Please complete your payment.<br>Otherwise your order is not countable !! </p>
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <label>Name on Card</label>
                            <input class="form-control" size="4" type="text" name="name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <label>Card Number</label>
                            <input autocomplete="off" class="form-control" size="20" type="text" name="card_no">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 form-group">
                            <label>CVC</label>
                            <input autocomplete="off" class="form-control" placeholder="ex. 311" size="3" type="text" name="cvv">
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Expiration</label>
                            <input class="form-control" placeholder="MM" size="2" type="text" name="expiry_month">
                        </div>
                        <div class="col-lg-4 form-group p-2">
                            <label> </label>
                            <input class="form-control" placeholder="YYYY" size="4" type="text" name="expiry_year">
                        </div>
                    </div>
                </div>
            </div>
        </h4>

    </div>
    <div class="order_button col-md-12 mb-2">
        <button type="submit" style="background:#3dc9a0" onclick="event.preventDefault();
                                document.getElementById('checkout-form').submit()">Order Confirm</button>
    </div>
    </form>
</div>

@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
    // $(document).ready(function() {
    //     $('input[type="submit"]').click(function() {
    //         var inputValue = $(this).attr("value");
    //     });

    // });
    $(document).ready(function() {
        $('input[type="radio"]').click(function() {
            var inputValue = $(this).attr("value");
            $("." + inputValue).toggle();
        });
        $('input[type="text"]').click(function() {
            var inputValue = $(this).attr("value");
            $("." + inputValue);
        });

    });
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

        $('div.setup-panel div a.btn-primary').trigger('click');
    });
</script>

@endsection