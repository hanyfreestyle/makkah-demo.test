<div class="ltn__counterup-area section-bg-1 {{getPaddingSize($config) }}   {{getMarginSize($config) }}">
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center">
      @foreach($block->schema['items']  as $item)
        <div class="{{getColumnsSize($config)}} align-self-center">
          <div class="ltn__counterup-item text-color-white---">
            <div class="counter-icon"><i class="{{updateFontawesomeIcon(getData($item, 'icon'))}}"></i></div>
            <h2 class="thisIsNumbers">
              <span class="counter" data-target="{{getData($item, 'number')}}">{{getData($item, 'number')}}</span>
              @if(getData($item, 'symbol'))
                @if(getData($item, 'symbol') == 'M2')
                  <span class="counterUp-icon suffix font-bold">m<sup>2</sup></span>
                @else
                  <span class="counterUp-icon suffix font-bold">{{getData($item, 'symbol')}}</span>
                @endif
              @endif

            </h2>
            {{--            {!! updateCounterPlusMakkah(getData($item, 'number')) !!}--}}
            <h6 class="updateFont">{{getLangData($item, 'name')}}</h6></div>
        </div>
      @endforeach
    </div>
  </div>
</div>

@push('stackStyle')
  <style>

      .thisIsNumbers {
          font-size: 55px;
          direction: ltr;

      }

      .counterUp-icon {
          font-size: 35px;
          font-weight: 700 !important;
      }

      .counterUp-icon sup {
          font-size: 20px;
          font-weight: bold !important;
      }
  </style>
@endpush