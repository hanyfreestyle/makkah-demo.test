@if(count($latestNews) >0 )
  <div class="ltn__blog-area pt-120 pb-70">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title-area ltn__section-title-2--- text-center"><h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">News & Blogs</h6>
            <h1 class="section-title">Leatest News Feeds</h1></div>
        </div>
      </div>
      <div class="row  ltn__blog-slider-one-active slick-arrow-1 ltn__blog-item-3-normal">
        @foreach($latestNews as $news)
          <div class="col-lg-12">
            <div class="ltn__blog-item ltn__blog-item-3">
              <div class="ltn__blog-img"><a href="blog-details.html"><img src="{{defImagesDir('logo_dark','photo')}}" alt="#"></a></div>
              <div class="ltn__blog-brief">
                <div class="ltn__blog-meta">
                  <ul>
                    <li class="ltn__blog-author"><a href="#"><i class="far fa-user"></i>by: Admin</a></li>
                    <li class="ltn__blog-tags"><a href="#"><i class="fas fa-tags"></i>Decorate</a></li>
                  </ul>
                </div>
                <h3 class="ltn__blog-title">
                  <a href="blog-details.html">
                    {{$news->name}}
                  </a>
                </h3>
                <div class="ltn__blog-meta-btn">
                  <div class="ltn__blog-meta">
                    <ul>
                      <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>June 24, 2021</li>
                    </ul>
                  </div>
                  <div class="ltn__blog-btn"><a href="blog-details.html">Read more</a></div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endif
