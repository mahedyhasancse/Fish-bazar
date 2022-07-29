@extends('layouts.admin.app')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title ">
                    <h4 class="text-center bg-info p-4 text-white">Video Of The Weeks </h4>
                </div>
                <hr>
                <form action="{{route('store.video')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="links" class="control-label mb-1">
                            <h3 style="font-weight:bold">Add Video <small>(video Duration max: 10s)</small> </h3>
                        </label>
                        <input type="file" name="links" class="form-control">
                    </div>
                    @error('links')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <button id="payment-button" type="submit" class="btn btn-sm btn-info ">
                        <i class="fa fa-plus-circle"></i>&nbsp;
                        <span id="payment-button-amount">Upload</span>
                    </button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
     @foreach($videos as $video)
        <video width="320" height="240" class="m-2" controls poster="{{asset('frontend/img/video_image.jpg')}}">
            <source src="{{asset($video->links)}}" type="video/mp4" >
        </video>
        <form action="{{route('video.delete',$video->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-info">
                Delete
            </button>
        </form>
        @endforeach
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