@php
  $blockPhoto = $blockPhoto ?? asset('makkah/img/video-bg.jpg') ;
@endphp


<div class="ltn__testimonial-area section-bg-1--- bg-image-top pt-100 pb-30" data-bs-bg="{{ asset('makkah/img/aminities-bg.jpg') }}">

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title-area ltn__section-title-2--- updateFont text-center---">
          @if(getLangData($schema, 'h1'))
            <h6 class="section-subtitle section-subtitle-2--- ltn__secondary-color--- updateFont white-color">{{getLangData($schema, 'h1')}}</h6>
          @endif
          @if(getLangData($schema, 'des'))
            <h2 class="section-title white-color updateFont">{{getLangData($schema, 'des')}}</h2>
          @endif

        </div>
      </div>
    </div>

  </div>

  <div class="container-fluid">
    <div class="row ltn__image-slider-4-active slick-arrow-1 slick-arrow-1-inner ltn__no-gutter-all">

      @foreach($block->photos as $photo)

        <div class="col-lg-12">
          <div class="ltn__img-slide-item-4">
            <a href="{{ Storage::disk('root_folder')->url($photo->photo)}}" class="example-image-link" data-lightbox="example-set">
              <img src="{{ Storage::disk('root_folder')->url($photo->photo_thumbnail)}}" alt="Image">
            </a>
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