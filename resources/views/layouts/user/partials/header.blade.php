<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{url('/')}}">Divine Green</a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <p class="user-avatar rounded-circle ec-user-avatar">{{auth()->user()->username}}</p>
                </a>
                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="{{route('user.profile',auth()->user()->id)}}"><i class="fa fa-user"></i>My Profile</a>
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                        <i class="fa fa-power-off"></i>Logout</a>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>
