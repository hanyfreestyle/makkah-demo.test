<div class="ltn__testimonial-area section-bg-1--- bg-image-top {{getPaddingSize($config) }}   {{getMarginSize($config) }}" data-bs-bg="{{ asset('makkah/img/aminities-bg.jpg') }}">
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
    <div class="row ltn__testimonial-slider-6-active slick-arrow-3">

      @foreach($block->schema['items']  as $item)

        <div class="aminities_1 aminities_2">
          <a href="#" class="list_li text-center">
            <span class="category-icon"><i class="{{updateFontawesomeIcon(getData($item, 'icon'))}}"></i></span>
            <span class="category-title white-color updateFont">{{getLangData($item, 'name')}}</span>
          </a>
        </div>

      @endforeach

    </div>
  </div>
</div>