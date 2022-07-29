@extends('layouts.admin.app')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title ">
                    <h4 class="text-center bg-info p-4 text-white">Add post code Sample</h4>
                </div>
                <hr>
                <form action="{{route('store.code')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="post_code" class="control-label mb-1" style="font-weight:bold">Post Code</label>
                        <input id="post_code" placeholder="Enter the Post Code" name="post_code" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('post_code')}}">
                        @error('post_code')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button id="payment-button" type="submit" class="btn btn-sm btn-info ">
                        <i class="fa fa-plus-circle"></i>&nbsp;
                        <span id="payment-button-amount">Add Sample</span>
                    </button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-8">
    <div class="card">
        <div class="card-body">
            @if(!$posts->isEmpty())
            <div class="card-title">
                <h3 class="text-center card-heading ">All Post Codes</h3>
            </div>
            <hr>
            <div class="x-content">
                <table id="category" class="table table-responsive table-striped table-bordered">
                    <thead>
                        <tr class="bg-info text-white text-center">
                            <th>Post Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $p)
                        <tr class="text-center">
                            <td>{{$p->post_code}}</td>
                            <td>
                                <form action="{{route('delete.post',$p->id)}}" method="post" style="margin:5px;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm ">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-info">
                No post code found!
            </div>
            @endif

        </div>
    </div>
</div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#category').DataTable([
            'order' = 'asc',
        ]);
    });
</script>
@endsection