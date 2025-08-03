<div class="ltn__img-slider-area">
  <div class="container-fluid">
    <div class="row ltn__image-slider-4-active slick-arrow-1 slick-arrow-1-inner ltn__no-gutter-all">

      @foreach($block->photos as $photo)

        <div class="col-lg-12">
          <div class="ltn__img-slide-item-4">
            <a href="{{ Storage::disk('root_folder')->url($photo->photo)}}" class="example-image-link" data-lightbox="example-set">
              <img src="{{ Storage::disk('root_folder')->url($photo->photo_thumbnail)}}" alt="Image">
            </a>
            {{--            <div class="ltn__img-slide-info">--}}
            {{--              <div class="ltn__img-slide-info-brief">--}}
            {{--                <h6>Heart of NYC</h6>--}}
            {{--                <h1><a href="portfolio-details.html">Manhattan </a></h1>--}}
            {{--              </div>--}}
            {{--              <div class="btn-wrapper">--}}
            {{--                <a href="portfolio-details.html" class="btn theme-btn-1 btn-effect-1 text-uppercase">Details</a>--}}
            {{--              </div>--}}
            {{--            </div>--}}
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