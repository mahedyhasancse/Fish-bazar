@extends('layouts.app')
@section('content')
<div class="card container" style="color:#000;font-weight:bold;">
    <div class="card-header">
        <h3 class="btn-success p-4 text-white">Upadte User Information</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid col-md-10">
            <form action="{{ route('store.user',$user->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="form-group row">
                    <label for="name" class=" col-form-label text-md-right">First Name & Second Name</label><br>
                    <div class="col-md-8">
                        <div class="input-group">

                            <input id="name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ auth()->user()->first_name }}" required autocomplete="first_name" autofocus placeholder="First name">
                            <input id="name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ auth()->user()->last_name }}" required autocomplete="last_name" autofocus placeholder="Last name">
                        </div>

                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="">User Name</label>
                    <input type="text" class="form-control" name="username" value="{{$user->username}}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">User Email</label>
                    <input type="email" class="form-control" name="email" value="{{$user->email}}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" value="{{null}}">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">User Contact</label>
                    <input type="text" class="form-control" name="phone" value="{{$user->phone}}">
                    @error('contact')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">User Address</label>
                    <input type="text" class="form-control" name="address" value="{{$user->address}}">
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Street</label>
                    <input type="text" class="form-control" name="street" value="{{$user->street}}">
                    @error('street')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Post Code</label>
                    <input type="post_code" class="form-control w-50" name="post_code" value="{{$user->post_code ?? 'NULL'}}">
                    @error('post_code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" name="submit" class="btn btn-success text-white ">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection