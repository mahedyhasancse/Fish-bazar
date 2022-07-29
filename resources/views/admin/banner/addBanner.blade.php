@extends('layouts.admin.app')
@section('style')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
@endsection
@section('content')
<div class="col-md-4"></div>
<div class="card col-md-6 container-fluid">
    <div class="card-header">
        <h3>Add Slider image (1920x540)</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
        <form action="{{route('store.banner')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group control-group increment mb-2">
                    <input type="file" name="image" class="form-control">
                </div>
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
               <input type="submit" name="submit" value="Add Slider" class="btn btn-primary" >
            </form>
        </div>
    </div>
    <div class="card" style="margin-top:20px">
        <div class="card-header">
            <h3>Slider Images</h3>
        </div>
        <div class="card-body">
            @if(isset($banners) && $banners->isEmpty())
            <div class="alert alert-danger">No Banner add yet!</div>
          @else
            <div class="row">
                @foreach($banners as $banner)
                <div class="col-md-4 text-center">
                    <img src="{{asset($banner->image)}}" style="height:150px;width:200px; margin:10px auto; border:1px solid #888888"/>
                    <div class="col-md-12 text-center">
                    <form action="{{route('banner.delete',$banner->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                    </form>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
@endsection
