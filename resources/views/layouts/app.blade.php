<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name', 'Fish Bazaar') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/frontend/fishbazaar.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS  -->
    <!--bootstrap min css-->
    <link rel="stylesheet" href="{{asset('frontend/toastr.min.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!--owl carousel min css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <!--slick min css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <!--magnific popup min css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <!--font awesome css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/font.awesome.css') }}">
    <!--ionicons css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/ionicons.min.css') }}">
    <!--linearicons css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/linearicons.css') }}">
    <!--animate css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <!--jquery ui min css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}">
    <!--slinky menu css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/slinky.menu.css') }}">
    <!--plugins css-->
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins.css') }}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <!--modernizr min js here-->
    <script src="{{ asset('frontend/js/vendor/modernizr-3.7.1.min.js') }}"></script>
    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>
    <style>
        .main_menu nav>ul>li:hover>a {
            background-color: red;
            border-radius: none !important;
        }

        #newpost {
            display: none;
        }

        #newpost.visible {
            display: block;
        }
    </style>
    @yield('style')
</head>

<body>

    <div id="">
        @include('layouts.partials.header')
        @include('flashMessages')

        @yield('content')
        @jquery
        @toastr_css
        @toastr_js
        @toastr_render
        @include('layouts.partials.modal')
        @include('layouts.partials.footer')
    </div>

    <!-- Postcode Modal -->
    <div class="modal fade" id="postcodeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enter your post code!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h3 class="text-danger" style="font-weight:bold">Free Next Day Delivery <span style="color:red;font-size:40px" class="fa fa-truck mt-2"></span></h3>
                    <h4 class="">When You Spend £50 Online!!</h4>
                    <div>
                        <p style="font-weight:bold">Check if we can deliver. Please enter your postcode <br> below to check if we are able to deliver to your address.</p>
                        <div class="row justify-content-center">
                            <div id="modalbodydiv" class="col-md-8-auto">
                                <form action="" method="get">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input style="border:1px solid red" type="text" id="postcodeModalvalue" name="post_code" placeholder="Post code" class="form-control w-100 text-left" required>
                                            <br>
                                            <span id="ModalpostcodeError" style="color: red"></span>
                                        </div>
                                        <div id="postcodebutton" class="col-md-6">
                                            <button class="btn" onclick="event.preventDefault();checkPostcode();" style="background:#38c79f;color:white;font-weight:bold">
                                                Check Postcode
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Postcode Modal -->


    <!-- JS libraries -->
    <!--jquery min js-->
    <script src="{{ asset('frontend/js/vendor/jquery-3.4.1.min.js') }}"></script>
    <!--popper min js-->
    <script src="{{ asset('frontend/js/popper.js') }}"></script>
    <!--bootstrap min js-->
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <!--owl carousel min js-->
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <!--slick min js-->
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <!--magnific popup min js-->
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <!--counterup min js-->
    <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
    <!--jquery countdown min js-->
    <script src="{{ asset('frontend/js/jquery.countdown.js') }}"></script>
    <!--jquery ui min js-->
    <script src="{{ asset('frontend/js/jquery.ui.js') }}"></script>
    <!--jquery elevatezoom min js-->
    <script src="{{ asset('frontend/js/jquery.elevatezoom.js') }}"></script>
    <!--isotope packaged min js-->
    <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
    <!--slinky menu js-->
    <script src="{{ asset('frontend/js/slinky.menu.js') }}"></script>
    <!--instagramfeed menu js-->
    <script src="{{ asset('frontend/js/jquery.instagramFeed.min.js') }}"></script>
    <!-- Plugins JS -->
    <script src="{{ asset('frontend/js/plugins.js') }}"></script>
    <script src="{{asset('frontend/toastr.min.js')}}"></script>
    <!-- Main JS -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('frontend/js/custom.js') }}"></script>

    <script>
        var div = document.getElementById('newpost');

        document.getElementById('button').addEventListener('click', showhide);

        function showhide() {
            div.classList.toggle('visible');
        }
    </script>
    @yield('scripts')
</body>

</html>