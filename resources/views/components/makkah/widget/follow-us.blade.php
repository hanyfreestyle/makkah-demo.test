<div class="widget ltn__social-media-widget">
  <h4 class="ltn__widget-title ltn__widget-title-border-2 updateFont">{{__('web/def.widget.follow_us')}}</h4>
  <x-makkah.def.social-media type="mobile" :web-config="$webConfig"/>
  <div class="widget_cta_btn">
    <a href="{{ctaActionWhatsapp($webConfig)}}" target="_blank" class="btn whatsapp updateFont">
      <i class="fab fa-whatsapp"></i> {{__('default/lang.cta.whatsapp')}}
    </a>
    <a href="{{ctaActionMap($webConfig)}}" target="_blank" class="btn map updateFont">
      <i class="fas fa-map"></i> {{__('default/lang.cta.map')}}
    </a>
  </div>
</div>