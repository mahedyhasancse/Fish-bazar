@extends('layouts.admin.app')
@section('style')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
@endsection
@section('content')
<div class="card col-md-12 container-fluid"   >
    <div class="card-header btn-info active p-4">
        <h3 class="">Add Recipe</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="{{route('store.recipe')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="category_name" class="control-label mb-1"><strong> Recipe Name</strong></label>
                    <input id="category_name" name="title" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('title')}}">
                    @error('title')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category_name" class="control-label mb-1"><strong> Recipe Youtube embed Link</strong></label>
                    <input id="category_name" name="link" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('link')}}">
                    @error('link')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="parent_category" class=" form-control-label">Select Parents Recipe </label>
                    <select name="parent_id" id="parent_category" class="form-control" value="{{old('parent_id')}}">
                        <option value="">Please select</option>
                        @if(!$recipes->isEmpty())
                        @foreach($recipes as $recipe)
                        <option value="{{$recipe->id}}">{{$recipe->title}}</option>
                        @endforeach
                        @endif
                    </select>
                    @error('parent_id')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for=""><strong>Description</strong></label>
                    <textarea type="text" class="form-control" name="content" col="3" row="80" style="height:200px"></textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <input type="submit" name="submit" value="Add Recipes" class="btn btn-info">
            </form>
        </div>
    </div>
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-body">
                @if(!$recipes->isEmpty())
                <div class="card-title  btn-primary p-4">
                    <h3 class="text-center  ">All Recipes</h3>
                </div>
                <hr>
                <table id="category" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Recipe Name</th>
                            <th>parents recipe</th>
                               <th>link</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recipes as $recipe)
                        <tr>
                            <td>{{$recipe->title}}</td>
                            <td>{{($recipe->parent )? $recipe->parent->title: '-'}}</td>
                                   <td><a href="{{$recipe->link}}">{{$recipe->link}}z</a></td>
                            <td>{{substr($recipe->content,0,80)}}...... <span class="text-warning">See More</span> </td>
                            <td>
                                <a href="{{route('edit.recipe',$recipe->id)}}" class="btn btn-info btn-sm">Edit</a>
                                <form action="{{route('delete.recipe',$recipe->id)}}" method="post">
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
