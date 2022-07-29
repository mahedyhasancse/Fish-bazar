@extends('layouts.admin.app')
@section('style')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
@endsection
@section('content')
<div class="card col-md-6 container-fluid">
    <div class="card-header btn-info active p-4">
        <h3 class="">Add Instagram Post</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="{{route('store.instagram')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="category_name" class="control-label mb-1"><strong>Link (Optional)</strong></label>
                    <input id="category_name" name="link" type="text" class="form-control" aria-required="true" placeholder="Enter the instagram link" aria-invalid="false" value="{{old('link')}}">
                    @error('link')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label for="category_name" class="control-label mb-1"> <strong>Instagram  Image</strong></label>
                <div class="input-group control-group increment mb-2">
                    <input type="file" name="image" class="form-control">
                </div>
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <input type="submit" name="submit" value="Add" class="btn btn-info">
            </form>
        </div>
    </div>
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-body">
                @if(!$instagrams->isEmpty())
                <div class="card-title  btn-primary p-4">
                    <h3 class="text-center  ">All Instagram Posts</h3>
                </div>
                <hr>
                <table id="category" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>link</th>
                            <th>image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($instagrams as $instagram)
                        <tr>
                            <td><a href="{{$instagram->link}}">{{$instagram->link}}</a></td>
                            <td><img style="max-width:100px;" src="{{asset($instagram->image)}}"></td>
                            <td>
                                <a href="{{route('edit.instagram',$instagram->id)}}" class="btn btn-info btn-sm">Edit</a>
                                <form action="{{route('instagram.delete',$instagram->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger mt-2">Delete</button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-info">
                    No categories found!
                </div>
                @endif

            </div>
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