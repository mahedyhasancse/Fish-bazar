@php
$banners = App\Banner::latest()->get();
@endphp
<!--slider area start-->

 <style>
   .carousel-control-prev-icon, .carousel-control-next-icon{
    height: 44px;
   }
 </style>
      <section class="slider_section slider_s_five" >
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            @for ($i = 0; $i < $banners->count(); $i++)
              <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" @if($i==0)class="active" @endif></li>
              @endfor
          </ol>
          <div class="carousel-inner">
            @php
            $active = 'active';
            @endphp
            @foreach ($banners as $banner)
            <div class="carousel-item {{$active}}">
              <img class="d-block"  src="{{asset($banner->image) }}">
            </div>
            @php
            $active = '';
            @endphp
            @endforeach
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next" >
            <span class="carousel-control-next-icon" aria-hidden="true" ></span>
            <span class="sr-only bg-dark" >Next</span>
          </a>
        </div>
      </section>

 

<!--slider area end-->