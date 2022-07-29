@extends('layouts.app')

@section('content')

<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                   <h3>Contact Us</h3>
                    <ul>
                        <li><a href="/">home</a></li>
                        <li>contact us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--contact map start-->
<div class="container">
<div class="contact_map mt-60">
   <div class="map-area">
    {{--  <div id="googleMap"></div>  --}}
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2481.5183554122214!2d0.08010111577118101!3d51.54039337964059!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a67209db05f3%3A0xe9cce73eade511b!2s35%20Longbridge%20Rd%2C%20Barking%20IG11%208RT%2C%20UK!5e0!3m2!1sen!2sbd!4v1602843307971!5m2!1sen!2sbd" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="true" aria-hidden="false" tabindex="0"></iframe>
   </div>
</div>
</div>
<!--contact map end-->

<!--contact area start-->
<div class="contact_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
               <div class="contact_message content">
                    <h3>contact us</h3>
                     <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram anteposuerit litterarum formas human. qui sequitur mutationem consuetudium lectorum. Mirum est notare quam</p>
                    <ul>
                        <li><i class="fa fa-fax"></i>  Address :<address> 35 Longbridge Road <br>Barking London <br>IG11 8TN</address></li>
                        <li><i class="fa fa-phone"></i> <a href="mailto:contact@divinegreen.co.uk">contact@divinegreen.co.uk</a></li>
                        <li><i class="fa fa-envelope-o"></i><a href="tel:+447711232329">+447711232329</a>  </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
               <div class="contact_message form">
                    <h3>Tell us your project</h3>
                    <form id="contact-form" method="POST"  action="">
                        <p>
                           <label> Your Name (required)</label>
                            <input name="name" placeholder="Name *" type="text">
                        </p>
                        <p>
                           <label>  Your Email (required)</label>
                            <input name="email" placeholder="Email *" type="email">
                        </p>
                        <p>
                           <label>  Subject</label>
                            <input name="subject" placeholder="Subject *" type="text">
                        </p>
                        <div class="contact_textarea">
                            <label>  Your Message</label>
                            <textarea placeholder="Message *" name="message"  class="form-control2" ></textarea>
                        </div>
                        <button type="submit"> Send</button>
                        <p class="form-messege"></p>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!--contact area end-->
@endsection
