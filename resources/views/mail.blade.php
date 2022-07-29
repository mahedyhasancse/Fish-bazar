<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="col-md-12 text-center">
                        <img width="250px" height="100px" src="http://ababil.group/fishbazaar.png" alt="">
                    </div>
                    <div class="card-heading p-4">
                        <h4 class="bg-info p-4 text-center  text-white">Thank You For Your Order</h4>
                    </div>
                    <div class="card-body ">
                        <p class="ml-4">Hi {{$data->user->username}},</p>
                        <p class="ml-4 mt-4">Just to let you know -we,ve recived your <b style="font-size:25px">{{$data->order_no}}</b></p>
                        <p class="ml-4 mt-4">pay with <b>{{$data->status}}</b></p>
                        <h3 class="ml-4 mt-4 text-info">[{{$data->order_no}}] [{{ date('d-M-y H:s', strtotime($data->created_at)) }}]</h3>
                        <div class="col-md-12 p-4">

                            </style>
                            <table border="1px" cell-padding="10px">
                                <thead>
                                    <tr>

                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->orderDetails as $od)
                                    <tr>

                                        <td>
                                            {{$od->product->name}} * {{$od->quantity}}
                                        </td>
                                        <td>
                                            @if($od->product->offer)
                                            <li>{{$od->product->offer->offerPrice}} EUR</li>
                                            @else
                                            <li>{{$od->product->price}} EUR</li>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach

                            </table>

                            <h3>Total Amount: {{$data->total}} EUR</h3>
                        </div>
                        @if($data->status=="pick from the shop")
                        <div>
                            @foreach($data->time as $t)
                            <p> Pick Time: {{$t->time}}</p>
                            <p>Date: {{$t->date}}</p>
                            @endforeach
                        </div>
                        @else
                        <div class="col-md-12">
                            <h3 class="text-info">Billing Adress:</h3>
                            <div class="card col-md-6 p-4 m-4">
                                <p>{{$data->shipped->s_name}}</p>
                                <p>{{$data->shipped->s_phone}}</p>
                                <p>{{$data->shipped->post_code}}</p>
                                <p>{{$data->shipped->s_address_line_1}}</p>
                                <p>{{$data->shipped->s_address_line_2}}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="card-footer text-center">
                        <span>Thank For Using <a href="http://divinegreen.co.uk/">Divinegreen.co.uk</a></span>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>