@extends('layouts.admin.app')
@section('content')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center ">Update Category</h3>
                </div>
                <hr>
                <form action="{{route('category.update',$category->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="category_name" class="control-label mb-1">Category Name</label>
                        <input id="category_name" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$category->name}}">
                        @error('name')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category_slug" class="control-label mb-1">Category Slug</label>
                        <input id="category_slug" name="slug" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$category->slug}}">
                        @error('slug')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="parent_category" class=" form-control-label">Select</label>
                        <select name="parent_id" id="parent_category" class="form-control" value="{{$category->parent_id}}">
                            <option value="">Please select</option>
                            @if(!$categories->isEmpty())
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('parent_id')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">

                        <label for="category_name" class="control-label mb-1">Category Name</label>
                        <input type="file" name="image" class="form-control" value="{{$category->image}}">
                    </div>
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div>
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <i class="fa fa-plus-circle"></i>&nbsp;
                                <span id="payment-button-amount">Update Category</span>
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    @endsection