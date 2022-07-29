@extends('layouts.admin.app')
@section('content')
<div class="col-md-5">
    <div class="card">
        <div class="card-body">
            <div class="card-title ">
                <h3 class="text-center bg-info text-white p-2  ">Train Station</h3>
            </div>
            <hr>
            <form action="{{route('update.train',$train->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="category_name" class="control-label mb-1"> Name</label>
                    <input id="category_name" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$train->name}}">
                    @error('title')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group pl-2 pr-2">
                    <label for="">Description</label>
                    <textarea type="text" class="form-control" name="description" col="3" row="80">{!!$train->description!!}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">

                    <label for="category_name" class="control-label mb-1 ml-4">Train Station</label>
                    <input type="file" name="image" class="form-control">
                </div>
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-md ml-2 ">
                        <i class="fa fa-plus-circle"></i>&nbsp;
                        <span id="payment-button-amount">Update</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection