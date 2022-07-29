@extends('layouts.admin.app')
@section('style')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
@endsection
@section('content')
<div class="card col-md-6 container-fluid">
    <div class="card-header btn-info active p-4">
        <h3 class="">Add Recipe Image(426 * 348)</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="{{route('update.recipe',$recipe->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="category_name" class="control-label mb-1"><strong> Recipe Name</strong></label>
                    <input id="category_name" name="title" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$recipe->title}}">
                    @error('title')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="parent_category" class=" form-control-label">Select Recipe</label>
                    <select name="parent_id" id="parent_category" class="form-control" value="{{$recipe->parent_id}}">
                        <option value="">Please select</option>
                               @if(!$recipes->isEmpty())
                        @foreach($recipes as $re)
                        <option value="{{$re->id}}">{{$re->title}}</option>
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
                    <label for="link" class="control-label mb-1"><strong> Recipe Youtube Link</strong></label>
                         <input id="link" value="{{ $recipe->link }}"   name="link" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('link')}}">
                    @error('link')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for=""><strong>Description</strong></label>
                    <textarea type="text" class="form-control" name="content" col="3" row="80" style="height:200px">{!!$recipe->content!!}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <input type="submit" name="submit" value="Update Recipe" class="btn btn-info">
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
