var baseweb = 'http://divinegreen.co.uk/';
function addtocart(d) {
    // $('#loadedcart').css("display", 'none').removeClass('d-block');
    // $('#loadingcart').css("display", 'block');
    var vc = $('#pdcartqty_'+d).val();
    var v = parseInt(vc) + 1;
    if (v < 1) {
        v = parseInt(0)
    }
    $.ajax({
               type:'GET',
               url: baseweb+"update-cart-item/"+d,
               data:{quantity:v},
                success: function (data){
                    if (v == 0) {
                        $('#cart_item_'+d).remove();
                        $('#cartbuttons_'+d).html('<input id="pdcartqty_'+d+'" type="hidden" name="quantity" value="0">'+
                        '<button onclick="addtocart('+d+')" class="btn btn-md text-white w-90 ml-2" style="border-radius:5px;background:#40A944; padding:7px 15px; margin-right: 5px;">Add To Basket</button>');
                    }else{
                        if (vc == 0) {
                            var i = '<button onclick="rmfmcart('+d+')" class="btn btn-primary ">-</button>'+
                            '<input style="width: 40px" id="pdcartqty_'+d+'" class="cartqty text-center" type="number" min="1" value="'+v+'">'+
                            '<button onclick="addtocart('+d+')" class="btn btn-primary">+</button>';
                            $('#cartbuttons_'+d).html(i);
                        }else{
                            $('#pdcartqty_'+d).val().innerHTML = $('#pdcartqty_'+d).val(v);
                        }
                        var f = $('#cart_item_'+d).val();
                        if (f == null) {
                            var f = '<div id="cart_item_'+d+'">'+
                            '<div class="row mx-1 pl-2">'+
                            '<div class="cart_img"><a href="#"><img src="'+data.image+'" alt=""></a></div>'+
                            '<div class="cart_p_name "><a href="#">'+data.product.name+'</a></div></div>'+
                            '<div class="row mx-3 justify-content-between " style="margin-top: 0.3rem">'+
                            '<div class="col-xs-5 text-center cart-button">'+
                                '<div class="d-flex" style="width: 33%">'+
                                    '<button onclick="rmpdfmcart('+d+')" class="btn btn-primary btn-sm">-</button>'+
                                    '<input id="cartqty_'+d+'" class="cartqty text-center" type="number" min="1" value="'+data.product.quantity+'">'+
                                    '<button onclick="addpdtocart('+d+')" class="btn btn-primary btn-sm">+</button>'+
                                '</div></div>'+
                            '<div class="col-xs-6 cart_info text-center"><p id="cartpdqty_'+d+'" style="margin: 0;">'+data.product.quantity+' x <span> ??'+data.product.price+' </span></p><p style="margin: 0;">'+data.model+'</p></div>'+
                            '<div class="col-xs-1"><div class="cart_remove"><button onclick="rmvfmcart('+d+')" type="submit" style="border:none;"><i class="fa fa-trash"></i></button></div>'+
                            '</div></div><hr style="margin-top: 0.3rem;margin-bottom: 0.3rem; border: 0; border-top: 1px solid rgb(64 169 68 / 34%);"></div>';

                        $('#loadedcart').append(f);
                        }else{
                            $('#cartqty_'+d).val().innerHTML = $('#cartqty_'+d).val(v);
                        }


                    $('#cartpdqty_'+d).html(data.product.quantity+' x <span> &#163;'+data.product.price+' </span>');
                    }
                    $('#cartsubtotal').html('&#163;'+data.subtotalprice);
                    $('#carttotal').html('&#163;'+data.totalprice);
                    $('#cartheadcount').html(data.items);
                    $('#cartheadprice').html('&#163;'+data.subtotalprice);
                    // $('#loadedcart').addClass('d-block');
                    // $('#loadingcart').css("display", 'none');
                }
            });
}
function addpdtocart(d) {
    // $('#loadedcart').css("display", 'none').removeClass('d-block');
    // $('#loadingcart').css("display", 'block');
    var v = $('#cartqty_'+d).val();
    var v = parseInt(v) + 1;
    if (v < 1) {
        v = parseInt(0)
    }
    $.ajax({
               type:'GET',
               url: baseweb+"update-cart-item/"+d,
               data:{quantity:v},
                success: function (data){
                    if (v == 0) {
                        $('#cart_item_'+d).remove();
                        $('#cartbuttons_'+d).html('<input id="pdcartqty_'+d+'" type="hidden" name="quantity" value="0">'+
                        '<button onclick="addtocart('+d+')" class="btn btn-md text-white w-90 ml-2" style="border-radius:5px;background:#40A944; padding:7px 15px; margin-right: 5px;">Add To Basket</button>');
                    }else{
                    $('#pdcartqty_'+d).val().innerHTML = $('#pdcartqty_'+d).val(v);
                    $('#cartqty_'+d).val().innerHTML = $('#cartqty_'+d).val(v);
                    $('#cartpdqty_'+d).html(data.product.quantity+' x <span> &#163;'+data.product.price+' </span>');
                    }
                    $('#cartsubtotal').html('&#163;'+data.subtotalprice);
                    $('#carttotal').html('&#163;'+data.totalprice);
                    $('#cartheadcount').html(data.items);
                    $('#cartheadprice').html('&#163;'+data.subtotalprice);
                    // $('#loadedcart').addClass('d-block');
                    // $('#loadingcart').css("display", 'none');
                }
            });
}
function rmfmcart(d) {
    // $('#loadedcart').css("display", 'none').removeClass('d-block');
    // $('#loadingcart').css("display", 'block');
    var v = $('#pdcartqty_'+d).val();
    var v = parseInt(v) - 1;
    if (v < 1) {
        v = parseInt(0)
    }
    $.ajax({
               type:'GET',
               url: baseweb+"update-cart-item/"+d,
               data:{quantity:v},
                success: function (data){
                    if (v == 0) {
                        $('#cart_item_'+d).remove();
                        $('#cartbuttons_'+d).html('<input id="pdcartqty_'+d+'" type="hidden" name="quantity" value="0">'+
                        '<button onclick="addtocart('+d+')" class="btn btn-md text-white w-90 ml-2" style="border-radius:5px;background:#40A944; padding:7px 15px; margin-right: 5px;">Add To Basket</button>');
                    }else{
                        $('#pdcartqty_'+d).val().innerHTML = $('#pdcartqty_'+d).val(v);
                        var f = $('#cart_item_'+d).val();
                        if (f == null) {
                            var f = '<div id="cart_item_'+d+'">'+
                            '<div class="row mx-1 pl-2">'+
                            '<div class="cart_img"><a href="#"><img src="'+data.image+'" alt=""></a></div>'+
                            '<div class="cart_p_name "><a href="#">'+data.product.name+'</a></div></div>'+
                            '<div class="row mx-3 justify-content-between " style="margin-top: 0.3rem">'+
                            '<div class="col-xs-5 text-center cart-button">'+
                                '<div class="d-flex" style="width: 33%">'+
                                    '<button onclick="rmpdfmcart('+d+')" class="btn btn-primary btn-sm">-</button>'+
                                    '<input id="cartqty_'+d+'" class="cartqty text-center" type="number" min="1" value="'+data.product.quantity+'">'+
                                    '<button onclick="addpdtocart('+d+')" class="btn btn-primary btn-sm">+</button>'+
                                '</div></div>'+
                            '<div class="col-xs-6 cart_info text-center"><p id="cartpdqty_'+d+'" style="margin: 0;">'+data.product.quantity+' x <span> ??'+data.product.price+' </span></p><p style="margin: 0;">'+data.model+'</p></div>'+
                            '<div class="col-xs-1"><div class="cart_remove"><button onclick="rmvfmcart('+d+')" type="submit" style="border:none;"><i class="fa fa-trash"></i></button></div>'+
                            '</div></div><hr style="margin-top: 0.3rem;margin-bottom: 0.3rem; border: 0; border-top: 1px solid rgb(64 169 68 / 34%);"></div>';

                        $('#loadedcart').append(f);
                        }else{
                            $('#cartqty_'+d).val().innerHTML = $('#cartqty_'+d).val(v);
                        }

                        $('#pdcartqty_'+d).val().innerHTML = $('#pdcartqty_'+d).val(v);



                    $('#cartpdqty_'+d).html(data.product.quantity+' x <span> &#163;'+data.product.price+' </span>');
                    }
                    $('#cartsubtotal').html('&#163;'+data.subtotalprice);
                    $('#carttotal').html('&#163;'+data.totalprice);
                    $('#cartheadcount').html(data.items);
                    $('#cartheadprice').html('&#163;'+data.subtotalprice);
                    // $('#loadedcart').addClass('d-block');
                    // $('#loadingcart').css("display", 'none');
                }
        });
}
function rmpdfmcart(d) {
    // $('#loadedcart').css("display", 'none').removeClass('d-block');
    // $('#loadingcart').css("display", 'block');
    var v = $('#cartqty_'+d).val();
    var v = parseInt(v) - 1;
    if (v < 1) {
        v = parseInt(0)
    }
    $.ajax({
               type:'GET',
               url: baseweb+"update-cart-item/"+d,
               data:{quantity:v},
                success: function (data){
                    if (v == 0) {
                        $('#cart_item_'+d).remove();
                        $('#cartbuttons_'+d).html('<input id="pdcartqty_'+d+'" type="hidden" name="quantity" value="0">'+
                        '<button onclick="addtocart('+d+')" class="btn btn-md text-white w-90 ml-2" style="border-radius:5px;background:#40A944; padding:7px 15px; margin-right: 5px;">Add To Basket</button>');
                    }else{
                        $('#cartqty_'+d).val().innerHTML = $('#cartqty_'+d).val(v);
                        $('#cartpdqty_'+d).html(data.product.quantity+' x <span> &#163;'+data.product.price+' </span>');
                        $('#pdcartqty_'+d).val().innerHTML = $('#pdcartqty_'+d).val(v);

                    }
                    $('#cartsubtotal').html('&#163;'+data.subtotalprice);
                    $('#carttotal').html('&#163;'+data.totalprice);
                    $('#cartheadcount').html(data.items);
                    $('#cartheadprice').html('&#163;'+data.subtotalprice);
                    // $('#loadedcart').addClass('d-block');
                    // $('#loadingcart').css("display", 'none');
                }
        });
}
function rmvfmcart(d) {
    // $('#loadedcart').css("display", 'none').removeClass('d-block');
    // $('#loadingcart').css("display", 'block');
    var v = parseInt(0);
    $.ajax({
               type:'GET',
               url: baseweb+"update-cart-item/"+d,
               data:{quantity:v},
                success: function (data){
                    $('#cartbuttons_'+d).html('<input id="pdcartqty_'+d+'" type="hidden" name="quantity" value="0">'+
                        '<button onclick="addtocart('+d+')" class="btn btn-md text-white w-90 ml-2" style="border-radius:5px;background:#40A944; padding:7px 15px; margin-right: 5px;">Add To Basket</button>');
                    $('#cartsubtotal').html('&#163;'+data.subtotalprice);
                    $('#carttotal').html('&#163;'+data.totalprice);
                    $('#cartheadcount').html(data.items);
                    $('#cartheadprice').html('&#163;'+data.subtotalprice);
                    $('#cart_item_'+d).remove();
                    // $('#loadedcart').addClass('d-block');
                    // $('#loadingcart').css("display", 'none');
                }
    });
}
