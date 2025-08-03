<div class="ltn__call-to-action-area ltn__call-to-action-4 bg-image mt-120 pt-115 pb-120 mb-120" data-bs-bg="{{ asset('makkah/img/cta-bg.jpg') }}">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="call-to-action-inner call-to-action-inner-4 text-center">
          <div class="section-title-area ltn__section-title-2">
            <h6 class="section-subtitle ltn__secondary-color updateFont">{{getLangData($schema, 'h1')}}</h6>
            <h1 class="section-title white-color">{{getLangData($schema, 'number')}}</h1>
          </div>
          <div class="btn-wrapper">
            <a href="{{ctaActionCall($webConfig)}}" class="theme-btn-1 btn btn-effect-1 updateFont">{{getLangData($schema, 'btn')}}</a>
            <a href="{{ctaActionWhatsapp($webConfig)}}" class="btn btn-transparent btn-effect-4 white-color updateFont">{{getLangData($schema, 'btn2')}}</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ltn__call-to-4-img-2">
    <img src="{{ asset('makkah/img/cta-agent.png') }}" alt="#">
  </div>
</div>