    <!-- modal area start-->
    @if (isset($products))
    @foreach ($products as $product)
    @php
    $sizes = explode(',', $product->productDetails->size);
    $colors = explode(',', $product->productDetails->color);
    @endphp
    <div class="modal fade" id="modal_box_{{ $product->id }}" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-x"></i></span>
                </button>
                <div class="modal_body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <div class="modal_tab">
                                    <div class="tab-content product-details-large">
                                        @php
                                        $active = "show active";
                                        $tab = 1;
                                        @endphp
                                        @foreach ($product->image as $image)
                                        <div class="tab-pane fade {{ $active }}" id="{{ $tab }}" role="tabpanel" >
                                            <div class="modal_tab_img">
                                                <a href="#"><img src="{{ asset($image->image) }}" alt=""></a>
                                            </div>
                                        </div>
                                        @php
                                        $tab++;
                                        $active ="";
                                        @endphp
                                        @endforeach
                                    </div>
                                    <div class="modal_tab_button">
                                        <ul class="nav product_navactive owl-carousel" role="tablist">
                                            @php
                                            $active = "active";
                                            $tab = 1;
                                            @endphp
                                            @foreach ($product->image as $image)
                                            <li >
                                                <a class="nav-link {{ $active }}" data-toggle="tab" href="#{{ $tab }}" role="tab" aria-controls="tab1" aria-selected="false"><img src="{{ asset($image->image) }}" alt=""></a>
                                            </li>
                                            @php
                                            $tab++;
                                            $active ="";
                                            @endphp
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <div class="modal_right">
                                    <div class="modal_title mb-10">
                                        <h2>{{ $product->name }}</h2>
                                    </div>
                                    <div class="modal_price mb-10">
                                        <span class="new_price">${{ $product->price }}</span>
                                        {{-- <span class="old_price" >$78.99</span> --}}
                                    </div>
                                    <div class="modal_description mb-15">
                                        <p>{{ $product->description }} </p>
                                    </div>
                                    <form method="post" action="{{route('add.cart',$product->id)}}">
                                        @csrf
                                            <div class="modal_add_to_cart">
                                                <span>Quantity: </span>
                                                <input min="1" max="100" step="2" name="quantity" value="1" type="number">
                                                <br>
                                                <br>
                                                <button class="btn borde btn-success" type="submit">Add to Basket </button>

                                            </div>
                                        </div>
                                    </form>
                                    <div class="modal_social">
                                        {{-- <h2>Share this product</h2>
                                        <ul>
                                            <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li class="pinterest"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                            <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                            <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        </ul> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
    <!-- modal area end-->
