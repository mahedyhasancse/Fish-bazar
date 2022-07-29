@extends('layouts.admin.app')
@section('style')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
@endsection
@section('content')
<div class="card col-md-6 container-fluid">
    <div class="card-header btn-info active p-4">
        <h3 class="">Update Instagram Post</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="{{route('update.instagram',$instagram->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="category_name" class="control-label mb-1"><strong>Link (Optional)</strong></label>
                    <input id="category_name" name="link" type="text" class="form-control" aria-required="true" placeholder="Enter the instagram link" aria-invalid="false" value="{{$instagram->link}}">
                    @error('link')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label for="category_name" class="control-label mb-1"> <strong>Instagram  Image</strong></label>
                <div class="input-group control-group increment mb-2">
                    <input type="file" name="image" class="form-control" value="{{$instagram->image}}">
                </div>
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <input type="submit" name="submit" value="Update" class="btn btn-info">
            </form>
        </div>
    </div>
    @endsection
    @section('scripts')
    <script type="text/javascript">
        var $ = jQuery;
        $(document).ready(function() {
            $('#category').DataTable();
        });
    </script>
    @endsection
    