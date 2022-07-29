@extends('layouts.admin.app')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title ">
                        <h3 class="text-center ">Add Category</h3>
                    </div>
                    <hr>
                    <form action="{{ route('update.categorybanner',$banner->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="category" class="form-control-label">Category</label>
                            <select name="category_id" id="category" class="form-control" value="{{$banner->category->name}}">
                                <option value="">Please select</option>
                                @if(!$categories->isEmpty())
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" {{($category->id == $banner->category->id)?'selected':''}}>
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
                        <div class="input-group control-group increment mb-2">
                            <input type="file" name="image" class="form-control" value="{{ $banner->image }}">
                        </div>
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <input type="submit" name="submit" value="Add Banner" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

