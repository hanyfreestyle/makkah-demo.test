<div class="ltn__category-area ltn__product-gutter section-bg-1--- pt-115 pb-70">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title-area ltn__section-title-2--- text-center">
          @if(getLangData($schema, 'h1'))
            <h6 class="section-subtitle section-subtitle-2--- ltn__secondary-color updateFont">{{getLangData($schema, 'h1')}}</h6>
          @endif
          @if(getLangData($schema, 'des'))
            <h2 class="section-title updateFont">{{getLangData($schema, 'des')}}</h2>
          @endif
        </div>
      </div>
    </div>
    <div class="row ltn__category-slider-active--- slick-arrow-1 justify-content-center">

      @foreach($block->schema['items']  as $item)
        <div class="col-lg-2 col-md-4 col-sm-6 col-6">
          <div class="aminities_1">
            <a href="#" class="list_li text-center">
              <span class="category-icon"><i class="{{updateFontawesomeIcon(getData($item, 'icon'))}}"></i></span>
              <span class="category-title updateFont">{{getLangData($item, 'name')}}</span>
            </a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>