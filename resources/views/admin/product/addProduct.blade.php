@extends('layouts.admin.app')
@section('style')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
@endsection
@section('content')
<div class="card container">
    <div class="card-header">
        <h3>Add Product</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
        <div class="alert alert-info">
                <strong>Please add ',' for multiple color or size</strong>
            </div>
        <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="name" class="form-control" name="name" placeholder="enter the product name" value="{{ old('name') }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="form-group">
                        <label for="">Company Name</label>
                        <input type="text" class="form-control" name="company_name" placeholder="enter the company name" value="{{ old('company_name') }}">
                        @error('company_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="form-group">
                        <label for="category" class="form-control-label">Category</label>
                        <select name="category_id" id="category" class="form-control" value="{{old('category_id')}}">
                            <option value="">Please select</option>
                            @if(!$categories->isEmpty())
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    @error('category_id')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                        <label for="">product Price</label>
                        <input type="number" step="0.01" class="form-control" name="price" placeholder="enter the product price">
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="form-group">
                        <label for="">product quantity</label>
                        <input type="quantity" class="form-control" name="quantity" placeholder="enter the product quantity">
                        @error('quantity ')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="form-group">
                        <label for="">Product weight (ex. £6.00 per 1 kg)</label>
                        <input type="text" class="form-control" name="model" placeholder="enter the product model">
                        @error('model')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="form-group">
                        <label for="brand" class="form-control-label">Proudct Brand Name</label>
                        <select name="brand" id="brand" class="form-control">
                            <option value="">Please select Brand</option>
                            @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                        @error('brand')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="input-group control-group increment">
                        <input type="file" name="filename[]" class="form-control">
                        <div class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                        </div>
                        @error('filename')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="clone hide">
                    <div class="control-group input-group" style="margin-top:10px">
                        <input type="file" name="filename[]" class="form-control">
                        <div class="input-group-btn">
                            <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                        <label for="">Description</label>
                        <textarea type="text" class="form-control" name="description" col="3" row="80"></textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        $(".btn-success").click(function() {
            var html = $(".clone").html();
            $(".increment").after(html);
        });

        $("body").on("click", ".btn-danger", function() {
            $(this).parents(".control-group").remove();
        });

    });
</script>
@endsection
