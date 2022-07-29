@extends('layouts.admin.app')
@section('content')
<div class="card container" style="font-weight:bold">
    <div class="card-header bg-info text-white text-center" ><h3>Upadte Admin Information</h3></div>
    <div class="card-body">
        <div class="container-fluid col-md-10">
            <form action="{{route('admin.update',$user->id)}}" method="post">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="">First  Name</label>
                <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}">
                @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Last  Name</label>
                <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}">
                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Admin  Username</label>
                <input type="text" class="form-control" name="username" value="{{$user->username}}">
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Admin Email</label>
                <input type="email" class="form-control" name="email"  value="{{$user->email}}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                 <label for="">Password</label>
                 <input type="password" class="form-control" name="password" value="{{null}}" >
                 @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                 <label for="">Admin Contact</label>
                 <input type="text" class="form-control" name="phone" value="{{$user->phone}}">
                 @error('contact')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                 <label for="">Admin Address</label>
                 <input type="text" class="form-control" name="address" value="{{$user->address}}">
                 @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                 <label for="">Admin Street</label>
                 <input type="text" class="form-control" name="street" value="{{$user->street}}">
                 @error('street')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                 <label for="">Post Code</label>
                 <input type="text" class="form-control" name="post_code" value="{{$user->post_code ?? 'NULL'}}">
                 @error('post_code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" name="submit" class="btn btn-info">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
