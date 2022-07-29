@extends('layouts.admin.app')
    @section('content')
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">User Lists</div>
          <div class="card-body">
          @if(isset($users) && $users->isEmpty())
            <div class="alert alert-danger">No User add yet!</div>
          @else
          <div class="x_content">
            <table id="userShow" class="table table-striped table-bordered" style="text-align:center;">
              <thead>
                <tr>
                  <th>User Name</th>
                  <th>User email</th>
                  <th>user Contact</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($users as $user)
                  <tr>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->phone}}</td>
                  <td>
                  <form action="{{route('make.admin',$user->id)}}" method="post">
                      @csrf
                      @method('PATCH')
                      <input type="submit" value="Make Admin" class="btn btn-info btn btn-sm">
                    </form>
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
            $('#userShow').DataTable();
        } );
    </script>
@endsection
