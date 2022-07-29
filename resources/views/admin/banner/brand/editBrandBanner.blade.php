@extends('layouts.admin.app')
@section('content')
    <div class="col-md-4"> </div>
    <div class="card col-md-6 container-fluid">
        <div class="card-header">Add Brand Banner</div>
        <div class="card-body">
            <div class="container-fluid">
                <form action="{{ route('update.brandbanner',$banner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="category" class="form-control-label">Brand</label>
                        <select name="brand_id" id="category" class="form-control" value="{{$banner->brand->name}}">
                            <option value="">Please select</option>
                            @if(!$brands->isEmpty())
                            @foreach($brands as $brand)
                            <option value="{{$brand->id}}" {{($brand->id == $banner->brand->id)?'selected':''}}>
                                {{$brand->name}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('brand_id')
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
@endsection
