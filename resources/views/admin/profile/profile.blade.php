@extends('layouts.admin.app')
    @section('content')
    <div class="card text-center container ">
        <div class="card-header bg-info text-white p-4">
         Your Profile
        </div>
        <div class="card-body" style="font-weight:bold">
            <h5 class="card-title">{{"First Name:  " }} {{ $user->first_name }}</h5>
            <h5 class="card-title">{{"Last Name:  " }} {{ $user->last_name }}</h5>
            <h5 class="card-title">{{"Username:  " }} {{ $user->username }}</h5>
            <h5 class="card-title">{{"Email: "}}  {{ $user->email }}</h5>
            <h5 class="card-title">{{"Phone: "}}  {{ $user->phone }}</h5>
            <h5 class="card-title">{{"Address: "}}  {{ $user->address }}</h5>
            <h5 class="card-title">{{"Street: "}}  {{ $user->street }}</h5>
            <h5 class="card-title">{{"Post Code: "}}  {{ $user->post_code }}</h5>
            <a href="{{route('admin.profileEdit',$user->id)}}" class="btn btn-info">Edit</a>
        </div>
      </div>
    @endsection
</body>
</html>
