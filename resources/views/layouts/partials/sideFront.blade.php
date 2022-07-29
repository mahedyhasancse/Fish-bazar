<?php
$brands = App\Brand::all();
$price['max'] = App\Product::max('price');
$price['min'] = App\Product::min('price');
?>
<div class="col-lg-3 col-md-12">
    <!--sidebar widget start-->
    <aside class="sidebar_widget">
        <div class="widget_inner">
            <div class="widget_list widget_categories">
                <h3>Brand</h3>
                @foreach($brands as $brand)
                <ul>
                    <li class="widget_sub_categories sub_categories1"><a href="{{route('brand.product',$brand->id)}}">{{$brand->name}}</a>
                        <!-- <ul class="widget_dropdown_categories dropdown_categories1">
                                        <li><a href="#">Document</a></li>
                                        <li><a href="#">Dropcap</a></li>
                                        <li><a href="#">Dummy Image</a></li>
                                        <li><a href="#">Dummy Text</a></li>
                                        <li><a href="#">Fancy Text</a></li>
                                    </ul> -->
                    </li>
                </ul>
                @endforeach
            </div>

            <div class="widget_list widget_filter">
                <h3 class="">Filter by Price</h3>
                <div class="price_filter">
                    <div id="price-slider-range"></div>
                    <form action="{{route('range.search')}}" method="get">
                        <div class="price_slider_amount">
                            <div class="label-input">
                                <label>price : <span id="price-amount" style="width:100%"></span> </label>
                                <input type="hidden" name="name" val="{{$query ?? ''}}">
                                <input type="hidden" id="amount" name="price" placeholder="Add Your Price" style="width:80% !important" />
                            </div>
                        </div>
                        <button type="submit" >Filter</button>
                    </form>
                </div>
            </div>
            <!-- <div class="widget_list widget_color">
                            <h3>Select By Color</h3>
                            <ul>
                                <li>
                                    <a href="#">Black  <span>(6)</span></a>
                                </li>
                                <li>
                                    <a href="#"> Blue <span>(8)</span></a>
                                </li>
                                <li>
                                    <a href="#">Brown <span>(10)</span></a>
                                </li>
                                <li>
                                    <a href="#"> Green <span>(6)</span></a>
                                </li>
                                <li>
                                    <a href="#">Pink <span>(4)</span></a>
                                </li>

                            </ul>
                        </div>
                        <div class="widget_list widget_color">
                            <h3>Select By SIze</h3>
                            <ul>
                                <li>
                                    <a href="#">S  <span>(6)</span></a>
                                </li>
                                <li>
                                    <a href="#"> M <span>(8)</span></a>
                                </li>
                                <li>
                                    <a href="#">L <span>(10)</span></a>
                                </li>
                                <li>
                                    <a href="#"> XL <span>(6)</span></a>
                                </li>
                                <li>
                                    <a href="#">XLL <span>(4)</span></a>
                                </li>

                            </ul>
                        </div> -->
            <!-- <div class="widget_list widget_manu">
                            <h3>Manufacturer</h3>
                            <ul>
                                <li>
                                    <a href="#">Brake Parts <span>(6)</span></a>
                                </li>
                                <li>
                                    <a href="#">Accessories <span>(10)</span></a>
                                </li>
                                <li>
                                    <a href="#">Engine Parts <span>(4)</span></a>
                                </li>
                                <li>
                                    <a href="#">hermes <span>(10)</span></a>
                                </li>
                                <li>
                                    <a href="#">louis vuitton <span>(8)</span></a>
                                </li>

                            </ul>
                        </div>
                        <div class="widget_list tags_widget">
                            <h3>Product tags</h3>
                            <div class="tag_cloud">
                                <a href="#">Men</a>
                                <a href="#">Women</a>
                                <a href="#">Watches</a>
                                <a href="#">Bags</a>
                                <a href="#">Dress</a>
                                <a href="#">Belt</a>
                                <a href="#">Accessories</a>
                                <a href="#">Shoes</a>
                            </div>
                        </div> -->
            <div class="widget_list banner_widget">
                <div class="banner_thumb">
                    <a href="#"><img src="{{ asset('frontend/img/bg/banner17.jpg') }}" alt=""></a>
                </div>
            </div>
        </div>
    </aside>
    <!--sidebar widget end-->
</div>
@section('scripts')
<script>
    var sliderrange = $('#price-slider-range');
    var amountprice = $('#price-amount');
    var amount_input = $('#amount');
    $(function() {
        sliderrange.slider({
            range: true,
            min: parseInt('{{$price["min"] ?? "20"}}'),
            max: parseInt('{{$price["max"] ?? "5000"}}'),
            values: [parseInt('{{$searchPrice["min"] ?? "0"}}'), parseInt('{{$searchPrice["max"] ?? $price["max"]}}')],
            slide: function(event, ui) {
                amountprice.html("(" + ui.values[0] + " - " + ui.values[1] + ") EURO");
                amount_input.val(ui.values[0] + "," + ui.values[1]);

            }
        });
        amountprice.html("(" + sliderrange.slider("values", 0) + ' - ' + sliderrange.slider("values", 1) + ") EURO");
        amount_input.val(sliderrange.slider("values", 0) + ',' + sliderrange.slider("values", 1));
    });
    
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.addcart').on('click',function(e){

                e.preventDefault();
                var id= $(this).data('id');
                var quantity = $("#quantity").val();

                $.ajax({
                   type:'POST',
                   url:"ajax-add-to-cart/"+id,
                   data:{_token: CSRF_TOKEN,quantity:quantity},
                });
            });
            });
</script>
@endsection