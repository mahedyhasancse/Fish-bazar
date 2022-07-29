@extends('layouts.admin.app')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css
">
@endsection
@section('content')
<div class="card">
    <div class="row ">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">{{ __('Add Product Brands') }}</div>

                <div class="card-body">
                <form method="POST" action="{{ route('store.brand') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="brand_name" class="col-md-4 col-form-label text-md-right">{{ __(' Name') }}</label>

                            <div class="col-md-12">
                                <input type="text" name="brand_name" class="form-control" />
                                @error('brand_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __(' Image') }}</label>
                            <div class="col-md-12">
                                <input type="file" class="form-control" name="image">
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-0">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Store Brand') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if(!$brands->isEmpty())
                        <div class="card-title">
                            <h3 class="text-center ">All Product Brands</h3>
                        </div>
                        <hr>
                        <table id="category" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Brand Name</th>
                                <th>Brand Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($brands as $brand)
                                <tr class="text-center">
                                    <td>{{$brand->name}}</td>
                                    <td><a href="{{($brand->image)}}"><img withd="100px" height="70px;" src="{{($brand->image)}}" alt="image" ></a></td>
                                <td>
                                <form action="{{route('brand.delete',$brand->id)}}" method="post" style="margin:5px;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                    </form>
                                  </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            No Brand found!
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
        @endsection

@section('scripts')


<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.datatable').DataTable( {
            "order": [[ 0, "dsc" ]]
        });
    });
</script>
@endsection