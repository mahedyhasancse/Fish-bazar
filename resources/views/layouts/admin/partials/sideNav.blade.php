<nav class="navbar navbar-expand-sm navbar-default">
    <div id="main-menu" class="main-menu collapse navbar-collapse">
        <ul class="nav navbar-nav" style="font-weight:bold;color:#000">
            <li class="active">
                <a href="{{route('admin.index')}}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
            </li>
            <li class="menu-title">Management</li><!-- /.menu-title -->
            <li>
            <a href="{{route('cash.on.delivery.show')}}"><i class="menu-icon fa  fa-list-alt"></i> Click & Collection</a>
            <a href="{{route('delivery.all')}}"><i class="menu-icon fa  fa-list-alt"></i> All Booking Deliveries</a>
            <a href="{{route('paypal.payment')}}"><i class="menu-icon fa  fa-list-alt"></i>Paypal Payment</a>
                <a href="{{route('postcode')}}"><i class="menu-icon fa fa-tasks"></i>Add Post Code </a>
                <a href="{{route('add.video')}}"><i class="menu-icon fa fa-tasks"></i>Video of the week </a>
                <a href="{{route('find.us')}}"><i class="menu-icon fa fa-tasks"></i>Find Us </a>
                <a href="{{route('category.index')}}"><i class="menu-icon fa fa-tasks"></i>Category </a>
                <a href="{{route('add.brand')}}"><i class="menu-icon fa fa fa-product-hunt"></i>Add Band </a>
                <a href="{{route('banner.add')}}"><i class="menu-icon fa fa-image"></i>Slider</a>
                 <a href="{{route('add.recipe')}}"><i class="menu-icon fa  fa-list-alt"></i> Recipe</a>
                      <a href="{{route('add.instagram')}}"><i class="menu-icon fa  fa-list-alt"></i> Instagram</a>
                <a href="{{ route('add.categroybanner') }}"><i class="menu-icon fa  fa-list-alt"></i>Category Banner </a>
                <a href="{{ route('add.brandbanner') }}"><i class="menu-icon fa  fa-list-alt"></i>Brand Bannner </a>
                <a href="{{ route('product.offers') }}"><i class="menu-icon fa  fa-list-alt"></i>Offers </a>
       
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="menu-icon fa fa-product-hunt"></i>Product</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-product-hunt"></i><a href="{{route('product.add')}}">Add Product </a></li>
                        <li><i class="fa fa-product-hunt"></i><a href="{{route('product.all')}}">All Products </a></li>
                        </ul>
                    </li>
            <li class="menu-item-has-children dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="menu-icon fa fa-user-plus"></i>User</a>
                <ul class="sub-menu children dropdown-menu">
                    <li><i class="fa fa-user"></i><a href="{{route('user.all')}}">All Users </a></li>
                    <li><i class="fa fa-user"></i><a href="{{route('admin.all')}}">All Admins </a></li>
                </ul>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>

