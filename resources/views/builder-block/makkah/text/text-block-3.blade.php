<div class="ltn__about-us-area aboutUs_1 chairMan mt-50 pt-10 pb-30 ">
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center">

      <div class="col-lg-6 align-self-center">
        <div class="about_info">
          <div class="section-title-area ltn__section-title-2--- mb-30">
            <h6 class="section-subtitle section-subtitle-2--- ltn__secondary-color updateFont">{{getLangData($schema, 'h6')}}</h6>
            <h3 class="updateFont">{{getLangData($schema, 'h1')}}</h3>
            <div>
              {{getLangData($schema, 'des')}}
            </div>
          </div>


        </div>
      </div>
      <div class="col-lg-1 align-self-center"></div>
      <div class="col-lg-3 align-self-center">
        <div class="imgWrap text-center">
          <img src="{{$blockPhoto}}" class="img-fluid"/>
        </div>
      </div>
    </div>
  </div>
</div>
<hr>

@push('stackStyle')
  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/builder/about_us.css',$cssMinifyType,$cssReBuild) !!}
@endpush