<div class="ltn__img-slider-area mb-90">
  <div class="container-fluid">
    <div class="row ltn__image-slider-5-active slick-arrow-1 slick-arrow-1-inner ltn__no-gutter-all">
      @foreach($block->photos as $photo)
        <div class="col-lg-12">
          <div class="ltn__img-slide-item-4">
            <a href="{{ Storage::disk('root_folder')->url($photo->photo)}}" data-rel="lightcase:myCollection">
              <img src="{{ Storage::disk('root_folder')->url($photo->photo_thumbnail)}}" alt="Image">
            </a>
          </div>
        </div>
      @endforeach

    </div>
  </div>
</div>