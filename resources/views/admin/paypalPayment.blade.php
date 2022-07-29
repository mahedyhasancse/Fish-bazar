@extends('layouts.admin.app')
    @section('content')
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">Paypal On Payment Lists</div>
          <div class="card-body">
          @if(isset($payments) && $payments->isEmpty())
            <div class="alert alert-danger">No payment add yet!</div>
          @else
          <div class="x_content">
            <table id="userShow" class="table table-striped table-bordered" style="text-align:center;">
              <thead class="bg-info text-white">
                <tr>
                 <th> User Name</th>
                 <th> User Email</th>
                 <th> User Phone</th>
                  <th>Paypal Account</th>
                  <th>Payer ID</th>
                  <th>Amount</th>
                  <th>Payment Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($payments as $payment)
                  <tr>
                  <td>{{$payment->user->username}}</td>
                  <td>{{$payment->user->email}}</td>
                  <td>{{$payment->user->phone}}</td>
                  <td>{{$payment->payer_email}}</td>
                  <td>{{$payment->payer_id}}</td>
                  <td>{{$payment->amount}}</td>
                  <td>{{$payment->payment_status}}</td>
                  <td>
              
                  <form action="{{route('delete.paypalPayment',$payment->id)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <input type="submit" value="Delete" class="btn btn-danger btn btn-sm">
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