@extends('layouts.admin.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Edit Product</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="alert alert-info">
                <strong>Please add ',' for multiple color or size</strong>
            </div>
        <form action="{{ route('update.product',$product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="">Product Name</label>
                    <input type="name" class="form-control" name="name" placeholder="enter the product name"
                        value="{{ $product->name }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="company_name">Company Name</label>
                    <input type="text" class="form-control" name="company_name" placeholder="enter the company name"
                        value="{{ $product->company_name }}">
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
                        <option value="{{$category->id}}" {{($category->id == $product->category->id)?'selected':''}}>
                            {{$category->name}}</option>
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
                    <label for="price">product Price</label>
                    <input type="number" class="form-control" name="price" placeholder="enter the product price"
                        value="{{$product->price}}">
                    @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="quantity">product quantity</label>
                    <input type="number" class="form-control" name="quantity" placeholder="enter the product quantity"
                        value="{{$product->quantity}}" step="0.1">
                    @error('quantity ')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="model">Product weight (ex. £6.00 per 1 kg)</label>
                    <input type="text" class="form-control" name="model" placeholder="enter the product model" value="{{ $product->productDetails->model }}">
                    @error('model')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group control-group increment">
                    <input type="file" name="image[]" class="form-control">
                    <div class="input-group-btn">
                        <button class="btn btn-success" type="button"><i
                                class="glyphicon glyphicon-plus"></i>Add</button>
                    </div>
                </div>
                <div class="clone d-none">
                    <div class="control-group input-group" style="margin-top:10px">
                        <input type="file" name="image[]" class="form-control">
                        <div class="input-group-btn">
                            <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i>
                                Remove</button>
                        </div>
                    </div>
                </div>
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea type="text" class="form-control" name="description" col="3"
                        row="80">{!! $product->description !!}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Product</button>
            </form>
            @if(isset($product->image) && !empty($product->image))

            <div class="row mt-3">
                @foreach($product->image as $image)
                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top" max-width="100%" height="200px" src="{{asset($image->image)}}"
                            alt="{{$product->name}}">
                        <div class="card-body text-center">
                        <form action="{{ route('delete.image',$image->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger mt-2" value="Delete">
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="alert alert-danger">
                Please add product first!
            </div>
            @endif
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
