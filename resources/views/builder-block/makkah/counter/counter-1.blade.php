{{getPaddingSize($config) }}
<div class="ltn__counterup-area section-bg-1 {{getPaddingSize($config) }}   {{getMarginSize($config) }}">
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center">
      @foreach($block->schema['items']  as $item)
        <div class="{{getColumnsSize($config)}} align-self-center">
          <div class="ltn__counterup-item text-color-white---">
            <div class="counter-icon"><i class="{{updateFontawesomeIcon(getData($item, 'icon'))}}"></i></div>
            {!! updateCounterPlusMakkah(getData($item, 'number')) !!}
            <h6 class="updateFont">{{getLangData($item, 'name')}}</h6></div>
        </div>
      @endforeach
    </div>
  </div>
</div>