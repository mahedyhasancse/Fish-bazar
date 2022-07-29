<!--brand banner area start-->
<div class="banner_area">
    <div class="container">
        <div class="product_carousel deals3_column1 owl-carousel">
            @php
            $allbanners = App\BrandBanner::all();
            $count = $allbanners->count() / 2;
            @endphp
            @for ($i = 0; $i < $count; $i++)
            @php
            $skip = $i*2;
            $brandbanners = App\BrandBanner::latest()->skip($skip)->take(2)->get();
            @endphp
            <article class="single_product">
                <figure>
                    <figcaption class="product_content">
                        <div class="row">
                            @foreach ($brandbanners as $brandbanner)
                            <div class="col-lg-6 col-md-6">
                                <div class="single_banner">
                                    <div class="banner_thumb">
                                        <a href="{{ route('brand.product',$brandbanner->brand->id) }}"><img style="height: 260px" src="{{ $brandbanner->image }}" alt=""></a>
                                    </div>
                                </div>
                                {{-- <figcaption class="blog_content">
                                   <footer class="blog_footer">
                                        <a href="blog-details.html">Show more</a>
                                    </footer>
                                </figcaption> --}}
                            </div>
                            @endforeach
                            </figure>
                        </article>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </section>
<!--brand banner area end-->
