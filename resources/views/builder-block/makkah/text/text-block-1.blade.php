<div class="ltn__about-us-area aboutUs_1 pt-10 pb-50 ">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 align-self-center">
        <div class="imgWrap text-center">
          <img src="{{$blockPhoto}}" class="img-fluid"/>
        </div>
      </div>
      <div class="col-lg-6 align-self-center">
        <div class="about_info">
          <div class="section-title-area ltn__section-title-2--- mb-30">
            <h6 class="section-subtitle section-subtitle-2--- ltn__secondary-color updateFont">{{getLangData($schema, 'h6')}}</h6>
            <h3 class="updateFont">{{getLangData($schema, 'h1')}}</h3>
            <div>
              {{getLangData($schema, 'des')}}
            </div>
          </div>

          @foreach($block->schema['items']  as $item)
            <div class="ltn__feature-item feature_item">
              <div class="ltn__feature-info">
                <h4 class="title updateFont">{{getLangData($item, 'h1')}}</h4>
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

@push('stackStyle')
  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/builder/about_us.css',$cssMinifyType,$cssReBuild) !!}
@endpush