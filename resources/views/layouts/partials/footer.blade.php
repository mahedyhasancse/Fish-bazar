<style>
  ul {
    margin: 0px;
    padding: 0px;
  }

  .footer-section {
      
    overflow:none;
    color: white;
    background-image: url('/frontend/img/footer.png');
    position: relative;
    background-size: cover;
  }

  .footer-cta {
    border-bottom: 1px solid #373636;
  }

  .single-cta i {
    color: #40a944;
    font-size: 30px;
    float: left;
    margin-top: 8px;
  }

  .cta-text {
    padding-left: 15px;
    display: inline-block;
  }

  .cta-text h4 {
    color: #fff;
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 2px;
  }

  .cta-text span {
    color: white;
    font-size: 15px;
  }

  .footer-content {
    position: relative;
    z-index: 2;
  }

  .footer-pattern img {
    position: absolute;
    top: 0;
    left: 0;
    height: 330px;
    background-size: cover;
    background-position: 100% 100%;
  }

  .footer-logo {
    margin-bottom: 30px;
  }

  .footer-logo img {
    max-width: 200px;
  }

  .footer-text p {
    margin-bottom: 14px;
    font-size: 14px;
    color: #7e7e7e;
    line-height: 28px;
  }

  .footer-social-icon span {
    color: #fff;
    display: block;
    font-size: 20px;
    font-weight: 700;
    font-family: 'Poppins', sans-serif;
    margin-bottom: 20px;
  }

  .footer-social-icon a {
    color: #fff;
    font-size: 16px;
    margin-right: 15px;
  }

  .footer-social-icon i {
    height: 40px;
    width: 40px;
    text-align: center;
    line-height: 38px;
    border-radius: 50%;
  }

  .facebook-bg {
    background: #3B5998;
  }

  .twitter-bg {
    background: #55ACEE;
  }

  .google-bg {
    background: #DD4B39;
  }

  .footer-widget-heading h3 {
    color: #fff;
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 40px;
    position: relative;
  }

  .footer-widget-heading h3::before {
    content: "";
    position: absolute;
    left: 0;
    bottom: -15px;
    height: 2px;
    width: 50px;
    background: #40a944;
  }

  .footer-widget ul li {
    display: inline-block;
    float: left;
    width: 50%;
    margin-bottom: 12px;
  }

  .footer-widget ul li a:hover {
    color: #ff5e14;
  }

  .footer-widget ul li a {
    color: #878787;
    text-transform: capitalize;
  }

  .subscribe-form {
    position: relative;
    overflow: hidden;
  }

  .subscribe-form input {
    width: 100%;
    padding: 14px 28px;
    background: #2E2E2E;
    border: 1px solid #2E2E2E;
    color: #fff;
  }

  .subscribe-form button {
    position: absolute;
    right: 0;
    background: #40a944;
    padding: 13px 20px;
    border: 1px solid #40a944;
    top: 0;
  }

  .subscribe-form button i {
    color: #fff;
    font-size: 22px;
    transform: rotate(-6deg);
  }

  .copyright-area {
    background: url('/frontend/img/topmenu.png');
    color: white;
    font-size: 14px;
    padding: 25px 0;
    color: white;
  }

  .copyright-text p {
    margin: 0;
    font-size: 14px;
    color: #878787;
  }

  .copyright-text p a {
    color: #ff5e14;
  }

  .footer-menu li {
    display: inline-block;
    margin-left: 20px;
  }

  .footer-menu li:hover a {
    color: #fff;
    background-color: #40A944;
    padding: 5px;
    border-radius: 5px;
  }

  .footer-menu li a {
    font-size: 14px;
    color: #878787;
  }

  }
</style>

<footer class="footer-section">
  <div class="container">
    <div class="footer-cta pt-5 pb-5">
      <div class="row">
        <div class="col-xl-4 col-md-4 mb-30">
          <div class="single-cta">
            <i style="color:#28bf9e" class="fa fa-map-marker"></i>
            <div class="cta-text">
              <h4>Find us</h4>
              <span>35 Longbridge Road <br>Barking London <br>IG11 8TN</span>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-4 mb-30">
          <div class="single-cta">
            <i style="color:#28bf9e" class="fa fa-phone"></i>
            <div class="cta-text">
              <h4>Call us</h4>
              <span> +447711232329</span>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-4 mb-30">
          <div class="single-cta">
            <i style="color:#28bf9e" class="fa fa-envelope-open"></i>
            <div class="cta-text">
              <h4>Mail us</h4>
              <span>contact@fishbazaar.co.uk </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-content pt-5 pb-5">
      <div class="row">
        <div class="col-xl-4 col-lg-4 mb-50">
          <div class="footer-widget-heading">
            <h3>Comapny</h3>
          </div>
          <div class="footer-widget">
            <h4><a href="{{route('about')}}">About Us</a></h4>
            <h4><a href="{{route('contact')}}">Contact Us</a></h4>
            <div class="footer-social-icon ">
              <span>Follow us</span>
              <a href="#"><i class="fa fa-facebook facebook-bg"></i></a>
              <a href="#"><i class="fa fa-twitter twitter-bg"></i></a>
              <a href="#"><i class="fa fa-google-plus google-bg"></i></a>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
          <div class="footer-widget">
            <div class="footer-widget-heading">
              <h3>Customer Services</h3>
            </div>
            <ul>
              <li><a class="text-white" href="https://www.qualityfoodsonline.com/policies/terms-of-service">Terms & Conditions</a></li>
              <li><a class="text-white" href="">Privacy Policy</a></li>
              <li><a class="text-white" href="">Cookie Policy</a></li>
              <li><a class="text-white" href="">Return Policy</a></li>
            </ul>
            <div class="footer-widget">
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 mb-50">
          <div class="footer-widget">
            <div class="footer-widget-heading">
              <h3>Contact Us</h3>
            </div>
            <div class="footer-text mb-25">
              <h4  class="text-white">35 Longbridge Road, <br>
                  Barking London,
                  IG11 8TN</h4 >
              <h4  class="text-white">+447711232329</h4 >
              <h4 class="text-white">contact@fishbazaar.co.uk</h4 >
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="copyright-area">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 col-lg-6 text-center text-lg-left text-white">
          <div class="copyright-text">
            <p class="text-white">Copyright &copy; 2020, All Right Reserved <a class="text-warning" href="{{url('/')}}">Fish Bazaar</a></p>
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
          <div class="footer-menu">
            <ul>
              <li><a class="text-white" href="{{url('/')}}">Home</a></li>
              <li><a class="text-white" href="{{route('contact')}}">Terms</a></li>
              <li><a class="text-white" href="#">Privacy</a></li>
              <li><a class="text-white" href="#">Policy</a></li>
              <li><a class="text-white" href="{{route('contact')}}">Contact</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>