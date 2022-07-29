@extends('layouts.admin.app')
@section('content')
    <div class="row">
        <div id="app" class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title " >
                        <h3 class="text-center ">Add offer</h3>
                    </div>
                    <hr>
                    <form action="{{route('update.offer', $offer->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="product_id" class=" form-control-label">Select product</label>
                            <select name="product_id" id="product_id" onchange="selectedproduct(this.value)" class=" form-control" value="{{old('product_id')}}">
                                <option value="">Please select</option>
                                <option value="{{ $offer->product->id }}" selected>{{ $offer->product->name }}</option>
                                @if(!$products->isEmpty())
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}" > {{ $product->name }} </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('product_id')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div id="img"></div>
                            <span id="price"></span>
                        </div>
                        <div class="form-group">
                            <label for="offerPrice" class="control-label mb-1">Enter Offer Price</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >$</span>
                                </div>
                                <input id="offerPrice" name="offerPrice" type="number" step="0.01" class="form-control" value="{{ $offer->offerPrice }}">
                            </div>
                            @error('offerPrice')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="validTill" class="control-label mb-1">Offer Valid Till</label>
                            <div class='input-group date'>
                                <input class="form-control" type="date" id="validTill" name="validTill" value="{{ date($offer->validTill) }}">
                            </div>
                        </div>

                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <i class="fa fa-plus-circle"></i>&nbsp;
                                <span id="payment-button-amount">Update offer</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if(!$offers->isEmpty())
                        <div class="card-title">
                            <h3 class="text-center ">All Offers</h3>
                        </div>
                        <hr>
                        <table id="category" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Product Photo</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Offer Price</th>
                                <th>Valid Till</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($offers as $offer)
                                <tr class="text-center">
                                    <td>
                                        <img style="max-height: 100px; max-width: 100px;" src="{{ asset($offer->product->image[0]->image) }}" alt="">
                                    </td>
                                    <td>{{$offer->product->name}}</td>
                                    <td>${{ $offer->product->price }}</td>
                                    <td>${{ $offer->offerPrice }}</td>
                                    <td>{{ $offer->validTill }}</td>
                                    <td><a href="{{ route('offer.edit', $offer->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="" method="post" style="margin:5px;">
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
                            No Offer found!
                        </div>
                    @endif
            </div>
        </div>
    </div>
<img src="" alt="">
@endsection
@section('scripts')
    <script type="text/javascript">
        var $ = jQuery;
        $(document).ready(function() {
            $('#category').DataTable();
        } );
        function selectedproduct(product){
            $.ajax({
            dataType: "json",
            url: '/api/product/'+product,
            success: function(data) {
                var img = '<img src="'+data[1]+'" alt="">';
                $('#price').html('Price: $'+data[0].price);
                $('#img').html(img);
            }
            });
        };
    </script>
@endsection
