@if(isset($pageView['cta_footer']) and $pageView['cta_footer'] == true )
  <div class="ltn__call-to-action-area call-to-action-6 before-bg-bottom" data-bs-bg="img/1.jpg--">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg position-relative text-center---">
            <div class="coll-to-info text-color-white">
              <h1 class="updateFont">{{__('web/def.footer.cta_h1')}}</h1>
              <p>{{__('web/def.footer.cta_p')}}</p>
            </div>
            <div class="btn-wrapper">
              <a class="btn btn-effect-3 btn-white updateFont" href="{{$pageView['cta_footer_slug'] ?? '#'}}">
                {{__('web/def.footer.cta_btn')}}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endif
