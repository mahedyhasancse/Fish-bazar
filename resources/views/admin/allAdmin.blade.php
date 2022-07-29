@extends('layouts.admin.app')
    @section('content')
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">Admin Lists</div>
          <div class="card-body">
          @if(isset($users) && $users->isEmpty())
            <div class="alert alert-danger">No Admin add yet!</div>
          @else
          <div class="x_content">
            <table id="userShow" class="table table-striped table-bordered" style="text-align:center;">
              <thead>
                <tr>
                  <th>Admin Name</th>
                  <th>Admin email</th>
                  <th>Admin Contact</th>
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
                @if($user->id == 1)
                @else
                  <form action="{{ route('make.user',$user->id) }}" method="post">
                      @csrf
                      @method('PATCH')
                      <input type="submit" value="Make User" class="btn btn-info btn btn-sm">
                    </form>
                  </td>
                  </tr>
                  @endif
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