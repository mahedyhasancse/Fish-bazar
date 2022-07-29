@extends('layouts.app')
@section('style')
<link href="https://fonts.googleapis.com/css2?family=Arimo&family=Assistant&family=Martel:wght@600&display=swap" rel="stylesheet">
<style type="text/css">

    .box {
        color: black;
        display: none;
        margin-top: 20px;
    }
    .check {
        background: #ffffff;
    }
    .Checkout_section {
     background:#f1f1f1;
     font-family: -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif
    }
  .Checkout_section .col-lg-4{
      background:#fff;
  }
  .checkout_form h3{
      background:none;
      color:black;
      font-weight:bold;
  }
table{
    border:1px solid #ededed;
}
.table-responsive table thead tr th{
     text-align:left !important;
     padding:10px;
     font-size:20px;  
}
.order_table table tfoot tr th{
    padding:10px;
    text-align:left !important;
}

</style>
@endsection
@section('content')
@if ($errors->any())
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (Session::has('success'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p>
        </div>
        @endif
        @if (Session::has('postcodeerror'))
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('postcodeerror') }}</p>
        </div>
        @endif
<!--breadcrumbs area start-->
<div class="breadcrumbs_area m-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>Checkout</h3>
                    <ul>
                        <li><a href="{{url('/')}}">home</a></li>
                        <li>Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--Checkout page section-->
<div class="Checkout_section">
    <div class="container">
        <div class="checkout_form">
            <div class="row">
                <div class="col-lg-6 col-md-5" style="font-size:18px; padding:20px; background:white">
                          <h3 class="" style="font-weight:bold;font-size:24px;">Billing Details</h3>
                          <hr>
                    <form action="{{route('store.order')}}" method="post" id="checkout-form">
                        @csrf
                  
                        <div class="row">
                            
                            <div class="col-lg-6 mb-20">
                                <label> First Name <span>*</span></label>
                                <input class="form-control " type="text" value="{{old('name') ?? auth()->user()->first_name}}"  name="username" disabled required />
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                               <div class="col-lg-6 mb-20">
                                <label>Last Name <span>*</span></label>
                                <input class="form-control " type="text" value="{{old('name') ?? auth()->user()->last_name}}"  name="username" disabled required />
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-20">
                                <label>Address <span>*</span></label>
                                <input style="background:#e9ecef" type="text" name="address_line_1" value="{{old('address_line_1')?? auth()->user()->address}}"  />
                                @error('address_line_1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-20">
                                <input type="text" style="background:#e9ecef" name="address_line_2" value="{{old('address_line_2')?? auth()->user()->street}}"   />
                                @error('address_line_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-20">
                            <label>Post Code<span>*</span></label>
                                <input type="text" style="background:#e9ecef" id="post_code" name="post_code" value="{{old('post_code')?? Session::get('postcode')[0]}}"   />
                                @error('post_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-20">
                                <label>Phone<span>*</span></label>
                                <input type="text" class="form-control" value="{{auth()->user()->phone}}" name="phone" value="{{old('phone')}}" disabled  />
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <div class="col-lg-6 mb-20">
                                <label>Email<span>*</span></label>
                                <input type="email"class="form-control" value="{{auth()->user()->email}}" name="email" value="{{old('email')}}" disabled required />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <div class="col-12 mb-20">
                                <div id="collapseOne" class="collapse one" data-parent="#accordion">
                                    <div class="card-body1">
                                        <label> Account password <span>*</span></label>
                                        <input placeholder="password" type="password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-20 " >
                                <div class="form-group ">
                                    <h3>
                                        <label  style="font-weight:bold;font-size:24px;" >Ship to Another?</label>
                                        <input type="checkbox" name="others" value="check" />
                                    </h3>
                                </div>
                                <div class="form-group form-group--inline check box">
                                    <label>Name <span class="required">*</span></label>
                                    <input class="form-control" type="text" placeholder="" name="s_name" value="{{old('s_name')}}" />
                                    @error('s_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-group--inline check box">
                                    <label>Address <span class="required">*</span></label>
                                    <input class="form-control" type="text" placeholder="Apartment, suite, unit etc." name="s_address_line_1" value="{{old('s_address_line_1')}}" />
                                    @error('s_address_line_1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-group--inline check box">
                                    <input class="form-control" type="text" placeholder="Street address" name="s_address_line_2" value="{{old('s_address_line_2')}}" />
                                    @error('s_address_line_2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-group--inline check box">
                                <label>Post Code <span class="required">*</span></label>
                                    <input class="form-control" type="text" placeholder="Post Code" name="post_code" value="{{old('post_code') ?? Session::get('postcode')[0]}}" />
                                    @error('post_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-group--inline check box">
                                    <label>Phone <span class="required">*</span></label>
                                    <input class="form-control" type="text" placeholder="Contact Number" name="s_phone" value="{{old('s_phone')}}" />
                                    @error('s_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12" style="font-size:16px;">
                                <div class="order-notes">
                                    <label for="order_note">Order Notes</label>
                                    <textarea id="order_note" name="note" placeholder="Notes about your order, e.g. special notes for delivery." style="height:100px"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5 col-md-6 pr-5 text-left" style="font-size:16px; padding:20px; background:white;border-left:40px solid #ededed">
                        <h3  style="font-weight:bold;font-size:24px;">Order Summary</h3>
                        <hr>
                    <form action="#">
                    
                        <div class="order_table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Products</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody style="color:blue">
                                    @foreach($products as $product)
                                    <tr>
                                        <td> {{$product->name}} <strong> × {{$product->quantity}}</strong></td>
                                        <td> {{$product->subTotal}} &#163;</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="color:#424242">SubTotal</th>
                                        <td>{{$cart['subTotal']}} &#163;</td>
                                    </tr>
                                    <tr>
                                        <th style="color:#424242">Shipping (Express)</th>
                                        <td>{{0}} &#163;</td>
                                    </tr>
                                    <tr class="order_total">
                                        <th style="font-size:24px">Total</th>
                                        <td><strong>{{$cart['subTotal']}}&#163; </strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="order_button text-right mr-4"  >
                            <button  type="submit" onclick="event.preventDefault();
                                document.getElementById('checkout-form').submit()" style="background:#42cca0">Proceed to Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Checkout page section end-->
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('input[type="checkbox"]').click(function() {
            var inputValue = $(this).attr("value");
            $("." + inputValue).toggle();
        });
    });
</script>
@endsection
