@extends('layouts.admin.app')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header p-2  text-center">
            <h4><strong>All Delivery Slots</strong></h4>
        </div>
        <div class="card-body">
            @if(isset($delivers) && $delivers->isEmpty())
            <div class="alert alert-danger">No Booking Delivery Yet!</div>
            @else
            <div class="x_content">
                <table id="userShow" class="table table-striped table-bordered" style="text-align:center;">
                    <thead>
                        <tr class="bg-info text-white">
                            <th>User Name</th>
                            <th>Phone</th>
                            <th> Delivery Time</th>
                            <th>Delivery Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <style>
                        .switch {
                            position: relative;
                            display: inline-block;
                            width: 60px;
                            height: 34px;
                        }

                        .switch input {
                            opacity: 0;
                            width: 0;
                            height: 0;
                        }

                        .slider {
                            position: absolute;
                            cursor: pointer;
                            top: 0;
                            left: 0;
                            right: 0;
                            bottom: 0;
                            background-color: #ccc;
                            -webkit-transition: .4s;
                            transition: .4s;
                        }

                        .slider:before {
                            position: absolute;
                            content: "";
                            height: 26px;
                            width: 26px;
                            left: 4px;
                            bottom: 4px;
                            background-color: white;
                            -webkit-transition: .4s;
                            transition: .4s;
                        }

                        input:checked+.slider {
                            background-color: #2196F3;
                        }

                        input:focus+.slider {
                            box-shadow: 0 0 1px #2196F3;
                        }

                        input:checked+.slider:before {
                            -webkit-transform: translateX(26px);
                            -ms-transform: translateX(26px);
                            transform: translateX(26px);
                        }
                    </style>
                    <tbody>
                        @foreach($delivers as $delivery)
                        <tr>
                            <td>{{$delivery->user->username}}</td>
                            <td>{{$delivery->user->phone}}</td>
                            <td>{{$delivery->time}}</td>
                            <td>{{$delivery->date}}</td>
                            <td>
                                @if($delivery->status=='false')
                                <a href="{{route('delivery.update',$delivery->id)}}" class="btn btn-success btn-sm">Done</a>
                                @else
                                <a href="{{route('delivery.update',$delivery->id)}}" class="btn btn-info btn-sm">Delivered</a>

                                @endif


                                <button type="button" class="btn bg-danger text-white btn-sm" data-toggle="modal" data-target="#exampleModal1">
                                    Delete
                                </button>
                                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h3 class="text-center p-4 card bg-danger text-white"> Delete ?</h3>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn bg-success text-white btn-sm mt-2" data-dismiss="modal">Close</button>
                                                <form action="{{route('delivery.delete',$delivery->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="Delete" class="btn btn-danger mt-2 btn btn-sm">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


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
    });
</script>
@endsection