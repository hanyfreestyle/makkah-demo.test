<!-- Gallery area start -->
<div class="ltn__gallery-area mb-120">
  <div class="container">
    <!--
    <div class="row">
        <div class="col-lg-12">
            <div class="ltn__gallery-menu">
                <div class="ltn__gallery-filter-menu portfolio-filter text-uppercase mb-50">
                    <button data-filter="*" class="active">all</button>
                    <button data-filter=".filter_category_1">Houses</button>
                    <button data-filter=".filter_category_2">Retail</button>
                    <button data-filter=".filter_category_3">Condos</button>
                </div>
            </div>
        </div>
    </div>
     -->

    <!-- Portfolio Wrapper Start -->
    <!-- (ltn__gallery-info-hide) Class for 'ltn__gallery-item-info' not showing -->
    <div class="ltn__gallery-active row ltn__gallery-style-2 ltn__gallery-info-hide---">
      <div class="ltn__gallery-sizer col-1"></div>


      @foreach($block->photos as $photo)

        <div class="ltn__gallery-item filter_category_3 col-lg-4 col-sm-6 col-12">
          <div class="ltn__gallery-item-inner">
            <div class="ltn__gallery-item-img">
              <a href="{{ Storage::disk('root_folder')->url($photo->photo_thumbnail)}}" data-rel="lightcase:myCollection">
                <img src="{{ Storage::disk('root_folder')->url($photo->photo_thumbnail)}}" alt="Image">
                <span class="ltn__gallery-action-icon">
                                    <i class="fas fa-search"></i>
                                </span>
              </a>
            </div>
            <div class="ltn__gallery-item-info">
              <h4><a href="portfolio-details.html">Portfolio Link </a></h4>
              <p>Web Design & Development, Branding</p>
            </div>
          </div>
        </div>



      @endforeach



    </div>

    <div id="ltn__inline_description_1" style="display: none;">
      <h4 class="first">This content comes from a hidden element on that page</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis mi eu elit tempor facilisis id et neque. Nulla sit amet sem sapien. Vestibulum imperdiet porta ante ac ornare. Nulla et lorem eu nibh adipiscing ultricies nec at lacus. Cras laoreet ultricies sem, at blandit mi eleifend aliquam. Nunc enim ipsum, vehicula non pretium varius, cursus ac tortor.</p>
      <p>Vivamus fringilla congue laoreet. Quisque ultrices sodales orci, quis rhoncus justo auctor in. Phasellus dui eros, bibendum eu feugiat ornare, faucibus eu mi. Nunc aliquet tempus sem, id aliquam diam varius ac. Maecenas nisl nunc, molestie vitae eleifend vel.</p>
    </div>



    <!-- pagination start -->
    <!--
    <div class="row">
        <div class="col-lg-12">
            <div class="ltn__pagination text-center margin-top-50">
                <ul>
                    <li class="arrow-icon"><a href="#"> &leftarrow; </a></li>
                    <li class="active"><a href="blog.html">1</a></li>
                    <li><a href="blog-2.html">2</a></li>
                    <li><a href="blog-2.html">3</a></li>
                    <li><a href="blog-2.html">...</a></li>
                    <li><a href="blog-2.html">10</a></li>
                    <li class="arrow-icon"><a href="#"> &rightarrow; </a></li>
                </ul>
            </div>
        </div>
    </div>
    -->
    <!-- pagination end -->

  </div>
</div>
<!-- Gallery area end -->

<!-- CALL TO ACTION START (call-to-action-4) -->
<div class="ltn__call-to-action-area ltn__call-to-action-4 bg-image pt-115 pb-120" data-bs-bg="img/bg/6.jpg">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="call-to-action-inner call-to-action-inner-4 text-center">
          <div class="section-title-area ltn__section-title-2">
            <h6 class="section-subtitle ltn__secondary-color">//  any question you have  //</h6>
            <h1 class="section-title white-color">897-876-987-90</h1>
          </div>
          <div class="btn-wrapper">
            <a href="tel:+123456789" class="theme-btn-1 btn btn-effect-1">MAKE A CALL</a>
            <a href="contact.html" class="btn btn-transparent btn-effect-3 white-color">CONTACT US</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ltn__call-to-4-img-1">
    <!-- <img src="img/bg/12.png" alt="#"> -->
    <img src="img/slider/21.png" alt="#">
  </div>
  <div class="ltn__call-to-4-img-2">
    <img src="img/bg/11.png" alt="#">
  </div>
</div>