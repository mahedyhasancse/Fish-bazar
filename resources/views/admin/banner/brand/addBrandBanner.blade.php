@extends('layouts.admin.app')
@section('content')
    <div class="col-md-4"> </div>
    <div class="card col-md-6 container-fluid">
        <div class="card-header">Add Brand Banner (550x320)</div>
        <div class="card-body">
            <div class="container-fluid">
                <form action="{{route('store.brandbanner')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="brand" class="form-control-label">Brand Name</label>
                        <select name="brand_id" id="brand" class="form-control" value="{{ old('brand_id') }}">
                            <option value="">Please select Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group control-group increment mb-2">
                        <input type="file" name="image" class="form-control">
                    </div>
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input type="submit" name="submit" value="Add Banner" class="btn btn-primary">
                </form>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (!$brand_banners->isEmpty())
                            <div class="card-title">
                                <h3 class="text-center ">All Brand Banner</h3>
                            </div>
                            <hr>
                            <table id="dataTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brand_banners as $banner)
                                        <tr class="text-center">
                                            <td>{{ $banner->id }}</td>
                                            <td>{{ $banner->brand->name }}</td>
                                            <td><a href="{{ asset($banner->image) }}"><img height="80px" width="150px"
                                                        src="{{ asset($banner->image) }}" alt=""></a></td>
                                            <td><a href="{{ route('edit.brandbanner',$banner->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{route('delete.brandbanner',$banner->id)}}" method="post" style="margin:5px;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="delete" class="btn btn-danger btn btn-sm">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-info">
                                No Brand banner found!
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        var $ = jQuery;
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

    </script>
@endsection
