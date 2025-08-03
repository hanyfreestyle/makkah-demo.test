<div class="ltn__gallery-area mt-50 mb-120">
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


@push('stackStyle')
    {!! $minifyTools->setDir('makkah/')->MinifyCss('lightbox/css/lightbox.css','Web',$cssReBuild) !!}
@endpush


@push('stackScript')
  {!! $minifyTools->setDir('makkah/')->MinifyJs('lightbox/js/lightbox.js',"Web",false) !!}
@endpush
