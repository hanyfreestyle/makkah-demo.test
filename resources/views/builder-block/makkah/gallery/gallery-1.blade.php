<div class="ltn__gallery-area mt-50 mb-10">
  <div class="container ">
    <div class=" masonry bordered ltn__gallery-active row ltn__gallery-style-2 ltn__gallery-info-hide---">
      <div class="ltn__gallery-sizer col-1"></div>
      @foreach($block->photos as $photo)
        <div class="ltn__gallery-item filter_category_3 col-lg-3 col-sm-6 col-12">
          <div class="ltn__gallery-item-inner">
            <div class="ltn__gallery-item-img">
              <a href="{{ Storage::disk('root_folder')->url($photo->photo)}}" class="example-image-link"  data-lightbox="example-set">
                <img src="{{ Storage::disk('root_folder')->url($photo->photo_thumbnail)}}" alt="">
                <span class="ltn__gallery-action-icon"><i class="fas fa-search"></i></span>
              </a>
            </div>
            <div class="ltn__gallery-item-info">
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>


<div class="ltn__call-to-action-area ltn__call-to-action-4 bg-image pt-115 pb-120 mb-120" data-bs-bg="img/bg/6.jpg">
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
            <a href="contact.html" class="btn btn-transparent btn-effect-4 white-color">CONTACT US</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ltn__call-to-4-img-1">
    <img src="img/slider/21.png" alt="#">
  </div>
  <div class="ltn__call-to-4-img-2">
    <img src="img/bg/11.png" alt="#">
  </div>
</div>

@push('stackStyle')
    {!! $minifyTools->setDir('makkah/')->MinifyCss('lightbox/css/lightbox.css','Web',$cssReBuild) !!}
@endpush


@push('stackScript')
  {!! $minifyTools->setDir('makkah/')->MinifyJs('lightbox/js/lightbox.js',"Web",false) !!}
@endpush
