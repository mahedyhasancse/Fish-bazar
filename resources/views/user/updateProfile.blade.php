@extends('layouts.app')

@section('content')

<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>Update Account</h3>
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li>My account</li>
                        <li>Account Settings</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!-- my account start  -->
<section class="main_content_area">
    <div class="container">
        <div class="account_dashboard">
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <!-- Nav tabs -->
                    <div class="dashboard_tab_button">
                        <ul role="tablist" class="nav flex-column dashboard-list">
                            <li><a href="/home" class="nav-link">Dashboard</a></li>
                            <li><a href="#personalinfo" data-toggle="tab" class="nav-link active">Personal Info</a></li>
                            <li> <a href="#contactinfo" data-toggle="tab" class="nav-link">Contact Info</a></li>
                            <li><a href="#changepassword" data-toggle="tab" class="nav-link">Change Password</a></li>
                            <li><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i>Logout</a>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ session()->get('success') }}</strong>
                    </div>
                @elseif (session()->has('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ session()->get('error') }}</strong>
                    </div>
                @endif

                <!-- Tab panes -->
                <div class="tab-content dashboard_content">
                    <div class="tab-pane fade show active" id="personalinfo">
                        <h3>Update Personal Information </h3>
                        <div class="login">
                            <div class="login_form_container">
                                <div class="account_login_form">
                                    <form action="{{ route('user.profile.update.save') }}" method="POST">
                                        @csrf
                                        <div class="input-radio">
                                            <span class="custom-radio"><input type="radio" value="Male" name="gender" @php if(auth()->user()->profile->gender == 'Male'){ echo 'checked'; } @endphp > Mr.</span>
                                            <span class="custom-radio"><input type="radio" value="Female" name="gender" @php if(auth()->user()->profile->gender == 'Female'){ echo 'checked'; } @endphp> Mrs.</span>
                                        </div> <br>
                                        <div class="d-flex justify-content-between">
                                            <div style="width: 50%" class="pr-2">
                                                <label>First Name</label>
                                                <input type="text" name="firstName" value="{{ auth()->user()->profile->firstName }}">
                                            </div>
                                            <div style="width: 50%">
                                                <label>Last Name</label>
                                                <input type="text" name="lastName" value="{{ auth()->user()->profile->lastName }}">
                                            </div>
                                        </div>
                                        <label>Birthdate</label>
                                        <input type="date" placeholder="MM/DD/YYYY" value="{{ auth()->user()->profile->birthday }}" name="birthday">
                                        <span class="example">
                                            (E.g.: 05/31/1970)
                                        </span>
                                        <br>
                                        <br>
                                        <label>Address</label>
                                        <textarea class="form-control" name="address" id="address" cols="30" rows="10">{{ auth()->user()->profile->address }}</textarea>
                                        <br>
                                        {{-- <span class="custom_checkbox">
                                            <input type="checkbox" value="1" name="optin">
                                            <label>Receive offers from our partners</label>
                                        </span> --}}
                                        <br>
                                        {{-- <span class="custom_checkbox">
                                            <input type="checkbox" value="1" name="newsletter">
                                            <label>Sign up for our newsletter<br><em>You may unsubscribe at any moment. For that purpose, please find our contact info in the legal notice.</em></label>
                                        </span> --}}
                                        <div class="save_button primary_btn default_button">
                                            <button class="border btn-lg" type="submit">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contactinfo">
                        <h3>Contact Info</h3>
                        <div class="login">
                            <div class="login_form_container">
                                <div class="account_login_form">
                                    <form action="{{ route('user.contact.update') }}" method="POST">
                                        @csrf
                                        <label>Email</label>
                                        <div class="d-flex">
                                            <div style="width: 81%" class="pr-2">
                                                <input onchange="checkemail()" id="email" type="email" name="email" value="{{ auth()->user()->email }}" />
                                            </div>
                                            <div id="check">
                                                {{-- data will come from ajax --}}
                                            </div>
                                        </div>
                                        <div style="width: 80%">
                                            <label>Phone</label>
                                            <input type="text" placeholder="" value="{{ auth()->user()->phone }}" name="phone" />
                                        </div>
                                    </span>
                                    <br>
                                    <br>
                                    {{-- <span class="custom_checkbox">
                                        <input type="checkbox" value="1" name="optin">
                                        <label>Receive offers from our partners</label>
                                    </span> --}}
                                    <br>
                                    {{-- <span class="custom_checkbox">
                                        <input type="checkbox" value="1" name="newsletter">
                                        <label>Sign up for our newsletter<br><em>You may unsubscribe at any moment. For that purpose, please find our contact info in the legal notice.</em></label>
                                    </span> --}}
                                    <div class="save_button primary_btn default_button">
                                        <button class="border btn-lg" type="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="changepassword">
                    <h3>Change Password</h3>
                    <div class="login">
                        <div class="login_form_container">
                            <div class="account_login_form">
                                <form action="{{ route('user.password.change') }}" method="POST">
                                    @csrf
                                    <label>Current Password</label>
                                    <input type="password" name="oldpassword">
                                    @error('oldpassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label>New Password</label>
                                    <input type="password" name="password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label>Confirm new Password</label>
                                    <input type="password" name="confirmapassword">
                                    @error('confirmapassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <br>
                                    <br>
                                    {{-- <span class="custom_checkbox">
                                        <input type="checkbox" value="1" name="optin">
                                        <label>Receive offers from our partners</label>
                                    </span> --}}
                                    <br>
                                    {{-- <span class="custom_checkbox">
                                        <input type="checkbox" value="1" name="newsletter">
                                        <label>Sign up for our newsletter<br><em>You may unsubscribe at any moment. For that purpose, please find our contact info in the legal notice.</em></label>
                                    </span> --}}
                                    <div class="save_button primary_btn default_button">
                                        <button class="border btn-lg" type="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
<script>
    function checkemail(){
        var email = $('#email').val();
        // $('#check').html('<i class="fa fa-spinner fa-2x"></i>');
        if (email == '') {
            $('#check').html('<span style="color: red"><i class="fa fa-times-circle fa-lg"></i> Not Available</span>');
        }else{
            $.ajax({
                url: '/user/checkemail/'+email,
                success: function(data) {
                    if (data == 0) {
                        $('#check').html('<span style="color: green"><i class="fa fa-check-circle-o fa-lg"></i> Available</span>');
                    }else{
                        $('#check').html('<span style="color: red"><i class="fa fa-times-circle fa-lg"></i> Not Available</span>');
                    }
                }
            });
        }
    }
</script>
<!-- my account end   -->
@endsection
