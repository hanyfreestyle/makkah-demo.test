<div class="ltn__about-us-area pt-30 pb-30 ">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 align-self-center">
        <div class="about-us-img-wrap text-center">
          <img src="{{defImagesDir('news_thumbnail','photo')}}" class="img-fluid"/>
        </div>
      </div>
      <div class="col-lg-6 align-self-center">
        <div class="about-us-info-wrapX">
          <div class="section-title-area ltn__section-title-2--- mb-30">
            <h6 class="section-subtitle section-subtitle-2--- ltn__secondary-color">{{getLangData($schema, 'h6')}}</h6>
            <h3 class=" title updateFont">{{getLangData($schema, 'h1')}}</h3>
            <div>
              {{getLangData($schema, 'des')}}
            </div>
          </div>

          @foreach($block->schema['items']  as $item)

{{--            {{dd($item)}}--}}
            <div class="ltn__feature-item ltn__feature-item-3">
{{--              <div class="ltn__feature-icon">--}}
{{--                <span><i class="{{updateFontawesomeIcon(getData($item, 'icon'))}}"></i></span>--}}
{{--              </div>--}}
              <div class="ltn__feature-info">
                <h4 class="updateFont">{{getLangData($item, 'h1')}}</h4>
                <ul class="listItem clearfix">
                  @foreach (explode("\n", getLangData($item, 'des')) as $line)
                    @if(trim($line) !== '')
                      <li><i class="fa-solid fa-thumbtack"> </i> {{ $line }}</li>
                    @endif
                  @endforeach
                </ul>
              </div>
            </div>

          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

