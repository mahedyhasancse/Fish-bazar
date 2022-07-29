@php
    
@endphp
@extends('layouts.admin.app')
    @section('content')
      <div class="container-fluid">
        <div class="card">
          <div class="card-header text-center bg-primary text-white">Product Lists</div>
          <div class="card-body">
          @if(isset($users) && $users->isEmpty())
            <div class="alert alert-danger">No Product add yet!</div>
          @else
          <div class="x_content">
            <table id="userShow" class="table table-striped table-bordered" style="text-align:center;">
              <thead>
                <tr>
                  <th>Product ID</th>
                  <th>Product Name</th>
                  <th>Category</th>
                  <th>price</th>
                  <th>Quantity</th>
                  <th>Color</th>
                  <th>Size</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Top Selling</th>
                  <th>Most view</th>
                  <th>Hide</th>
                  <th>Action</th>
                  <th>Partials</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($products as $product)
                  <tr>
                  <td>{{$product->id}}</td>
                  <td><a href="{{route('productDetails',[$product->id,Str::slug($product->name)])}}">{{$product->name}}</a></td>
                  <td>{{$product->category->name}}</td>
                  <td>{{$product->price}}</td>
                  <td>{{$product->quantity}}</td>
                  <td>{{($product->productDetails->color)?? 'N/A'}}</td>
                  <td>{{($product->productDetails->size) ?? 'N/A'}}</td>
                  <td>{{substr($product->description,0,50)}}....</td>
                  <td><a href="{{$product->image[0]->image}}"><img src="{{$product->image[0]->image}}" style="max-width:90px; max-height:60px;" alt="image"/></a></td>
                  <td>{{$product->is_top_selling}}</td>
                  <td>{{$product->is_most_view}}</td>
                  <td>{{$product->is_hide}}</td>
                  <td>
                  <a href="{{route('product.edit', $product->id)}}" style="float:left;overflow:hidden;" class="btn btn-info btn btn-sm mr-4 mb-2">Edit</a>
                  <form action="{{route('product.delete',$product->id) }}" method="post" style="float:left;overflow:hidden;">
                      @csrf
                      @method('DELETE')
                      <input type="submit" value="Delete" class="btn btn-danger btn btn-sm">
                    </form>
                  </td>
                  <td>
                    @if($product->is_top_selling==true)
                    <a href="{{route('not.top',$product->id)}}" class="btn btn-primary btn-sm mb-2">Remove from top</a><br>
                    @else
                    <a href="{{route('top',$product->id)}}" class="btn btn-primary btn-sm mb-2">Make Top selling</a><br>
                    @endif
                    @if($product->is_most_view==true)
                    <a href="{{route('not.most_view',$product->id)}}" class="btn btn-success btn-sm mb-2">Remove from most</a><br>
                    @else
                    <a href="{{route('most_view',$product->id)}}" class="btn btn-success btn-sm mb-2">Most View</a><br>
                    @endif
                    @if($product->is_hide == true)
                    <a href="{{route('unhide',$product->id)}}" class="btn btn-danger btn-sm">Unhide</a>
                    @else
                    <a href="{{route('hide',$product->id)}}" class="btn btn-danger btn-sm">Hide</a>
                    @endif
                  </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
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
            $('#userShow').DataTable({
              'order':['0','desc'],
            });
        } );
    </script>
@endsection
