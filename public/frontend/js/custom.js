var baseweb = 'http://localhost:8000/';
function addtocart(d) {
    // $('#loadedcart').css("display", 'none').removeClass('d-block');
    // $('#loadingcart').css("display", 'block');
    var vc = $('#pdcartqty_' + d).val();
    var v = parseInt(vc) + 1;
    if (v < 1) {
        v = parseInt(0)
    }
    $.ajax({
        type: 'GET',
        url: baseweb + "update-cart-item/" + d,
        data: { quantity: v },
        success: function (data) {
            if (v == 0) {
                $('#cart_item_' + d).remove();
                $('#cartbuttons_' + d).html('<input id="pdcartqty_' + d + '" type="hidden" name="quantity" value="0">' +
                    '<button onclick="addtocart(' + d + ')" class="btn btn-md text-white w-90 ml-2" style="border-radius:5px;background:#40A944; padding:7px 15px; margin-right: 5px;">Add To Basket</button>');
            } else {
                if (vc == 0) {
                    var i = '<button onclick="rmfmcart(' + d + ')" class="btn btn-primary ">-</button>' +
                        '<input style="width: 40px" id="pdcartqty_' + d + '" class="cartqty text-center" type="number" min="1" value="' + v + '">' +
                        '<button onclick="addtocart(' + d + ')" class="btn btn-primary">+</button>';
                    $('#cartbuttons_' + d).html(i);
                } else {
                    $('#pdcartqty_' + d).val().innerHTML = $('#pdcartqty_' + d).val(v);
                }
                var f = $('#cart_item_' + d).val();
                if (f == null) {
                    var f = '<div id="cart_item_' + d + '">' +
                        '<div class="row mx-1 pl-2">' +
                        '<div class="cart_img"><a href="#"><img src="' + data.image + '" alt=""></a></div>' +
                        '<div class="cart_p_name "><a href="#">' + data.product.name + '</a></div></div>' +
                        '<div class="row mx-3 justify-content-between " style="margin-top: 0.3rem">' +
                        '<div class="col-xs-5 text-center cart-button">' +
                        '<div class="d-flex" style="width: 33%">' +
                        '<button onclick="rmpdfmcart(' + d + ')" class="btn btn-primary btn-sm">-</button>' +
                        '<input id="cartqty_' + d + '" class="cartqty text-center" type="number" min="1" value="' + data.product.quantity + '">' +
                        '<button onclick="addpdtocart(' + d + ')" class="btn btn-primary btn-sm">+</button>' +
                        '</div></div>' +
                        '<div class="col-xs-6 cart_info text-center"><p id="cartpdqty_' + d + '" style="margin: 0;">' + data.product.quantity + ' x <span> £' + data.product.price + ' </span></p><p style="margin: 0;">' + data.model + '</p></div>' +
                        '<div class="col-xs-1"><div class="cart_remove"><button onclick="rmvfmcart(' + d + ')" type="submit" style="border:none;"><i class="fa fa-trash"></i></button></div>' +
                        '</div></div><hr style="margin-top: 0.3rem;margin-bottom: 0.3rem; border: 0; border-top: 1px solid rgb(64 169 68 / 34%);"></div>';

                    $('#loadedcart').append(f);
                } else {
                    $('#cartqty_' + d).val().innerHTML = $('#cartqty_' + d).val(v);
                }


                $('#cartpdqty_' + d).html(data.product.quantity + ' x <span> &#163;' + data.product.price + ' </span>');
            }
            $('#cartsubtotal').html('&#163;' + data.subtotalprice);
            $('#carttotal').html('&#163;' + data.totalprice);
            $('#cartheadcount').html(data.items);
            $('#cartheadprice').html('&#163;' + data.subtotalprice);
            $('#loadedcart').addClass('d-block');
            $('#loadingcart').css("display", 'none');
        }
    });
}
function addpdtocart(d) {
    $('#loadedcart').css("display", 'none').removeClass('d-block');
    $('#loadingcart').css("display", 'block');
    var v = $('#cartqty_' + d).val();
    var v = parseInt(v) + 1;
    if (v < 1) {
        v = parseInt(0)
    }
    $.ajax({
        type: 'GET',
        url: baseweb + "update-cart-item/" + d,
        data: { quantity: v },
        success: function (data) {
            if (v == 0) {
                $('#cart_item_' + d).remove();
                $('#cartbuttons_' + d).html('<input id="pdcartqty_' + d + '" type="hidden" name="quantity" value="0">' +
                    '<button onclick="addtocart(' + d + ')" class="btn btn-md text-white w-90 ml-2" style="border-radius:5px;background:#40A944; padding:7px 15px; margin-right: 5px;">Add To Basket</button>');
            } else {
                var elem = document.getElementById("pdcartqty_" + d);
                if (typeof (elem) != 'undefined' && elem != null) {
                    $('#pdcartqty_' + d).val().innerHTML = $('#pdcartqty_' + d).val(v);
                }
                $('#cartqty_' + d).val().innerHTML = $('#cartqty_' + d).val(v);
                $('#cartpdqty_' + d).html(data.product.quantity + ' x <span> &#163;' + data.product.price + ' </span>');
            }
            $('#cartsubtotal').html('&#163;' + data.subtotalprice);
            $('#carttotal').html('&#163;' + data.totalprice);
            $('#cartheadcount').html(data.items);
            $('#cartheadprice').html('&#163;' + data.subtotalprice);
            $('#loadedcart').addClass('d-block');
            $('#loadingcart').css("display", 'none');
        }
    });
}
function rmfmcart(d) {
    $('#loadedcart').css("display", 'none').removeClass('d-block');
    $('#loadingcart').css("display", 'block');
    var v = $('#pdcartqty_' + d).val();
    var v = parseInt(v) - 1;
    if (v < 1) {
        v = parseInt(0)
    }
    $.ajax({
        type: 'GET',
        url: baseweb + "update-cart-item/" + d,
        data: { quantity: v },
        success: function (data) {
            if (v == 0) {
                $('#cart_item_' + d).remove();
                $('#cartbuttons_' + d).html('<input id="pdcartqty_' + d + '" type="hidden" name="quantity" value="0">' +
                    '<button onclick="addtocart(' + d + ')" class="btn btn-md text-white w-90 ml-2" style="border-radius:5px;background:#40A944; padding:7px 15px; margin-right: 5px;">Add To Basket</button>');
            } else {
                if ($('#pdcartqty_' + d)) {
                    $('#pdcartqty_' + d).val().innerHTML = $('#pdcartqty_' + d).val(v);
                }
                var f = $('#cart_item_' + d).val();
                if (f == null) {
                    var f = '<div id="cart_item_' + d + '">' +
                        '<div class="row mx-1 pl-2">' +
                        '<div class="cart_img"><a href="#"><img src="' + data.image + '" alt=""></a></div>' +
                        '<div class="cart_p_name "><a href="#">' + data.product.name + '</a></div></div>' +
                        '<div class="row mx-3 justify-content-between " style="margin-top: 0.3rem">' +
                        '<div class="col-xs-5 text-center cart-button">' +
                        '<div class="d-flex" style="width: 33%">' +
                        '<button onclick="rmpdfmcart(' + d + ')" class="btn btn-primary btn-sm">-</button>' +
                        '<input id="cartqty_' + d + '" class="cartqty text-center" type="number" min="1" value="' + data.product.quantity + '">' +
                        '<button onclick="addpdtocart(' + d + ')" class="btn btn-primary btn-sm">+</button>' +
                        '</div></div>' +
                        '<div class="col-xs-6 cart_info text-center"><p id="cartpdqty_' + d + '" style="margin: 0;">' + data.product.quantity + ' x <span> £' + data.product.price + ' </span></p><p style="margin: 0;">' + data.model + '</p></div>' +
                        '<div class="col-xs-1"><div class="cart_remove"><button onclick="rmvfmcart(' + d + ')" type="submit" style="border:none;"><i class="fa fa-trash"></i></button></div>' +
                        '</div></div><hr style="margin-top: 0.3rem;margin-bottom: 0.3rem; border: 0; border-top: 1px solid rgb(64 169 68 / 34%);"></div>';

                    $('#loadedcart').append(f);
                } else {
                    $('#cartqty_' + d).val().innerHTML = $('#cartqty_' + d).val(v);
                }

                $('#pdcartqty_' + d).val().innerHTML = $('#pdcartqty_' + d).val(v);



                $('#cartpdqty_' + d).html(data.product.quantity + ' x <span> &#163;' + data.product.price + ' </span>');
            }
            $('#cartsubtotal').html('&#163;' + data.subtotalprice);
            $('#carttotal').html('&#163;' + data.totalprice);
            $('#cartheadcount').html(data.items);
            $('#cartheadprice').html('&#163;' + data.subtotalprice);
            $('#loadedcart').addClass('d-block');
            $('#loadingcart').css("display", 'none');
        }
    });
}
function rmpdfmcart(d) {
    $('#loadedcart').css("display", 'none').removeClass('d-block');
    $('#loadingcart').css("display", 'block');
    var v = $('#cartqty_' + d).val();
    var v = parseInt(v) - 1;
    if (v < 1) {
        v = parseInt(0)
    }
    $.ajax({
        type: 'GET',
        url: baseweb + "update-cart-item/" + d,
        data: { quantity: v },
        success: function (data) {
            if (v == 0) {
                $('#cart_item_' + d).remove();
                $('#cartbuttons_' + d).html('<input id="pdcartqty_' + d + '" type="hidden" name="quantity" value="0">' +
                    '<button onclick="addtocart(' + d + ')" class="btn btn-md text-white w-90 ml-2" style="border-radius:5px;background:#40A944; padding:7px 15px; margin-right: 5px;">Add To Basket</button>');
            } else {
                $('#cartqty_' + d).val().innerHTML = $('#cartqty_' + d).val(v);
                $('#cartpdqty_' + d).html(data.product.quantity + ' x <span> &#163;' + data.product.price + ' </span>');
                var elem = document.getElementById("pdcartqty_" + d);
                if (typeof (elem) != 'undefined' && elem != null) {
                    $('#pdcartqty_' + d).val().innerHTML = $('#pdcartqty_' + d).val(v);
                }

            }
            $('#cartsubtotal').html('&#163;' + data.subtotalprice);
            $('#carttotal').html('&#163;' + data.totalprice);
            $('#cartheadcount').html(data.items);
            $('#cartheadprice').html('&#163;' + data.subtotalprice);
            $('#loadedcart').addClass('d-block');
            $('#loadingcart').css("display", 'none');
        }
    });
}
function rmvfmcart(d) {
    $('#loadedcart').css("display", 'none').removeClass('d-block');
    $('#loadingcart').css("display", 'block');
    var v = parseInt(0);
    $.ajax({
        type: 'GET',
        url: baseweb + "update-cart-item/" + d,
        data: { quantity: v },
        success: function (data) {
            $('#cartbuttons_' + d).html('<input id="pdcartqty_' + d + '" type="hidden" name="quantity" value="0">' +
                '<button onclick="addtocart(' + d + ')" class="btn btn-md text-white w-90 ml-2" style="border-radius:5px;background:#40A944; padding:7px 15px; margin-right: 5px;">Add To Basket</button>');
            $('#cartsubtotal').html('&#163;' + data.subtotalprice);
            $('#carttotal').html('&#163;' + data.totalprice);
            $('#cartheadcount').html(data.items);
            $('#cartheadprice').html('&#163;' + data.subtotalprice);
            $('#cart_item_' + d).remove();
            $('#loadedcart').addClass('d-block');
            $('#loadingcart').css("display", 'none');
        }
    });
}
function checkPostcode() {
    $('#postcodebutton').html(`<div class="loader"></div>`)
    var postcode = $('#post_code').val();
    if (postcode == '') {
        console.log('1')
        postcode = $('#postcodeModalvalue').val();
        if (postcode == '') {
            console.log('2')
            postcode = $('#postcode2').val();
        }
    }
    if (postcode == '') {
        $('#postcodeError').html('Invalid postcode!');
        $('#postcodeErrorFlex').html('Invalid postcode!');
        $('#postcodebutton').html(`
                                        <button class="btn" onclick="event.preventDefault();checkPostcode();" style="background:#38c79f;color:white;font-weight:bold">
                                            Check Postcode
                                        </button>
                        `);
        if ($('#postcodeModalvalue').val() != '') {
            $('#ModalpostcodeError').html('Invalid postcode!');
        }
    } else {
        var pcode = postcode.split(" ")
        axios.get('http://api.postcodes.io/postcodes/' + pcode[0] + '/autocomplete')
            .then(response => {
                if (response.data.result == null) {
                    $('#postcodeError').html('Invalid postcode!');
                    if ($('#postcode2').val() != '') {
                        $('#postcodeErrorFlex').html('Invalid postcode!');
                    }
                    $('#postcodebutton').html(`
                                        <button class="btn" onclick="event.preventDefault();checkPostcode();" style="background:#38c79f;color:white;font-weight:bold">
                                            Check Postcode
                                        </button>
                        `);
                    if ($('#postcodeModalvalue').val() != '') {
                        $('#ModalpostcodeError').html('Invalid postcode!');
                    }
                } else {
                    axios.get(baseweb + 'postcode/check/' + postcode).then(res => {
                        if (res.data == 1) {
                            var div = `<p style="font-weight:bold">
                                <i style="color: green" class=" fa fa-check"></i> Great news! We'll deliver your shop to `+ postcode.toUpperCase() + `<br> for free when you spend over £35!
                                        <a class="changecode" onclick="removePostcode()">Change Postcode</a>
                                    </p>

                                    <div class="row">
                                        <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a class="btn border" href="/booking">Book Delivery</a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a class="btn" href="" style="background:#38c79f;color:white;font-weight:bold">
                                                            Continue
                                                        </a>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>`
                            $('#postcodeSpace').html(div);
                            var div2 = `
                                    <div class="col-md-6 text-center text-dark">
                                    <i style="color: green" class=" fa fa-check"></i> Great! We'll deliver to  `+ postcode.toUpperCase() + ` Postcode, not right?
                                        <a class="changecode" onclick="removePostcode()">Change it</a>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <a class="btn border" href="/booking">Book Delivery</a>
                                    </div>`
                            $('#postcodeflex').html(div2);
                            var div3 = `<p style="font-weight:bold">
                                    <i style="color: green" class=" fa fa-check"></i> Great news! We'll deliver your shop to `+ postcode.toUpperCase() + `<br> for free when you spend over £35!
                                            <a class="changecode" onclick="removePostcode()">Change Postcode</a>
                                        </p>`
                            $('#modalbodydiv').html(div3);
                            window.location.reload();
                        }
                        else {
                            var div = `<p style="font-weight:bold">
                                    Sorry, we don't deliver to `+ postcode.toUpperCase() + ` at the moment.<br> Create an account with us and we will let you know <br> when online deliveries are available in your area.
                                     <a class="changecode" onclick="removePostcode()">Change Postcode</a>
                                 </p>

                                 <div class="row">
                                     <div class="col-md-12">
                                             <div class="row">
                                                 <div class="col-md-6">
                                                     <a class="btn border" href="">Continue</a>
                                                 </div>
                                                 <div class="col-md-6">
                                                     <!-- <a class="btn" href="" style="background:#38c79f;color:white;font-weight:bold">
                                                         Continue
                                                     </a> -->
                                                 </div>
                                             </div>
                                     </div>
                                 </div>`
                            $('#postcodeSpace').html(div);
                            var div2 = `<div class="col-md-6 text-center text-dark">
                                        Sorry, we're unable to deliver to `+ postcode.toUpperCase() + ` Postcode, not right?
                                        <a class="changecode" onclick="removePostcode()">Change it</a>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <a href="/register" class="btn" style="background:#0096cf;color:white;font-weight:bold">
                                            Register
                                        </a>
                                    </div>`
                            $('#postcodeflex').html(div2);
                            var div3 = `<div class="col-md-12 text-center text-dark">
                                    Sorry, we're unable to deliver to `+ postcode.toUpperCase() + ` Postcode, <br> not right?
                                    <a class="changecode" onclick="removePostcode()">Change it</a>
                                    </div>`
                            $('#modalbodydiv').html(div3);
                        }
                    });
                }

            });
    }
}
function removePostcode() {
    axios.get(baseweb + 'postcode/remove').then(res => {
        if (res.data == 0) {
            var div = `<p style="font-weight:bold">Check if we can deliver. Please enter your postcode <br> below to check if we are able to deliver to your address.</p>
                                <div class="row justify-content-center">
                                    <div class="col-md-8-auto">
                                        <form action="" method="get">
                                            <div class="row">
                                                <div class="col-md-6">
                                            <input style="border:1px solid red" type="text" id="post_code" name="post_code"  placeholder ="Post code" class="form-control w-100 text-left" required>
                                            <br>
                                            <span id="postcodeError" style="color: red"></span>
                                                </div>
                                                <div id="postcodebutton" class="col-md-6">
                                                    <button class="btn" onclick="event.preventDefault();checkPostcode();" style="background:#38c79f;color:white;font-weight:bold">
                                                        Check Postcode
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>`
            $('#postcodeSpace').html(div);
            var div2 = `<div class="col-md-6 text-center">
                                                <input style="border:1px solid #0096cf" type="text" id="postcode2" name="post_code" placeholder="Enter Post Code" class="form-control w-100 text-left" required>
                                                <br>
                                                <span id="postcodeErrorFlex" style="color: red"></span>
                                            </div>
                                            <div class="col-md-6 text-left">
                                                <button class="btn" onclick="event.preventDefault();checkPostcode();" style="background:#0096cf;color:white;font-weight:bold">
                                                    Check Postcode
                                                </button>
                                            </div>`
            $('#postcodeflex').html(div2);
        }
        window.location.reload();
    });
}
