<?php
$categories = App\ProductCategory::all();
?>
@extends('layouts.app')
@section('content')
<!--home three bg area start-->
<style>
    .a {
        margin: 5px;
    }

    .a ul li {
        float: left;
        overflow: hidden;
        margin: 0;
    }
</style>




   <!--home three bg area start-->
   <div class="row" id="Recipes">
    <div class="col-md-12 container">
        <h2 style="padding:20px" class="text-center"><strong>{{ $recipes[0]->title }} Recipes</strong></h2>

        <div class="col-md-12  bg-white text-black" style="padding:20px">
            <div class="row">
                @foreach($recipes as $recipe)
                <div class="col-md-6 p-2">

                    <iframe width="500" height="315" src="{{ $recipe->link }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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

<!--home three bg area end-->

<!--shipping area end-->

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

<!--product area start-->

<!--product area end-->

<!--blog area start-->
<!--blog area end-->



<!--instagram area start-->

<!--instagram area end-->

<!--brand area start-->

    <!--brand area end-->
    <!--brand area end-->

@endsection
