@extends('layouts.admin.app')
@section('content')
<div class="row" style="font-weight:bold">
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <div class="card-title ">
                    <h3 class="text-center bg-info text-white p-2 ">Bus Stand</h3>
                </div>
                <hr>
            </div>

            <form action="{{route('bus.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group pl-4 pr-4">
                    <label for="category_name" class="control-label mb-1"> Name</label>
                    <input id="category_name" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('title')}}" placeholder="Bus Station Name">
                    @error('title')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group pl-4 pr-4">
                    <label for="">Map Links</label>
                    <textarea type="text" class="form-control" name="description" col="3" row="80"></textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group pl-4 pr-4">

                    <label for="category_name" class="control-label mb-1 ml-2">Bus Stand</label>
                    <input type="file" name="image" class="form-control">
                </div>
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-md ml-4 mb-2   ">
                        <i class="fa fa-plus-circle"></i>&nbsp;
                        <span id="payment-button-amount">Upload</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <div class="card-title ">
                    <h3 class="text-center bg-info text-white p-2  ">Train Station</h3>
                </div>
                <hr>
                <form action="{{route('train.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="category_name" class="control-label mb-1"> Name</label>
                        <input id="category_name" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('title')}}">
                        @error('title')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group pl-2 pr-2">
                        <label for="">Map Links</label>
                        <textarea type="text" class="form-control" name="description" col="3" row="80"></textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">

                        <label for="category_name" class="control-label mb-1 ml-4">Train Station</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-md ml-2 ">
                            <i class="fa fa-plus-circle"></i>&nbsp;
                            <span id="payment-button-amount">Upload</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <div class="card-title ">
                    <h3 class="text-center bg-info text-white p-2  ">Car Parking</h3>
                </div>
                <hr>
                <form action="{{route('car.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="category_name" class="control-label mb-1"> Name</label>
                        <input id="category_name" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('title')}}">
                        @error('title')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group pl-2 pr-2">
                        <label for="">Map Links</label>
                        <textarea type="text" class="form-control" name="description" col="3" row="80"></textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">

                        <label for="category_name" class="control-label mb-1 ml-4">Car Parking</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-md ml-2 ">
                            <i class="fa fa-plus-circle"></i>&nbsp;
                            <span id="payment-button-amount">Upload</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                @if(!$buses->isEmpty())
                <div class="card-title">
                    <h3 class="text-center ">Bus Stand Info</h3>
                </div>
                <hr>
                <table id="category" class="table table-striped table-responsive table-bordered">
                    <thead>
                        <tr class="bg-info text-white">
                            <th>Name</th>
                            <th>Map Links</th>
                            <th>image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buses as $bus)
                        <tr class="text-center">
                            <td>{{$bus->name}}</td>
                            <td>{!!$bus->description!!}</td>
                            <td><a href="{{asset($bus->image)}}"> <img height="80px" width="80px" src="{{asset($bus->image)}}" alt=""></a></td>
                            <td><a href="{{route('bus.edit',$bus->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{route('delete.bus',$bus->id)}}" method="post" style="margin:5px;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger btn btn-sm">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-info">
                    No info found!
                </div>
                @endif

            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                @if(!$trains->isEmpty())
                <div class="card-title">
                    <h3 class="text-center ">Train Station  Info</h3>
                </div>
                <hr>
                <table id="category1" class="table  table-responsive table-striped table-bordered">
                    <thead>
                        <tr class="bg-info text-white">
                            <th>Name</th>
                            <th>Map Links</th>
                            <th>image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trains as $train)
                        <tr class="text-center">
                            <td>{{$train->name}}</td>
                            <td>{!!$train->description!!}</td>
                            <td> <img height="100px" width="100px" src="{{asset($train->image)}}" alt=""></td>
                            <td><a href="{{route('train.edit',$train->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{route('train.delete',$train->id)}}" method="post" style="margin:5px;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger btn btn-sm">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-info">
                    No info found!
                </div>
                @endif

            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                @if(!$cars->isEmpty())
                <div class="card-title">
                    <h3 class="text-center ">Car parking  Info</h3>
                </div>
                <hr>
                <table id="category1" class="table  table-responsive table-striped table-bordered">
                    <thead>
                        <tr class="bg-info text-white">
                            <th>Name</th>
                            <th>Map Links</th>
                            <th>image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cars as $car)
                        <tr class="text-center">
                            <td>{{$car->name}}</td>
                            <td>{!!$car->description!!}</td>
                            <td> <img height="100px" width="100px" src="{{asset($car->image)}}" alt=""></td>
                            <td><a href="{{route('car.edit',$car->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{route('car.delete',$car->id)}}" method="post" style="margin:5px;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger btn btn-sm">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-info">
                    No info found!
                </div>
                @endif

            </div>
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
    $(document).ready(function() {
        $('#category1').DataTable();
    });
    $(document).ready(function() {
        $('#category2').DataTable();
    });
</script>
@endsection